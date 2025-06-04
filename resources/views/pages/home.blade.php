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

<div aria-hidden="true">
  <div class="floating-shape bg-green-200 w-24 h-24 top-10 left-10" style="animation-delay: 0s;"></div>
  <div class="floating-shape bg-green-300 w-32 h-32 bottom-20 right-20" style="animation-delay: 3s;"></div>
  <div class="floating-shape bg-green-100 w-16 h-16 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="animation-delay: 1.5s;"></div>
</div>

@if($hero && $hero->is_active && isset($hero->content))
<section class="relative bg-gradient-to-br from-green-50 to-white py-20 px-6 md:px-16 overflow-hidden">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12 relative z-10">
    <div class="md:w-1/2 space-y-6" data-aos="fade-right">
      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
        {!! $hero->content['title'] ?? 'Pesan Gas LPG <span class="text-green-600">dengan Mudah</span>' !!}
      </h1>
      <p class="text-lg text-gray-600">{{ $hero->content['subtitle'] ?? 'Gasify hadir untuk kenyamanan rumah Anda. Tinggal klik, gas langsung sampai!' }}</p>
      <a href="{{ $hero->content['button_url'] ? url($hero->content['button_url']) : route('order.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300">
        {{ $hero->content['button_text'] ?? 'Pesan Sekarang' }}
      </a>
    </div>
    <div class="md:w-1/2" data-aos="fade-left">
      <img src="{{ $hero->content['image_url'] ? (Str::startsWith($hero->content['image_url'], 'http') ? $hero->content['image_url'] : asset($hero->content['image_url'])) : asset('admin/images/Home/deliverygas.jpg') }}" alt="Ilustrasi Gas" class="w-full max-w-md mx-auto rounded-xl drop-shadow-xl hover:scale-105 transition-transform duration-300 animate-wiggle" />
    </div>
  </div>
</section>
@endif

@if(isset($priceCatalogStocks) && $priceCatalogStocks->isNotEmpty())
<section class="py-16 px-6 bg-gray-50" data-aos="fade-up">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
      Katalog <span class="text-green-600">Harga Gas</span> Kami
    </h2>
    <p class="text-gray-600 mt-3 max-w-xl mx-auto">
      Temukan harga terbaik untuk kebutuhan gas LPG Anda. Harga dapat berubah sewaktu-waktu.
    </p>
  </div>

  {{-- TAMBAHKAN BLOK PHP UNTUK SORTING DI SINI --}}
  @php
    // Urutkan $priceCatalogStocks: 3kg dulu, lalu 12kg, lalu sisanya
    // Asumsi $stock->type adalah string seperti '3kg', '12kg'
    // Jika $stock->type adalah angka (misal 3, 12), sesuaikan logikanya
    $sortedStocks = $priceCatalogStocks->sortBy(function ($stock) {
        $type = strtolower(str_replace(' ', '', $stock->type)); // Normalisasi tipe: '3kg', '12kg'
        if ($type == '3kg') {
            return 0; // Urutan pertama
        } elseif ($type == '12kg') {
            return 1; // Urutan kedua
        } else {
            // Untuk tipe lain, bisa diurutkan berdasarkan nama tipe atau biarkan apa adanya
            // Misalnya, urutkan berdasarkan angka di tipe jika ada, atau abjad
            preg_match('/(\d+)/', $type, $matches);
            if (isset($matches[1])) {
                return 20 + (int)$matches[1]; // Beri bobot agar setelah 3kg dan 12kg
            }
            return 100; // Default untuk yang tidak cocok pola
        }
    });
  @endphp

  {{-- Gunakan $sortedStocks dalam loop --}}
  <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($sortedStocks as $stock) {{-- <--- UBAH KE $sortedStocks --}}
    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-shadow duration-300 flex flex-col items-center text-center transform hover:-translate-y-1">
      <div class="bg-green-100 p-4 rounded-full mb-4">
        <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.272a1 1 0 102 0V4.414l.707-.707A1 1 0 009 2H7zm0 0a1 1 0 00-1 1v.083c.09.032.178.074.26.125A1.001 1.001 0 007 15.5V16a1 1 0 102 0v-.5c0-.398-.236-.766-.607-.917A2.001 2.001 0 017 3.083V3a1 1 0 000-1zm4 0a1 1 0 00-1 1v.083c.09.032.178.074.26.125A1.001 1.001 0 0011 15.5V16a1 1 0 102 0v-.5c0-.398-.236-.766-.607-.917A2.001 2.001 0 0111 3.083V3a1 1 0 000-1zM5.05 8.05a1 1 0 10-1.414 1.414L2.293 10l1.343.657a1 1 0 001.414-1.414L3.707 8.5l1.343-.45zm9.9 0a1 1 0 00-1.414-.45L12.293 8.5l1.343.45a1 1 0 101.414-1.414L13.707 10l1.343-.657z" clip-rule="evenodd"></path><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm0 2a10 10 0 100-20 10 10 0 000 20z"></path></svg>
      </div>
      <h3 class="text-xl font-semibold text-green-700 mb-2">
        Gas LPG {{ $stock->type }}
      </h3>
      <p class="text-3xl font-extrabold text-gray-900 mb-1">
        Rp {{ number_format($stock->price, 0, ',', '.') }}
      </p>
      <p class="text-sm text-gray-500 mb-4">
        Per Tabung
      </p>
      <a href="{{ route('order.create') }}?type={{ $stock->type }}"
         class="mt-auto inline-block bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
        Pesan Sekarang
      </a>
    </div>
    @endforeach
  </div>
</section>
@endif

@if($orderToolsTitle && $orderToolsTitle->is_active && isset($orderToolsTitle->content))
<section class="py-20 px-6 bg-green-50" data-aos="fade-up">
  <div class="max-w-6xl mx-auto text-center mb-14">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">{!! $orderToolsTitle->content['title'] ?? 'Fitur <span class="text-green-600">Gasify</span>' !!}</h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">{{ $orderToolsTitle->content['subtitle'] ?? 'Gunakan fitur praktis kami untuk pengalaman yang lebih mudah dan cepat.' }}</p>
  </div>
  <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    @if($orderTool1 && $orderTool1->is_active && isset($orderTool1->content))
    <a href="{{ $orderTool1->content['url'] ? url($orderTool1->content['url']) : route('pages.order-history') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $orderTool1->content['icon_svg_path'] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
      </svg>
      <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $orderTool1->content['title'] ?? 'Riwayat Pemesanan' }}</h3>
      <p class="text-gray-600">{{ $orderTool1->content['description'] ?? 'Cek riwayat pemesanan Anda secara praktis & detail.' }}</p>
    </a>
    @endif
    @if($orderTool2 && $orderTool2->is_active && isset($orderTool2->content))
    <a href="{{ $orderTool2->content['url'] ? url($orderTool2->content['url']) : route('pages.order-history') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center hover:bg-green-100">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $orderTool2->content['icon_svg_path'] ?? 'M12 2c2.21 0 4 1.79 4 4 0 3.53-4 8-4 8s-4-4.47-4-8c0-2.21 1.79-4 4-4zM12 12a2 2 0 100-4 2 2 0 000 4zm0 10c-4.418 0-8-1.79-8-4v-1c0-.552.448-1 1-1h14c.552 0 1 .448 1 1v1c0 2.21-3.582 4-8 4z' }}"/>
      </svg>
      <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $orderTool2->content['title'] ?? 'Lacak Kurir' }}</h3>
      <p class="text-gray-600">{{ $orderTool2->content['description'] ?? 'Lihat posisi kurir Anda secara real-time dan akurat.' }}</p>
    </a>
    @endif
  </div>
</section>
@endif

@if($faqTitle && $faqTitle->is_active && isset($faqTitle->content))
<section class="py-20 px-6 bg-gray-50">
  <div class="max-w-6xl mx-auto text-center mb-14" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">{!! $faqTitle->content['title'] ?? 'Pertanyaan <span class="text-green-600">Umum (FAQ)</span>' !!}</h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">{{ $faqTitle->content['subtitle'] ?? 'Temukan jawaban atas pertanyaan yang sering diajukan.' }}</p>
  </div>
  @if($faqsData && $faqsData->is_active && !empty($faqsData->content))
  <div class="max-w-3xl mx-auto" data-aos="fade-up">
    <div x-data="{ openIndex: null }" class="space-y-4">
      @foreach ($faqsData->content as $index => $faq)
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
          class="mt-2 p-4 text-gray-700 bg-white rounded-b-lg shadow-inner overflow-hidden">
          {{-- Diganti p-4 agar padding konsisten dan tidak terpotong --}}
          {{ $faq['a'] }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</section>
@endif

@if($promoTitle && $promoTitle->is_active && isset($promoTitle->content))
<section class="py-20 px-6 bg-white" data-aos="fade-up">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">{!! $promoTitle->content['title'] ?? 'Promo <span class="text-green-600">Spesial</span>' !!}</h2>
    <p class="text-gray-600 mt-2 max-w-xl mx-auto">{{ $promoTitle->content['subtitle'] ?? 'Dapatkan penawaran menarik dan diskon terbatas dari Gasify!' }}</p>
  </div>
  @if($promosData && $promosData->is_active && !empty($promosData->content))
  <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($promosData->content as $promo)
    <div class="bg-green-50 rounded-xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-xl font-semibold text-green-700 mb-2">{{ $promo['title'] }}</h3>
      <p class="text-gray-700">{{ $promo['desc'] }}</p>
    </div>
    @endforeach
  </div>
  @endif
</section>
@endif

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
{{-- Pastikan AlpineJS hanya di-load sekali, jika sudah ada di layout utama, tidak perlu di sini --}}
@if(!isset($alpineLoaded)) {{-- Tambahkan pengecekan ini jika AlpineJS ada di layout utama --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@php $alpineLoaded = true; @endphp
@endif
<script>
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
  });
</script>

@endsection