@extends('layouts.admin-simple')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/requests.css') }}">
@endpush

@section('title', 'قائمة طلبات الشهادات السلبية')

@section('content')
<div class="extract-container">
    <div class="page-requests">
        <div class="card-title">📄 قائمة طلبات الشهادات السلبية</div>


        <table>
            <thead>
                <tr>
                    <th>الاسم الكامل</th>
                    <th>البريد الإلكتروني</th>
                    <th>نوع الطلب</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->owner_firstname }} {{ $certificate->owner_lastname }}</td>
                    <td>{{ $certificate->email }}</td>
                    <td>{{ $certificate->type ?? '-' }}</td>
                    <td>{{ $certificate->status }}</td>
                    <td>{{ $certificate->created_at->format('d/m/Y') }}</td>
                    <td class="top-actions">
                        <a href="{{ route('admin.certificates.show', $certificate->id) }}" class="btn-process">عرض</a>

                        @if($certificate->status === 'pending')
                        <form action="{{ route('admin.certificates.approve', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            
                        </form>

                        <form action="{{ route('admin.certificates.reject', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; font-weight:bold; color:#c9a24d;">لا توجد طلبات حالياً</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
