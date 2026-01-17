<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layout')

@section('content')
<div class="space-y-6">

    <!-- الترحيب -->
    <div class="bg-white p-4 rounded shadow text-right">
        <h1 class="text-2xl font-bold">مرحبا بك في لوحة الإدارة</h1>
    </div>

    <!-- البطاقات (Cards) -->
    <div class="grid grid-cols-4 gap-4">
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-lg font-semibold">📄 طلبات جديدة</h2>
            <p class="text-2xl font-bold">{{ $newRequests }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-lg font-semibold">⏳ قيد المعالجة</h2>
            <p class="text-2xl font-bold">{{ $processingRequests }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-lg font-semibold">✔️ مقبولة</h2>
            <p class="text-2xl font-bold">{{ $approvedRequests }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-lg font-semibold">👤 المستخدمين</h2>
            <p class="text-2xl font-bold">{{ $usersCount }}</p>
        </div>
    </div>

    <!-- آخر الطلبات -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-bold mb-3">📋 آخر الطلبات</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">الرقم</th>
                        <th class="py-2 px-4 border">المواطن</th>
                        <th class="py-2 px-4 border">نوع الطلب</th>
                        <th class="py-2 px-4 border">الحالة</th>
                        <th class="py-2 px-4 border">الإجراءات</th>
                        <th class="py-2 px-4 border">التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestRequests as $request)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $request->id }}</td>
                        <td class="py-2 px-4 border">{{ $request->user_id }}</td>
                        <td class="py-2 px-4 border">{{ $request->type }}</td>
                        <td class="py-2 px-4 border">{{ $request->status }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('admin.requests.show', $request->id) }}" class="text-blue-500">👁️ عرض</a>
                            <a href="{{ route('admin.requests.edit', $request->id) }}" class="text-green-500 ml-2">⚙️ معالجة</a>
                        </td>
                        <td class="py-2 px-4 border">{{ $request->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-2 px-4 border text-center" colspan="6">لا توجد طلبات حاليا</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- الأزرار السريعة -->
    <div class="grid grid-cols-4 gap-4 mt-6">
        <a href="{{ route('admin.requests.create') }}" class="p-4 bg-blue-500 text-white rounded shadow text-center hover:bg-blue-600">➕ معالجة طلب جديد</a>
        <a href="{{ route('admin.certificates.index') }}" class="p-4 bg-green-500 text-white rounded shadow text-center hover:bg-green-600">📄 الشهادات السلبية</a>
        <a href="{{ route('admin.documents.index') }}" class="p-4 bg-yellow-500 text-white rounded shadow text-center hover:bg-yellow-600">📑 الوثائق العقارية</a>
        <a href="{{ route('admin.messages.index') }}" class="p-4 bg-purple-500 text-white rounded shadow text-center hover:bg-purple-600">📩 الرسائل الجديدة</a>
    </div>

</div>
@endsection
