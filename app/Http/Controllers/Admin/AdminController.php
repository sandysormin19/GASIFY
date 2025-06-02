<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Stock;
use App\Models\AdminLogin;
use App\Models\Order;

class AdminController extends Controller
{

    public function dashboard()
    {
        $stocks = Stock::all();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $orderList = Order::latest()->take(10)->get(); // 10 order terbaru

        return view('admin.dashboard', compact('stocks', 'totalOrders', 'totalRevenue', 'orderList'));
    }

    public function stok()
    {
        $types = ['3kg', '12kg'];
        foreach ($types as $type) {
            Stock::firstOrCreate(
                ['type' => $type],
                ['quantity' => 0] // pastikan 0 adalah integer, bukan string '0'
            );
        }

       // $stok = Stock::all();
       // return view('admin.stok', compact('stok'));
    }

    public function updateStok(Request $request)
    {
        foreach ($request->input('stok') as $type => $data) {
            Stock::updateOrCreate(
                ['type' => $type],
                [
                    'quantity' => (int) $data['quantity'],
                    'price' => (int) $data['price']
                ]
            );
        }

        return back()->with('success', 'Stok dan harga diperbarui.');
    }

}
