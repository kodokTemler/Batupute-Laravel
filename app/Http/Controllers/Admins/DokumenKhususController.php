<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenKhusus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokumenKhususController extends Controller
{
    public function showView()
    {
        return view('admin.dokumen-khusus', [
            'dokumenKhusus' => DokumenKhusus::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumenKhusus = new DokumenKhusus();
        $dokumenKhusus->nama_dokumen = $request->input('nama_dokumen');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('assets/documents/dokumenKhusus', $filename, 'public');

            // Simpan hanya path relatif dari storage/public
            $dokumenKhusus->file = $path;
        }

        $dokumenKhusus->save();

        return redirect()->route('admin.dokumen-khusus')->with('success', 'Dokumen khusus berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $dokumenKhusus = DokumenKhusus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumenKhusus->nama_dokumen = $request->input('nama_dokumen');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($dokumenKhusus->file && Storage::disk('public')->exists($dokumenKhusus->file)) {
                Storage::disk('public')->delete($dokumenKhusus->file);
            }

            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('assets/documents/dokumenKhusus', $filename, 'public');

            $dokumenKhusus->file = $path;
        }

        $dokumenKhusus->save();

        return redirect()->route('admin.dokumen-khusus')->with('success', 'Dokumen khusus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumenKhusus = DokumenKhusus::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($dokumenKhusus->file && Storage::disk('public')->exists($dokumenKhusus->file)) {
            Storage::disk('public')->delete($dokumenKhusus->file);
        }

        $dokumenKhusus->delete();

        return redirect()->route('admin.dokumen-khusus')->with('success', 'Dokumen khusus berhasil dihapus.');
    }
}
