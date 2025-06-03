<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DokumenPublik;

class DokumenPublikController extends Controller
{
    public function showView()
    {
        return view('admin.dokumen-publik', ['dokumenPublik' => DokumenPublik::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'file_dokumen' => 'required|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumenPublik = new DokumenPublik();
        $dokumenPublik->nama_dokumen = $request->input('nama_dokumen');
        $dokumenPublik->kategori = $request->input('kategori');
        $dokumenPublik->tahun = $request->input('tahun');

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('assets/documents/dokumenPublik', $fileName, 'public');

            $dokumenPublik->file_dokumen = $fileName;
        }
        $dokumenPublik->status = $request->input('status');
        $dokumenPublik->save();

        return redirect()->route('admin.dokumen-publik')->with('success', 'Data dokumen publik berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'file_dokumen' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumenPublik = DokumenPublik::findOrFail($id);
        $dokumenPublik->nama_dokumen = $request->input('nama_dokumen');
        $dokumenPublik->kategori = $request->input('kategori');
        $dokumenPublik->tahun = $request->input('tahun');

        if ($request->hasFile('file_dokumen')) {
            if ($dokumenPublik->file_dokumen) {
                Storage::disk('public')->delete('assets/documents/dokumenPublik/' . $dokumenPublik->file_dokumen);
            }
            $file = $request->file('file_dokumen');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('assets/documents/dokumenPublik', $fileName, 'public');
            $dokumenPublik->file_dokumen = $fileName;
        }

        $dokumenPublik->status = $request->input('status');
        $dokumenPublik->save();
        return redirect()->route('admin.dokumen-publik')->with('success', 'Data dokumen publik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumenPublik = DokumenPublik::findOrFail($id);
        if ($dokumenPublik->file_dokumen) {
            Storage::disk('public')->delete('assets/documents/dokumenPublik/' . $dokumenPublik->file_dokumen);
        }
        $dokumenPublik->delete();
        return redirect()->route('admin.dokumen-publik')->with('success', 'Data transparansi anggaran berhasil dihapus.');
    }
}
