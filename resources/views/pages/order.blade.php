@extends('layouts.app')

@section('title', 'Pesan Gas')

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

        {{-- Alamat Pengiriman --}}
        <div class="mb-5">
            <label for="address" class="form-label fw-semibold">Alamat Pengiriman</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
            <button type="button" class="btn btn-outline-info mt-2" onclick="getCurrentLocation()">
                <i class="bi bi-geo-alt"></i> Gunakan Lokasi Saat Ini
            </button>
        </div>

        {{-- Tombol Submit --}}
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-success px-5 rounded-pill shadow-sm transition-scale">
                <i class="bi bi-cart-check-fill me-2"></i>Pesan Sekarang
            </button>
        </div>
    </form>
</div>

{{-- Script --}}
<script>
    const harga3kg = {{ $harga3kg }};
    const harga12kg = {{ $harga12kg }};
    const progressBar = document.getElementById('progressBar');

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
        const qty3 = parseInt(document.getElementById('qty3kg').value) || 0;
        const qty12 = parseInt(document.getElementById('qty12kg').value) || 0;
        const total = (qty3 * harga3kg) + (qty12 * harga12kg);
        document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');

        // Update progress bar (as dummy, max Rp 1.000.000)
        const percent = Math.min((total / 1000000) * 100, 100);
        progressBar.style.width = percent + "%";
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('address').value = data.display_name;
                    })
                    .catch(() => alert('Gagal mengambil alamat.'));
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }
</script>

<style>
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
@endsection
