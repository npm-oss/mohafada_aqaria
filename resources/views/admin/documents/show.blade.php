@extends('layouts.admin-simple')

@section('title','تفاصيل الطلب')

@section('content')

<div class="details-layout">

    <!-- الكارد الكبير لكل المعلومات -->
    <div class="left-column">

        <div class="info-card">
            <h3>تفاصيل الطلب</h3>

            <div class="grid-2columns">
                <!-- العمود الأيسر: معلومات الطالب -->
                <div class="column">
                    <h4>معلومات الطالب</h4>
                    <div class="grid">
                        <div>نوع البطاقة</div><div>{{ $request->card_type }}</div>

                        @if($request->applicant_type == 'company')
                            <div>اسم الشركة</div><div>{{ $request->applicant_lastname }}</div>
                            <div>ممثل الشركة</div><div>{{ $request->applicant_firstname }}</div>
                            <div>الرقم الجبائي</div><div>{{ $request->applicant_nin }}</div>
                            <div>الإيميل</div><div>{{ $request->applicant_email }}</div>
                            <div>الهاتف</div><div>{{ $request->applicant_phone }}</div>
                        @else
                            <div>الاسم</div><div>{{ $request->applicant_lastname }} {{ $request->applicant_firstname }}</div>
                            <div>رقم التعريف</div><div>{{ $request->applicant_nin }}</div>
                            <div>اسم الأب</div><div>{{ $request->applicant_father }}</div>
                            <div>الإيميل</div><div>{{ $request->applicant_email }}</div>
                            <div>الهاتف</div><div>{{ $request->applicant_phone }}</div>
                        @endif
                    </div>
                </div>

                <!-- العمود الأيمن: معلومات صاحب الملكية -->
                <div class="column">
                    <h4>معلومات صاحب الملكية</h4>
                    <div class="grid">
                        @if($request->owner_type == 'company')
                            <div>اسم الشركة</div><div>{{ $request->owner_lastname }}</div>
                            <div>ممثل الشركة</div><div>{{ $request->owner_firstname }}</div>
                            <div>الرقم الجبائي</div><div>{{ $request->owner_nin }}</div>
                        @else
                            <div>الاسم</div><div>{{ $request->owner_lastname }} {{ $request->owner_firstname }}</div>
                            <div>رقم التعريف</div><div>{{ $request->owner_nin }}</div>
                            <div>اسم الأب</div><div>{{ $request->owner_father }}</div>
                            <div>تاريخ الميلاد</div><div>{{ $request->owner_birthdate }}</div>
                            <div>مكان الميلاد</div><div>{{ $request->owner_birthplace }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- معلومات العقار ممتدة أسفل العمودين -->
            <div class="property-info">
                <h4>معلومات العقار</h4>
                <div class="grid">
                    <div>الحالة</div>
                    <div>{{ $request->property_status == 'surveyed' ? 'ممسوح' : 'غير ممسوح' }}</div>

                    @if($request->property_status == 'surveyed')
                        <div>القسم</div><div>{{ $request->section }}</div>
                        <div>البلدية</div><div>{{ $request->municipality }}</div>
                        <div>رقم المخطط</div><div>{{ $request->plan_number }}</div>
                        <div>رقم القطعة</div><div>{{ $request->parcel_number }}</div>
                    @else
                        <div>البلدية</div><div>{{ $request->municipality_ns }}</div>
                        <div>رقم التجزئة</div><div>{{ $request->subdivision_number }}</div>
                        <div>رقم القطعة</div><div>{{ $request->parcel_number_ns }}</div>
                    @endif

                    <div>الحالة</div>
                    <div><span class="status {{ $request->status }}">{{ $request->status }}</span></div>

                    <div>تاريخ الإيداع</div>
                    <div>{{ $request->created_at }}</div>
                </div>
            </div>

        </div>

    </div>

    <!-- العمود الجانبي للأزرار -->
    <div class="right-column">
        <div class="side-card">
            <h3>الإجراءات</h3>

            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px;">
                <!-- معالجة -->
                <a href="{{ route('admin.documents.process',$request->id) }}" 
                   class="btn blue"
                   style="background-color: #3b82f6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    ⚙️ معالجة
                </a>

                {{-- زر الطباعة - دائماً ظاهر --}}
                <a href="{{ route('admin.documents.print', $request->id) }}" 
                   class="btn green" 
                   target="_blank"
                   style="background-color: #10b981; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    🖨️ طباعة البطاقة
                </a>

                <!-- حذف -->
                <form method="POST" action="{{ route('admin.documents.destroy',$request->id) }}"
                      onsubmit="return confirm('هل أنت متأكد من الحذف؟')"
                      style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn red" style="background-color: #ef4444; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer; font-weight: bold;">
                        🗑️ حذف
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
/* ====== التخطيط العام ====== */
.details-layout {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 30px;
    max-width: 1300px;
    margin: 40px auto;
    padding: 20px;
}

/* العمود الأيسر */
.left-column {
    display: flex;
    flex-direction: column;
}

/* الكارد الكبير */
.info-card {
    background: rgba(255,255,255,0.9);
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,0.6);
    backdrop-filter: blur(12px);
    box-shadow: 0 15px 45px rgba(0,0,0,0.12);
    padding: 25px;
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.18);
}

/* العنوان الرئيسي */
.info-card h3 {
    background: linear-gradient(135deg,#22c55e,#3b82f6);
    color:white;
    padding:18px 20px;
    font-size:17px;
    font-weight:700;
    margin-bottom:20px;
    border-radius:12px;
}

/* شبكة عمودين */
.grid-2columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap:25px;
}

/* كل عمود */
.column h4 {
    font-size:15px;
    font-weight:700;
    margin-bottom:10px;
    color:#0f172a;
    border-bottom:1px solid #dbeafe;
    padding-bottom:6px;
}

.column .grid {
    display: grid;
    grid-template-columns: 140px 1fr;
    gap:10px;
    margin-bottom:15px;
}

.column .grid div:nth-child(odd) {
    font-weight:600;
    color:#334155;
}

.column .grid div:nth-child(even) {
    font-weight:700;
    color:#0f172a;
}

/* معلومات العقار ممتدة */
.property-info {
    margin-top:25px;
}

.property-info h4 {
    font-size:15px;
    font-weight:700;
    margin-bottom:10px;
    color:#0f172a;
    border-bottom:1px solid #dbeafe;
    padding-bottom:6px;
}

.property-info .grid {
    display: grid;
    grid-template-columns: 160px 1fr;
    gap:12px;
}

/* الحالة */
.status {
    padding:10px 18px;
    border-radius:999px;
    font-weight:800;
    text-align:center;
    font-size:14px;
    text-transform:capitalize;
}

.status.pending { background: linear-gradient(90deg,#fde68a,#facc15); color:#78350f; }
.status.approved { background: linear-gradient(90deg,#bbf7d0,#22c55e); color:#14532d; }
.status.rejected { background: linear-gradient(90deg,#fecaca,#ef4444); color:#7f1d1d; }

/* العمود الجانبي */
.right-column {
    position: sticky;
    top:25px;
}

/* كارد الأزرار */
.side-card {
    background: rgba(255,255,255,0.95);
    border-radius:20px;
    padding:20px;
    display:flex;
    flex-direction:column;
    gap:15px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

/* عنوان كارد الأزرار */
.side-card h3 {
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    border-bottom:2px solid #dbeafe;
    padding-bottom:10px;
}

/* الأزرار */
.btn {
    width:100%;
    padding:14px;
    border-radius:16px;
    border:none;
    font-weight:700;
    cursor:pointer;
    color:white;
    font-size:14px;
    text-align:center;
    transition: all 0.3s ease;
}

.blue { background: linear-gradient(135deg,#3b82f6,#06b6d4); }
.red { background: linear-gradient(135deg,#ef4444,#f87171); }

.btn:hover { transform: scale(1.05); box-shadow:0 12px 28px rgba(0,0,0,0.18); }

/* الخلفية */
body {
    background: linear-gradient(135deg,#f0f8ff,#e0f2fe);
    font-family:'Inter',system-ui,sans-serif;
    margin:0;
    padding:0;
}
</style>

@endsection
