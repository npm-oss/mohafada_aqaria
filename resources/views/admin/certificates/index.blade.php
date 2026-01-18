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
                        <a href="{{ route('admin.certificates.show', $certificate->id) }}" class="btn-process" style="background-color: #3b82f6; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; margin: 2px; font-size: 12px; display: inline-block;">👁️ عرض</a>

                        {{-- زر الطباعة - دائماً ظاهر --}}
                        <a href="{{ route('admin.certificates.print', $certificate->id) }}" 
                           class="btn-print" 
                           target="_blank"
                           style="background-color: #10b981; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; margin: 2px; font-size: 12px; display: inline-block;">
                            🖨️ طباعة
                        </a>

                        @if($certificate->status === 'pending')
                        <form action="{{ route('admin.certificates.approve', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" style="background-color: #22c55e; color: white; padding: 5px 10px; border-radius: 3px; border: none; cursor: pointer; margin: 2px; font-size: 12px;">✅ موافقة</button>
                        </form>

                        <form action="{{ route('admin.certificates.reject', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" style="background-color: #ef4444; color: white; padding: 5px 10px; border-radius: 3px; border: none; cursor: pointer; margin: 2px; font-size: 12px;">❌ رفض</button>
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
