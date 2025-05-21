<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;

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



Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/order', function () {
    return view('pages.order');
})->name('order');

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

    //User register route
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');

    //Dashboard user setelah login
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    });


// Tampilkan form login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
Route::match(['get', 'post'], 'dashboard',[AdminController::class,'dashboard']);
Route::match(['get', 'post'], 'login',[AdminController::class,'login']);
Route::match(['get', 'post'], 'register',[AdminController::class,'register']);
});