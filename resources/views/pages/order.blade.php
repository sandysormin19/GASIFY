@extends('layouts.app')

@section('title', 'Pesan Gas')

@push('styles')
{{-- CSS Leaflet sudah ada di layout utama, jadi tidak perlu di-push lagi dari sini --}}
{{-- HANYA PUSH STYLE UNTUK #map --}}
<style>
    #map { height: 300px; width: 100%; border-radius: 0.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
    /* Style tambahan dari Anda */
    .gas-card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease-in-out;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .transition-scale:hover {
        transform: scale(1.05);
        transition: 0.2s ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Form Pemesanan Gas LPG</h2>
        <p class="text-muted fs-5">Silakan pilih jumlah gas, metode pembayaran, dan isi alamat pengiriman Anda.</p>
    </div>

    @php
        $stok3kg = $stok3kg ?? 0;
        $stok12kg = $stok12kg ?? 0;
        $harga3kg = $harga3kg ?? 0;
        $harga12kg = $harga12kg ?? 0;
    @endphp

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        <div class="row g-4 justify-content-center mb-5">
            {{-- Gas 3Kg --}}
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4 p-4 gas-card h-100">
                    <h5 class="text-success">Gas LPG 3 Kg</h5>
                    <p class="text-muted">Stok: {{ $stok3kg }}</p>
                    <span class="badge bg-success fs-6 mb-3">Rp {{ number_format($harga3kg, 0, ',', '.') }}</span>

                    <div class="input-group mt-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', -1)">-</button>
                        <input type="number" name="qty_3kg" id="qty3kg" class="form-control text-center" value="0" min="0" max="{{ $stok3kg }}" onchange="updateTotal()">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', 1, {{ $stok3kg }})">+</button>
                    </div>
                </div>
            </div>

            {{-- Gas 12Kg --}}
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4 p-4 gas-card h-100">
                    <h5 class="text-primary">Gas LPG 12 Kg</h5>
                    <p class="text-muted">Stok: {{ $stok12kg }}</p>
                    <span class="badge bg-primary fs-6 mb-3">Rp {{ number_format($harga12kg, 0, ',', '.') }}</span>

                    <div class="input-group mt-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', -1)">-</button>
                        <input type="number" name="qty_12kg" id="qty12kg" class="form-control text-center" value="0" min="0" max="{{ $stok12kg }}" onchange="updateTotal()">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', 1, {{ $stok12kg }})">+</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Estimasi Total --}}
        <div class="text-center mb-4">
            <h5>Total Estimasi: <span class="text-primary fw-bold" id="totalHarga">Rp 0</span></h5>
            <div class="progress mx-auto" style="height: 15px; max-width: 300px;">
                <div class="progress-bar bg-info" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-4">
            <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran</label>
            <select class="form-select" name="payment_method" id="payment_method" required>
                <option value="" disabled selected>-- Pilih metode --</option>
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
                <option value="dana">DANA</option>
                <option value="shopeepay">ShopeePay</option>
            </select>
        </div>
        
    <div class="container py-5">
        {{-- ... (Konten HTML Anda lainnya tetap sama) ... --}}
        {{-- Alamat Pengiriman & Peta --}}
        <div class="mb-5">
            <label for="address" class="form-label fw-semibold">Alamat Pengiriman</label>
            <div id="map"></div> {{-- Pastikan div ini ada --}}
            <textarea name="address" id="address" class="form-control" rows="3" required placeholder="Detail alamat Anda..."></textarea>
            <button type="button" class="btn btn-outline-info mt-2" onclick="getCurrentLocation()">
                <i class="bi bi-geo-alt"></i> Gunakan Lokasi Saat Ini
            </button>
            <input type="hidden" name="delivery_lat" id="lat_user">
            <input type="hidden" name="delivery_lng" id="lng_user">
        </div>
        {{-- ... (Sisa konten HTML Anda tetap sama) ... --}}
    </div>
    {{-- Tombol Submit --}}
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success px-5 rounded-pill shadow-sm transition-scale">
                    <i class="bi bi-cart-check-fill me-2"></i>Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection {{-- Pastikan section content ditutup dengan benar --}}

@push('scripts')
{{-- JS Leaflet sudah ada di layout utama, jadi tidak perlu di-push lagi dari sini --}}
{{-- HANYA PUSH SCRIPT LOGIKA PETA ANDA --}}
<script>
    console.log("Script peta (order.blade.php) mulai dimuat."); // DEBUG

    const harga3kg = {{ $harga3kg ?? 0 }}; // Tambahkan null coalescing untuk default jika variabel tidak ada
    const harga12kg = {{ $harga12kg ?? 0 }}; // Tambahkan null coalescing
    const progressBar = document.getElementById('progressBar');
    let map;
    let marker;

    function changeQty(id, delta, max = Infinity) {
        let input = document.getElementById(id);
        let current = parseInt(input.value) || 0;
        let newVal = current + delta;
        if (newVal < 0) newVal = 0;
        if (newVal > max) newVal = max;
        input.value = newVal;
        updateTotal();
    }

    function updateTotal() {
        const qty3Input = document.getElementById('qty3kg');
        const qty12Input = document.getElementById('qty12kg');
        const totalHargaEl = document.getElementById('totalHarga');

        if (!qty3Input || !qty12Input || !totalHargaEl) {
            console.error("Elemen kuantitas atau total harga tidak ditemukan.");
            return;
        }

        const qty3 = parseInt(qty3Input.value) || 0;
        const qty12 = parseInt(qty12Input.value) || 0;
        const total = (qty3 * harga3kg) + (qty12 * harga12kg);
        totalHargaEl.innerText = 'Rp ' + total.toLocaleString('id-ID');

        if (progressBar) {
            const percent = Math.min((total / 1000000) * 100, 100); // Asumsi max Rp 1.000.000
            progressBar.style.width = percent + "%";
        }
    }

    function initMap(lat, lon, zoomLevel = 15) {
        console.log(`Menginisialisasi peta di Lat: ${lat}, Lon: ${lon}, Zoom: ${zoomLevel}`); // DEBUG
        const mapDiv = document.getElementById('map');
        if (!mapDiv) {
            console.error("Elemen #map tidak ditemukan!"); // DEBUG
            return;
        }
        // Cek apakah L (Leaflet) sudah terdefinisi
        if (typeof L === 'undefined') {
            console.error("Leaflet (L) tidak terdefinisi. Pastikan leaflet.js sudah dimuat sebelum skrip ini.");
            return;
        }

        if (mapDiv.offsetHeight === 0 && mapDiv.offsetWidth === 0) {
             // Beri sedikit waktu agar CSS diterapkan, terutama jika ada transisi atau rendering lambat
             setTimeout(() => {
                 if (mapDiv.offsetHeight === 0 && mapDiv.offsetWidth === 0) {
                     console.warn("Elemen #map masih memiliki tinggi atau lebar 0 setelah timeout. Periksa CSS.");
                 }
                 if (!map) { // Cek lagi setelah timeout
                     map = L.map('map').setView([lat, lon], zoomLevel);
                     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                     }).addTo(map);
                     console.log("Peta berhasil diinisialisasi (setelah timeout).");
                 } else {
                     map.setView([lat, lon], zoomLevel);
                 }
                 // Lanjutkan dengan marker
                  if (marker) { map.removeLayer(marker); }
                 marker = L.marker([lat, lon]).addTo(map).bindPopup('Lokasi Pengiriman').openPopup();

             }, 100); // tunggu 100ms
        } else if (!map) {
            map = L.map('map').setView([lat, lon], zoomLevel);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            console.log("Peta berhasil diinisialisasi."); // DEBUG
        } else {
            map.setView([lat, lon], zoomLevel);
            console.log("View peta diupdate."); // DEBUG
        }

        if (marker) {
            map.removeLayer(marker);
        }
        // Pastikan map sudah ada sebelum menambahkan marker
        if (map) {
             marker = L.marker([lat, lon]).addTo(map)
                 .bindPopup('Lokasi Pengiriman')
                 .openPopup();
             console.log("Marker ditambahkan/diupdate."); // DEBUG
        } else {
            console.warn("Instance map belum ada saat mencoba menambahkan marker (di luar timeout).");
        }
    }

    function getCurrentLocation() {
        console.log("Mencoba mendapatkan lokasi saat ini..."); // DEBUG
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                console.log(`Lokasi ditemukan: Lat: ${lat}, Lon: ${lon}`); // DEBUG

                document.getElementById('lat_user').value = lat;
                document.getElementById('lng_user').value = lon;
                initMap(lat, lon, 16);

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
    .then(res => {
        if (!res.ok) {
            // Jika status HTTP bukan 2xx (misal 404, 500), lempar error
            console.error("Nominatim response was not ok. Status:", res.status, res.statusText);
            // Coba baca respons sebagai teks untuk melihat pesan error dari server
            return res.text().then(text => {
                console.error("Nominatim error response text:", text);
                throw new Error("Nominatim error: " + res.status + " " + (text || res.statusText));
            });
        }
        return res.json(); // Jika ok, lanjutkan proses JSON
    })
    .then(data => {
        console.log("Data lengkap dari Nominatim:", data); // DEBUG: Tampilkan seluruh data dari Nominatim
        if (data && data.display_name) {
            document.getElementById('address').value = data.display_name;
            console.log("Alamat dari Nominatim (display_name):", data.display_name);
        } else {
            document.getElementById('address').value = "Tidak dapat menemukan nama alamat detail.";
            console.warn("Field 'display_name' tidak ditemukan dalam respons Nominatim atau data kosong.");
            // Anda bisa coba menggunakan fallback lain jika display_name tidak ada, misal:
            // let fallbackAddress = [];
            // if (data.address) {
            //     if (data.address.road) fallbackAddress.push(data.address.road);
            //     if (data.address.suburb) fallbackAddress.push(data.address.suburb);
            //     if (data.address.city) fallbackAddress.push(data.address.city);
            //     if (fallbackAddress.length > 0) {
            //         document.getElementById('address').value = fallbackAddress.join(', ');
            //     } else {
            //          document.getElementById('address').value = `Koordinat: ${lat.toFixed(5)}, ${lon.toFixed(5)}`;
            //     }
            // } else {
            //     document.getElementById('address').value = `Koordinat: ${lat.toFixed(5)}, ${lon.toFixed(5)}`;
            // }
        }
    })
    .catch(err => {
        console.error('Error saat mengambil atau memproses alamat dari Nominatim:', err);
        document.getElementById('address').value = `Gagal ambil alamat. Lat: ${lat.toFixed(5)}, Lng: ${lon.toFixed(5)}`;
        // Sebaiknya tidak menggunakan alert() di sini agar tidak mengganggu debugging di console
        // alert('Gagal mengambil nama alamat dari koordinat. Lihat konsol untuk detail.');
    });
            }, function(error) {
                console.error("Error Geolocation:", error); // DEBUG
                // ... (Error handling Geolocation Anda tetap sama) ...
                alert("Gagal mendapatkan lokasi: " + error.message);
                // Pertimbangkan untuk memanggil initMap dengan lokasi default di sini juga jika diperlukan
                // initMap(-6.2088, 106.8456, 12); // Contoh: Jakarta
            });
        } else {
            console.warn("Geolocation tidak didukung oleh browser ini."); // DEBUG
            alert("Geolocation tidak didukung oleh browser ini.");
            // Pertimbangkan untuk memanggil initMap dengan lokasi default di sini juga
            // initMap(-6.2088, 106.8456, 12); // Contoh: Jakarta
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM Content Loaded (order.blade.php)."); // DEBUG
        updateTotal();

        const defaultLat = -6.200000; // Jakarta
        const defaultLng = 106.816666; // Jakarta
        try {
             initMap(defaultLat, defaultLng, 12); // Inisialisasi peta dengan lokasi default
             console.log("Peta diinisialisasi dengan lokasi default dari DOMContentLoaded.");
        } catch (e) {
             console.error("Gagal menginisialisasi peta dari DOMContentLoaded:", e);
        }
    });
</script>
@endpush