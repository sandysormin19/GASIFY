@extends('layouts.app')

@section('content')

<!-- CDN Tailwind & AOS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Custom Animasi -->
<style>
@keyframes wiggle {
    0%, 100% { transform: rotate(-3deg); }
    50% { transform: rotate(3deg); }
}
.animate-wiggle {
    animation: wiggle 1.5s infinite;
}
</style>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-green-50 to-white py-20 px-6 md:px-16">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12">
        <!-- Text -->
        <div class="md:w-1/2 space-y-6" data-aos="fade-right">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Pesan Gas LPG <span class="text-green-600">dengan Mudah</span>
            </h1>
            <p class="text-lg text-gray-600">
                Dapatkan gas LPG diantar langsung ke rumah Anda dengan cepat dan terpercaya.
            </p>
            <a href="{{ route('order.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300">
                Pesan Sekarang
            </a>
        </div>

        <!-- Image -->
        <div class="md:w-1/2" data-aos="fade-left">
            <img src="{{ asset('admin/images/Home/deliverygas.jpg') }}" alt="Ilustrasi Gas" class="w-full max-w-md mx-auto rounded-xl drop-shadow-xl hover:scale-105 transition-transform duration-300">
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="py-24 px-6 bg-white">
    <div class="text-center mb-14" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
            Mengapa Memilih <span class="text-green-600">Gasify</span>?
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto" data-aos="zoom-in-up">
        <!-- Card 1 -->
        <div class="bg-green-50 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
            <img src="{{ asset('admin/images/Home/timer.jpg') }}" alt="Cepat" class="w-16 mx-auto mb-4 animate-bounce">
            <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
            <p class="text-gray-600">Pesanan gas diantar cepat dan tepat waktu</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-green-50 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
            <img src="{{ asset('admin/images/Home/wallet.jpg') }}" alt="Pembayaran" class="w-16 mx-auto mb-4 animate-pulse">
            <h3 class="text-xl font-semibold mb-2">Pembayaran Mudah</h3>
            <p class="text-gray-600">Terima berbagai metode pembayaran digital</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-green-50 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
            <img src="{{ asset('admin/images/Home/tabunggas.jpg') }}" alt="Luas" class="w-16 mx-auto mb-4 animate-wiggle">
            <h3 class="text-xl font-semibold mb-2">Jangkauan Luas</h3>
            <p class="text-gray-600">Layanan tersedia di berbagai area dan lokasi</p>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="py-20 bg-green-50 px-6" data-aos="fade-up">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-10">Testimoni Pelanggan</h2>
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <img src="{{ asset('admin/images/Home/user-avatar.png') }}" alt="Budi" class="w-20 h-20 mx-auto rounded-full mb-4 border-4 border-green-600">
            <p class="text-gray-600 italic">“Layanannya sangat memuaskan! Gas datang tepat waktu dan pemesanannya sangat mudah.”</p>
            <p class="mt-4 font-semibold text-gray-800">– Budi</p>
        </div>
    </div>
</section>

<!-- AOS Init -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

@endsection
