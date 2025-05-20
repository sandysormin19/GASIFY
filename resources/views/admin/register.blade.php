<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gasify | Sign Up</title>
  <style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
    }

    .signup-box {
      width: 100%;
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      text-align: center;
    }

    .signup-logo img {
      width: 80px;
      margin-bottom: 10px;
    }

    .signup-logo .brand {
      font-size: 2rem;
      color: #1a8b4c;
      font-weight: bold;
    }

    .signup-box-msg {
      font-size: 1.8rem;
      font-weight: bold;
      margin: 20px 0;
    }

    .form-control {
      background-color: #fff0f0;
      border: none;
      border-radius: 6px;
      height: 45px;
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      font-size: 14px;
    }

    .form-control:focus {
      outline: none;
      box-shadow: none;
    }

    .btn-signup {
      background-color: #1a8b4c;
      border: none;
      font-weight: bold;
      height: 45px;
      width: 100%;
      max-width: 200px;
      color: #fff;
      border-radius: 8px;
      margin-top: 10px;
      cursor: pointer;
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
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body>
  <div class="signup-box">
    <div class="signup-logo">
      <img src="assets/img/gas-logo.png" alt="Gasify logo"> <!-- Ganti dengan path logo -->
      <div class="brand">Gasify</div>
    </div>

    <p class="signup-box-msg">Sign Up</p>

    <form action="/register" method="post">
      <input type="text" class="form-control" placeholder="Name" name="name" required>
      <input type="email" class="form-control" placeholder="Email address" name="email" required>
      <input type="password" class="form-control" placeholder="Password" name="password" required>

      <button type="submit" class="btn-signup">Sign Up</button>
    </form>

    <div class="text-login">
      Already have an account? <a href="/login">Login</a>
    </div>
  </div>
</body>
</html>
