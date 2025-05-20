<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gasify | Login</title>
  <style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      text-align: center;
    }

    .login-logo img {
      width: 80px;
      margin-bottom: 10px;
    }

    .login-logo .brand {
      font-size: 2rem;
      color: #1a8b4c;
      font-weight: bold;
    }

    .login-box-msg {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }

    .form-control {
      background-color: #fff0f0;
      border: none;
      border-radius: 5px;
      height: 45px;
      width: 100%;
      margin-bottom: 1rem;
      padding-left: 10px;
    }

    .form-control:focus {
      outline: none;
      box-shadow: none;
    }

    .btn-primary {
      background-color: #1a8b4c;
      border: none;
      font-weight: bold;
      height: 45px;
      width: 100%;
      max-width: 200px;
      color: #fff;
      margin: 0 auto;
    }

    .btn-primary:hover {
      background-color: #146a3b;
    }

    .text-signup {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 14px;
    }

    .text-signup a {
      font-weight: bold;
      color: #1a8b4c;
      text-decoration: none;
    }

    .input-group {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .input-group .input-group-text {
      background: none;
      border: none;
      padding-left: 5px;
      padding-right: 5px;
    }

    .input-group i {
      color: #555;
    }
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <img src="your-logo.png" alt="Gasify logo"> <!-- Ganti dengan path logo kamu -->
      <div class="brand">Gasify</div>
    </div>

    <p class="login-box-msg">Login</p>

    <form action="../../index3.html" method="post">
      <div class="input-group">
        <input type="email" class="form-control" placeholder="Email address">
        <div class="input-group-text"></div>
      </div>
      <div class="input-group">
        <input type="password" class="form-control" placeholder="Password">
        <div class="input-group-text"></div>
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>

    <div class="text-signup">
      Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
    </div>
  </div>
</body>
</html>
