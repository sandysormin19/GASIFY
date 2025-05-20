<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// Halaman Utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman Tentang
Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

// Halaman Cara Kerja
Route::get('/cara-kerja', function () {
    return view('pages.cara-kerja');
})->name('cara-kerja');

// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/order', function () {
    return view('pages.order');
})->name('order');

<<<<<<< HEAD
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
=======
Route::post('/order', function (\Illuminate\Http\Request $request) {
    // Validasi dan simpan pesanan
    $request->validate([
        'qty_3kg' => 'required|integer|min:0',
        'qty_12kg' => 'required|integer|min:0',
        'payment_method' => 'required',
        'address' => 'required|string',
    ]);

    return redirect()->route('order')->with('success', 'Pesanan berhasil dibuat!');
})->name('order.store');

>>>>>>> 395c29333a6ebae1f5f03f1b4ccac57813937058

    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminController::class, 'register']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
Route::match(['get', 'post'], 'dashboard',[AdminController::class,'dashboard']);
Route::match(['get', 'post'], 'login',[AdminController::class,'login']);
Route::match(['get', 'post'], 'register',[AdminController::class,'register']);
});