@extends('layouts.app')

@php
    $hideNavbar = true;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/document-requests.css') }}">
@endpush

@section('title','قائمة طلبات الوثائق')

@section('content')

<div class="document-requests-container">

    <h2 class="requests-title">📄 قائمة طلبات </h2>

    @if($requests->isEmpty())
        <div class="no-requests">
            لا توجد أي طلبات حالياً.
        </div>
    @else

        <table class="requests-table">
            <thead>
                <tr>
                    <th>صاحب الطلب</th>
                   
                    <th>الحالة</th>
                    <th>تاريخ الإيداع</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
            @foreach($requests as $req)
                <tr>

                    {{-- صاحب الطلب --}}
                    <td>
                        {{ $req->applicant_lastname ?? '-' }}
                        {{ $req->applicant_firstname ?? '' }}
                    </td>

                    

                    {{-- الحالة --}}
                    <td>
                        @if($req->status === 'approved')
                            <span class="badge approved">موافق</span>
                        @elseif($req->status === 'rejected')
                            <span class="badge rejected">مرفوض</span>
                        @else
                            <span class="badge pending">قيد المعالجة</span>
                        @endif
                    </td>

                    {{-- التاريخ --}}
                    <td>
                      {{ $req->created_at ? $req->created_at->format('d/m/Y') : '-' }}

                    </td>

                    {{-- الإجراءات --}}
                    <td class="actions-cell">

                        <a href="{{ route('admin.documents.show',$req->id) }}"
                           class="btn view-btn">
                            عرض
                        </a>

                      
                      

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

</div>

@endsection
