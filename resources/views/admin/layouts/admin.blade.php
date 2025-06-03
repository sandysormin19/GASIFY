{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gasify Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Atau 6.4.0 seperti di layouts.blade.php Anda --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}


    {{-- <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}"> --}}

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden; /* Mencegah scroll horizontal karena sidebar fixed */
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa; /* Warna latar belakang area konten */
            overflow-y: auto; /* Scroll hanya pada area konten jika perlu */
        }
        /* Untuk membuat sidebar tetap terlihat saat di-scroll jika konten panjang */
        /* Ini adalah contoh sederhana, mungkin perlu penyesuaian lebih lanjut */
        /* .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            height: calc(100vh);
            z-index: 1020;
        } */

        /* Styling untuk active nav-link di sidebar admin */
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #198754; /* Warna hijau Gasify */
        }
        .nav-link.text-white:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    @stack('admin_styles') {{-- Untuk CSS tambahan spesifik halaman admin --}}
</head>
<body>
    {{-- Sidebar Admin --}}
    @include('admin.partials.sidebar') {{-- atau .sidebar-sticky jika menggunakan style di atas --}}

    {{-- Konten Utama Admin --}}
    <div class="main-content">
        {{-- Anda bisa menambahkan Admin Navbar di sini jika perlu, yang berbeda dari navbar publik --}}
        {{-- Contoh:
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
            <div class="container-fluid">
                <button class="btn btn-primary d-md-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebar" aria-controls="adminSidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand mb-0 h1">@yield('page_title', 'Halaman Admin')</span>
                <div class="ms-auto">
                    <span class="navbar-text">
                        Selamat datang, {{ Auth::user()->name ?? 'Admin' }}!
                    </span>
                </div>
            </div>
        </nav>
        --}}

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('admin_scripts')
</body>
</html>