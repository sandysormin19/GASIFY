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

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                // Set session manual
                session(['is_admin' => true, 'admin_id' => $admin->_id, 'admin_name' => $admin->name]);
                AdminLogin::create([
                    'admin_id'   => $admin->_id,
                    'admin_name' => $admin->name,
                    'email'      => $admin->email,
                    'ip_address' => $request->ip(),
                    'login_at'   => now(),
                ]);
                return redirect('/admin/dashboard');
            }

            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        return view('admin.login');
    }

   // public function register(Request $request)
  //  {
 //    if ($request->isMethod('post')) {
//      $request->validate([
//        'name' => 'required|string|max:255',
 //      'email' => 'required|email|unique:admins,email',
   //    'password' => 'required|string|min:6|confirmed',
  // ]);
 // Admin::create([
//   'name' => $request->name,
// 'email' => $request->email,
 //'password' => Hash::make($request->password),
//]);

      //      return redirect('/admin/login')->with('success', 'Akun admin berhasil dibuat.');
      //  }

    //    return view('admin.register');
  //  }

    public function logout(Request $request)
    {
        // Hapus session manual
        $request->session()->forget(['is_admin', 'admin_id', 'admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
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
