<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;

class OrderController extends Controller
{
    public function create()
    {
        $stok3kg = Stock::where('type', '3kg')->value('quantity') ?? 0;
        $stok12kg = Stock::where('type', '12kg')->value('quantity') ?? 0;

        return view('pages.order')->with([
            'stok3kg' => $stok3kg,
            'stok12kg' => $stok12kg,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty_3kg' => 'required|integer|min:0',
            'qty_12kg' => 'required|integer|min:0',
            'payment_method' => 'required',
            'address' => 'required|string|max:255',
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

        // Kurangi stok
        if ($request->qty_3kg > 0) {
            $stok3kg->decrement('quantity', $request->qty_3kg);
        }

        if ($request->qty_12kg > 0) {
            $stok12kg->decrement('quantity', $request->qty_12kg);
        }

        Order::create([
            'user_id' => auth()->id(),
            'qty_3kg' => $request->qty_3kg,
            'qty_12kg' => $request->qty_12kg,
            'payment_method' => $request->payment_method,
            'address' => $request->address,
            'created_at' => now(),
        ]);

        // TODO: Notifikasi ke admin di sini

        return redirect()->route('order.history')->with('success', 'Pesanan berhasil!');
    }

    public function history()
    {
        $orders = Order::orderByDesc('created_at')->get();
        return view('pages.order-history', compact('orders'));
    }
}
