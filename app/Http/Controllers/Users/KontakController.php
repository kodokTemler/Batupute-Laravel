<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'nullable|in:Diterima,Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kontaks = new Kontak();
        $kontaks->nama = $request->input('nama');
        $kontaks->email = $request->input('email');
        $kontaks->subject = $request->input('subject');
        $kontaks->message = $request->input('message');
        $kontaks->status = $request->input('status', 'Diterima');
        $kontaks->save();

        if ($request->ajax()) {
            return response('OK', 200);
        }

        return redirect()->route('index');
    }
}
