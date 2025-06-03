<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showView()
    {
        return view('admin.users', ['users' => User::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
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
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $users->id,
            'password' => 'nullable|string|min:8|confirmed',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        if ($request->filled('password')) {
            $users->password = Hash::make($request->input('password'));
        }
        $users->tempat_lahir = $request->input('tempat_lahir');
        $users->tanggal_lahir = $request->input('tanggal_lahir');
        $users->nomor_hp = $request->input('nomor_hp');
        $users->jenis_kelamin = $request->input('jenis_kelamin');
        $users->alamat = $request->input('alamat');
        $users->save();
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
