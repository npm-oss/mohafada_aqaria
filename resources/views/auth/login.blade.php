<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

<div class="login-container">
    <h2>تسجيل الدخول</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required autofocus>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn-login">دخول</button>
    </form>
</div>

</body>
</html>
