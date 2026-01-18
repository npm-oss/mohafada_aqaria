# محرر القوالب - دليل شامل 📚

## 📋 جدول المحتويات
1. [نظرة عامة](#نظرة-عامة)
2. [المشكلة والحل](#المشكلة-والحل)
3. [الملفات](#الملفات)
4. [التثبيت](#التثبيت)
5. [الاستخدام](#الاستخدام)
6. [الاختبار](#الاختبار)
7. [استكشاف الأخطاء](#استكشاف-الأخطاء)
8. [الوثائق](#الوثائق)

---

## 🎯 نظرة عامة

محرر القوالب هو أداة تفاعلية لتخصيص قوالب الطباعة للشهادات والبطاقات العقارية في نظام المحافظة العقارية.

### المميزات الرئيسية
- ✅ تحرير مرئي بالسحب والإفلات
- ✅ تعديل النصوص مباشرة
- ✅ تغيير حجم وموضع العناصر
- ✅ دعم صفحات متعددة
- ✅ حفظ وتحميل القوالب
- ✅ تصدير/استيراد JSON
- ✅ معاينة وطباعة
- ✅ تصدير PDF

### التقنيات المستخدمة
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: Laravel 8.x, PHP 7.3+
- **Libraries**: 
  - interact.js (السحب والإفلات)
  - html2canvas (تحويل HTML لصورة)
  - jsPDF (تصدير PDF)

---

## 🔧 المشكلة والحل

### المشكلة الأصلية
كانت صفحة محرر القوالب تظهر **بيضاء تماماً** بدون أي محتوى.

### الأسباب
1. عدم وجود رسالة تحميل أثناء التهيئة
2. عدم معالجة الأخطاء بشكل صحيح
3. عدم وجود محتوى افتراضي واضح
4. مشاكل في ترتيب تحميل JavaScript

### الحل
تم إصلاح المشكلة من خلال:
1. ✅ إضافة رسالة تحميل
2. ✅ تحسين معالجة الأخطاء
3. ✅ إضافة محتوى افتراضي لكل قالب
4. ✅ تحسين ترتيب تحميل الملفات
5. ✅ إنشاء صفحة اختبار مستقلة

---

## 📁 الملفات

### الملفات الأساسية

#### 1. Backend (Laravel)
```
app/Http/Controllers/Admin/TemplateEditorController.php
├── index()           # عرض صفحة القوالب
├── load()            # تحميل قالب محدد
├── save()            # حفظ القالب
├── saveSettings()    # حفظ إعدادات JSON
├── loadSettings()    # تحميل إعدادات JSON
└── restore()         # استعادة القالب الافتراضي
```

#### 2. Views (Blade Templates)
```
resources/views/admin/templates/
├── editor.blade.php        # صفحة اختيار القوالب
└── editor-frame.blade.php  # إطار المحرر
```

#### 3. Frontend Assets
```
public/
├── css/
│   └── template-editor.css      # أنماط المحرر
├── js/
│   └── template-editor.js       # منطق المحرر
└── test-template-editor.html    # صفحة اختبار
```

#### 4. Routes
```
routes/web.php
├── GET  /admin/templates/editor
├── GET  /admin/templates/editor-frame/{type}
├── POST /admin/templates/save-settings
├── GET  /admin/templates/load-settings/{type}
└── POST /admin/templates/restore/{type}
```

### الملفات المعدلة
- ✏️ `resources/views/admin/templates/editor-frame.blade.php`
- ✏️ `public/js/template-editor.js`
- ✏️ `public/css/template-editor.css`

### الملفات الجديدة
- 🆕 `public/test-template-editor.html`
- 🆕 `TEMPLATE_EDITOR_FIX.md`
- 🆕 `QUICK_FIX_AR.md`
- 🆕 `SOLUTION_SUMMARY.md`
- 🆕 `USER_GUIDE_AR.md`
- 🆕 `TEMPLATE_EDITOR_README.md` (هذا الملف)

---

## 🚀 التثبيت

### المتطلبات
- PHP 7.3 أو أحدث
- Laravel 8.x
- Composer
- متصفح حديث (Chrome, Firefox, Edge)

### خطوات التثبيت

#### 1. تحديث الملفات
```bash
# تأكد من وجود جميع الملفات المحدثة
git pull origin main
```

#### 2. مسح الكاش
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

#### 3. التحقق من الملفات
```bash
# تأكد من وجود:
ls public/css/template-editor.css
ls public/js/template-editor.js
ls public/test-template-editor.html
```

#### 4. تشغيل السيرفر
```bash
php artisan serve
```

---

## 💻 الاستخدام

### الطريقة 1: عبر Laravel

#### 1. الوصول للمحرر
```
http://localhost:8000/admin/templates/editor
```

#### 2. اختيار القالب
- اختر "شهادة سلبية" أو "بطاقة عقارية"
- سيفتح المحرر في نافذة منبثقة

#### 3. التعديل
1. اضغط "تفعيل وضع التعديل"
2. حرك العناصر بالسحب
3. عدّل النصوص بالنقر المزدوج
4. غيّر الحجم بسحب الحواف

#### 4. الحفظ
1. اضغط "💾 حفظ التغييرات"
2. انتظر رسالة التأكيد
3. التغييرات محفوظة على السيرفر

### الطريقة 2: الاختبار المباشر

#### 1. فتح صفحة الاختبار
```
افتح: public/test-template-editor.html
في المتصفح مباشرة
```

#### 2. المميزات
- لا يحتاج Laravel
- يستخدم localStorage
- مثالي للتطوير والاختبار
- يعمل بدون سيرفر

---

## 🧪 الاختبار

### اختبار سريع

#### 1. اختبار الصفحة الرئيسية
```bash
# افتح في المتصفح
http://localhost:8000/admin/templates/editor

# يجب أن ترى:
✅ بطاقات القوالب
✅ أيقونات واضحة
✅ أوصاف القوالب
```

#### 2. اختبار المحرر
```bash
# اختر قالب
# يجب أن ترى:
✅ شريط الأدوات
✅ صفحة A4 بيضاء
✅ محتوى افتراضي
✅ رقم الصفحة
```

#### 3. اختبار التحرير
```bash
# فعّل وضع التعديل
# يجب أن تستطيع:
✅ تحديد العناصر
✅ تحريك العناصر
✅ تغيير الحجم
✅ تعديل النصوص
```

#### 4. اختبار الحفظ
```bash
# اضغط حفظ
# يجب أن ترى:
✅ رسالة نجاح
✅ التغييرات محفوظة
✅ يمكن إعادة التحميل
```

### اختبار متقدم

#### اختبار الأداء
```javascript
// في Console
console.time('init');
// أعد تحميل الصفحة
console.timeEnd('init');
// يجب أن يكون < 1 ثانية
```

#### اختبار الذاكرة
```javascript
// في Console
console.log(performance.memory);
// تحقق من usedJSHeapSize
```

#### اختبار التوافق
- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Edge 90+
- ✅ Safari 14+

---

## 🔍 استكشاف الأخطاء

### المشكلة: الصفحة بيضاء

#### الحل 1: تحقق من Console
```javascript
// افتح Developer Tools (F12)
// ابحث عن أخطاء حمراء
// شائع: "interact is not defined"
```

#### الحل 2: تحقق من الملفات
```bash
# تأكد من تحميل:
# Network tab في Developer Tools
✅ template-editor.css (200 OK)
✅ template-editor.js (200 OK)
✅ interact.min.js (200 OK)
```

#### الحل 3: امسح الكاش
```bash
# في المتصفح
Ctrl + Shift + R

# في Laravel
php artisan cache:clear
php artisan view:clear
```

### المشكلة: لا يمكن تحريك العناصر

#### الحل
```
1. تأكد من تفعيل "وضع التعديل"
2. انقر على العنصر أولاً
3. تحقق من Console للأخطاء
4. جرب صفحة الاختبار
```

### المشكلة: التغييرات لا تُحفظ

#### الحل
```
1. تحقق من اتصال الإنترنت
2. افتح Network tab
3. ابحث عن طلب save-settings
4. تحقق من الاستجابة (200 OK)
5. تحقق من CSRF token
```

### المشكلة: الطباعة غير صحيحة

#### الحل
```
1. استخدم "معاينة الطباعة"
2. إعدادات الطابعة:
   - الحجم: A4
   - الاتجاه: عمودي
   - الهوامش: افتراضي
   - طباعة الخلفية: نعم
3. جرب حفظ PDF أولاً
```

---

## 📚 الوثائق

### للمستخدمين
- 📖 [دليل الاستخدام](USER_GUIDE_AR.md) - شرح مفصل للمستخدم النهائي
- 🚀 [دليل سريع](QUICK_FIX_AR.md) - بدء سريع

### للمطورين
- 🔧 [شرح الإصلاح](TEMPLATE_EDITOR_FIX.md) - تفاصيل تقنية
- 📊 [ملخص الحل](SOLUTION_SUMMARY.md) - نظرة شاملة

### API Documentation

#### حفظ القالب
```javascript
POST /admin/templates/save-settings
Content-Type: application/json

{
  "type": "negative-certificate",
  "settings": "{...}"
}

Response:
{
  "success": true,
  "message": "تم حفظ القالب بنجاح"
}
```

#### تحميل القالب
```javascript
GET /admin/templates/load-settings/{type}

Response:
{
  "success": true,
  "settings": {...}
}
```

#### استعادة الافتراضي
```javascript
POST /admin/templates/restore/{type}

Response:
{
  "success": true,
  "message": "تم استعادة القالب الافتراضي"
}
```

---

## 🎓 أمثلة عملية

### مثال 1: إنشاء قالب جديد
```javascript
// 1. افتح المحرر
// 2. فعّل وضع التعديل
// 3. أضف العناصر
// 4. رتب العناصر
// 5. احفظ
// 6. صدّر JSON كنسخة احتياطية
```

### مثال 2: تعديل قالب موجود
```javascript
// 1. افتح المحرر
// 2. سيتم تحميل القالب المحفوظ
// 3. فعّل وضع التعديل
// 4. عدّل ما تريد
// 5. احفظ
```

### مثال 3: استيراد قالب
```javascript
// 1. افتح المحرر
// 2. اضغط "استيراد JSON"
// 3. اختر الملف
// 4. سيتم تطبيق القالب
// 5. احفظ إذا أردت
```

---

## 🤝 المساهمة

### الإبلاغ عن مشاكل
1. افتح Developer Console (F12)
2. التقط صورة للشاشة
3. انسخ الأخطاء من Console
4. سجل الخطوات للتكرار
5. أنشئ Issue في GitHub

### اقتراح تحسينات
1. صف الميزة المطلوبة
2. اشرح الفائدة
3. أرفق mockups إن أمكن
4. أنشئ Feature Request

---

## 📞 الدعم

### الدعم الفني
- 📧 Email: support@example.com
- 💬 Chat: متاح في لوحة التحكم
- 📱 Phone: +213-XXX-XXX-XXX

### الموارد
- 📖 [الوثائق الكاملة](https://docs.example.com)
- 🎥 [فيديوهات تعليمية](https://youtube.com/example)
- 💡 [الأسئلة الشائعة](https://faq.example.com)

---

## 📝 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE).

---

## ✨ الخلاصة

محرر القوالب الآن يعمل بشكل كامل مع:
- ✅ واجهة سهلة الاستخدام
- ✅ تحرير مرئي تفاعلي
- ✅ حفظ وتحميل موثوق
- ✅ معالجة أخطاء محسّنة
- ✅ وثائق شاملة

**جاهز للاستخدام! 🎉**

---

*آخر تحديث: 18 يناير 2026*
