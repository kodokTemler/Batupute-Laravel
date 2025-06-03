<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    //
    public function showView()
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->status = Cache::has("admin_logged_in_{$admin->id}") ? 'Aktif' : 'Tidak Aktif';
        }

        return view('admin.admins', compact('admins'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return redirect()->route('admin.admins')->with('success', 'Admin created successfully.');
    }

    public function update(Request $request, $id)
    {
        $admins = Admin::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admins->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admins->name = $request->input('name');
        $admins->email = $request->input('email');

        if ($request->filled('password')) {
            $admins->password = Hash::make($request->input('password'));
        }

        $admins->save();

        return redirect()->route('admin.admins')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admins = Admin::findOrFail($id);
        $admins->delete();

        return redirect()->route('admin.admins')->with('success', 'Admin deleted successfully.');
    }
}
