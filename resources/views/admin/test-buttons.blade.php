@extends('admin.layout')

@section('content')

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">🧪 صفحة اختبار الأزرار</h1>

    <!-- أزرار الطباعة -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold mb-4 text-green-600">🖨️ أزرار الطباعة</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.certificates.print', 1) }}" 
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-center block">
                🖨️ طباعة شهادة سلبية (ID: 1)
            </a>
            <a href="{{ route('admin.documents.print', 1) }}" 
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-center block">
                🖨️ طباعة بطاقة عقارية (ID: 1)
            </a>
        </div>
        <p class="text-sm text-gray-600 mt-2">ملاحظة: إذا لم تعمل، تأكد من وجود بيانات بـ ID = 1</p>
    </div>

    <!-- محرر القوالب -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold mb-4 text-purple-600">🎨 محرر القوالب</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.templates.editor') }}" 
               class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-6 rounded-lg text-center block">
                🎨 فتح محرر القوالب
            </a>
            <a href="{{ route('admin.templates.editor-frame', 'negative-certificate') }}" 
               target="_blank"
               class="bg-purple-400 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-lg text-center block">
                📄 محرر الشهادة السلبية (مباشر)
            </a>
        </div>
    </div>

    <!-- قوائم الإدارة -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold mb-4 text-blue-600">📋 قوائم الإدارة</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.certificates') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg text-center block">
                📄 قائمة الشهادات السلبية
            </a>
            <a href="{{ route('admin.documents') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg text-center block">
                📑 قائمة الوثائق العقارية
            </a>
        </div>
    </div>

    <!-- معلومات المسارات -->
    <div class="bg-gray-100 p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">ℹ️ معلومات المسارات</h2>
        <div class="space-y-2 text-sm">
            <p><strong>الشهادات:</strong> {{ route('admin.certificates') }}</p>
            <p><strong>الوثائق:</strong> {{ route('admin.documents') }}</p>
            <p><strong>محرر القوالب:</strong> {{ route('admin.templates.editor') }}</p>
            <p><strong>طباعة شهادة:</strong> {{ route('admin.certificates.print', 1) }}</p>
            <p><strong>طباعة وثيقة:</strong> {{ route('admin.documents.print', 1) }}</p>
        </div>
    </div>

    <!-- رجوع للوحة الرئيسية -->
    <div class="text-center mt-8">
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg">
            ← رجوع للوحة الرئيسية
        </a>
    </div>
</div>

@endsection