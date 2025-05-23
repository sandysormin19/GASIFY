<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

// ==============================
// Halaman Umum
// ==============================
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

Route::get('/cara-kerja', function () {
    return view('pages.cara-kerja');
})->name('cara-kerja');

// ==============================
// Auth User (Login & Register)
// ==============================
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');

// ==============================
// Fitur Setelah Login User
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

    // Halaman Profil
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile')->middleware('auth');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update')->middleware('auth');

    // Fitur Order Gas
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order-history', [OrderController::class, 'history'])->name('pages.order-history');
});

// ==============================
// Admin Routes
// ==============================
Route::prefix('/admin')->group(function () {
    Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard']);
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
     Route::post('update-stok', [AdminController::class, 'updateStok'])->name('admin.stok.update'); 
    
    // Route::match(['get', 'post'], 'register', [AdminController::class, 'register']);
});

