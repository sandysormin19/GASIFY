<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourierLocationController;
use App\Http\Controllers\Admin\HomepageContentController; // <-- Tambahkan ini
use App\Models\HomepageContent; // <-- Tambahkan ini untuk mengambil data di route '/'

// ==============================
// Halaman Umum
// ==============================
Route::get('/', function () {
    // Ambil data dari HomepageContent untuk ditampilkan di home
    $hero = HomepageContent::where('section', 'hero')->where('is_active', true)->first();
    $orderToolsTitle = HomepageContent::where('section', 'order_tools_title')->where('is_active', true)->first();
    $orderTool1 = HomepageContent::where('section', 'order_tool_1')->where('is_active', true)->first();
    $orderTool2 = HomepageContent::where('section', 'order_tool_2')->where('is_active', true)->first();
    $faqTitle = HomepageContent::where('section', 'faq_title')->where('is_active', true)->first();
    $faqsData = HomepageContent::where('section', 'faqs')->where('is_active', true)->first();
    $promoTitle = HomepageContent::where('section', 'promo_title')->where('is_active', true)->first();
    $promosData = HomepageContent::where('section', 'promos')->where('is_active', true)->first();

    // Sediakan nilai default jika data null untuk menghindari error di view
    $defaultContent = ['title' => '', 'subtitle' => '', 'button_text' => '', 'button_url' => '', 'image_url' => ''];
    $defaultItemContent = ['title' => '', 'description' => '', 'url' => '', 'icon_svg_path' => ''];
    $defaultFaqPromoContent = [];

    return view('pages.home', [
        'hero' => $hero ?? (object)['is_active' => false, 'content' => $defaultContent],
        'orderToolsTitle' => $orderToolsTitle ?? (object)['is_active' => false, 'content' => $defaultContent],
        'orderTool1' => $orderTool1 ?? (object)['is_active' => false, 'content' => $defaultItemContent],
        'orderTool2' => $orderTool2 ?? (object)['is_active' => false, 'content' => $defaultItemContent],
        'faqTitle' => $faqTitle ?? (object)['is_active' => false, 'content' => $defaultContent],
        'faqsData' => $faqsData ?? (object)['is_active' => false, 'content' => $defaultFaqPromoContent],
        'promoTitle' => $promoTitle ?? (object)['is_active' => false, 'content' => $defaultContent],
        'promosData' => $promosData ?? (object)['is_active' => false, 'content' => $defaultFaqPromoContent],
    ]);
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
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile'); // Middleware 'auth' sudah ada di grup
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update'); // Middleware 'auth' sudah ada di grup

    // Fitur Order Gas
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // ✅ Tambahan Route untuk Halaman Order History
    Route::get('/order-history', [OrderController::class, 'history'])->name('pages.order-history');

    // ✅ Tambahan Route untuk Halaman Track Courier
   // Route::get('/track-courier', [CourierController::class, 'index'])->name('pages.track-courier');
});

Route::post('/api/courier-location', [CourierLocationController::class, 'updateLocation']);
Route::get('/api/courier-location/{orderId}', [CourierLocationController::class, 'getLocationByOrder']);


// ==============================
// Admin Routes
// ==============================
// Anda mungkin perlu menambahkan middleware untuk otentikasi admin di sini,
// misalnya ->middleware(['auth', 'admin']) jika Anda memiliki middleware 'admin'
Route::prefix('admin')->name('admin.')->group(function () {
        Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // Hapus route login admin dari sini jika sudah ada di luar middleware group
        // Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
        // Route untuk menampilkan halaman manajemen stok
        Route::get('stok', [AdminController::class, 'manageStock'])->name('stok.index');
        // Route untuk memproses update stok (ini seharusnya sudah ada)
        Route::post('update-stok', [AdminController::class, 'updateStok'])->name('stok.update');
        // Route untuk edit homepage content
        Route::get('/homepage/edit', [HomepageContentController::class, 'edit'])->name('homepage.edit');
        Route::post('/homepage/update', [HomepageContentController::class, 'update'])->name('homepage.update');
    // });


    // Route::match(['get', 'post'], 'register', [AdminController::class, 'register']); // Biasanya admin tidak register sendiri
});