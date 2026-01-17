@extends('admin.layout')

@section('content')

<h1 class="text-3xl font-bold mb-6">📅 إدارة المواعيد</h1>

<div class="bg-white p-6 rounded-lg shadow">

    <table class="w-full text-right border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3">#</th>
                <th class="p-3">اسم الزبون</th>
                <th class="p-3">رقم الهاتف</th>
                <th class="p-3">تاريخ الموعد</th>
                <th class="p-3">الحالة</th>
                <th class="p-3">الإجراءات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($appointments as $app)
            <tr class="border-b">
                <td class="p-3">{{ $app->id }}</td>
                <td class="p-3">{{ $app->client_name }}</td>
                <td class="p-3">{{ $app->phone }}</td>
                <td class="p-3">{{ $app->date }}</td>
                <td class="p-3">{{ $app->status ?? 'قيد الانتظار' }}</td>

                <td class="p-3">
                    <a href="/admin/appointments/{{ $app->id }}/edit"
                       class="text-blue-600 font-bold">↪️ تعديل</a>

                    <a href="/admin/appointments/{{ $app->id }}/delete"
                       class="text-red-600 font-bold ml-3">🗑 حذف</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
