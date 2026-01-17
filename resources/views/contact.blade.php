@extends('layouts.app')

@php
    $hideNavbar = true;
@endphp

@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">

<div class="contact-container">

    <div class="contact-card">

        <div class="contact-header">
            <h2>📞 اتصل بنا</h2>
            <p>نحن هنا للإجابة عن استفساراتكم</p>
        </div>

        <form class="contact-form">

            <div class="input-group">
                <label>الاسم الكامل *</label>
                <input type="text" required>
            </div>

            <div class="input-group">
                <label>البريد الإلكتروني *</label>
                <input type="email" required>
            </div>

            <div class="input-group">
                <label>رقم الهاتف</label>
                <input type="text">
            </div>

            <div class="input-group">
                <label>الموضوع *</label>
                <input type="text" required>
            </div>

            <div class="input-group">
                <label>الرسالة *</label>
                <textarea rows="5" required></textarea>
            </div>

            <div class="submit-box">
                <button type="submit">✉️ إرسال الرسالة</button>
            </div>

        </form>

    </div>

</div>
@endsection
