<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananPengaduan;
use Illuminate\Support\Facades\Validator;

class LayananPengaduanController extends Controller
{
    //
    public function showView()
    {
        return view('user.layanan-pengaduan', ['layananPengaduan' => LayananPengaduan::all()]);
    }

    public function showFormLayananPengaduan()
    {
        return view('pelayanan.layanan-pengaduan');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'kategori' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'status' => 'in:Diterima,Diproses,Selesai',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic,heif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $layananPengaduan = new LayananPengaduan();
        $layananPengaduan->nama = $request->input('nama');
        $layananPengaduan->nomor_hp = $request->input('nomor_hp');
        $layananPengaduan->kategori = $request->input('kategori');
        $layananPengaduan->isi_pengaduan = $request->input('isi_pengaduan');
        $layananPengaduan->status = $request->input('status', 'Diterima');

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/layananPengaduan', $filename, 'public');

            // Simpan nama file ke database
            $layananPengaduan->foto_bukti = $filename;
        }

        $layananPengaduan->save();
        return redirect()->route('pelayanan.layanan-pengaduan')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'in:Diterima,Diproses,Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $layananPengaduan = LayananPengaduan::findOrFail($id);
        $layananPengaduan->status = $request->input('status', 'Diterima');

        $layananPengaduan->save();
        return redirect()->route('user.layanan-pengaduan')->with('success', 'Layanan Pengaduan updated successfully.');
    }
}
