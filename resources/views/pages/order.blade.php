@extends('layouts.app')

@section('title', 'Pesan Gas')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Formulir Pemesanan Gas</h2>

    @php
        $stok3kg = $stok3kg ?? 0;
        $stok12kg = $stok12kg ?? 0;
        $harga3kg = $harga3kg ?? 0;
        $harga12kg = $harga12kg ?? 0;
        $alamatRumah = auth()->user()->address ?? '';
    @endphp

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        {{-- Pilih Produk --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Gas LPG 3 Kg (Stok: {{ $stok3kg }})</h5>
                <p>Harga: <strong>Rp {{ number_format($harga3kg, 0, ',', '.') }}</strong></p>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', -1)">-</button>
                    <input type="number" name="qty_3kg" id="qty3kg" class="form-control text-center" value="0" min="0" max="{{ $stok3kg }}">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', 1, {{ $stok3kg }})">+</button>
                </div>
            </div>

            <div class="col-md-6">
                <h5>Gas LPG 12 Kg (Stok: {{ $stok12kg }})</h5>
                <p>Harga: <strong>Rp {{ number_format($harga12kg, 0, ',', '.') }}</strong></p>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', -1)">-</button>
                    <input type="number" name="qty_12kg" id="qty12kg" class="form-control text-center" value="0" min="0" max="{{ $stok12kg }}">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', 1, {{ $stok12kg }})">+</button>
                </div>
            </div>
        </div>

        {{-- Estimasi Total Harga --}}
        <div class="mb-4">
            <h5>Total Estimasi Harga: <span id="totalHarga">Rp 0</span></h5>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-4">
            <label for="payment_method" class="form-label"><strong>Metode Pembayaran</strong></label>
            <select class="form-select" name="payment_method" id="payment_method" required>
                <option value="" selected disabled>Pilih metode pembayaran</option>
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
                <option value="dana">DANA</option>
                <option value="shopeepay">ShopeePay</option>
            </select>
        </div>

        {{-- Alamat Pengiriman --}}
        <div class="mb-4">
            <label for="address_option" class="form-label"><strong>Pilih Alamat Pengiriman</strong></label>
            <select id="address_option" class="form-select mb-3" onchange="handleAddressOption()">
                <option value="manual">Ketik Alamat Manual</option>
                <option value="home">Gunakan Alamat Rumah</option>
                <option value="current">Gunakan Lokasi Saat Ini</option>
            </select>

            <textarea name="address" id="address" class="form-control" rows="3" required placeholder="Masukkan alamat pengiriman"></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        </div>
    </form>
</div>

{{-- SCRIPT --}}
<script>
    const harga3kg = {{ $harga3kg }};
    const harga12kg = {{ $harga12kg }};
    const alamatRumah = @json($alamatRumah);

    function changeQty(id, delta, max = Infinity) {
        let input = document.getElementById(id);
        let current = parseInt(input.value) || 0;
        let newVal = current + delta;
        if (newVal < 0) newVal = 0;
        if (newVal > max) newVal = max;
        input.value = newVal;
        updateTotalHarga();
    }

    function updateTotalHarga() {
        const qty3kg = parseInt(document.getElementById('qty3kg').value) || 0;
        const qty12kg = parseInt(document.getElementById('qty12kg').value) || 0;
        const total = (qty3kg * harga3kg) + (qty12kg * harga12kg);
        document.getElementById('totalHarga').textContent = "Rp " + total.toLocaleString('id-ID');
    }

    function handleAddressOption() {
        const option = document.getElementById('address_option').value;
        const addressField = document.getElementById('address');

        if (option === 'home') {
            addressField.value = alamatRumah || '';
        } else if (option === 'current') {
            getCurrentLocation();
        } else {
            addressField.value = '';
        }
    }

    function getCurrentLocation() {
        const addressField = document.getElementById('address');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(res => res.json())
                    .then(data => {
                        addressField.value = data.display_name || '';
                    })
                    .catch(() => alert('Gagal mengambil alamat.'));
            }, function () {
                alert('Gagal mengakses lokasi. Pastikan izin lokasi diaktifkan.');
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    // Tambahkan event listener setelah DOM siap
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('qty3kg').addEventListener('input', updateTotalHarga);
        document.getElementById('qty12kg').addEventListener('input', updateTotalHarga);
    });
</script>
@endsection
