<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function extracts()
    {
        return view('contracts.extracts');
    }

    public function send(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        return back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}

