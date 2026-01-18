extends('layouts.admi @extends('layouts.admin-simple')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/details.css') }}">
@endpush

@section('title', 'تفاصيل الشهادة السلبية')

@section('content')
<div class="page-details">
    <div class="extract-card">
    {{-- معلومات صاحب الملكية --}}
    <div class="extract-card">
        <h4>📌 معلومات صاحب الملكية</h4>
        <div class="row"><label>اللقب:</label> <span>{{ $certificate->owner_lastname }}</span></div>
        <div class="row"><label>الاسم:</label> <span>{{ $certificate->owner_firstname }}</span></div>
        <div class="row"><label>اسم الأب:</label> <span>{{ $certificate->owner_father ?? '-' }}</span></div>
        <div class="row"><label>تاريخ الميلاد:</label> <span>{{ $certificate->owner_birthdate ?? '-' }}</span></div>
        <div class="row"><label>مكان الميلاد:</label> <span>{{ $certificate->owner_birthplace ?? '-' }}</span></div>
        
    </div>

    {{-- معلومات مقدم الطلب --}}
    <div class="extract-card">
        <h4>👤 معلومات مقدم الطلب</h4>
        <div class="row"><label>اللقب:</label> <span>{{ $certificate->applicant_lastname }}</span></div>
        <div class="row"><label>الاسم:</label> <span>{{ $certificate->applicant_firstname }}</span></div>
        <div class="row"><label>اسم الأب:</label> <span>{{ $certificate->applicant_father ?? '-' }}</span></div>
        <div class="row"><label>البريد الإلكتروني:</label> <span>{{ $certificate->email }}</span></div>
        <div class="row"><label>رقم الهاتف:</label> <span>{{ $certificate->phone }}</span></div>
    </div>

    {{-- الأزرار --}}
    <div class="extract-card top-actions" style="display: flex; gap: 10px; flex-wrap: wrap; padding: 20px;">
        <a href="{{ route('admin.certificates.process', $certificate->id) }}" 
           class="btn-process"
           style="background-color: #3b82f6; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
            ⚙️ معالجة
        </a>

        {{-- زر الطباعة - دائماً ظاهر --}}
        <a href="{{ route('admin.certificates.print', $certificate->id) }}" 
           class="btn-print" 
           target="_blank"
           style="background-color: #10b981; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
            🖨️ طباعة الشهادة
        </a>

        <a href="{{ route('admin.certificates.index') }}" 
           style="background-color: #6b7280; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
            ← رجوع للقائمة
        </a>
    </div>

</div>
@endsection


