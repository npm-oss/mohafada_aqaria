# 🚀 كيفية تشغيل المشروع - دليل شامل

## 📋 نظرة عامة

هذا المشروع يستخدم:
- **Laravel** (Backend - PHP)
- **Firebase Realtime Database** (قاعدة البيانات السحابية)
- **HTML/CSS/JavaScript** (Frontend)

## ⚡ التشغيل السريع (3 خطوات فقط!)

### 1️⃣ شغّل السيرفر المحلي

#### على Windows:
```bash
# انتقل إلى مجلد التطبيق
cd public/firebase-app

# شغّل السيرفر (انقر مرتين على الملف)
start-server.bat
```

#### على Linux/Mac:
```bash
cd public/firebase-app
chmod +x start-server.sh
./start-server.sh
```

### 2️⃣ افتح المتصفح

اختر حسب الحاجة:

| الصفحة | الرابط | الوصف |
|--------|--------|-------|
| **الزبون** | http://localhost:8000/index.html | الصفحة الرئيسية للعملاء |
| **الأدمن** | http://localhost:8000/admin/login.html | لوحة تحكم الإدارة |
| **الاختبار** | http://localhost:8000/test-connection.html | فحص الاتصال بـ Firebase |

### 3️⃣ أنشئ حساب أدمن (مرة واحدة فقط)

1. اذهب إلى: https://console.firebase.google.com
2. اختر المشروع: **project-811172743097267139**
3. من القائمة الجانبية: **Authentication**
4. اضغط **Add User**
5. أدخل:
   - البريد: `admin@mohafada.dz`
   - كلمة المرور: `Admin@123`
6. احفظ

الآن يمكنك تسجيل الدخول! 🎉

---

## 🔧 التشغيل المتقدم

### الطريقة 1: PHP Built-in Server (موصى بها)

```bash
# من مجلد المشروع الرئيسي
php -S localhost:8000 -t public/firebase-app

# أو من مجلد firebase-app
cd public/firebase-app
php -S localhost:8000
```

### الطريقة 2: Python HTTP Server

```bash
cd public/firebase-app

# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000
```

### الطريقة 3: Node.js http-server

```bash
# تثبيت (مرة واحدة)
npm install -g http-server

# تشغيل
cd public/firebase-app
http-server -p 8000
```

### الطريقة 4: Laravel Artisan Serve

```bash
# من مجلد المشروع الرئيسي
php artisan serve

# ثم افتح
# http://localhost:8000/firebase-app/index.html
```

---

## 🧪 اختبار الاتصال

### الطريقة السريعة:
افتح: http://localhost:8000/test-connection.html

يجب أن ترى:
- ✅ تحميل مكتبة Firebase
- ✅ تحميل ملف الإعدادات
- ✅ تهيئة التطبيق
- ✅ الاتصال بقاعدة البيانات
- ✅ قراءة البيانات

### الطريقة اليدوية:
افتح: http://localhost:8000/admin/debug-connection.html

---

## 🔐 إدارة المستخدمين

### إنشاء حساب أدمن جديد:

1. **عبر Firebase Console** (موصى به):
   ```
   https://console.firebase.google.com
   → اختر المشروع
   → Authentication
   → Add User
   → أدخل البريد وكلمة المرور
   ```

2. **عبر Firebase CLI** (متقدم):
   ```bash
   firebase auth:import users.json --project project-811172743097267139
   ```

### حسابات تجريبية مقترحة:

| الدور | البريد | كلمة المرور |
|------|--------|-------------|
| أدمن رئيسي | admin@mohafada.dz | Admin@2026 |
| موظف | staff@mohafada.dz | Staff@2026 |
| مدير | manager@mohafada.dz | Manager@2026 |

---

## 📊 إعدادات Firebase

### معلومات المشروع:

```javascript
Project ID: project-811172743097267139
Database URL: https://project-811172743097267139-default-rtdb.europe-west1.firebasedatabase.app
Region: europe-west1
```

### قواعد قاعدة البيانات:

#### للتطوير (Development):
```json
{
  "rules": {
    ".read": true,
    ".write": true
  }
}
```

#### للإنتاج (Production):
```json
{
  "rules": {
    ".read": "auth != null",
    ".write": "auth != null",
    "negative_certificates": {
      ".read": true,
      ".write": "auth != null"
    },
    "documents_requests": {
      ".read": true,
      ".write": "auth != null"
    },
    "contacts": {
      ".read": "auth != null",
      ".write": true
    }
  }
}
```

---

## 🐛 حل المشاكل الشائعة

### ❌ المشكلة: صفحة فارغة أو بيضاء

**الحل:**
1. تأكد من تشغيل السيرفر المحلي
2. لا تفتح الملفات مباشرة (file:///)
3. استخدم http://localhost:8000

### ❌ المشكلة: CORS Error

**الحل:**
```
Access to script at 'file:///.../firebase-config.js' from origin 'null' has been blocked by CORS policy
```
- هذا يعني أنك فتحت الملف مباشرة
- شغّل السيرفر المحلي واستخدم http://localhost

### ❌ المشكلة: لا يتصل بـ Firebase

**الحل:**
1. تحقق من اتصال الإنترنت
2. افتح صفحة الاختبار: http://localhost:8000/test-connection.html
3. تحقق من قواعد Database في Firebase Console
4. تأكد من أن المشروع نشط في Firebase

### ❌ المشكلة: لا يمكن تسجيل الدخول

**الحل:**
1. تأكد من إنشاء حساب في Firebase Authentication
2. تحقق من البريد وكلمة المرور
3. افتح Console المتصفح (F12) لرؤية الأخطاء

### ❌ المشكلة: Permission Denied

**الحل:**
```
PERMISSION_DENIED: Permission denied
```
- تحقق من قواعد Database في Firebase Console
- للتطوير، استخدم القواعد المفتوحة (انظر أعلاه)

---

## 📁 هيكل المشروع

```
mohafada_aqaria/
├── public/
│   └── firebase-app/              # تطبيق Firebase
│       ├── index.html             # الصفحة الرئيسية
│       ├── negative-new.html      # طلب شهادة سلبية
│       ├── contact.html           # صفحة الاتصال
│       ├── test-connection.html   # اختبار الاتصال ⭐
│       ├── START_HERE.html        # صفحة البداية
│       ├── start-server.bat       # تشغيل السيرفر (Windows) ⭐
│       ├── start-server.sh        # تشغيل السيرفر (Linux/Mac) ⭐
│       ├── admin/
│       │   ├── login.html         # تسجيل دخول الأدمن
│       │   ├── dashboard.html     # لوحة التحكم
│       │   ├── certificates.html  # إدارة الشهادات
│       │   ├── documents.html     # إدارة الوثائق
│       │   └── messages.html      # إدارة الرسائل
│       ├── js/
│       │   ├── firebase-config.js # إعدادات Firebase ⭐
│       │   └── main.js
│       └── css/
│           ├── main.css
│           ├── forms.css
│           └── admin.css
├── app/                           # Laravel Backend
├── config/                        # إعدادات Laravel
├── ابدأ_هنا.md                   # دليل البدء السريع ⭐
├── FIREBASE_CONNECTION_FIX_AR.md  # حل مشاكل الاتصال ⭐
└── HOW_TO_RUN_AR.md              # هذا الملف ⭐
```

---

## 🎯 الميزات المتاحة

### للزبون (العملاء):
- ✅ طلب شهادة سلبية جديدة
- ✅ إعادة استخراج شهادة
- ✅ طلب بطاقة عقارية (حضرية، ريفية، شخصية، أبجدية)
- ✅ التواصل مع الإدارة
- ✅ تتبع حالة الطلبات

### للأدمن (الإدارة):
- ✅ إدارة طلبات الشهادات السلبية
- ✅ إدارة طلبات الوثائق
- ✅ إدارة رسائل التواصل
- ✅ طباعة الشهادات والوثائق
- ✅ تحرير القوالب
- ✅ لوحة تحكم شاملة
- ✅ إحصائيات وتقارير

---

## 📞 الدعم والمساعدة

### الملفات المرجعية:
1. **ابدأ_هنا.md** - دليل البدء السريع
2. **FIREBASE_CONNECTION_FIX_AR.md** - حل مشاكل الاتصال
3. **public/firebase-app/README_AR.md** - دليل التطبيق
4. **TEMPLATE_EDITOR_README.md** - دليل محرر القوالب

### صفحات الاختبار:
- http://localhost:8000/test-connection.html
- http://localhost:8000/admin/debug-connection.html

### أدوات المطور:
- اضغط `F12` في المتصفح لفتح Console
- تحقق من تبويب Network لرؤية الطلبات
- تحقق من تبويب Console لرؤية الأخطاء

---

## ⚠️ ملاحظات مهمة

1. **اتصال الإنترنت**: التطبيق يحتاج اتصال إنترنت دائماً (Firebase سحابي)
2. **السيرفر المحلي**: لا تفتح الملفات مباشرة، استخدم http://localhost
3. **قواعد Firebase**: للتطوير استخدم قواعد مفتوحة، للإنتاج استخدم قواعد آمنة
4. **حسابات الأدمن**: يجب إنشاؤها في Firebase Console
5. **المتصفحات المدعومة**: Chrome, Firefox, Edge, Safari (آخر إصدار)

---

## 🚀 البدء الآن!

```bash
# 1. شغّل السيرفر
cd public/firebase-app
start-server.bat  # أو ./start-server.sh

# 2. افتح المتصفح
http://localhost:8000/test-connection.html

# 3. إذا نجح الاختبار، افتح التطبيق
http://localhost:8000/index.html  # للزبون
http://localhost:8000/admin/login.html  # للأدمن
```

**مبروك! 🎉 التطبيق يعمل الآن**

---

**آخر تحديث**: يناير 2026
**الإصدار**: 1.0.0
