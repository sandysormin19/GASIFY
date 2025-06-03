<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Pastikan use statement ini ada dan benar
use App\Models\Admin;
use App\Models\Stock;
use App\Models\Order;

class AdminController extends Controller
{

    public function dashboard()
    {
        $stocks = Stock::all(); // Tetap ambil stok untuk ditampilkan di ringkasan dashboard jika perlu
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $orderList = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact('stocks', 'totalOrders', 'totalRevenue', 'orderList'));
    }

    // Method baru untuk menampilkan halaman manajemen stok
    public function manageStock()
    {
        $types = ['3kg', '12kg']; // Definisikan tipe gas utama Anda di sini
        // Anda bisa menambahkan tipe lain seperti '5.5kg', 'Bright Gas', dll. jika ada

        foreach ($types as $type) {
            Stock::firstOrCreate(
                ['type' => $type],
                ['quantity' => 0, 'price' => 0] // Inisialisasi dengan kuantitas 0 dan harga 0 jika belum ada
            );
        }

        $stocks = Stock::orderBy('type')->get(); // Ambil semua stok, urutkan berdasarkan tipe
        return view('admin.stok.index', compact('stocks'));
    }

    public function updateStok(Request $request)
    {
        $request->validate([
            'stok.*.quantity' => 'required|integer|min:0',
            'stok.*.price' => 'required|integer|min:0',
        ]);

        foreach ($request->input('stok') as $type => $data) {
            Stock::updateOrCreate(
                ['type' => $type],
                [
                    'quantity' => (int) $data['quantity'],
                    'price' => (int) $data['price']
                ]
            );
        }
        // Redirect kembali ke halaman manajemen stok dengan pesan sukses
        return redirect()->route('admin.stok.index')->with('success', 'Stok dan harga berhasil diperbarui.');
    }

    // ... (method login dan lainnya jika ada)
}