<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;

class CertificateController extends Controller
{
    // صفحة معالجة الطلب
    public function process($id)
    {
        $certificate = UserRequest::findOrFail($id);

        // قيم افتراضية لتجنب أي خطأ في Blade
        $certificate->owner_name = $certificate->owner_name ?? '';
        $certificate->owner_lastname = $certificate->owner_lastname ?? '';
        $certificate->owner_firstname = $certificate->owner_firstname ?? '';
        $certificate->gender = $certificate->gender ?? '';
        $certificate->nationality = $certificate->nationality ?? '';
        $certificate->birth_certificate_number = $certificate->birth_certificate_number ?? '';
        $certificate->owner_birthdate = $certificate->owner_birthdate ?? '';
        $certificate->owner_birthplace = $certificate->owner_birthplace ?? '';
        $certificate->state = $certificate->state ?? '';
        $certificate->municipality = $certificate->municipality ?? '';

        return view('admin.certificates.process', compact('certificate'));
    }

    // صفحة الشهادة
    public function certificate($id)
    {
        $certificate = UserRequest::findOrFail($id);

        return view('admin.certificates.certificate', compact('certificate'));
    }

    // حفظ بيانات الشهادة
    public function saveCertificate(Request $request, $id)
    {
        $certificate = UserRequest::findOrFail($id);
        $certificate->certificate_data = json_encode($request->all());
        $certificate->result_type = $certificate->result_type ?? 'positive';
        $certificate->certificate_issued_at = now();
        $certificate->status = 'certified';
        $certificate->save();

        return back()->with('success','تم حفظ الشهادة');
    }

    // عمليات أخرى (اعتماد / رفض / بحث)
    public function approve($id) { /* ... */ }
    public function reject($id) { /* ... */ }
    public function extract($id) { /* ... */ }
}

