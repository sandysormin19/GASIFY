<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gasify | Login</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #d9fbe7, #b2dfdb);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background-color: #ffffff;
      border-radius: 20px;
      padding: 60px 40px 50px;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 370px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
      position: relative;
    }

    .login-logo {
      margin-bottom: 10px;
      margin-left: 63px;
      margin-right: 10px;
    }

    .login-logo img {
      width: 230px; /* Ubah ukuran logo di sini */
      height: auto;
      display: block;
      margin-left: 400px;  /* Bisa kamu ubah untuk sesuaikan posisi kiri */
      margin-right: 200px; /* Bisa kamu ubah untuk sesuaikan posisi kanan */
    }

    .login-box-msg {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1.8rem;
    }

    .input-group {
      display: flex;
      align-items: center;
      background-color: #f1f8f6;
      border-radius: 10px;
      margin-bottom: 1rem;
      padding: 0.6rem 0.9rem;
    }

    .input-group i {
      margin-right: 12px;
      color: #1a8b4c;
      font-size: 1.1rem;
    }

    .input-group input {
      border: none;
      background: transparent;
      width: 100%;
      outline: none;
      font-size: 1rem;
      color: #333;
    }

    .btn-primary {
      background-color: #1a8b4c;
      border: none;
      font-weight: 600;
      padding: 0.9rem;
      border-radius: 10px;
      color: #fff;
      font-size: 1rem;
      width: 100%;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #156e3e;
    }

    .text-signup {
      margin-top: 1.5rem;
      font-size: 14px;
    }

    .text-signup a {
      font-weight: bold;
      color: #1a8b4c;
      text-decoration: none;
    }

    .error-message {
      color: red;
      font-size: 0.95rem;
      margin-bottom: 1rem;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <img src="{{ asset('admin/images/Home/logogasify.png') }}" alt="Gasify Logo"
           style="margin-left: auto; margin-right: auto;"> <!-- Bisa edit margin manual di sini -->
    </div>

    <p class="login-box-msg">Masuk ke akun Anda</p>

    @if ($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('user.login.submit') }}">
      @csrf
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email address" required value="{{ old('email') }}">
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="btn-primary">Masuk</button>
    </form>

    <div class="text-signup">
      Belum punya akun? <a href="{{ route('user.register') }}">Daftar di sini</a>
    </div>
  </div>
</body>
</html>
