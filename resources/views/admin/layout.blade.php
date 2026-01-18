<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS إضافي إن وجد -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-white shadow-xl p-5 border-l">

        <!-- عنوان -->
        <h2 class="text-2xl font-bold text-blue-700 mb-8 text-center">
            لوحة التحكم
        </h2>

        <!-- روابط -->
        <ul class="space-y-3 text-lg">
            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/dashboard">🏠 الرئيسية</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/users">👤 المستخدمين</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/messages">📩 الرسائل</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/appointments">📅 المواعيد</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="{{ route('admin.certificates') }}">📄 الشهادات السلبية</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="{{ route('admin.documents') }}">📑 استخراج الوثائق العقارية</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/topographic">📐 الوثائق المسحية</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/payments">💰 الدفع الإلكتروني</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="{{ route('admin.templates.editor') }}">🎨 محرر القوالب</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/settings">⚙️ الإعدادات</a></li>

            <li><a class="nav-link block py-2 px-3 rounded hover:bg-blue-100" href="/admin/change-password">🔐 تغيير كلمة المرور</a></li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-right py-2 px-3 text-red-600 hover:bg-red-100 rounded">
                        🚪 تسجيل الخروج
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- محتوى كامل -->
    <main class="flex-1 p-0">

        
        <!-- محتوى الصفحات -->
        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>
