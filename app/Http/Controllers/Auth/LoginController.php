<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
            'password' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $adminId = Auth::guard('admin')->id(); // ✅ Ambil ID sesuai guard
            Cache::forget("admin_logged_in_$adminId");
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
