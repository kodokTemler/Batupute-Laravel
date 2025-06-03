<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\LaporanKegiatan;

class LaporanKegiatanController extends Controller
{
    public function showView()
    {
        return view('admin.laporan-kegiatan', [
            'laporanKegiatan' => LaporanKegiatan::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'anggaran' => 'required|numeric',
            'deskripsi' => 'required|string',
            'file_laporan' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'foto_kegiatan' => 'nullable|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $laporanKegiatan = new LaporanKegiatan();
        $laporanKegiatan->nama_kegiatan = $request->input('nama_kegiatan');
        $laporanKegiatan->tanggal_kegiatan = $request->input('tanggal_kegiatan');
        $laporanKegiatan->lokasi = $request->input('lokasi');
        $laporanKegiatan->anggaran = $request->input('anggaran');
        $laporanKegiatan->deskripsi = $request->input('deskripsi');

        // Logic Laporan
        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->storeAs('assets/documents/laporanKegiatan', $fileName, 'public');

            $laporanKegiatan->file_laporan = $fileName;
        }

        // Logic Foto
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('assets/image/laporanKegiatan', $fileName, 'public');

            $laporanKegiatan->foto_kegiatan = $fileName;
        }

        $laporanKegiatan->status = $request->input('status');
        $laporanKegiatan->save();

        return redirect()->route('admin.laporan-kegiatan')->with('success', 'Data laporan kegiatan berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'anggaran' => 'required|numeric',
            'deskripsi' => 'required|string',
            'file_laporan' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'foto_kegiatan' => 'nullable|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $laporanKegiatan = LaporanKegiatan::findOrFail($id);
        $laporanKegiatan->nama_kegiatan = $request->input('nama_kegiatan');
        $laporanKegiatan->tanggal_kegiatan = $request->input('tanggal_kegiatan');
        $laporanKegiatan->lokasi = $request->input('lokasi');
        $laporanKegiatan->anggaran = $request->input('anggaran');
        $laporanKegiatan->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('file_laporan')) {
            if ($laporanKegiatan->file_laporan) {
                Storage::disk('public')->delete('assets/documents/laporanKegiatan/' . $laporanKegiatan->file_laporan);
            }
            $file = $request->file('file_laporan');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('assets/documents/laporanKegiatan', $fileName, 'public');
            $laporanKegiatan->file_laporan = $fileName;
        }

        if ($request->hasFile('foto_kegiatan')) {
            if ($laporanKegiatan->foto_kegiatan) {
                Storage::disk('public')->delete('assets/image/laporanKegiatan/' . $laporanKegiatan->foto_kegiatan);
            }
            $file = $request->file('foto_kegiatan');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('assets/image/laporanKegiatan', $fileName, 'public');
            $laporanKegiatan->foto_kegiatan = $fileName;
        }

        $laporanKegiatan->status = $request->input('status');
        $laporanKegiatan->save();

        return redirect()->route('admin.laporan-kegiatan')->with('success', 'Data laporan kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporanKegiatan = LaporanKegiatan::findOrFail($id);
        if ($laporanKegiatan->file_laporan) {
            Storage::disk('public')->delete('assets/documents/laporanKegiatan/' . $laporanKegiatan->file_laporan);
        }

        if ($laporanKegiatan->foto_kegiatan) {
            Storage::disk('public')->delete('assets/image/laporanKegiatan/' . $laporanKegiatan->foto_kegiatan);
        }

        $laporanKegiatan->delete();
        return redirect()->route('admin.laporan-kegiatan')->with('success', 'Laporan kegiatan berhasil dihapus.');
    }
}
