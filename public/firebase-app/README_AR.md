# تطبيق المحافظة العقارية - Firebase

## 🚀 كيفية التشغيل

### Windows
```bash
# انقر مرتين على الملف
start-server.bat

# أو من سطر الأوامر
cd public/firebase-app
start-server.bat
```

### Linux/Mac
```bash
cd public/firebase-app
chmod +x start-server.sh
./start-server.sh
```

### أو يدوياً
```bash
# PHP
php -S localhost:8000

# Python 3
python -m http.server 8000

# Node.js
npx http-server -p 8000
```

## 📱 الوصول للتطبيق

بعد تشغيل السيرفر:

- **الصفحة الرئيسية للزبون**: http://localhost:8000/index.html
- **لوحة تحكم الأدمن**: http://localhost:8000/admin/login.html
- **فحص الاتصال**: http://localhost:8000/admin/debug-connection.html

## 🔐 تسجيل الدخول للأدمن

يجب إنشاء حساب في Firebase Console:

1. اذهب إلى: https://console.firebase.google.com
2. اختر المشروع: `project-811172743097267139`
3. Authentication > Add User
4. أدخل البريد وكلمة المرور

## ⚠️ مهم جداً

- **لا تفتح الملفات مباشرة** من المجلد (file:///)
- **استخدم دائماً سيرفر محلي** (http://localhost)
- **تحتاج اتصال إنترنت** للاتصال بـ Firebase

## 🔧 إعدادات Firebase

الإعدادات موجودة في: `js/firebase-config.js`

```javascript
const firebaseConfig = {
    apiKey: "AIzaSyABixUDt7OMdP0WaeZRW1vr5_xsg-LpPao",
    authDomain: "project-811172743097267139.firebaseapp.com",
    databaseURL: "https://project-811172743097267139-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "project-811172743097267139",
    // ...
};
```

## 📊 قواعد قاعدة البيانات

للتطوير، استخدم هذه القواعد في Firebase Console:

```json
{
  "rules": {
    ".read": true,
    ".write": true
  }
}
```

⚠️ للإنتاج، استخدم قواعد أمان مناسبة!

## 🐛 حل المشاكل

### المتصفح يعرض صفحة فارغة
- تأكد من تشغيل السيرفر المحلي
- افتح Console (F12) لرؤية الأخطاء

### خطأ CORS
- لا تفتح الملفات مباشرة
- استخدم http://localhost بدلاً من file:///

### لا يتصل بـ Firebase
- تحقق من اتصال الإنترنت
- تحقق من قواعد Database في Firebase Console
- افتح صفحة الفحص: http://localhost:8000/admin/debug-connection.html

### لا يمكن تسجيل الدخول
- تأكد من إنشاء حساب في Firebase Authentication
- تحقق من البريد وكلمة المرور

## 📁 هيكل المشروع

```
firebase-app/
├── index.html              # الصفحة الرئيسية
├── negative-new.html       # طلب شهادة سلبية
├── contact.html            # صفحة الاتصال
├── admin/
│   ├── login.html         # تسجيل دخول الأدمن
│   ├── dashboard.html     # لوحة التحكم
│   ├── certificates.html  # إدارة الشهادات
│   ├── documents.html     # إدارة الوثائق
│   └── messages.html      # إدارة الرسائل
├── js/
│   ├── firebase-config.js # إعدادات Firebase
│   └── main.js           # وظائف عامة
└── css/
    ├── main.css          # تنسيقات عامة
    ├── forms.css         # تنسيقات النماذج
    └── admin.css         # تنسيقات الأدمن
```

## 🎯 الميزات

### للزبون
- طلب شهادة سلبية جديدة
- إعادة استخراج شهادة
- طلب بطاقة عقارية
- التواصل مع الإدارة

### للأدمن
- إدارة طلبات الشهادات السلبية
- إدارة طلبات الوثائق
- إدارة رسائل التواصل
- طباعة الشهادات والوثائق
- تحرير القوالب

## 📞 الدعم

للمساعدة، راجع:
- `FIREBASE_CONNECTION_FIX_AR.md` - حل مشاكل الاتصال
- `TEMPLATE_EDITOR_README.md` - دليل محرر القوالب
