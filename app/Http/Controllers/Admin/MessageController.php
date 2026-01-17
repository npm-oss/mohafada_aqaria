<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        // هنا تجيب الرسائل من DB
        $messages = []; // مؤقتاً، أو Model Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        // عرض رسالة واحدة
        return view('admin.messages.show', ['id' => $id]);
    }
}
