<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananKesra;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LayananKesraController extends Controller
{
    //
    public function showView()
    {
        return view('admin.layanan-kesra', [
            'layananKesra' => LayananKesra::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Draft,Publish',
            'file_dokumen' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananKesra = new LayananKesra();
        $layananKesra->nama_layanan = $request->input('nama_layanan');
        $layananKesra->jenis_bantuan = $request->input('jenis_bantuan');
        $layananKesra->tahun = $request->input('tahun');
        $layananKesra->deskripsi = $request->input('deskripsi');
        $layananKesra->status = $request->input('status');
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/layananKesra', $filename, 'public');
            $layananKesra->file_dokumen = $filename;
        }
        $layananKesra->save();
        return redirect()->route('admin.layanan-kesra')->with('success', 'Layanan Kesra created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Draft,Publish',
            'file_dokumen' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananKesra = LayananKesra::findOrFail($id);
        if (!$layananKesra) {
            return redirect()->back()->with('error', 'Layanan Kesra tidak ditemukan!.');
        }
        $layananKesra->nama_layanan = $request->input('nama_layanan');
        $layananKesra->jenis_bantuan = $request->input('jenis_bantuan');
        $layananKesra->tahun = $request->input('tahun');
        $layananKesra->deskripsi = $request->input('deskripsi');
        $layananKesra->status = $request->input('status');

        if ($request->hasFile('file_dokumen')) {

            if ($layananKesra->file_dokumen) {
                Storage::disk('public')->delete('assets/documents/layananKesra/' . $layananKesra->file_dokumen);
            }

            $file = $request->file('file_dokumen');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/layananKesra', $filename, 'public');

            $layananKesra->file_dokumen = $filename;
        }

        $layananKesra->save();
        return redirect()->route('admin.layanan-kesra')->with('success', 'Layanan Kesra updated successfully.');
    }

    public function destroy($id)
    {
        $layananKesra = LayananKesra::findOrFail($id);
        if (!$layananKesra) {
            return redirect()->back()->with('error', 'Layanan Kesra tidak ditemukan!.');
        }
        if ($layananKesra->file_dokumen) {
            Storage::disk('public')->delete('assets/documents/layananKesra/' . $layananKesra->file_dokumen);
        }
        $layananKesra->delete();
        return redirect()->route('admin.layanan-kesra')->with('success', 'Layanan Kesra deleted successfully.');
    }
}
