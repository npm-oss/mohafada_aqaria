@extends('layouts.admin-simple')

@section('title','شهادة عقارية')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/certificate.css') }}">
@endpush

@section('content')
<div class="certificate-page">

    {{-- ====== رأس الشهادة ====== --}}
    <div class="cert-header">
        <h2>إدارة الأملاك الوطنية</h2>
        <h3>شهادة</h3>
    </div>

    {{-- ====== معلومات الطلب ====== --}}
    <div class="cert-box">
        <div>رقم الطلب: {{ $certificate->id }}</div>
        <div>التاريخ: {{ now()->format('d/m/Y') }}</div>
    </div>

    {{-- ====== معلومات صاحب الطلب (ثابتة) ====== --}}
    <div class="cert-box">
        <h4>معلومات المعني بالأمر</h4>
        <div class="row">
            <span>الاسم واللقب:</span>
            <strong>{{ $certificate->owner_firstname }} {{ $certificate->owner_lastname }}</strong>
        </div>
        <div class="row">
            <span>تاريخ ومكان الميلاد:</span>
            <strong>{{ $certificate->owner_birthdate }} - {{ $certificate->owner_birthplace }}</strong>
        </div>
    </div>

    {{-- ====== هنا الاختلاف ====== --}}
    @if($certificate->result_type === 'negative')
        {{-- ====== شهادة سلبية ====== --}}
        <div class="cert-box">
            <p class="cert-text">
                نشهد أن المعني بالأمر لا يملك أي عقار مسجل
                على مستوى المحافظة العقارية.
            </p>
        </div>
    @else
        {{-- ====== شهادة إيجابية (واجهة ثانية منقحة) ====== --}}
        <div class="cert-box">
            <h4>معلومات العقار</h4>

            <form method="POST" action="{{ route('admin.certificates.saveCertificate',$certificate->id) }}">
                @csrf

                <div class="row">
                    <label>القطعة</label>
                    <input type="text" name="parcel">
                </div>

                <div class="row">
                    <label>القسم</label>
                    <input type="text" name="section">
                </div>

                <div class="row">
                    <label>المساحة</label>
                    <input type="text" name="area">
                </div>

                <div class="row">
                    <label>الموقع</label>
                    <input type="text" name="location">
                </div>

                <button type="submit" class="btn-save">💾 حفظ</button>
            </form>
        </div>
    @endif

    {{-- ====== توقيع ====== --}}
    <div class="cert-footer">
        <div>إمضاء وختم المحافظ</div>
    </div>

    <button onclick="window.print()" class="btn-print">🖨️ طباعة</button>
</div>
@endsection

