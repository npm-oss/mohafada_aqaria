@extends('layouts.app')

@php
    $hideNavbar = true;
@endphp

@section('content')
<link rel="stylesheet" href="{{ asset('css/extracts.css') }}">

<div class="extract-container">

    <!-- شريط أنواع المستخرج -->
    <div class="extract-types">
        <button type="button" class="active">حجز</button>
        <button type="button">رهن أو امتياز</button>
        <button type="button">تشطيب</button>
        <button type="button">عرصة</button>
        <button type="button">وثيقة ناقلة للملكية</button>
    </div>

    <!-- البطاقة الرئيسية -->
    <div class="extract-card">

        <h3 class="card-title">طلب مستخرج عقد</h3>
        <p class="note">الحقول التي تحمل (*) إجبارية</p>

        <form>

            <!-- معلومات الطالب -->
            <div class="form-section">
                <h4 style="margin-bottom:20px;color:#14532d">👤 معلومات الطالب</h4>

                <div class="form-grid">
                    <div>
                        <label>NIN</label>
                        <input type="text" placeholder="رقم التعريف الوطني">
                    </div>

                    <div>
                        <label>اللقب *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>الاسم *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>اسم الأب *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>البريد الإلكتروني</label>
                        <input type="email">
                    </div>

                    <div>
                        <label>الهاتف</label>
                        <input type="text">
                    </div>
                </div>
            </div>

            <!-- معلومات الوثيقة -->
            <div class="document-box">

                <div class="document-header">
                    📄 معلومات الوثيقة العقارية
                </div>

                <div class="document-body">

                    <div class="doc-field">
                        <span>📘</span>
                        <div style="flex:1">
                            <label>رقم المجلد *</label>
                            <input type="text" required>
                        </div>
                    </div>

                    <div class="doc-field">
                        <span>🔢</span>
                        <div style="flex:1">
                            <label>رقم النشر *</label>
                            <input type="text" required>
                        </div>
                    </div>

                    <div class="doc-field">
                        <span>📅</span>
                        <div style="flex:1">
                            <label>تاريخ النشر</label>
                            <input type="date">
                        </div>
                    </div>

                </div>

            </div>

            <!-- زر الإرسال -->
            <div class="submit-box">
                <button type="submit">🔍 البحث</button>
            </div>

        </form>

    </div>

</div>

{{-- تفعيل الحركة بين الأزرار --}}
<script>
    document.querySelectorAll('.extract-types button').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.extract-types button')
                .forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>
@endsection
