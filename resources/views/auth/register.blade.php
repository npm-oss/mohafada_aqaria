<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب جديد</title>

    <!-- ربط CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="register-container">

        <h2>إنشاء حساب جديد</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <label class="form-label" for="name">الاسم الكامل</label>
            <input id="name" type="text" class="form-input" name="name" required autofocus>

            <!-- Email -->
            <label class="form-label" for="email">البريد الإلكتروني</label>
            <input id="email" type="email" class="form-input" name="email" required>

            <!-- Password -->
            <label class="form-label" for="password">كلمة المرور</label>
            <input id="password" type="password" class="form-input" name="password" required>

            <!-- Confirm Password -->
            <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required>

            <!-- تسجيل -->
            <button class="btn-register">إنشاء الحساب</button>

            <div class="footer-text">
                <p>عندك حساب؟ <a href="{{ route('login') }}">سجّل الدخول</a></p>
            </div>
        </form>

    </div>

</body>
</html>
