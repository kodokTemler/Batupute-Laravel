<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananPengaduan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LayananPengaduanController extends Controller
{
    //
    public function showView()
    {
        return view('admin.layanan-pengaduan', ['layananPengaduan' => LayananPengaduan::all()]);
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
        return redirect()->route('admin.layanan-pengaduan')->with('success', 'Layanan Pengaduan created successfully.');
    }

    public function update(Request $request, $id)
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

        $layananPengaduan = LayananPengaduan::findOrFail($id);
        $layananPengaduan->nama = $request->input('nama');
        $layananPengaduan->nomor_hp = $request->input('nomor_hp');
        $layananPengaduan->kategori = $request->input('kategori');
        $layananPengaduan->isi_pengaduan = $request->input('isi_pengaduan');
        $layananPengaduan->status = $request->input('status', 'Diterima');

        if ($request->hasFile('foto_bukti')) {
            // Hapus foto lama jika ada
            if ($layananPengaduan->foto_bukti) {
                Storage::disk('public')->delete('assets/image/layananPengaduan/' . $layananPengaduan->foto_bukti);
            }

            $file = $request->file('foto_bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/layananPengaduan', $filename, 'public');

            // Simpan nama file ke database
            $layananPengaduan->foto_bukti = $filename;
        }

        $layananPengaduan->save();
        return redirect()->route('admin.layanan-pengaduan')->with('success', 'Layanan Pengaduan updated successfully.');
    }

    public function destroy($id)
    {
        $layananPengaduan = LayananPengaduan::findOrFail($id);

        // Hapus foto jika ada
        if ($layananPengaduan->foto_bukti) {
            Storage::disk('public')->delete('assets/image/layananPengaduan/' . $layananPengaduan->foto_bukti);
        }

        $layananPengaduan->delete();
        return redirect()->route('admin.layanan-pengaduan')->with('success', 'Layanan Pengaduan deleted successfully.');
    }
}
