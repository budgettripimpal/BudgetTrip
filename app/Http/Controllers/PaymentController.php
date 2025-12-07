<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PlanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    protected function configureMidtrans()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function checkout(PlanItem $planItem)
    {
        // 1. Validasi Brand
        if (!str_contains(strtolower($planItem->providerName), 'budgettrip')) {
            return back()->with('error', 'Hanya item Budgettrip yang bisa dibayar langsung.');
        }

        // 2. Hitung Harga 
        $pricePerItem = (int) round($planItem->estimatedCost / $planItem->quantity);
        $grossAmount = $pricePerItem * $planItem->quantity;

        // 3. Konfigurasi Midtrans
        $this->configureMidtrans();

        // Cek Server Key
        if (empty(Config::$serverKey)) {
            return back()->with('error', 'Server Key Midtrans kosong. Cek .env Anda.');
        }

        // 4. Buat/Cari Order
        // Gunakan updateOrCreate agar tidak duplikat order untuk item yang sama
        $order = Order::updateOrCreate(
            ['plan_item_id' => $planItem->planItemID],
            [
                'user_id' => Auth::id(),
                'order_number' => 'TRIP-' . uniqid() . '-' . $planItem->planItemID, // Order ID baru setiap klik
                'total_price' => $grossAmount,
                'status' => 'unpaid',
            ]
        );

        // 5. Siapkan Parameter Snap
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phoneNumber ?? '08123456789',
            ],
            'item_details' => [
                [
                    'id' => $planItem->planItemID,
                    'price' => $pricePerItem,
                    'quantity' => $planItem->quantity,
                    'name' => substr($planItem->description, 0, 50),
                ]
            ]
        ];

        // 6. Request Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan token ke DB
            $order->snap_token = $snapToken;
            $order->save();

            // Redirect dengan token
            return back()->with('snapToken', $snapToken);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->first();

        if ($order) {
            $order->update(['status' => 'paid']);
            
            return redirect()->route('travel-plan.manage', $order->planItem->itinerary->planID)
                ->with('success', 'Pembayaran Berhasil! Tiket/Voucher telah terbit.');
        }

        return redirect()->route('dashboard')->with('error', 'Transaksi tidak ditemukan.');
    }
}