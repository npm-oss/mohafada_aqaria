#!/bin/bash

echo "========================================"
echo "  تشغيل سيرفر Firebase App"
echo "========================================"
echo ""

# التحقق من وجود PHP
if command -v php &> /dev/null; then
    echo "[*] تم العثور على PHP - جاري التشغيل..."
    echo "[*] افتح المتصفح على: http://localhost:8000"
    echo "[*] للزبون: http://localhost:8000/index.html"
    echo "[*] للأدمن: http://localhost:8000/admin/login.html"
    echo ""
    echo "[*] اضغط Ctrl+C لإيقاف السيرفر"
    echo ""
    php -S localhost:8000
    exit 0
fi

# التحقق من وجود Python
if command -v python3 &> /dev/null; then
    echo "[*] تم العثور على Python - جاري التشغيل..."
    echo "[*] افتح المتصفح على: http://localhost:8000"
    echo "[*] للزبون: http://localhost:8000/index.html"
    echo "[*] للأدمن: http://localhost:8000/admin/login.html"
    echo ""
    echo "[*] اضغط Ctrl+C لإيقاف السيرفر"
    echo ""
    python3 -m http.server 8000
    exit 0
fi

# لم يتم العثور على أي سيرفر
echo "[!] خطأ: لم يتم العثور على PHP أو Python"
echo "[!] يرجى تثبيت أحدهما لتشغيل السيرفر"
echo ""
