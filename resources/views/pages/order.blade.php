@extends('layouts.app')

@section('title', 'Pesan Gas')

@section('content')
<div class="container py-5">
    <!-- Hero Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Form Pemesanan Gas LPG</h1>
        <p class="lead text-muted">Pesan gas secara online dengan cepat dan praktis</p>
    </div>

    @php
        $stok3kg = $stok3kg ?? 0;
        $stok12kg = $stok12kg ?? 0;
    @endphp

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        <!-- Pilihan Produk -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold">Gas LPG 3 Kg</h4>
                    <p class="text-muted">Stok tersedia: {{ $stok3kg }}</p>
                    <div class="input-group input-group-lg">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQty('qty3kg', -1)">−</button>
                        <input type="number" name="qty_3kg" id="qty3kg" class="form-control text-center" value="0" min="0" max="{{ $stok3kg }}">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQty('qty3kg', 1, {{ $stok3kg }})">+</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold">Gas LPG 12 Kg</h4>
                    <p class="text-muted">Stok tersedia: {{ $stok12kg }}</p>
                    <div class="input-group input-group-lg">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQty('qty12kg', -1)">−</button>
                        <input type="number" name="qty_12kg" id="qty12kg" class="form-control text-center" value="0" min="0" max="{{ $stok12kg }}">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQty('qty12kg', 1, {{ $stok12kg }})">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-5">
            <label class="form-label fs-5 fw-semibold">Metode Pembayaran</label>
            <select class="form-select form-select-lg shadow-sm" name="payment_method" required>
                <option value="" disabled selected>Pilih metode</option>
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
                <option value="dana">DANA</option>
                <option value="shopeepay">ShopeePay</option>
            </select>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="mb-5">
            <label for="address" class="form-label fs-5 fw-semibold">Alamat Pengiriman</label>
            <textarea name="address" id="address" class="form-control form-control-lg shadow-sm" rows="4" placeholder="Masukkan alamat lengkap..." required></textarea>

            <!-- Tombol Lokasi -->
            <button type="button" class="btn mt-3 border border-primary text-primary bg-white d-flex align-items-center gap-2" onclick="getCurrentLocation()">
                <i class="bi bi-geo-alt-fill fs-5"></i>
                Gunakan Lokasi Saat Ini
            </button>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg px-5 fw-bold shadow">
                <i class="bi bi-cart-check-fill me-2"></i>Pesan Sekarang
            </button>
        </div>
    </form>
</div>

<script>
    function changeQty(id, delta, max = Infinity) {
        const input = document.getElementById(id);
        let value = parseInt(input.value) || 0;
        value = Math.min(Math.max(value + delta, 0), max);
        input.value = value;
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                fetch(https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon})
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('address').value = data.display_name;
                    })
                    .catch(() => alert('Gagal mengambil alamat'));
            }, () => alert('Gagal mengambil lokasi. Periksa izin lokasi.'));
        } else {
            alert('Geolocation tidak didukung browser ini.');
        }
    }
</script>
@endsection
