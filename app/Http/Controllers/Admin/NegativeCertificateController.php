<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NegativeCertificate;

class NegativeCertificateController extends Controller
{
    // عرض فورم المواطن
    public function new()
    {
        return view('negative.new');
    }

    // حفظ الطلب (مواطن فقط)
    public function store(Request $request)
    {
        $request->validate([
            'owner_lastname'      => 'required|string|max:255',
            'owner_firstname'     => 'required|string|max:255',
            'applicant_lastname'  => 'required|string|max:255',
            'applicant_firstname' => 'required|string|max:255',
            'email'               => 'required|email',
            'phone'               => 'required',
        ]);

        NegativeCertificate::create([
            'owner_lastname'      => $request->owner_lastname,
            'owner_firstname'     => $request->owner_firstname,
            'owner_father'        => $request->owner_father,
            'owner_birthdate'     => $request->owner_birthdate,
            'owner_birthplace'    => $request->owner_birthplace,

            'applicant_lastname'  => $request->applicant_lastname,
            'applicant_firstname' => $request->applicant_firstname,
            'applicant_father'    => $request->applicant_father,

            'email'  => $request->email,
            'phone'  => $request->phone,

            'type'   => 'جديدة',
            'status' => 'قيد المعالجة',
        ]);

        return redirect()
            ->back()
            ->with('success', '✅ تم إرسال طلبك وسيتم معالجته من طرف الإدارة');
    }
}
