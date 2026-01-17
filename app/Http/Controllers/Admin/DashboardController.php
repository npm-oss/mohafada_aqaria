<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRequest;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // عدد الطلبات حسب الحالة
        $newRequests        = UserRequest::where('status','new')->count();
        $processingRequests = UserRequest::where('status','processing')->count();
        $approvedRequests   = UserRequest::where('status','approved')->count();

        $totalRequests = $newRequests + $processingRequests + $approvedRequests;

        // نسبة لكل حالة (progress bars)
        $newPercent        = $totalRequests > 0 ? round(($newRequests / $totalRequests) * 100) : 0;
        $processingPercent = $totalRequests > 0 ? round(($processingRequests / $totalRequests) * 100) : 0;
        $approvedPercent   = $totalRequests > 0 ? round(($approvedRequests / $totalRequests) * 100) : 0;

        // عدد المستخدمين
        $usersCount = User::count();

        // آخر الطلبات (أحدث 5)
        $latestRequests = UserRequest::latest()->take(5)->get();

        // الرسائل الغير مقروءة → نجعلها 0 حتى لا يظهر خطأ
        $unreadMessages = 0;

        // آخر النشاطات → مجموعة فارغة
        $activities = collect();

        return view('admin.dashboard', compact(
            'newRequests',
            'processingRequests',
            'approvedRequests',
            'usersCount',
            'latestRequests',
            'newPercent',
            'processingPercent',
            'approvedPercent',
            'unreadMessages',
            'activities'
        ));
    }
}
