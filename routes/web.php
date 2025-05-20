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
    return view('pages.login');
})->name('login');

Route::get('/pesan', function () {
    // Bisa arahkan ke halaman form pemesanan atau home lagi
    return view('pages.order'); // Pastikan file `order.blade.php` ada
})->name('order');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);

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