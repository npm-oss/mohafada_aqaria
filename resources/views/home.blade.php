<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>المحافظة العقارية</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">المحافظة العقارية</div>

    <ul class="nav-links">
        <li><a href="{{ route('home') }}">الرئيسية</a></li>

        <!-- طلب الشهادة السلبية (dropdown بالضغط) -->
        <li class="dropdown">
            <a href="javascript:void(0)" onclick="toggleNegativeMenu()">
                طلب الشهادة السلبية ▾
            </a>

            <ul class="dropdown-menu" id="negativeMenu">
                <li>
                    <a href="{{ route('negative.new') }}">➕ طلب جديد</a>
                </li>
                <li>
                    <a href="{{ route('negative.reprint') }}">🔁 إعادة استخراج</a>
                </li>
            </ul>
        </li>






<!-- استخراج نسخة من الوثائق العقارية (dropdown بالضغط) -->
<li class="dropdown">
    <a href="javascript:void(0)" onclick="toggleExtractMenu()">
        📄 طلب نسخة من الوثائق العقارية ▾
    </a>

    <ul class="dropdown-menu" id="extractMenu">

        <!-- البطاقات العقارية -->
        <li class="dropdown-sub">
            <a href="javascript:void(0)" onclick="toggleCardsMenu(event)">
                ▶ البطاقات  
            </a>

            <ul class="dropdown-submenu" id="cardsMenu">
                <li>
                    <a href="{{ route('card.natural') }}">البطاقةالشخصية</a>
                </li>
                <li>
                    <a href="{{ route('card.moral') }}">البطاقةالأبجدية</a>
                </li>
                <li>
                    <a href="{{ route('card.urban_private') }}">البطاقةالحضريةالخاصة</a>
                </li>
                <li>
                    <a href="{{ route('card.rural_card') }}">البطاقةالريفية</a>
                </li>
            </ul>
        </li>

        <!-- مستخرجات العقود -->
        <li>
           <a href="{{ url('/contracts/extracts') }}">

                مستخرجات العقود
            </a>
        </li>

    </ul>
</li>






<!-- استخراج الوثائق المسحية -->
<li class="dropdown">
    <a href="javascript:void(0)" onclick="toggleTopoMenu()">
        🗺️ استخراج الوثائق المسحية ▾
    </a>

    <ul class="dropdown-menu" id="topoMenu">
        <li>
            <a href="{{ url('/topographic/scanned') }}">
                🟢 بطاقات العقارات الممسوحة
            </a>
        </li>

        <li>
            <a href="{{ url('/topographic/unscanned') }}">
                🟠 بطاقات العقارات غير الممسوحة
            </a>
        </li>

        <li>
            <a href="{{ url('/topographic/rural') }}">
                🌾 بطاقات المسح الريفية
            </a>
        </li>
    </ul>
</li>

        <li><a href="{{ route('appointment') }}">حجز موعد</a></li>
        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
        <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
    </ul>
</nav>

<!-- HERO -->
<header class="hero">
    <div class="overlay"></div>

    <div class="hero-content">
        <h1> الموقع الرسمي للمحافظة العقارية اولاد جلال</h1>
        <p>إدارة الأراضي، الملكيات، العقود والوثائق العقارية.</p>
        <a href="#" class="btn">ابدئي الآن</a>
    </div>
</header>

<!-- SERVICES -->
<section id="services" class="services-section">
    <h2>خدمات المحافظة العقارية</h2>

    <div class="services-grid">
        <div class="service-card">
            <h3>مسك السجل العقاري الوطني</h3>
            <p>تسجيل وتدوين الحقوق العينية الأصلية والتبعية الخاصة بالعقارات.</p>
        </div>

        <div class="service-card">
            <h3>إشهار المعاملات العقارية</h3>
            <p>إشهار العقود والتصرفات مثل البيع والهبة والرهن والقسمة.</p>
        </div>

        <div class="service-card">
            <h3>حماية الملكية العقارية</h3>
            <p>ضمان استقرار الملكية ومنع النزاعات عبر التسجيل القانوني للعقود.</p>
        </div>

        <div class="service-card">
            <h3>تحيين المعلومات العقارية</h3>
            <p>تحديث وضعية العقار عند حدوث أي تغيير مثل البيع أو الميراث.</p>
        </div>

        <div class="service-card">
            <h3>تقديم المعلومات العقارية</h3>
            <p>تمكين المواطنين من الحصول على شهادات ووثائق عقارية رسمية.</p>
        </div>

        <div class="service-card">
            <h3>المساهمة في التنمية الاقتصادية</h3>
            <p>توفير بيانات دقيقة تساعد الدولة في التخطيط والاستثمار.</p>
        </div>
    </div>
</section>

<!-- JavaScript -->
<script>
function toggleNegativeMenu() {
    const menu = document.getElementById('negativeMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}
</script>

</body>
</html>


</html>
