@extends('layouts.app')



@php
    $hideNavbar = true;
@endphp



@section('title', 'إعادة استخراج شهادة سلبية')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/negative.css') }}">
@endpush

@section('content')

<div class="negative-container">

    <div class="negative-card">

        <div class="card-header">
            <h2>🔁 إعادة استخراج شهادة سلبية</h2>
            <a href="{{ url()->previous() }}" class="close-btn">✖</a>
        </div>

        <p class="note">──── معلومات البحث ────</p>

        <form>

            <div class="form-grid">

                <div class="form-group">
                    <label>رقم الطلب</label>
                    <input type="text" placeholder="مثال: 2024/00123">
                </div>

                <div class="form-group">
                    <label>اللقب</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email">
                </div>

            </div>

            <div class="submit-box">
                <button type="submit">📄 إعادة الاستخراج</button>
            </div>

        </form>

    </div>

</div>

@endsection
