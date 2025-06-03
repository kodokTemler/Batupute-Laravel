<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{

    public function showView()
    {
        return view('admin.kontak', ['kontaks' => Kontak::all()]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'in:Diterima,Selesai'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kontaks = Kontak::findOrFail($id);
        $kontaks->status = $request->input('status');
        $kontaks->save();

        return redirect()->route('admin.kontak')->with('success', 'Pesan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kontaks = Kontak::findOrFail($id);
        if (!$kontaks) {
            return redirect()->back()->with('error', 'Maaf pesan tidak tersedia!!.');
        }
        $kontaks->delete();
        return redirect()->route('admin.kontak')->with('success', 'Pesan berhasil dihapus.');
    }
}
