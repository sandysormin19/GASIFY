<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;

class OrderController extends Controller
{
    public function checkout($orderId)
    {
        $order = Order::where('_id', $orderId)->where('user_id', auth()->id())->firstOrFail();

        return view('pages.checkout', [
            'snapToken' => $order->snap_token
        ]);
    }
    public function create()
    {
        $stok3kg = Stock::where('type', '3kg')->first();
        $stok12kg = Stock::where('type', '12kg')->first();

        return view('pages.order')->with([
            'stok3kg' => $stok3kg->quantity ?? 0,
            'stok12kg' => $stok12kg->quantity ?? 0,
            'harga3kg' => $stok3kg->price ?? 0,
            'harga12kg' => $stok12kg->price ?? 0,
        ]);
    }

public function history()
{
    $orders = \App\Models\Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

    return view('pages.order-history', compact('orders'));
}


    public function store(Request $request)
    {
        $request->validate([
            'qty_3kg' => 'required|integer|min:0',
            'qty_12kg' => 'required|integer|min:0',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'delivery_lat' => 'required|numeric',
            'delivery_lng' => 'required|numeric',

        ]);

        if ($request->qty_3kg == 0 && $request->qty_12kg == 0) {
            return back()->withErrors(['message' => 'Minimal harus pesan salah satu jenis gas.'])->withInput();
        }

        $stok3kg = Stock::where('type', '3kg')->first();
        $stok12kg = Stock::where('type', '12kg')->first();

        if (
            ($request->qty_3kg > 0 && (!$stok3kg || $stok3kg->quantity < $request->qty_3kg)) ||
            ($request->qty_12kg > 0 && (!$stok12kg || $stok12kg->quantity < $request->qty_12kg))
        ) {
            return back()->withErrors(['message' => 'Jumlah melebihi stok.'])->withInput();
        }

        // Hitung total harga
        $total_price = ($request->qty_3kg * ($stok3kg->price ?? 0)) +
                    ($request->qty_12kg * ($stok12kg->price ?? 0));

        // Kurangi stok
        if ($request->qty_3kg > 0) {
            $stok3kg->decrement('quantity', $request->qty_3kg);
        }
        if ($request->qty_12kg > 0) {
            $stok12kg->decrement('quantity', $request->qty_12kg);
        }

      $order =  Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'qty_3kg' => $request->qty_3kg,
            'qty_12kg' => $request->qty_12kg,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'total_price' => $total_price,
            'created_at' => now(),
            //Punya kurir
            'courier_id' => 1,
            // Lokasi pengiriman
            'delivery_lat' => $request->delivery_lat,
            'delivery_lng' => $request->delivery_lng,
            'payment_status' => 'paid',
        ]);
                // Set up Midtrans configuration
          \Midtrans\Config::$serverKey = 'SB-Mid-server-yic6Mo0_JVykupsMYm9Mo3mT';
          \Midtrans\Config::$clientKey = 'SB-Mid-client-06O2KMZui7WkqN23';
          \Midtrans\Config::$isProduction = false;
          \Midtrans\Config::$isSanitized = true;
          \Midtrans\Config::$is3ds = true;
          // Gunakan URL aplikasi Anda sendiri untuk callback
          \Midtrans\Config::$appendNotifUrl = url('/api/midtrans/notification');
          \Midtrans\Config::$overrideNotifUrl = url('/api/midtrans/notification');

          $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $total_price,
            ],
            'enabled_payments' => ['gopay', 'qris', 'bank_transfer'],
        ];
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Midtrans error: ' . $e->getMessage()]);
        }

        $order->snap_token = $snapToken;
        $order->save();
        // TODO: Notifikasi ke admin
        return redirect()->route('order.checkout', $order->_id);
        //return redirect()->route('pages.order-history')->with('success', 'Pesanan berhasil!');
    }
}
