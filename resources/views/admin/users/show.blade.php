@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">👤 عرض المستخدم</h2>

<div class="bg-white p-6 shadow rounded">
    <p><strong>الاسم:</strong> {{ $user->name }}</p>
    <p><strong>البريد:</strong> {{ $user->email }}</p>
</div>

@endsection
