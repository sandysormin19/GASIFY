@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
@keyframes wiggle { 0%, 100% { transform: rotate(-3deg); } 50% { transform: rotate(3deg); } }
.animate-wiggle { animation: wiggle 1.5s infinite; }
</style>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-green-50 to-white py-20 px-6 md:px-16">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12">
    <div class="md:w-1/2 space-y-6" data-aos="fade-right">
      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
        Pesan Gas LPG <span class="text-green-600">dengan Mudah</span>
      </h1>
      <p class="text-lg text-gray-600">Gasify hadir untuk kenyamanan rumah Anda. Tinggal klik, gas langsung sampai!</p>
      <a href="{{ route('order.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300">
        Pesan Sekarang
      </a>
    </div>
    <div class="md:w-1/2" data-aos="fade-left">
      <img src="{{ asset('admin/images/Home/deliverygas.jpg') }}" alt="Ilustrasi Gas" class="w-full max-w-md mx-auto rounded-xl drop-shadow-xl hover:scale-105 transition-transform duration-300 animate-wiggle">
    </div>
  </div>
</section>

<!-- Lifestyle Section (Replaced Why Choose Section) -->
<section class="py-20 px-6 bg-white">
  <div class="text-center mb-14" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Hidup Nyaman <span class="text-green-600">Bersama Gasify</span></h2>
    <p class="text-gray-500 mt-2">Lebih dari sekadar pengantaran — Gasify mendukung gaya hidup modern yang efisien dan aman.</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto" data-aos="zoom-in-up">
    <div class="text-center p-6 bg-green-50 rounded-lg shadow hover:bg-green-100">
      <i class="fas fa-clock text-4xl text-green-600 mb-4"></i>
      <h4 class="font-semibold text-lg">Efisiensi Waktu</h4>
      <p class="text-gray-600 mt-2">Waktu Anda berharga — kami antar gas dengan cepat & tepat waktu.</p>
    </div>
    <div class="text-center p-6 bg-green-50 rounded-lg shadow hover:bg-green-100">
      <i class="fas fa-home text-4xl text-green-600 mb-4"></i>
      <h4 class="font-semibold text-lg">Kenyamanan Rumah</h4>
      <p class="text-gray-600 mt-2">Nikmati layanan praktis dari rumah tanpa perlu keluar.</p>
    </div>
    <div class="text-center p-6 bg-green-50 rounded-lg shadow hover:bg-green-100">
      <i class="fas fa-heart text-4xl text-green-600 mb-4"></i>
      <h4 class="font-semibold text-lg">Untuk Keluarga Tercinta</h4>
      <p class="text-gray-600 mt-2">Keamanan & keandalan kami menjaga kenyamanan orang-orang terkasih Anda.</p>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="py-20 px-6 bg-gray-50">
  <div class="text-center mb-14" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Fitur <span class="text-green-600">Gasify</span></h2>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto" data-aos="zoom-in-up">
    <!-- Order History -->
    <a href="{{ route('order-history') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <h3 class="text-xl font-semibold mb-2 text-gray-800">Riwayat Pemesanan</h3>
      <p class="text-gray-600">Cek riwayat pemesanan Anda secara praktis & detail.</p>
    </a>
    <!-- Track Courier -->
    <a href="{{ route('track-courier') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c2.21 0 4 1.79 4 4 0 3.53-4 8-4 8s-4-4.47-4-8c0-2.21 1.79-4 4-4zM12 12a2 2 0 100-4 2 2 0 000 4zm0 10c-4.418 0-8-1.79-8-4v-1c0-.552.448-1 1-1h14c.552 0 1 .448 1 1v1c0 2.21-3.582 4-8 4z"/>
      </svg>
      <h3 class="text-xl font-semibold mb-2">Lacak Kurir</h3>
      <p class="text-gray-600">Lihat posisi kurir Anda secara real-time dan akurat.</p>
    </a>
  </div>
</section>

<!-- Testimonial Section -->
<section class="py-20 px-6 bg-white">
  <div class="text-center mb-14" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Apa Kata Pelanggan?</h2>
  </div>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto" data-aos="fade-up">
    @foreach (range(1,3) as $i)
    <div class="bg-green-50 p-6 rounded-xl shadow hover:shadow-lg transition">
      <p class="text-gray-700 italic">"Gasify sangat membantu saya! Tidak perlu repot keluar rumah."</p>
      <div class="flex items-center gap-3 mt-4">
        <img src="https://i.pravatar.cc/50?img={{ $i }}" class="w-10 h-10 rounded-full" alt="User {{ $i }}">
        <div>
          <h4 class="font-bold text-sm text-gray-800">Pelanggan {{ $i }}</h4>
          <p class="text-gray-500 text-xs">User Terverifikasi</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: true });</script>

@endsection
