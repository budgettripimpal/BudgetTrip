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
    public function checkout(PlanItem $planItem)
    {
        // 1. Validasi: Hanya item dengan brand "Budgettrip" yang bisa dibayar
        if (!str_contains(strtolower($planItem->providerName), 'budgettrip')) {
            return back()->with('error', 'Item ini tidak mendukung pembayaran langsung.');
        }

        // 2. Cek apakah sudah ada order untuk item ini
        $order = Order::where('plan_item_id', $planItem->planItemID)
            ->where('status', 'unpaid')
            ->first();

        // Jika belum ada, buat order baru
        if (!$order) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'plan_item_id' => $planItem->planItemID,
                'order_number' => 'TRIP-' . uniqid() . '-' . $planItem->planItemID,
                'total_price' => $planItem->estimatedCost, // Harga * Quantity (sudah dihitung di TravelPlanController)
                'status' => 'unpaid',
            ]);
        }

        // 3. Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY'));
        Config::$isProduction = config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        Config::$isSanitized = config('services.midtrans.is_sanitized', env('MIDTRANS_IS_SANITIZED', true));
        Config::$is3ds = config('services.midtrans.is_3ds', env('MIDTRANS_IS_3DS', true));

        // 4. Buat Parameter Transaksi Midtrans
        $unitName = $planItem->itemType == 'Akomodasi' ? 'Kamar/Malam' : 'Tiket';
        
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
                    'price' => (int) ($planItem->estimatedCost / $planItem->quantity),
                    'quantity' => $planItem->quantity,
                    'name' => substr($planItem->description, 0, 50), // Midtrans limit nama item 50 char
                ]
            ]
        ];

        // 5. Dapatkan Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan token ke database agar tidak generate ulang terus
            $order->update(['snap_token' => $snapToken]);

            // Kembali ke halaman manage plan dengan membawa token
            return back()->with('snapToken', $snapToken);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        // Simulasi sukses: Update status order jadi 'paid'
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if ($order) {
            $order->update(['status' => 'paid']);
            
            // Redirect kembali ke halaman manage plan itinerary terkait
            return redirect()->route('travel-plan.manage', $order->planItem->itinerary->planID)
                ->with('success', 'Pembayaran Berhasil! E-Tiket telah diterbitkan.');
        }

        return redirect()->route('dashboard')->with('error', 'Transaksi tidak ditemukan.');
    }
}