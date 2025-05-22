@extends('layouts.app')

@section('title', 'Pesan Gas')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Formulir Pemesanan Gas</h2>

    {{-- Ambil stok dari variabel yang dikirim controller --}}
    @php
        $stok3kg = $stok3kg ?? 0;
        $stok12kg = $stok12kg ?? 0;
    @endphp

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        {{-- Pilih Produk --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Gas LPG 3 Kg (Stok: {{ $stok3kg }})</h5>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', -1)">-</button>
                    <input type="number" name="qty_3kg" id="qty3kg" class="form-control text-center" value="0" min="0" max="{{ $stok3kg }}">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty3kg', 1, {{ $stok3kg }})">+</button>
                </div>
            </div>

            <div class="col-md-6">
                <h5>Gas LPG 12 Kg (Stok: {{ $stok12kg }})</h5>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', -1)">-</button>
                    <input type="number" name="qty_12kg" id="qty12kg" class="form-control text-center" value="0" min="0" max="{{ $stok12kg }}">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('qty12kg', 1, {{ $stok12kg }})">+</button>
                </div>
            </div>
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
            <label for="address" class="form-label"><strong>Alamat Pengiriman</strong></label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
            <button type="button" class="btn btn-outline-primary mt-2" onclick="getCurrentLocation()">Gunakan Lokasi Saat Ini</button>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        </div>
    </form>
</div>

{{-- Script Tambah/Kurang dan Lokasi --}}
<script>
    function changeQty(id, delta, max = Infinity) {
        let input = document.getElementById(id);
        let current = parseInt(input.value) || 0;
        let newVal = current + delta;
        if (newVal < 0) newVal = 0;
        if (newVal > max) newVal = max;
        input.value = newVal;
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
@endsection
