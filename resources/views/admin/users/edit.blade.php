@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">✏️ تعديل المستخدم</h2>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <input name="name" type="text" value="{{ $user->name }}" class="w-full border p-2 rounded">
    <input name="email" type="email" value="{{ $user->email }}" class="w-full border p-2 rounded">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">تحديث</button>
</form>

@endsection
