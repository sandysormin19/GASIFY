<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Navbar Gasify</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      scroll-behavior: smooth;
      padding-top: 100px; /* tinggi navbar */
    }

    .navbar {
      transition: all 0.4s ease;
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(10px);
    }

    .navbar.scrolled {
      background-color: white;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      height: 80px;
      transition: transform 0.3s ease;
    }

    .navbar-brand img:hover {
      transform: scale(1.1) rotate(-2deg);
    }

    .nav-link {
      position: relative;
      font-size: 1.1rem;
      font-weight: 500;
      color: #333;
      margin-left: 1rem;
      transition: all 0.3s;
    }

    /* Hijau untuk nav link biasa */
    .nav-link:not(.btn-login):hover,
    .nav-link:not(.btn-login).active {
      color: #28a745 !important;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      width: 0%;
      height: 2px;
      background: #28a745;
      bottom: 0;
      left: 0;
      transition: width 0.3s ease;
    }

    .nav-link:not(.btn-login):hover::after {
      width: 100%;
    }

    /* Tombol Login & Logout biru */
    .btn-login {
      background: linear-gradient(135deg, #0d6efd, #66b2ff);
      color: white !important;
      border: none;
      border-radius: 30px;
      padding: 6px 16px;
      font-size: 1.05rem;
      margin-left: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-login:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px #0d6efd;
    }

    @media (max-width: 768px) {
      .nav-link {
        margin-left: 0;
        padding: 10px 0;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
  <div class="container-fluid px-4">
    <!-- Logo tanpa tulisan -->
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('admin/images/Home/logogasify.png') }}" alt="Gasify Logo">
    </a>

    <!-- Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="bi bi-house-door"></i> Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">
            <i class="bi bi-info-circle"></i> About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('cara-kerja') ? 'active' : '' }}" href="{{ route('cara-kerja') }}">
            <i class="bi bi-gear"></i> Cara Kerja
          </a>
        </li>

        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.profile') }}">
            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
          </a>
        </li>
        <li class="nav-item">
          <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-login">Logout</button>
          </form>
        </li>
        @else
        <li class="nav-item">
          <a class="btn btn-login" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS untuk efek scroll shadow -->
<script>
  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('scrolled', window.scrollY > 30);
  });
</script>

</body>
</html>
