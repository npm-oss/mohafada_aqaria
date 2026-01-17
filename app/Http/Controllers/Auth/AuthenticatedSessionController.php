<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        // قائمة الأدمن الثابتين
        $admins = [
            ['email' => 'admin1@system.com', 'password' => 'admin123'],
            ['email' => 'admin2@system.com', 'password' => 'admin456'],
        ];

        foreach ($admins as $admin) {
            if (
                $request->email === $admin['email'] &&
                $request->password === $admin['password']
            ) {
                session([
                    'admin_logged' => true,
                    'admin_email' => $admin['email'],
                ]);

                return redirect()->route('admin.dashboard');
            }
        }

        // تسجيل مستخدم عادي
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request)
    {
        session()->forget('admin_logged');

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
