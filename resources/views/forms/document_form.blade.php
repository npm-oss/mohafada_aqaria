@extends('layouts.app')
@section('content')
<div class="form-container">
    <form method="POST" action="{{ route('admin.documents.store') }}" class="document-form">
        @csrf

        {{-- نوع البطاقة --}}
        <div class="card-section">
            <div class="section-header">
                <h3>نوع البطاقة</h3>
            </div>
            <div class="section-body">
                <input type="hidden" name="card_type" value="{{ $cardType }}">
                <div class="card-type-display">
                    <span class="card-type-label">نوع البطاقة:</span>
                    <span class="card-type-value">{{ $cardType }}</span>
                </div>
            </div>
        </div>

        {{-- معلومات الطالب وصاحب الملكية جنبًا إلى جنب --}}
        <div class="row-container">
            {{-- معلومات الطالب --}}
            <div class="card-section applicant-section">
                <div class="section-header">
                    <h3>معلومات الطالب</h3>
                </div>
                <div class="section-body">
                    {{-- اختيار نوع الطالب --}}
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="applicant_type" value="person" checked>
                            <span class="radio-custom"></span>
                            شخص
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="applicant_type" value="company">
                            <span class="radio-custom"></span>
                            شركة
                        </label>
                    </div>

                    {{-- حقول الطالب (شخص) --}}
                    <div id="applicantPersonFields">
                        <fieldset>
                            <legend>معلومات الطالب (شخص)</legend>
                            <input type="text" name="applicant_nin" placeholder="رقم بطاقة التعريف الوطنية">
                            <input type="text" name="applicant_lastname" placeholder="اللقب">
                            <input type="text" name="applicant_firstname" placeholder="الاسم">
                            <input type="text" name="applicant_father" placeholder="اسم الأب">
                            <input type="email" name="applicant_email" placeholder="البريد الإلكتروني">
                            <input type="text" name="applicant_phone" placeholder="رقم الهاتف">
                        </fieldset>
                    </div>

                    <div id="applicantCompanyFields" style="display:none;">
                        <fieldset>
                            <legend>معلومات الطالب (شركة)</legend>
                            <input type="text" name="company_name" placeholder="اسم الشركة">
                            <input type="text" name="company_nin" placeholder="رقم التعريف الضريبي للشركة">
                            <input type="text" name="company_representative" placeholder="ممثل الشركة">
                            <input type="email" name="company_email" placeholder="البريد الإلكتروني للشركة">
                            <input type="text" name="company_phone" placeholder="هاتف الشركة">
                        </fieldset>
                    </div>
                </div>
            </div>

            {{-- معلومات صاحب الملكية --}}
            <div class="card-section owner-section">
                <div class="section-header">
                    <h3>معلومات صاحب الملكية</h3>
                </div>
                <div class="section-body">
                    {{-- اختيار نوع صاحب الملكية --}}
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="owner_type" value="person" checked>
                            <span class="radio-custom"></span>
                            شخص
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="owner_type" value="company">
                            <span class="radio-custom"></span>
                            شركة
                        </label>
                    </div>

                    {{-- حقول صاحب الملكية (شخص) --}}
                    <div id="ownerPersonFields">
                        <fieldset>
                            <legend>معلومات صاحب الملكية (شخص)</legend>
                            <input type="text" name="owner_nin" placeholder="رقم التعريف الوطني">
                            <input type="text" name="owner_lastname" placeholder="اللقب">
                            <input type="text" name="owner_firstname" placeholder="الاسم">
                            <input type="text" name="owner_father" placeholder="اسم الأب">
                            <input type="date" name="owner_birthdate" placeholder="تاريخ الميلاد">
                            <input type="text" name="owner_birthplace" placeholder="مكان الميلاد">
                        </fieldset>
                    </div>

                    <div id="ownerCompanyFields" style="display:none;">
                        <fieldset>
                            <legend>معلومات صاحب الملكية (شركة)</legend>
                            <input type="text" name="owner_company_name" placeholder="اسم الشركة">
                            <input type="text" name="owner_company_nin" placeholder="رقم التعريف الضريبي للشركة">
                            <input type="text" name="owner_company_representative" placeholder="ممثل الشركة">
                            <input type="email" name="owner_company_email" placeholder="البريد الإلكتروني للشركة">
                            <input type="text" name="owner_company_phone" placeholder="هاتف الشركة">
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        {{-- معلومات العقار --}}
        <div class="card-section property-section">
            <div class="section-header">
                <h3>معلومات العقار</h3>
            </div>
            <div class="section-body">
                {{-- حالة العقار --}}
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="property_status" value="surveyed">
                        <span class="radio-custom"></span>
                        ممسوح
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="property_status" value="not_surveyed">
                        <span class="radio-custom"></span>
                        غير ممسوح
                    </label>
                </div>

                <div id="surveyedFields" style="display:none;">
                    <fieldset>
                        <legend>معلومات العقار الممسوح</legend>
                        <input type="text" name="section" placeholder="القسم">
                        <input type="text" name="municipality" placeholder="البلدية">
                        <input type="text" name="plan_number" placeholder="رقم المخطط">
                        <input type="text" name="parcel_number" placeholder="رقم القطعة">
                    </fieldset>
                </div>

                <div id="notSurveyedFields" style="display:none;">
                    <fieldset>
                        <legend>معلومات العقار غير الممسوح</legend>
                        <input type="text" name="municipality_ns" placeholder="البلدية">
                        <input type="text" name="subdivision_number" placeholder="رقم التجزئة">
                        <input type="text" name="parcel_number_ns" placeholder="رقم القطعة">
                    </fieldset>
                </div>
            </div>
        </div>

        {{-- زر الإرسال --}}
        <div class="submit-container">
            <button type="submit" class="submit-btn">تقديم الطلب</button>
        </div>
    </form>
</div>

<style>
.form-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.document-form {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

/* تصميم الكاردات */
.card-section {
    background: white;
    border-radius: 10px;
    margin-bottom: 25px;
    border: 1px solid #e1e5e9;
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, #2c3e50, #4a6572);
    color: white;
    padding: 18px 25px;
    border-bottom: 1px solid #ddd;
}

.section-header h3 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.section-body {
    padding: 25px;
}

/* ترتيب الطالب وصاحب الملكية في صف واحد */
.row-container {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    margin-bottom: 25px;
}

.row-container .card-section {
    flex: 1;
    min-width: 300px;
}

/* نوع البطاقة */
.card-type-display {
    background: #f0f7ff;
    padding: 15px;
    border-radius: 8px;
    border-right: 4px solid #3498db;
}

.card-type-label {
    font-weight: 600;
    color: #2c3e50;
    margin-left: 10px;
}

.card-type-value {
    font-weight: 700;
    color: #2980b9;
    font-size: 1.1rem;
}

/* مجموعة الأزرار الراديوية */
.radio-group {
    display: flex;
    gap: 25px;
    margin-bottom: 25px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 8px;
}

.radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 500;
    color: #444;
}

.radio-label input {
    margin-left: 8px;
}

.radio-custom {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 2px solid #7e8c9a;
    border-radius: 50%;
    margin-left: 8px;
    position: relative;
}

.radio-label input:checked + .radio-custom {
    border-color: #3498db;
    background: #3498db;
}

.radio-label input:checked + .radio-custom::after {
    content: '';
    position: absolute;
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* حقول الإدخال */
fieldset {
    border: 1px solid #e1e5e9;
    border-radius: 8px;
    padding: 20px;
    margin: 0;
    background: #fdfdfd;
}

legend {
    font-weight: 600;
    color: #2c3e50;
    padding: 0 10px;
    font-size: 1rem;
}

input[type="text"],
input[type="email"],
input[type="date"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #d1d9e0;
    border-radius: 6px;
    font-size: 1rem;
    transition: all 0.3s;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

/* زر الإرسال */
.submit-container {
    text-align: center;
    margin-top: 30px;
}

.submit-btn {
    background-color: #8B4513; /* لون بني */
    color: white;
    border: none;
    padding: 15px 45px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 200px;
}

.submit-btn:hover {
    background-color: #A0522D; /* لون بني أغمق عند التمرير */
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(139, 69, 19, 0.2);
}

.submit-btn:active {
    transform: translateY(0);
}

/* التجاوب مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .row-container {
        flex-direction: column;
    }
    
    .row-container .card-section {
        width: 100%;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 15px;
    }
    
    .form-container {
        padding: 15px;
    }
    
    .section-body {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تبديل بين نوع مقدم الطلب
    const applicantTypeRadios = document.querySelectorAll('input[name="applicant_type"]');
    const applicantPersonFields = document.getElementById('applicantPersonFields');
    const applicantCompanyFields = document.getElementById('applicantCompanyFields');
    
    applicantTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'person') {
                applicantPersonFields.style.display = 'block';
                applicantCompanyFields.style.display = 'none';
            } else {
                applicantPersonFields.style.display = 'none';
                applicantCompanyFields.style.display = 'block';
            }
        });
    });
    
    // تبديل بين نوع صاحب الملكية
    const ownerTypeRadios = document.querySelectorAll('input[name="owner_type"]');
    const ownerPersonFields = document.getElementById('ownerPersonFields');
    const ownerCompanyFields = document.getElementById('ownerCompanyFields');
    
    ownerTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'person') {
                ownerPersonFields.style.display = 'block';
                ownerCompanyFields.style.display = 'none';
            } else {
                ownerPersonFields.style.display = 'none';
                ownerCompanyFields.style.display = 'block';
            }
        });
    });
    
    // تبديل بين حالة العقار
    const propertyStatusRadios = document.querySelectorAll('input[name="property_status"]');
    const surveyedFields = document.getElementById('surveyedFields');
    const notSurveyedFields = document.getElementById('notSurveyedFields');
    
    propertyStatusRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'surveyed') {
                surveyedFields.style.display = 'block';
                notSurveyedFields.style.display = 'none';
            } else {
                surveyedFields.style.display = 'none';
                notSurveyedFields.style.display = 'block';
            }
        });
    });
});
</script>
@endsection