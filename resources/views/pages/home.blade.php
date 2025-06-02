@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<style>
@keyframes wiggle {
    0%, 100% {
    transform: rotate(-3deg);
    }
    50% {
    transform: rotate(3deg);
    }
}
.animate-wiggle {
    animation: wiggle 1.5s infinite;
}

/* Decorative floating shapes */
.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
    animation: floatUpDown 6s ease-in-out infinite;
    pointer-events: none;
}
@keyframes floatUpDown {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

/* Accordion styles */
.accordion-button {
    cursor: pointer;
}
</style>

<!-- Decorative floating shapes -->
<div aria-hidden="true">
  <div class="floating-shape bg-green-200 w-24 h-24 top-10 left-10" style="animation-delay: 0s;"></div>
  <div class="floating-shape bg-green-300 w-32 h-32 bottom-20 right-20" style="animation-delay: 3s;"></div>
  <div class="floating-shape bg-green-100 w-16 h-16 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="animation-delay: 1.5s;"></div>
</div>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-green-50 to-white py-20 px-6 md:px-16 overflow-hidden">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12 relative z-10">
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
      <img src="{{ asset('admin/images/Home/deliverygas.jpg') }}" alt="Ilustrasi Gas" class="w-full max-w-md mx-auto rounded-xl drop-shadow-xl hover:scale-105 transition-transform duration-300 animate-wiggle" />
    </div>
  </div>
</section>

<!-- Order Tools Section (Replaces Kenapa Pilih Gasify) -->
<section class="py-20 px-6 bg-green-50" data-aos="fade-up">
  <div class="max-w-6xl mx-auto text-center mb-14">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Fitur <span class="text-green-600">Gasify</span></h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">Gunakan fitur praktis kami untuk pengalaman yang lebih mudah dan cepat.</p>
  </div>
  <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Order History -->
    <a href="{{ route('pages.order-history') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <h3 class="text-xl font-semibold mb-2 text-gray-800">Riwayat Pemesanan</h3>
      <p class="text-gray-600">Cek riwayat pemesanan Anda secara praktis & detail.</p>
    </a>
    <!-- Track Courier -->
    <a href="{{ route('pages.order-history') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c2.21 0 4 1.79 4 4 0 3.53-4 8-4 8s-4-4.47-4-8c0-2.21 1.79-4 4-4zM12 12a2 2 0 100-4 2 2 0 000 4zm0 10c-4.418 0-8-1.79-8-4v-1c0-.552.448-1 1-1h14c.552 0 1 .448 1 1v1c0 2.21-3.582 4-8 4z"/>
      </svg>
      <h3 class="text-xl font-semibold mb-2 text-gray-800">Lacak Kurir</h3>
      <p class="text-gray-600">Lihat posisi kurir Anda secara real-time dan akurat.</p>
    </a>
    
  </div>
</section>

<!-- FAQ Section -->
<section class="py-20 px-6 bg-gray-50">
  <div class="max-w-6xl mx-auto text-center mb-14" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Pertanyaan <span class="text-green-600">Umum (FAQ)</span></h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">Temukan jawaban atas pertanyaan yang sering diajukan.</p>
  </div>
  <div class="max-w-3xl mx-auto" data-aos="fade-up">
    <div x-data="{ openIndex: null }" class="space-y-4">
      @php
          $faqs = [
          ['q' => 'Bagaimana cara memesan gas?', 'a' => 'Anda dapat memesan gas melalui tombol "Pesan Sekarang" di halaman utama, pilih produk dan isi data pengiriman.'],
          ['q' => 'Berapa lama waktu pengiriman?', 'a' => 'Pengiriman biasanya berlangsung dalam 2-3 jam setelah konfirmasi pembayaran.'],
          ['q' => 'Apakah pembayaran bisa dilakukan secara COD?', 'a' => 'Saat ini pembayaran dilakukan secara online melalui metode yang tersedia.'],
          ['q' => 'Apakah gas yang dikirim aman?', 'a' => 'Kami menjamin keamanan produk dengan standar kualitas yang ketat dan pengecekan rutin.'],
          ];
      @endphp
      @foreach ($faqs as $index => $faq)
      <div>
        <button
          class="accordion-button w-full text-left bg-white rounded-lg p-4 shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-600"
          @click="openIndex === {{ $index }} ? openIndex = null : openIndex = {{ $index }}">
          <div class="flex justify-between items-center">
            <span class="font-semibold text-gray-800">{{ $faq['q'] }}</span>
            <svg
              :class="{ 'transform rotate-180': openIndex === {{ $index }} }"
              class="w-6 h-6 text-green-600 transition-transform duration-300"
              fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
        </button>
        <div
          x-show="openIndex === {{ $index }}"
          x-transition
          class="mt-2 px-4 text-gray-700 bg-white rounded-b-lg shadow-inner overflow-hidden">
          {{ $faq['a'] }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Promo Section -->
<section class="py-20 px-6 bg-white" data-aos="fade-up">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Promo <span class="text-green-600">Spesial</span></h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">Dapatkan penawaran menarik dan diskon terbatas dari Gasify!</p>
  </div>
  <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @php
      $promos = [
        [
          'title' => 'Diskon 10% untuk Pengguna Baru',
          'desc' => 'Gunakan kode GASBARU saat checkout untuk menikmati potongan harga.',
        ],
        [
          'title' => 'Gratis Ongkir untuk Pemesanan di Atas Rp150.000',
          'desc' => 'Nikmati pengiriman gratis tanpa minimum kuota tambahan!',
        ],
        [
          'title' => 'Cashback 5% untuk Pembayaran via E-Wallet',
          'desc' => 'Bayar dengan OVO, DANA, atau GoPay dan dapatkan cashback langsung.',
        ],
      ];
    @endphp
    @foreach ($promos as $promo)
    <div class="bg-green-50 rounded-xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-xl font-semibold text-green-700 mb-2">{{ $promo['title'] }}</h3>
      <p class="text-gray-700">{{ $promo['desc'] }}</p>
    </div>
    @endforeach
  </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
  });
</script>

@endsection
