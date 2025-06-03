<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LayananPosyandu;

class LayananPosyanduController extends Controller
{
    //
    public function showView()
    {
        return view('admin.layanan-posyandu', [
            'layananPosyandu' => LayananPosyandu::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelayanan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:Draft,Publish'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananPosyandu = new LayananPosyandu();
        $layananPosyandu->nama_pelayanan = $request->input('nama_pelayanan');
        $layananPosyandu->kategori = $request->input('kategori');
        $layananPosyandu->tanggal_pelayanan = $request->input('tanggal_pelayanan');
        $layananPosyandu->jam_mulai = $request->input('jam_mulai');
        $layananPosyandu->jam_selesai = $request->input('jam_selesai');
        $layananPosyandu->lokasi = $request->input('lokasi');
        $layananPosyandu->status = $request->input('status');
        $layananPosyandu->save();

        return redirect()->route('admin.layanan-posyandu')->with('success', 'Posyandu created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelayanan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:Draft,Publish'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananPosyandu = LayananPosyandu::findOrFail($id);
        $layananPosyandu->nama_pelayanan = $request->input('nama_pelayanan');
        $layananPosyandu->kategori = $request->input('kategori');
        $layananPosyandu->tanggal_pelayanan = $request->input('tanggal_pelayanan');
        $layananPosyandu->jam_mulai = $request->input('jam_mulai');
        $layananPosyandu->jam_selesai = $request->input('jam_selesai');
        $layananPosyandu->lokasi = $request->input('lokasi');
        $layananPosyandu->status = $request->input('status');
        $layananPosyandu->save();

        return redirect()->route('admin.layanan-posyandu')->with('success', 'Posyandu update successfully.');
    }

    public function destroy($id)
    {
        $layananPosyandu = LayananPosyandu::findOrFail($id);
        if (!$layananPosyandu) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan!.');
        }
        $layananPosyandu->delete();

        return redirect()->route('admin.layanan-posyandu')->with('success', 'Posyandu delete successfully.');
    }
}
