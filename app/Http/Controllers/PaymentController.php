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

    public function checkout(Request $request, PlanItem $planItem)
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

        if (empty(Config::$serverKey)) {
            return back()->with('error', 'Server Key Midtrans kosong. Cek .env Anda.');
        }

        // 4. Order
        $order = Order::updateOrCreate(
            ['plan_item_id' => $planItem->planItemID],
            [
                'user_id' => Auth::id(),
                'order_number' => 'TRIP-' . uniqid() . '-' . $planItem->planItemID,
                'total_price' => $grossAmount,
                'status' => 'unpaid',
                'origin' => $request->input('origin', 'manage'),
            ]
        );


        // 5. Parameter Snap
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

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->snap_token = $snapToken;
            $order->save();

            return back()->with([
                'snapToken'   => $snapToken,
                'snapOrigin' => $request->input('origin', 'manage'),
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function success(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->first();

        if ($order) {
            $order->update(['status' => 'paid']);
            $planItem = $order->planItem;

            // CEK BRAND BUDGETTRIP
            // Menggunakan helper Str untuk mengecek apakah providerName mengandung kata 'budgettrip'
            $isBudgettrip = \Illuminate\Support\Str::contains(strtolower($planItem->providerName), 'budgettrip');

            if ($isBudgettrip && empty($planItem->ticket_code)) {

                // 1. GENERATE KODE UNIK (Booking ID / Ticket ID)
                // Kode ini wajib ada karena dipakai di tampilan tiket sebagai "Booking Ref"
                $planItem->ticket_code = 'BGT-' . strtoupper(uniqid()) . '-' . $planItem->planItemID;
                
                $planItem->save();
            }

            $origin = $order->origin ?? 'manage';

            if ($origin === 'overview') {
                return redirect()
                    ->route('travel-plan.overview', $planItem->itinerary->planID)
                    ->with('success', 'Pembayaran Berhasil! Tiket/Voucher telah diterbitkan.');
            }

            return redirect()
                ->route('travel-plan.manage', $planItem->itinerary->planID)
                ->with('success', 'Pembayaran Berhasil! Tiket/Voucher telah diterbitkan.');
        }

        return redirect()->route('dashboard')->with('error', 'Transaksi tidak ditemukan.');
    }
}
