# 🏛️ المحافظة العقارية - نظام إدارة الشهادات والوثائق

نظام متكامل لإدارة الشهادات السلبية والبطاقات العقارية باستخدام Laravel و Firebase

## 🚀 البدء السريع

### تشغيل التطبيق (3 خطوات فقط!)

#### 1. شغّل السيرفر المحلي

**Windows:**
```bash
cd public/firebase-app
start-server.bat
```

**Linux/Mac:**
```bash
cd public/firebase-app
chmod +x start-server.sh
./start-server.sh
```

#### 2. افتح المتصفح

- **للزبون**: http://localhost:8000/index.html
- **للأدمن**: http://localhost:8000/admin/login.html
- **اختبار الاتصال**: http://localhost:8000/test-connection.html

#### 3. أنشئ حساب أدمن

1. اذهب إلى: https://console.firebase.google.com
2. اختر المشروع: `project-811172743097267139`
3. Authentication → Add User
4. أدخل البريد وكلمة المرور

**✅ جاهز للاستخدام!**

---

## 📚 الأدلة والوثائق

| الملف | الوصف |
|------|-------|
| **[ابدأ_هنا.md](ابدأ_هنا.md)** | دليل البدء السريع (موصى به للمبتدئين) |
| **[HOW_TO_RUN_AR.md](HOW_TO_RUN_AR.md)** | دليل شامل للتشغيل والإعداد |
| **[FIREBASE_CONNECTION_FIX_AR.md](FIREBASE_CONNECTION_FIX_AR.md)** | حل مشاكل الاتصال بـ Firebase |
| **[public/firebase-app/README_AR.md](public/firebase-app/README_AR.md)** | دليل التطبيق الكامل |
| **[TEMPLATE_EDITOR_README.md](TEMPLATE_EDITOR_README.md)** | دليل محرر القوالب |

---

## 🎯 الميزات

### للزبون (العملاء)
- ✅ طلب شهادة سلبية جديدة
- ✅ إعادة استخراج شهادة
- ✅ طلب بطاقة عقارية (حضرية، ريفية، شخصية، أبجدية)
- ✅ التواصل مع الإدارة

### للأدمن (الإدارة)
- ✅ إدارة طلبات الشهادات السلبية
- ✅ إدارة طلبات الوثائق
- ✅ إدارة رسائل التواصل
- ✅ طباعة الشهادات والوثائق
- ✅ تحرير القوالب
- ✅ لوحة تحكم شاملة

---

## 🛠️ التقنيات المستخدمة

- **Backend**: Laravel 8.x (PHP)
- **Database**: Firebase Realtime Database
- **Frontend**: HTML5, CSS3, JavaScript (ES6)
- **Authentication**: Firebase Auth
- **Styling**: Custom CSS with Tajawal Font

---

## ⚠️ مهم جداً

### ✅ افعل:
- شغّل السيرفر المحلي دائماً
- استخدم `http://localhost:8000`
- تأكد من اتصال الإنترنت

### ❌ لا تفعل:
- لا تفتح الملفات مباشرة من المجلد
- لا تستخدم `file:///` في المتصفح
- لا تغلق نافذة السيرفر أثناء العمل

---

## 🐛 حل المشاكل

### المشكلة: لا يتصل بقاعدة البيانات

**الحل:**
1. تأكد من تشغيل السيرفر المحلي
2. افتح صفحة الاختبار: http://localhost:8000/test-connection.html
3. اقرأ: [FIREBASE_CONNECTION_FIX_AR.md](FIREBASE_CONNECTION_FIX_AR.md)

### المشكلة: CORS Error

**الحل:**
- لا تفتح الملفات مباشرة
- استخدم السيرفر المحلي (start-server.bat)

### المشكلة: لا يمكن تسجيل الدخول

**الحل:**
- أنشئ حساب في Firebase Console أولاً
- تحقق من البريد وكلمة المرور

---

## 📁 هيكل المشروع

```
mohafada_aqaria/
├── public/firebase-app/          # تطبيق Firebase الرئيسي
│   ├── index.html                # الصفحة الرئيسية
│   ├── test-connection.html      # اختبار الاتصال ⭐
│   ├── start-server.bat          # تشغيل السيرفر ⭐
│   ├── admin/                    # لوحة تحكم الأدمن
│   ├── js/firebase-config.js     # إعدادات Firebase
│   └── css/                      # التنسيقات
├── app/                          # Laravel Backend
├── config/                       # إعدادات Laravel
└── ابدأ_هنا.md                  # دليل البدء السريع ⭐
```

---

## 📞 الدعم

للمساعدة، راجع:
1. **[ابدأ_هنا.md](ابدأ_هنا.md)** - للبدء السريع
2. **[HOW_TO_RUN_AR.md](HOW_TO_RUN_AR.md)** - للتشغيل المتقدم
3. **[FIREBASE_CONNECTION_FIX_AR.md](FIREBASE_CONNECTION_FIX_AR.md)** - لحل المشاكل

---

## 📄 الترخيص

هذا المشروع مرخص تحت MIT License

---

## 👥 المساهمة

المساهمات مرحب بها! يرجى فتح Issue أو Pull Request

---

**آخر تحديث**: يناير 2026  
**الإصدار**: 1.0.0
