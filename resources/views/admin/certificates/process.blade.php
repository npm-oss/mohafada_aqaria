@extends('layouts.admin-simple')


@push('styles')
<link rel="stylesheet" href="{{ asset('css/process.css') }}">
<style>
/* ضع هنا CSS اللي كتبناه أعلاه */
</style>
@endpush

@section('title','معالجة الطلب')

@section('content')
<div class="page-process">
    <div class="extract-card citizen-info">

    {{-- شريط الأزرار --}}
    <div class="top-actions">
        <button onclick="window.print()" class="btn-process">🖨️ طباعة</button>
        <button onclick="copyToClipboard()" class="btn-process">📄 نسخة</button>

        <form method="POST" action="{{ route('admin.certificates.extract',$certificate->id) }}">@csrf
            <button type="submit" class="btn-process">🔍 بحث</button>
        </form>

        <form method="POST" action="{{ route('admin.certificates.approve',$certificate->id) }}">@csrf
            <button type="submit" class="btn-success">✔️ قبول</button>
        </form>

        <form method="POST" action="{{ route('admin.certificates.reject',$certificate->id) }}">@csrf
            <button type="submit" class="btn-danger">❌ رفض</button>
        </form>
   <a href="{{ route('admin.certificates.extract', $certificate->id) }}" class="btn-certificate">🧾 شهادة</a>
    </div>


    </div>

    {{-- فورم المواطن --}}
    <div class="extract-card citizen-info">
        <h4>معلومات المواطن</h4>
        <form method="POST" action="{{ route('admin.certificates.updateFields',$certificate->id) }}">
            @csrf
            <div class="row"><label>اللقب</label><input type="text" name="owner_lastname" value=""></div>
            <div class="row"><label>الاسم</label><input type="text" name="owner_firstname" value=""></div>
            <div class="row"><label>اسم الأب</label><input type="text" name="owner_father" value=""></div>
            <div class="row"><label>الجنس</label>
                <select name="gender">
                    <option value="ذكر">ذكر</option>
                    <option value="أنثى">أنثى</option>
                </select>
            </div>
            <div class="row"><label>الجنسية</label>
                <select name="nationality"><option value="جزائرية">جزائرية</option></select>
            </div>
            <div class="row"><label>تاريخ الميلاد</label><input type="date" name="owner_birthdate" value=""></div>
            <div class="row"><label>رقم شهادة الميلاد</label><input type="text" name="birth_certificate_number" value=""></div>
            <div class="row"><label>مكان الميلاد</label><input type="text" name="owner_birthplace" value=""></div>
            <div class="row"><label>الولاية</label>
                <select name="state">
                    <option value="">اختر الولاية</option>
                    @php
                        $states = ['أدرار','الشلف','الأغواط','أم البواقي','باتنة','بجاية','بسكرة','بشار','البليدة','البويرة',
                        'تمنراست','تبسة','تلمسان','تيارت','تيزي وزو','الجزائر','الجلفة','جيجل','سطيف','سعيدة',
                        'سكيكدة','سيدي بلعباس','عنابة','قالمة','قسنطينة','المدية','المسيلة','معسكر','ممـاس','ميلة','الوادي','وهران','البيض','اليزي','برج بوعريريج','بومرداس','الطارف','تندوف','تيسمسيلت','غرداية','غليزان','الجلفة','جيجل'];
                    @endphp
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row"><label>البلدية</label><input type="text" name="municipality" value=""></div>

            <div class="submit-box">
                <button type="submit">💾 حفظ البيانات</button>
            </div>
        </form>
    </div>

</div>


<script src="{{ asset('js/custom-modal.js') }}"></script>
<script>
function copyToClipboard() {
    let text = `
اللقب: ${document.querySelector('input[name="owner_lastname"]').value}
الاسم: ${document.querySelector('input[name="owner_firstname"]').value}
اسم الأب: ${document.querySelector('input[name="owner_father"]').value}
الجنس: ${document.querySelector('select[name="gender"]').value}
الجنسية: ${document.querySelector('select[name="nationality"]').value}
تاريخ الميلاد: ${document.querySelector('input[name="owner_birthdate"]').value}
رقم شهادة الميلاد: ${document.querySelector('input[name="birth_certificate_number"]').value}
مكان الميلاد: ${document.querySelector('input[name="owner_birthplace"]').value}
الولاية: ${document.querySelector('select[name="state"]').value}
البلدية: ${document.querySelector('input[name="municipality"]').value}
`;
    navigator.clipboard.writeText(text).then(() => { showModal('تم نسخ المعلومات إلى الحافظة', 'success'); });
}
</script>
@endsection
