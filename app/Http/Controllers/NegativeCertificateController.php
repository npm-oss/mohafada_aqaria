<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NegativeCertificate;

class NegativeCertificateController extends Controller
{
    public function new()
    {
        return view('negative.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_lastname' => 'required',
            'owner_firstname' => 'required',
            'email' => 'required|email',
        ]);

        NegativeCertificate::create([
            'owner_lastname' => $request->owner_lastname,
            'owner_firstname' => $request->owner_firstname,
            'owner_father' => $request->owner_father,
            'owner_birthdate' => $request->owner_birthdate,
            'owner_birthplace' => $request->owner_birthplace,
            'applicant_lastname' => $request->applicant_lastname,
            'applicant_firstname' => $request->applicant_firstname,
            'applicant_father' => $request->applicant_father,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type ?? 'جديدة',
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success','تم إرسال طلبك وسيتم معالجته من طرف الإدارة');
    }
}
