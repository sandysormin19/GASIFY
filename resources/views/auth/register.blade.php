<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gasify | Sign Up</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #d9fbe7, #b2dfdb);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .signup-box {
      background-color: #ffffff;
      border-radius: 20px;
      padding: 40px 30px;
      width: 100%;
      max-width: 420px;
      text-align: center;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.7s ease-in-out;
    }

    .signup-logo img {
      width: 230px; /* LOGO DIBESARKAN */
      display: block;
      margin-bottom: 10px;
      margin-left: 120px;
      margin-right: 10px;
    }

    .signup-box-msg {
      font-size: 1.6rem;
      font-weight: 600;
      margin-bottom: 25px;
      color: #333;
    }

    .form-control {
      background-color: #f1f8f6;
      border: none;
      border-radius: 10px;
      height: 45px;
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      font-size: 15px;
      color: #333;
    }

    .form-control:focus {
      outline: none;
      box-shadow: 0 0 0 2px rgba(26, 139, 76, 0.2);
    }

    .btn-signup {
      background-color: #1a8b4c;
      border: none;
      font-weight: 600;
      height: 45px;
      width: 100%;
      color: #fff;
      border-radius: 10px;
      margin-top: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-signup:hover {
      background-color: #146a3b;
    }

    .text-login {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 14px;
    }

    .text-login a {
      font-weight: bold;
      color: #1a8b4c;
      text-decoration: none;
    }

    .alert {
      padding: 10px;
      background-color: #ffdddd;
      color: #a94442;
      margin-bottom: 15px;
      border-radius: 6px;
      font-size: 14px;
    }

    .alert-success {
      background-color: #ddffdd;
      color: #3c763d;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <div class="signup-logo">
      <img src="{{ asset('admin/images/Home/logogasify.png') }}" alt="Gasify Logo">
    </div>

    <p class="signup-box-msg">Buat Akun Baru</p>

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tampilkan error validasi --}}
    @if($errors->any())
      <div class="alert">
        <ul style="list-style: none; padding: 0; margin: 0;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('user.register') }}" method="post">
      @csrf
      <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
      <input type="email" class="form-control" name="email" placeholder="Email address" value="{{ old('email') }}" required>
      <input type="password" class="form-control" name="password" placeholder="Password" required>
      <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>

      <button type="submit" class="btn-signup">Daftar</button>
    </form>

    <div class="text-login">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
  </div>
</body>
</html>
