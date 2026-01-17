@extends('admin.layout')

@section('content')

<h1 class="text-3xl font-bold mb-6">👤 إدارة المستخدمين</h1>

<a href="{{ route('admin.users.create') }}"
   class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
    ➕ إضافة مستخدم جديد
</a>

@if(session('success'))
    <div class="bg-green-200 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="w-full bg-white shadow rounded-lg">
    <thead>
        <tr class="bg-gray-200 text-right">
            <th class="p-3">#</th>
            <th class="p-3">الاسم</th>
            <th class="p-3">البريد الإلكتروني</th>
            <th class="p-3">العمليات</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            <tr class="border-b">
                <td class="p-3">{{ $user->id }}</td>
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3 flex gap-2">

                    <a href="{{ route('admin.users.show', $user->id) }}"
                       class="text-blue-600 font-bold">
                        عرض
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="text-yellow-600 font-bold">
                        تعديل
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                          method="POST"
                          onsubmit="return confirm('حذف المستخدم؟');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 font-bold">
                            حذف
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">{{ $users->links() }}</div>

@endsection
