<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create()
    {
        return view('pages.order'); // Sesuaikan dengan letak file order.blade.php
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

        Order::create([
            'user_id' => auth()->id() ?? null, // jika kamu punya sistem login
            'qty_3kg' => $request->qty_3kg,
            'qty_12kg' => $request->qty_12kg,
            'payment_method' => $request->payment_method,
            'address' => $request->address,
            'created_at' => now(),
        ]);

        return redirect()->route('order.history')->with('success', 'Pesanan berhasil!');
    }

    public function history()
    {
        $orders = Order::orderByDesc('created_at')->get();
        return view('pages.order-history', compact('orders'));
    }
}
