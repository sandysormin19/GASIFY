@extends('layouts.app')

@section('content')

<section style="padding: 4rem 2rem;">
    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;">
        <!-- Kiri: Teks -->
        <div style="flex: 1; min-width: 300px;">
            <h1 style="font-size: 2.5rem; font-weight: bold;">Pesan Gas LPG dengan Mudah</h1>
            <p style="margin: 1rem 0; font-size: 1.2rem;">
                Dapatkan gas LPG diantar langsung ke rumah Anda dengan cepat dan terpercaya.
            </p>
            <a href="{{ route('order') }}" style="display: inline-block; background-color: #008000; color: #fff; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none;">
                Pesan Sekarang
            </a>
        </div>

        <!-- Kanan: Gambar -->
        <div style="flex: 1; min-width: 300px; text-align: center;">
            <img src="{{ asset('admin/images/Home/deliverygas.jpg') }}" alt="Ilustrasi Gas" style="max-width: 100%; height: auto;">
        </div>
    </div>
</section>

<!-- Seksi Mengapa Memilih -->
<section style="padding: 3rem 2rem; text-align: center;">
    <h2 style="font-size: 2rem;">Mengapa Memilih <span style="color: green;">Gasify</span>?</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2rem; margin-top: 2rem;">
        <div style="flex: 1; max-width: 200px;">
            <img src="{{ asset('admin/images/Home/timer.jpg') }}" alt="Cepat" width="50">
            <h3>Pengiriman Cepat</h3>
            <p>Pesanan gas diantar cepat dan tepat waktu</p>
        </div>
        <div style="flex: 1; max-width: 200px;">
            <img src="{{ asset('admin/images/Home/wallet.jpg') }}" alt="Pembayaran" width="50">
            <h3>Pembayaran Mudah</h3>
            <p>Terima berbagai metode pembayaran digital</p>
        </div>
        <div style="flex: 1; max-width: 200px;">
            <img src="{{ asset('admin/images/Home/tabunggas.jpg') }}" alt="Luas" width="50">
            <h3>Jangkauan Luas</h3>
            <p>Layanan tersedia di berbagai area dan lokasi</p>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section style="padding: 3rem 2rem; text-align: center;">
    <h2>Testimoni Pelanggan</h2>
    <div style="max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 1.5rem; border-radius: 12px;">
        <img src="{{ asset('admin/images/Home/user-avatar.png') }}" alt="Budi" style="width: 60px; border-radius: 50%;">
        <p style="margin-top: 1rem;">“Layanannya sangat memuaskan! Gas datang tepat waktu dan pemesanannya sangat mudah.”</p>
        <p><strong>Budi</strong></p>
    </div>
</section>

@endsection
