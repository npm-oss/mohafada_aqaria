@extends('layouts.app')

@php
    $hideNavbar = true;
@endphp

@section('title', 'طلب شهادة سلبية جديدة')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/negative.css') }}">
@endpush

@section('content')

<div class="extract-container">

    <div class="extract-card">

        <!-- HEADER -->
        <div class="card-header">
            <h3>📝 طلب شهادة سلبية جديدة</h3>
            <a href="{{ url()->previous() }}" class="close-btn">✖</a>
        </div>

        {{-- فورم المواطن فقط --}}
        <form 
            class="negative-form"
            method="POST"
            action="{{ route('negative.store') }}"
        >
            @csrf

            <div class="two-columns">

                <!-- صاحب الملكية -->
                <div class="info-card">
                    <h2>📌 معلومات صاحب الملكية</h2>

                    <div class="form-group">
                        <label>اللقب</label>
                        <input type="text" name="owner_lastname" required>
                    </div>

                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="owner_firstname" required>
                    </div>

                    <div class="form-group">
                        <label>اسم الأب</label>
                        <input type="text" name="owner_father">
                    </div>

                    <div class="form-group">
                        <label>تاريخ الميلاد</label>
                        <input type="date" name="owner_birthdate">
                    </div>

                    <div class="form-group">
                        <label>مكان الميلاد</label>
                        <input type="text" name="owner_birthplace">
                    </div>
                </div>

                <!-- مقدم الطلب -->
                <div class="info-card">
                    <h2>👤 معلومات مقدم الطلب</h2>

                    <div class="form-group">
                        <label>اللقب</label>
                        <input type="text" name="applicant_lastname" required>
                    </div>

                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="applicant_firstname" required>
                    </div>

                    <div class="form-group">
                        <label>اسم الأب</label>
                        <input type="text" name="applicant_father">
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>

            </div>

            <div class="submit-box">
                <button type="submit">📤 إرسال الطلب</button>
            </div>

        </form>

    </div>

</div>

@endsection
