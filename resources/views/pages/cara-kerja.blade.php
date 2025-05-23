@extends('layouts.app')

@section('title', 'Cara Kerja')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Font Awesome (untuk ikon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .step-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
    }

    .step-icon {
        font-size: 3rem;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .swiper {
        padding: 30px 0;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    h2.section-title {
        font-weight: 700;
        font-size: 2.5rem;
        color: #1b4332;
        margin-bottom: 0.5rem;
    }

    p.lead {
        font-size: 1.1rem;
        max-width: 680px;
        margin: 0 auto 2rem auto;
        color: #3a3a3a;
    }

    /* Tombol Pesan Sekarang */
    .btn-pesan-sekarang {
        display: inline-block;
        background: #28a745;
        color: white;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 50px;
        font-size: 1.2rem;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin: 30px auto 0;
        display: block;
        width: max-content;
        text-align: center;
    }

    .btn-pesan-sekarang:hover {
        background: #1e7e34;
        transform: scale(1.05);
        text-decoration: none;
        color: white;
    }
</style>

<div class="container py-5" data-aos="fade-up">
    <h2 class="text-center section-title">Cara Kerja <span class="text-success">Gasify</span></h2>
    <p class="lead text-center">
        Proses pemesanan gas LPG melalui Gasify hanya dalam beberapa langkah sederhana dan mudah.
    </p>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Step 1 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-fire"></i></div>
                    <h5>1. Pilih Produk</h5>
                    <p>Pilih jenis tabung gas LPG yang Anda butuhkan.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-file-alt"></i></div>
                    <h5>2. Isi Data Pemesanan</h5>
                    <p>Masukkan alamat dan informasi kontak secara lengkap.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-truck"></i></div>
                    <h5>3. Pengiriman</h5>
                    <p>Tim mitra kami akan mengantar pesanan ke rumah Anda.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-check-circle"></i></div>
                    <h5>4. Selesai</h5>
                    <p>Nikmati kemudahan dan kenyamanan layanan Gasify.</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-credit-card"></i></div>
                    <h5>5. Pembayaran Mudah</h5>
                    <p>Bayar melalui metode digital seperti e-wallet atau transfer bank.</p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="swiper-slide">
                <div class="step-card">
                    <div class="step-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <h5>6. Lacak Pesanan</h5>
                    <p>Gunakan fitur pelacakan untuk melihat posisi kurir secara real-time.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Pesan Sekarang -->
    <a href="{{ route('order.create') }}" class="btn-pesan-sekarang mx-auto">
        <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
    </a>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ duration: 800, once: true });

    new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        spaceBetween: 20,
        slidesPerView: 1,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            }
        }
    });
</script>
@endsection
