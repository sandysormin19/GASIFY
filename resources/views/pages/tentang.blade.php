@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Link AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Background dan warna section */
    body {
        background-color: #f0f4f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    section {
        padding: 60px 15px;
        background-color: #f9fafd; /* default abu muda */
    }

    section.bg-light {
        background-color: #e6f2ff; /* biru muda lembut */
    }

    section#keunggulan {
        background-color: #d4f0e7; /* hijau mint lembut */
    }

    section#testimoni {
        background-color: #fff7e6; /* krem muda */
    }

    /* Card putih dengan shadow */
    .bg-white {
        background-color: #ffffff !important;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .bg-white:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
    }

    /* Hover effect untuk fitur */
    .feature-icon {
        font-size: 3rem;
        color: #28a745;
        margin-bottom: 15px;
        transition: color 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        color: #1e7e34;
    }

    /* Hero Slide */
    #hero-slide {
        height: 300px;
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
    }

    #hero-slide .slide {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
    }

    #hero-slide .slide.active {
        opacity: 1;
        z-index: 2;
    }

    /* Judul utama */
    h2.text-center {
        font-weight: 700;
        font-size: 2.8rem;
        margin-bottom: 1rem;
        color: #1b4332;
    }

    /* Paragraph utama */
    p.lead {
        font-size: 1.2rem;
        max-width: 720px;
        margin: 0 auto 3rem auto;
        color: #3a3a3a;
    }
</style>

<div class="container py-5">

    <!-- Hero Slide dengan gambar berganti tiap 5 detik -->
    <div id="hero-slide">
        <div class="slide active" style="background-image: url('https://images.bisnis.com/posts/2025/02/04/1836649/jat-gas-4.jpg');"></div>
        <div class="slide" style="background-image: url('https://media.kompas.tv/library/image/content_article/article_img/20230720082057.jpg');"></div>
        <div class="slide" style="background-image: url('https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/202/2025/02/13/LPG-3-KiloJPG-1311201520.jpg');"></div>
    </div>

    <!-- Judul & Deskripsi -->
    <h2 class="text-center" data-aos="fade-up">
        Tentang <span class="text-success">Gasify</span>
    </h2>
    <p class="lead text-center" data-aos="fade-up" data-aos-delay="200">
        Gasify adalah platform digital terpercaya untuk pemesanan gas LPG rumah tangga. Kami mengutamakan kemudahan, kecepatan, dan keamanan dalam melayani kebutuhan energi rumah Anda.
    </p>

</div>

<!-- Misi & Visi -->
<section class="bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="bg-white p-5 h-100">
                    <h3 class="text-success fw-bold mb-3">Misi Kami</h3>
                    <p>
                        Menyediakan akses pemesanan gas LPG yang mudah, transparan, dan ramah lingkungan melalui platform digital modern, mendukung kenyamanan dan kesejahteraan pelanggan.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-left">
                <div class="bg-white p-5 h-100">
                    <h3 class="text-success fw-bold mb-3">Visi Kami</h3>
                    <p>
                        Menjadi layanan pemesanan gas LPG nomor satu di Indonesia yang inovatif, dapat diandalkan, dan mendukung transformasi energi berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan -->
<section id="keunggulan">
    <div class="container text-center">
        <h3 class="fw-bold mb-5" data-aos="zoom-in">Kenapa Memilih Gasify?</h3>

        <div class="row justify-content-center">
            @php
                $features = [
                    ['icon' => 'mobile-alt', 'title' => 'Pemesanan Mudah', 'desc' => 'Lewat website dan aplikasi resmi kami'],
                    ['icon' => 'shipping-fast', 'title' => 'Pengiriman Cepat', 'desc' => 'Mitra pengiriman resmi dengan jadwal teratur'],
                    ['icon' => 'map-marker-alt', 'title' => 'Pelacakan Real-Time', 'desc' => 'Pantau status pesanan Anda secara langsung'],
                    ['icon' => 'headset', 'title' => 'Layanan 24/7', 'desc' => 'Customer service siap membantu kapan saja'],
                    ['icon' => 'shield-alt', 'title' => 'Keamanan Terjamin', 'desc' => 'Produk asli dan pengiriman terpercaya'],
                    ['icon' => 'sync-alt', 'title' => 'Update Harga Otomatis', 'desc' => 'Harga gas selalu terbaru dan transparan'],
                ];
            @endphp

            @foreach ($features as $i => $item)
            <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="bg-white p-4 feature-card h-100">
                    <i class="fas fa-{{ $item['icon'] }} feature-icon"></i>
                    <h5 class="fw-semibold mb-2">{{ $item['title'] }}</h5>
                    <p class="text-muted">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni -->
<section id="testimoni">
    <div class="container text-center">
        <h3 class="fw-bold mb-5" data-aos="zoom-in">Apa Kata Pelanggan?</h3>

        <div class="row justify-content-center">
            @php
                $testimonials = [
                    ['name' => 'Siti Nurhaliza', 'text' => 'Pelayanan cepat dan mudah, saya sangat puas menggunakan Gasify!'],
                    ['name' => 'Andi Wijaya', 'text' => 'Pengiriman selalu tepat waktu dan customer service sangat ramah.'],
                    ['name' => 'Lia Rahmawati', 'text' => 'Fitur pelacakan sangat membantu saya mengetahui status pesanan.'],
                ];
            @endphp

            @foreach ($testimonials as $i => $t)
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <p class="fst-italic">"{{ $t['text'] }}"</p>
                    <h6 class="mt-3 text-success fw-bold">- {{ $t['name'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Footer Spacer -->
<div style="height: 60px;"></div>

<!-- AOS Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();

    // Hero slide background changer
    const slides = document.querySelectorAll('#hero-slide .slide');
    let currentIndex = 0;

    function changeSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(changeSlide, 5000); // change every 5 seconds
</script>

@endsection
