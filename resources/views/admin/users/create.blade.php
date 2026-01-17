@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">➕ إضافة مستخدم جديد</h2>

<form action="{{ route('users.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf

    <input name="name" type="text" placeholder="الاسم" class="w-full border p-2 rounded">
    <input name="email" type="email" placeholder="البريد الإلكتروني" class="w-full border p-2 rounded">
    <input name="password" type="password" placeholder="كلمة المرور" class="w-full border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
</form>

@endsection
