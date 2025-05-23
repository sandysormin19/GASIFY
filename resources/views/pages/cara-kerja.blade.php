@extends('layouts.app')

@section('title', 'Cara Kerja')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Cara Kerja Gasify</h2>
    <p class="lead text-center">Proses pemesanan gas LPG melalui Gasify hanya dalam beberapa langkah sederhana.</p>

    <div class="row text-center mt-5 g-4">
        <div class="col-md-4">
            <i class="fas fa-fire fa-3x text-primary"></i>
            <h5 class="mt-3">1. Pilih Produk</h5>
            <p>Pilih jenis tabung gas LPG yang Anda butuhkan.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-file-alt fa-3x text-success"></i>
            <h5 class="mt-3">2. Isi Data Pemesanan</h5>
            <p>Masukkan alamat dan informasi kontak secara lengkap.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-truck fa-3x text-warning"></i>
            <h5 class="mt-3">3. Pengiriman</h5>
            <p>Tim mitra kami akan mengantar pesanan ke rumah Anda.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-check-circle fa-3x text-success"></i>
            <h5 class="mt-3">4. Selesai</h5>
            <p>Nikmati kemudahan dan kenyamanan layanan Gasify.</p>
        </div>

        <!-- ✅ Tambahan Langkah -->
        <div class="col-md-4">
            <i class="fas fa-credit-card fa-3x text-info"></i>
            <h5 class="mt-3">5. Pembayaran Mudah</h5>
            <p>Bayar melalui metode digital seperti e-wallet atau transfer bank.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-map-marked-alt fa-3x text-danger"></i>
            <h5 class="mt-3">6. Lacak Pesanan</h5>
            <p>Gunakan fitur pelacakan untuk melihat posisi kurir secara real-time.</p>
        </div>
    </div>
</div>
@endsection
