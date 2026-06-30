<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        return view('checkout', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input kredensial Pelanggan 
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Cegah Checkout Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        // 3. Generate Kode TRX (Unik)
        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000; // Menambahkan biaya admin (dummy)

        // 4. Merekam Transaksi ke Database
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'pending', // Status awal transaksi
        ]);

        // --- INTEGRASI SNAP MIDTRANS ---
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->update(['snap_token' => $snapToken]);

            // 5. Kurangi stok tiket
            $event->decrement('stock');

            return redirect()->route('checkout.payment', $transaction->order_id);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran jaringan: ' . $e->getMessage());
        }
    }

    public function payment($order_id)
    {
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view('checkout.payment', compact('transaction', 'categories'));
    }

    public function success($order_id)
    {
        $categories = \App\Models\Category::all();

        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);

            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}
