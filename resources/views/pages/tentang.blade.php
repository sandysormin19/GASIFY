@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold" style="font-size: 2.5rem;">Tentang <span class="text-success">Gasify</span></h2>
    <p class="lead text-center text-muted mb-5">
        Gasify adalah solusi digital untuk kebutuhan gas LPG rumah tangga Anda—mudah, cepat, dan aman. Kami hadir untuk memberikan pelayanan energi yang modern dan terpercaya di era digital.
    </p>

    <!-- Misi & Visi -->
    <div class="row text-center mb-5">
        <div class="col-md-6">
            <div class="p-4 bg-light rounded shadow-sm h-100">
                <h4 class="text-success fw-semibold">Misi Kami</h4>
                <p class="text-muted mt-3">
                    Memberikan akses gas LPG dengan mudah melalui platform digital yang andal, transparan, dan ramah lingkungan.
                </p>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="p-4 bg-light rounded shadow-sm h-100">
                <h4 class="text-success fw-semibold">Visi Kami</h4>
                <p class="text-muted mt-3">
                    Menjadi platform pemesanan gas LPG nomor satu di Indonesia yang mendukung kemandirian energi nasional dan transformasi digital.
                </p>
            </div>
        </div>
    </div>

    <!-- Alasan Memilih Gasify -->
    <div class="text-center">
        <h4 class="fw-bold mb-4">Kenapa Memilih Gasify?</h4>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <i class="fas fa-mobile-alt fa-2x text-success mb-2"></i>
                    <p class="fw-semibold mt-2 mb-1">Pemesanan Mudah</p>
                    <small class="text-muted">Lewat website atau aplikasi resmi</small>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <i class="fas fa-shipping-fast fa-2x text-success mb-2"></i>
                    <p class="fw-semibold mt-2 mb-1">Pengiriman Cepat</p>
                    <small class="text-muted">Mitra resmi & pengiriman terjadwal</small>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                    <p class="fw-semibold mt-2 mb-1">Pelacakan Real-Time</p>
                    <small class="text-muted">Lacak status pengiriman secara langsung</small>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <i class="fas fa-headset fa-2x text-success mb-2"></i>
                    <p class="fw-semibold mt-2 mb-1">Layanan 24/7</p>
                    <small class="text-muted">Tim dukungan siap bantu kapan saja</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
