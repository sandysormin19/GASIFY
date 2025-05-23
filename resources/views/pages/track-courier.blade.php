@extends('layouts.app')

@section('content')

<!-- CDN Tailwind & AOS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<section class="py-16 px-6 max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold text-green-700 mb-8 text-center">Lacak Kurir Anda</h1>

    <!-- Search Box -->
    <form id="trackingForm" class="max-w-3xl mx-auto flex gap-4 mb-12" onsubmit="return handleSearch(event)">
        <input type="text" id="trackingNumber" placeholder="Masukkan Nomor Resi / ID Pengiriman"
            class="flex-grow border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
            required>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 rounded-lg transition">
            Cari
        </button>
    </form>

    <!-- Loading Animation -->
    <div id="loading" class="hidden text-center mb-12">
        <svg class="animate-spin mx-auto h-12 w-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="mt-4 text-green-600 font-semibold">Mencari data pengiriman...</p>
    </div>

    <!-- Result Container -->
    <div id="result" class="hidden bg-white rounded-xl shadow-lg p-8">
        <!-- Courier Info -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Status Pengiriman</h2>
            <p><strong>Nomor Resi:</strong> <span id="resiNumber"></span></p>
            <p><strong>Nama Kurir:</strong> <span id="courierName"></span></p>
            <p><strong>Status Saat Ini:</strong> <span id="currentStatus" class="font-semibold text-green-600"></span></p>
            <p><strong>Estimasi Waktu Tiba:</strong> <span id="eta"></span></p>
        </div>

        <!-- Map Placeholder -->
        <div class="mb-8 rounded-lg overflow-hidden shadow-md h-72 bg-gray-100 flex items-center justify-center text-gray-400 font-semibold">
            Peta Lokasi Kurir (Placeholder)
        </div>

        <!-- Timeline Pengiriman -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Riwayat Status Pengiriman</h3>
            <ul class="relative border-l border-green-400">
                <li class="mb-10 ml-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-green-600 rounded-full -left-3 ring-8 ring-white">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10l3 3 7-7"/></svg>
                    </span>
                    <h4 class="font-semibold text-gray-900">Paket Diterima di Gudang</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">2025-05-20 08:00</time>
                    <p class="text-gray-700">Paket sudah diterima dan akan dikirim ke kurir.</p>
                </li>
                <li class="mb-10 ml-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-green-600 rounded-full -left-3 ring-8 ring-white">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10l3 3 7-7"/></svg>
                    </span>
                    <h4 class="font-semibold text-gray-900">Kurir Berangkat</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">2025-05-20 09:30</time>
                    <p class="text-gray-700">Kurir mulai perjalanan pengiriman.</p>
                </li>
                <li class="ml-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-green-600 rounded-full -left-3 ring-8 ring-white">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10l3 3 7-7"/></svg>
                    </span>
                    <h4 class="font-semibold text-gray-900">Dalam Perjalanan</h4>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">2025-05-20 11:00</time>
                    <p class="text-gray-700">Kurir sedang dalam perjalanan menuju alamat tujuan.</p>
                </li>
            </ul>
        </div>
    </div>
</section>



<script>
function handleSearch(event) {
    event.preventDefault();
    const loading = document.getElementById('loading');
    const result = document.getElementById('result');

    // Show loading, hide result
    loading.classList.remove('hidden');
    result.classList.add('hidden');

    // Simulate fetching data
    setTimeout(() => {
        loading.classList.add('hidden');
        result.classList.remove('hidden');

        // Set dummy data (ganti dengan data asli dari backend nanti)
        document.getElementById('resiNumber').textContent = document.getElementById('trackingNumber').value;
        document.getElementById('courierName').textContent = 'Budi Santoso';
        document.getElementById('currentStatus').textContent = 'Dalam Perjalanan';
        document.getElementById('eta').textContent = 'Hari ini, 15:30 WIB';
    }, 2000);

    return false;
}
</script>

@endsection
