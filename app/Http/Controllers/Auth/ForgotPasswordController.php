<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Admin;

class ForgotPasswordController extends Controller
{
    // Tampilkan form lupa password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Kirim link reset password ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Cek apakah email ada di tabel admin atau user
        $guard = null;
        if (Admin::where('email', $request->email)->exists()) {
            $guard = 'admin';
        } elseif (User::where('email', $request->email)->exists()) {
            $guard = 'user';
        } else {
            return back()->withErrors(['email' => 'Email tidak ditemukan di sistem kami.']);
        }

        $token = Str::random(64);

        // Hapus token lama
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Simpan token baru (hashed)
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Sertakan guard dan email di URL
        $resetLink = url("/reset-password/{$token}?email=" . urlencode($request->email) . "&guard={$guard}");

        // Kirim email
        Mail::to($request->email)->send(new ForgotPasswordMail($resetLink));

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // Tampilkan form reset password
    public function showResetForm($token, Request $request)
    {
        $email = $request->query('email');
        $guard = $request->query('guard');

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kedaluwarsa.']);
        }

        // Gunakan expire berdasarkan guard
        $expire = $request->guard === 'admin'
            ? config('auth.passwords.admins.expire')
            : config('auth.passwords.users.expire');

        // Paksa Carbon parse
        $createdAt = \Carbon\Carbon::parse($record->created_at);

        // ✅ Pengecekan expire lebih dulu
        if ($createdAt->diffInMinutes(now()) > $expire) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Token reset password telah kedaluwarsa.']);
        }

        // Baru cek kecocokan token
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Token tidak valid.']);
        }

        return view('auth.reset-password', compact('token', 'email', 'guard'));
    }

    // Proses ubah password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'guard' => 'required|in:admin,user',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kedaluwarsa.']);
        }

        // Gunakan expire berdasarkan guard
        $expire = $request->guard === 'admin'
            ? config('auth.passwords.admins.expire')
            : config('auth.passwords.users.expire');

        if (now()->diffInMinutes($record->created_at) > $expire) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Token reset password telah kedaluwarsa.']);
        }

        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Token tidak valid.']);
        }

        if ($request->guard === 'admin') {
            $admin = Admin::where('email', $request->email)->first();
            if ($admin) {
                $admin->password = Hash::make($request->password);
                $admin->save();
            }
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
