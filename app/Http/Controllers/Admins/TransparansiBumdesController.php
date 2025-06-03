<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransparansiBumdes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransparansiBumdesController extends Controller
{
    public function showView()
    {
        return view('admin.transparansi-bumdes', ['transparansiBumdes' => TransparansiBumdes::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
            'file_bukti' => 'required|file|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $transparansiBumdes = new TransparansiBumdes();
        $transparansiBumdes->judul = $request->input('judul');
        $transparansiBumdes->tahun = $request->input('tahun');

        // Logic File Bukti
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/transparansiBumdes', $filename, 'public');

            $transparansiBumdes->file_bukti = $filename;
        }

        $transparansiBumdes->status = $request->input('status');
        $transparansiBumdes->save();
        return redirect()->route('admin.transparansi-bumdes')->with('success', 'Data transparansi Bumdes berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
            'file_bukti' => 'file|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $transparansiBumdes = TransparansiBumdes::findOrFail($id);
        $transparansiBumdes->judul = $request->input('judul');
        $transparansiBumdes->tahun = $request->input('tahun');
        // Logic File Bukti
        if ($request->hasFile('file_bukti')) {
            // Hapus file lama jika ada
            if ($transparansiBumdes->file_bukti) {
                Storage::disk('public')->delete('assets/documents/transparansiBumdes/' . $transparansiBumdes->file_bukti);
            }
            $file = $request->file('file_bukti');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/transparansiBumdes', $filename, 'public');

            $transparansiBumdes->file_bukti = $filename;
        }
        $transparansiBumdes->status = $request->input('status');
        $transparansiBumdes->save();
        return redirect()->route('admin.transparansi-bumdes')->with('success', 'Data transparansi Bumdes berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transparansiBumdes = TransparansiBumdes::findOrFail($id);
        if ($transparansiBumdes->file_bukti) {
            Storage::disk('public')->delete('assets/documents/transparansiBumdes/' . $transparansiBumdes->file_bukti);
        }
        $transparansiBumdes->delete();
        return redirect()->route('admin.transparansi-bumdes')->with('success', 'Data transparansi Bumdes berhasil dihapus.');
    }
}
