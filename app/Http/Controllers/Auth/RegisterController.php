<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showLoginRegister()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
        ], [
            'email.unique' => 'Email sudah digunakan. Silakan pakai email lain.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->tempat_lahir = $request->input('tempat_lahir');
        $user->tanggal_lahir = $request->input('tanggal_lahir');
        $user->nomor_hp = $request->input('nomor_hp');
        $user->jenis_kelamin = $request->input('jenis_kelamin');
        $user->alamat = $request->input('alamat');
        $user->save();
        return redirect()->route('login')->with('success', 'Account created successfully.');
    }
}
