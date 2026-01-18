@extends('layouts.admin-simple')

@section('title', 'معالجة الطلب')

@section('content')

<div class="process-box">

    <h2 class="page-title">معالجة الطلب</h2>

    <form id="processForm">

        <!-- نوع البطاقة -->
        <div class="form-group">
            <label>نوع البطاقة</label>
            <select id="card_type">
                <option value="">-- اختر نوع البطاقة --</option>
                <option value="الريفية">الريفية</option>
                <option value="الحضرية الخاصة">الحضرية الخاصة</option>
                <option value="شخصية">شخصية</option>
                <option value="أبجدية">أبجدية</option>
            </select>
        </div>

        <!-- حالة العقار -->
        <fieldset class="form-group">
            <legend>حالة العقار</legend>
            <label><input type="radio" name="property_status" value="ممسوح"> ممسوح</label>
            <label><input type="radio" name="property_status" value="غير ممسوح"> غير ممسوح</label>
        </fieldset>

        <!-- ممسوح -->
        <div id="surveyed_fields" class="sub-box hidden">
            <h4>معلومات العقار الممسوح</h4>
            <input type="text" id="section" placeholder="القطاع">
            <input type="text" id="municipality" placeholder="البلدية">
            <input type="text" id="plan_number" placeholder="رقم المخطط">
            <input type="text" id="parcel_number" placeholder="رقم القطعة">
        </div>

        <!-- غير ممسوح -->
        <div id="not_surveyed_fields" class="sub-box hidden">
            <h4>معلومات العقار غير الممسوح</h4>
            <input type="text" id="municipality_ns" placeholder="البلدية">
            <input type="text" id="subdivision_number" placeholder="رقم التجزئة">
            <input type="text" id="parcel_number_ns" placeholder="رقم القطعة">
        </div>

        <button type="button" id="searchBtn">بحث</button>
    </form>

    <!-- النتائج -->
    <div id="resultSection" class="result-box hidden">

        <h3>معلومات صاحب الملكية</h3>
        <div class="grid">
            <input id="owner_nin">
            <input id="owner_firstname">
            <input id="owner_lastname">
            <input id="owner_father">
            <input id="owner_birthdate">
            <input id="owner_birthplace">
        </div>

        <h3>معلومات العقار</h3>
        <input id="property_status_result" readonly>
        <input id="card_type_result" readonly>

        <!-- ممسوح -->
        <div id="surveyed_result" class="grid hidden">
            <input id="section_result" readonly>
            <input id="municipality_result" readonly>
            <input id="plan_number_result" readonly>
            <input id="parcel_number_result" readonly>
        </div>

        <!-- غير ممسوح -->
        <div id="not_surveyed_result" class="grid hidden">
            <input id="municipality_ns_result" readonly>
            <input id="subdivision_number_result" readonly>
            <input id="parcel_number_ns_result" readonly>
        </div>

        <h3>صورة البطاقة</h3>
        <img id="card_image">
    </div>
</div>

<script src="{{ asset('js/custom-modal.js') }}"></script>
<script>
const radios = document.querySelectorAll('input[name="property_status"]');
const surveyedFields = document.getElementById('surveyed_fields');
const notSurveyedFields = document.getElementById('not_surveyed_fields');
const surveyedResult = document.getElementById('surveyed_result');
const notSurveyedResult = document.getElementById('not_surveyed_result');
const resultSection = document.getElementById('resultSection');

// تعريف الحقول
const card_type = document.getElementById('card_type');
const section = document.getElementById('section');
const municipality = document.getElementById('municipality');
const plan_number = document.getElementById('plan_number');
const parcel_number = document.getElementById('parcel_number');
const municipality_ns = document.getElementById('municipality_ns');
const subdivision_number = document.getElementById('subdivision_number');
const parcel_number_ns = document.getElementById('parcel_number_ns');

// النتائج
const owner_nin = document.getElementById('owner_nin');
const owner_firstname = document.getElementById('owner_firstname');
const owner_lastname = document.getElementById('owner_lastname');
const owner_father = document.getElementById('owner_father');
const owner_birthdate = document.getElementById('owner_birthdate');
const owner_birthplace = document.getElementById('owner_birthplace');
const property_status_result = document.getElementById('property_status_result');
const card_type_result = document.getElementById('card_type_result');
const section_result = document.getElementById('section_result');
const municipality_result = document.getElementById('municipality_result');
const plan_number_result = document.getElementById('plan_number_result');
const parcel_number_result = document.getElementById('parcel_number_result');
const municipality_ns_result = document.getElementById('municipality_ns_result');
const subdivision_number_result = document.getElementById('subdivision_number_result');
const parcel_number_ns_result = document.getElementById('parcel_number_ns_result');
const card_image = document.getElementById('card_image');

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value === 'ممسوح') {
            surveyedFields.classList.remove('hidden');
            notSurveyedFields.classList.add('hidden');
        } else {
            notSurveyedFields.classList.remove('hidden');
            surveyedFields.classList.add('hidden');
        }
    });
});

document.getElementById('searchBtn').addEventListener('click', function () {

    const searchedStatus = document.querySelector('input[name="property_status"]:checked')?.value || '';

    // التأكد من وجود نوع البطاقة
    if(!card_type.value){
        showModal("اختر نوع البطاقة أولاً", "warning");
        return;
    }

    fetch("{{ route('search.card') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            card_type: card_type.value,
            property_status: searchedStatus,
            section: section.value,
            municipality: municipality.value,
            plan_number: plan_number.value,
            parcel_number: parcel_number.value,
            municipality_ns: municipality_ns.value,
            subdivision_number: subdivision_number.value,
            parcel_number_ns: parcel_number_ns.value
        })
    })
    .then(r => r.json())
    .then(data => {

        if(!data.success){
            showModal("البطاقة غير موجودة", "error");
            resultSection.classList.add("hidden");
            return;
        }

        const c = data.card;

        owner_nin.value = c.owner_nin || '';
        owner_firstname.value = c.owner_firstname || '';
        owner_lastname.value = c.owner_lastname || '';
        owner_father.value = c.owner_father || '';
        owner_birthdate.value = c.owner_birthdate || '';
        owner_birthplace.value = c.owner_birthplace || '';

        property_status_result.value = c.property_status;
        card_type_result.value = c.card_type;

        if(searchedStatus === 'ممسوح'){
            surveyedResult.classList.remove('hidden');
            notSurveyedResult.classList.add('hidden');

            section_result.value = c.section || '';
            municipality_result.value = c.municipality || '';
            plan_number_result.value = c.plan_number || '';
            parcel_number_result.value = c.parcel_number || '';
        }
        else{
            surveyedResult.classList.add('hidden');
            notSurveyedResult.classList.remove('hidden');

            municipality_ns_result.value = c.municipality_ns || '';
            subdivision_number_result.value = c.subdivision_number || '';
            parcel_number_ns_result.value = c.parcel_number_ns || '';
        }

        card_image.src = c.card_image ? "{{ asset('storage') }}/" + c.card_image : '';

        resultSection.classList.remove("hidden");
    });
});
</script>




<style>
.process-box{
    max-width:900px;
    margin:auto;
    padding:20px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.page-title{
    text-align:center;
    font-size:24px;
    font-weight:bold;
    color:#2563eb;
}

.form-group{
    margin-bottom:15px;
}

input, select{
    width:100%;
    padding:8px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    background:#2563eb;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#1e40af;
}

.sub-box{
    background:#f1f5f9;
    padding:15px;
    margin-top:10px;
    border-radius:8px;
    transition: all 0.3s ease; /* إضافة تأثير */
}

.hidden{
    display:none;
}

.result-box{
    margin-top:20px;
    background:#f9fafb;
    padding:15px;
    border-radius:8px;
    transition: all 0.3s ease; /* تأثير ظهور */
}

.grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:10px;
}

img{
    max-width:250px;
    border-radius:8px;
    border:1px solid #ccc;
}
</style>

@endsection
