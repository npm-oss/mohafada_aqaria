<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة سلبية - {{ $certificate->owner_firstname }} {{ $certificate->owner_lastname }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@600;700&display=swap');
        
        :root {
            --border-color: #000;
            --border-width: 1.5px;
        }
        
        body {
            font-family: 'Amiri', serif;
            background-color: #e0e0e0;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        
        .page {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 10mm 15mm;
            box-sizing: border-box;
            border: 1px solid #ccc;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            position: relative;
            color: #000;
        }
        
        p { margin: 2px 0; line-height: 1.3; }
        .bold { font-weight: bold; }
        .center { text-align: center; }
        .dotted { 
            border-bottom: 1px dotted #000; 
            flex-grow: 1; 
            margin: 0 5px; 
            min-width: 20px; 
            display: inline-block; 
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }
        
        .header-title {
            font-family: 'Cairo', sans-serif;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
            margin-top: 10px;
        }
        
        .header-left {
            font-size: 14px;
            font-weight: bold;
            text-align: left;
            width: 100px;
            line-height: 1.4;
        }
        
        .header-boxes {
            display: flex;
            gap: 10px;
            min-height: 110px;
            margin-bottom: 10px;
        }
        
        .conservator-box {
            width: 45%;
            border: 2px solid var(--border-color);
            padding: 2px;
            font-size: 13px;
            background: white;
        }
        
        .box-title {
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid var(--border-color);
            background-color: #fdfdfd;
            margin-bottom: 2px;
        }
        
        .conservator-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 10px;
            padding: 0 5px;
        }
        
        .conservator-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
            white-space: nowrap;
        }
        
        .stamp-box {
            width: 25%;
            border: 2px solid var(--border-color);
            position: relative;
            background: white;
            min-height: 100px;
        }
        
        .stamp-label {
            position: absolute;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            background: white;
            padding: 0 5px;
        }
        
        .alert-banner {
            border: 3px double var(--border-color);
            text-align: center;
            padding: 3px;
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 5px;
            background: white;
        }
        
        .main-wrapper {
            display: flex;
            border: 2px solid var(--border-color);
            min-height: 750px;
        }
        
        .sidebar {
            width: 26%;
            border-left: 2px solid var(--border-color);
            font-size: 11px;
            padding: 5px;
            line-height: 1.35;
            text-align: justify;
        }
        
        .sidebar-header {
            border: 1px solid var(--border-color);
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;
            padding: 2px;
            background-color: #f9f9f9;
        }
        
        .ref-item {
            margin-bottom: 8px;
            display: block;
            background: white;
        }
        
        .form-body {
            width: 74%;
            padding: 10px;
            position: relative;
        }
        
        .form-main-title {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .form-main-title h2 {
            margin: 0;
            font-size: 18px;
            text-decoration: underline;
            text-underline-offset: 5px;
        }
        
        .sub-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .input-row {
            display: flex;
            align-items: baseline;
            margin-bottom: 5px;
            font-size: 15px;
            padding: 2px 0;
        }
        
        .checkbox-section {
            margin-top: 15px;
        }
        
        .cb-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 6px;
            font-size: 14px;
            background: white;
            padding: 2px 0;
        }
        
        .square {
            width: 12px;
            height: 12px;
            border: 1.5px solid #000;
            margin-left: 8px;
            margin-top: 4px;
            flex-shrink: 0;
        }
        
        .square.checked {
            background-color: #000;
        }
        
        .legal-block {
            padding-right: 25px;
            font-size: 13.5px;
            line-height: 1.6;
            text-align: justify;
            background: white;
        }
        
        .bottom-section {
            border-top: 2px solid var(--border-color);
            margin-top: 10px;
            padding-top: 5px;
        }
        
        .other-info {
            border: 1px solid var(--border-color);
            height: 40px;
            position: relative;
            margin-bottom: 5px;
            background: white;
        }
        
        .other-info-label {
            position: absolute;
            top: -10px;
            right: 10px;
            background: white;
            padding: 0 5px;
            font-weight: bold;
            font-size: 13px;
        }
        
        .payment-area {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-area {
            text-align: left;
            margin-left: 20px;
            width: 200px;
        }
        
        .rejected-box {
            border: 2px solid var(--border-color);
            width: 45%;
            font-size: 12px;
            padding: 5px;
            margin-top: 10px;
            float: right;
            background: white;
        }
        
        .rejected-title {
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }
        
        .filled-data {
            background-color: #f0f0f0;
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- الرأس -->
        <div class="header-top">
            <div style="flex:1"></div>
            <div class="header-title">إدارة الأملاك الوطنية</div>
            <div class="header-left">عدد {{ $certificate->id }} م.ع.<br>مكرر</div>
        </div>

        <!-- الصناديق العلوية -->
        <div class="header-boxes">
            <div class="conservator-box">
                <div class="box-title">إطار مخصص للمحافظ</div>
                <div class="conservator-grid">
                    <div>
                        <div class="conservator-row">
                            <span>سعر :</span> 
                            <span class="dotted filled-data">{{ $certificate->price ?? '500 دج' }}</span>
                        </div>
                        <div class="conservator-row">
                            <span>خدمات عدد:</span> 
                            <span class="dotted filled-data">{{ $certificate->service_number ?? $certificate->id }}</span>
                        </div>
                        <div class="conservator-row">
                            <span>جدول مسلم في :</span> 
                            <span class="dotted filled-data">{{ $certificate->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="conservator-row">
                            <span>دج | طلب عدد :</span> 
                            <span class="dotted filled-data">{{ $certificate->id }}</span>
                        </div>
                        <div class="conservator-row">
                            <span>موضع في :</span> 
                            <span class="dotted filled-data">{{ $certificate->created_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="conservator-row">
                            <span>إجراء :</span> 
                            <span class="dotted filled-data">شهادة سلبية</span>
                        </div>
                        <div class="conservator-row">
                            <span>حجم :</span> 
                            <span class="dotted filled-data">A4</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stamp-box">
                <span class="stamp-label">طــــــابع المكتب</span>
            </div>
        </div>

        <div class="alert-banner">
            توصيــــــــة هــــــامــــــــــــة<br>
            تقدم لزوما الطلبات على نسختين و بالآلـــــــة الراقنــــــة
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-wrapper">
            <!-- الشريط الجانبي -->
            <div class="sidebar">
                <div class="sidebar-header">مراجع الطلب</div>
                <div class="ref-item"><strong>(1)</strong> يشطب عند الاقتضاء</div>
                <div class="ref-item"><strong>(2)</strong> اسم لقب مهنة الطالب</div>
                <div class="ref-item"><strong>(3)</strong> العنوان الكامل</div>
                <div class="ref-item"><strong>(4)</strong> إذا أراد الطالب التحصيل من نقلة كاملــــة لوثائق يلزم أن يعوض كلمة مستخرج بـ نقلة .</div>
                <div class="ref-item"><strong>(5)</strong> ضع علامة على التربيـعة المعنية</div>
                <div class="ref-item"><strong>(6)(7) تسليم المعلومات</strong><br>أ) في ظرف خمسين سنة التابعة للطلب عندما تعني العقارات و الحقوق المعينة الثابتة والداخلة في اختصاصات محافظي قديمة سابقة للأول مارس 1961<br>ب) و بعد فاتح مارس 1961 و في حالة ما تعلق بعقــــارات أو حقوق معينة ثابتة تابعة لمكتب حديث غير مجهز بوثائق قديمة يسند عندئذ أول مارس 1961</div>
                <div class="ref-item"><strong>(6)</strong> وفي هذه الحالة يلتمــــس الطالب عند الاقتضاء من المحافظة الأصلية تسليم المعلومات المحتوية على المادة السابقة لأول مــارس 1961 بضع حينئذ 01 مارس 1961بـ (7)</div>
                <div class="ref-item"><strong>(8)</strong> في حالة طلب المعلومات على الإجــــــراء حدده .</div>
                <div class="ref-item"><strong>(9)</strong> يبين نوعها ( تسجيل حجز – إشهار – تاريخ – حجم وعدد ...)</div>
            </div>

            <!-- النموذج الرئيسي -->
            <div class="form-body">
                <div class="form-main-title">
                    <h2>طــــــــلب معلومات موجزة (1)</h2>
                    <div class="sub-options">
                        <span>على (1)</span>
                        <span>خــــــارج عن (1)</span>
                    </div>
                    <div style="text-align: center; margin-top: 2px;">إجــــــــــــــراء</div>
                </div>

                <div class="input-row">
                    <span class="bold">أنا الممضي أسفلــــه (2) .</span>
                    <span class="dotted filled-data">{{ $certificate->owner_firstname }} {{ $certificate->owner_lastname }}</span>
                </div>

                <div class="input-row">
                    <span class="bold">الساكن بـ(3) :</span>
                    <span class="dotted filled-data">{{ $certificate->owner_birthplace ?? 'غير محدد' }}</span>
                </div>

                <!-- خيارات الاختيار -->
                <div class="checkbox-section">
                    <div class="center bold" style="margin-bottom: 5px;">أطلب مستخـــــــــرجا (4)</div>
                    
                    <div class="cb-row">
                        <div class="square checked"></div>
                        <span>من الحجزات الغير الباطلة و لا المشطبة ،(5)</span>
                    </div>
                    
                    <div class="cb-row">
                        <div class="square"></div>
                        <span>من تسجيلات الامتيازات و الرهــــون المستبقية ، (5)</span>
                    </div>
                    
                    <div class="cb-row">
                        <div class="square"></div>
                        <span>من الوثائق المسجلة أو المشهورة ( ما عدى التسجيلات و الحجزات و التأشيرات بالهــــــامش) التي لها أثر اكتسابي للأشخاص الناشئ عنها المعلومات المطلوبة(1)</span>
                    </div>
                    
                    <div class="cb-row">
                        <div class="square"></div>
                        <span>من تأشيرات الأحكام المعلنة الفسخ و الإبطــــال و النقض الحاصلة قبل أول مــــارس 1961 والصادرة أو المشهـــــــورة منذ(6) 01 مــــــارس1961</span>
                    </div>
                    
                    <div class="legal-block">
                        إلــى يــــومــــــــــــــنا هـــــــذا (7) إلــى تاريـخ هــــــــــــــذا الطلــب<br>
                        الناشئ عن الأشخــــــــــاص و العقــــــــــارات المبينة ظهر هذا الطلب<br>
                        باستثناء – التسجيل أو الإشهـــــــــار المطلــــــــــوب معــــــــــــا ، (8) (1)<br>
                        – الرسوم و الأحكــــــــــام المذكــــــــــورة في القــــــــــائمة أو الوثيقة الموضوعة مع هــذا الطلب<br>
                        – الإجراءات الآتية : (9)
                    </div>
                </div>

                <div class="bottom-section">
                    <div class="other-info">
                        <span class="other-info-label">معلومات أخرى مطلـــــــــــــوبة</span>
                    </div>
                    <div class="center bold" style="color: black;">* طلب خارج الاجراء</div>
                </div>

                <div class="payment-area">
                    <div style="width: 60%;">
                        <div class="input-row">
                            <span>أودع مبلغا قدره</span>
                            <span class="dotted filled-data">500</span>
                            <span>دج و أتعهد بأداء ما يقي من</span>
                        </div>
                        <div>المصاريف عند الاقتضاء بعد تسليم المعلومات .</div>
                    </div>
                    <div class="signature-area">
                        <div>في {{ $certificate->created_at->format('Y/m/d') }}</div>
                        <div style="text-align: center; border-top: 1px solid black; margin-top: 5px; padding-top: 2px;">
                            إمضــــــاء الطــــــالب:<br>
                            <span class="filled-data">{{ $certificate->owner_firstname }} {{ $certificate->owner_lastname }}</span>
                        </div>
                    </div>
                </div>

                <div class="rejected-box">
                    <div class="rejected-title">طلب غير قياسي<br>وضع مرفوض</div>
                    <div class="cb-row"><div class="square"></div> عدم استعمال الآلة الراقنة</div>
                    <div class="cb-row"><div class="square"></div> عدم إقامة نسخة ثانية</div>
                    <div class="cb-row"><div class="square"></div> بيان غير كامل للأطراف</div>
                    <div class="cb-row"><div class="square"></div> بيان غير كامل للعقارات</div>
                    <div class="cb-row"><div class="square"></div> عدم الدفع على الحساب المحافظ</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>