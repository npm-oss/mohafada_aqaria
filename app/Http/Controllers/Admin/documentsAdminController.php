<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class documentsAdminController extends Controller
{
    // قائمة الطلبات
    public function index()
    {
        $requests = DocumentsRequest::orderBy('created_at', 'desc')->get();
        return view('admin.documents.index', compact('requests'));
    }

    // عرض طلب واحد
    public function show($id)
    {
        $request = DocumentsRequest::findOrFail($id);
        return view('admin.documents.show', compact('request'));
    }
    public function destroy($id)
{
    $doc = Document::findOrFail($id);
    $doc->delete();

    return redirect()->route('admin.documents.index')
                     ->with('success','تم حذف الطلب بنجاح');
}


    // حفظ طلب جديد

public function store(Request $request)
{
    // التحقق الأساسي
    $request->validate([
        'applicant_type' => 'required|string',
        'owner_type' => 'required|string',
        'card_type' => 'required|string',
        'property_status' => 'required|string',
    ]);

    // -----------------------------
    // تعبئة بيانات الطالب
    // -----------------------------
    if ($request->applicant_type === 'person') {
        $applicant_nin = $request->applicant_nin ?? '-';
        $applicant_lastname = $request->applicant_lastname ?? '-';
        $applicant_firstname = $request->applicant_firstname ?? '-';
        $applicant_father = $request->applicant_father ?? '-';
        $applicant_email = $request->applicant_email ?? '-';
        $applicant_phone = $request->applicant_phone ?? '-';
    } else {
        // طالب شركة => نحفظ الشركة كمقدم الطلب في نفس الأعمدة
        $applicant_nin = $request->company_nin ?? '-';
        $applicant_lastname = $request->company_name ?? '-'; // يمكن وضع اسم الشركة هنا
        $applicant_firstname = $request->company_representative ?? '-';
        $applicant_father = '-';
        $applicant_email = $request->company_email ?? '-';
        $applicant_phone = $request->company_phone ?? '-';
    }

    // -----------------------------
    // تعبئة بيانات صاحب الملكية
    // -----------------------------
    if ($request->owner_type === 'person') {
        $owner_nin = $request->owner_nin ?? '-';
        $owner_lastname = $request->owner_lastname ?? '-';
        $owner_firstname = $request->owner_firstname ?? '-';
        $owner_father = $request->owner_father ?? '-';
        $owner_birthdate = $request->owner_birthdate ?? null;
        $owner_birthplace = $request->owner_birthplace ?? '-';
    } else {
        // صاحب الملكية شركة => نحفظ الشركة وممثلها في نفس الأعمدة
        $owner_nin = $request->owner_company_nin ?? '-';
        $owner_lastname = $request->owner_company_name ?? '-';
        $owner_firstname = $request->owner_company_representative ?? '-';
        $owner_father = $request->owner_company_email ?? '-';
        $owner_birthdate =  null;
        $owner_birthplace = $request->owner_company_phone ?? '-';
    }

    // -----------------------------
    // حالة العقار
    // -----------------------------
    $property_status = $request->property_status;
    $section = $request->section ?? null;
    $municipality = $request->municipality ?? null;
    $plan_number = $request->plan_number ?? null;
    $parcel_number = $request->parcel_number ?? null;
    $municipality_ns = $request->municipality_ns ?? null;
    $subdivision_number = $request->subdivision_number ?? null;
    $parcel_number_ns = $request->parcel_number_ns ?? null;

    // -----------------------------
    // إدخال البيانات في DB
    // -----------------------------
    DocumentsRequest::create([
         'applicant_type'=> $request->applicant_type, 
        'owner_type'=> $request->owner_type,
        'type' => $request->applicant_type, // شخص / شركة
        'request_type' => $request->owner_type, // شخص / شركة
        'status' => 'pending',
        'card_type' => $request->card_type,
        'property_status' => $property_status,

        'section' => $section,
        'municipality' => $municipality,
        'plan_number' => $plan_number,
        'parcel_number' => $parcel_number,
        'municipality_ns' => $municipality_ns,
        'subdivision_number' => $subdivision_number,
        'parcel_number_ns' => $parcel_number_ns,

        'applicant_nin' => $applicant_nin,
        'applicant_lastname' => $applicant_lastname,
        'applicant_firstname' => $applicant_firstname,
        'applicant_father' => $applicant_father,
        'applicant_email' => $applicant_email,
        'applicant_phone' => $applicant_phone,

        'owner_nin' => $owner_nin,
        'owner_lastname' => $owner_lastname,
        'owner_firstname' => $owner_firstname,
        'owner_father' => $owner_father,
        'owner_birthdate' => $owner_birthdate,
        'owner_birthplace' => $owner_birthplace,
    ]);

    return redirect()->back()->with('success', 'تم تسجيل الطلب بنجاح');
}



}