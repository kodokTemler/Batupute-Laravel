<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransparansiAnggaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransparansiAnggaranController extends Controller
{
    public function showView()
    {
        return view(
            'admin.transparansi-anggaran',
            ['tranparansiAnggaran' => TransparansiAnggaran::all()]
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|digits:4',
            'sumber_dana' => 'required|string|max:255',
            'jumlah_anggaran' => 'required|numeric',
            'jenis_penggunaan' => 'required|string|max:255',
            'kategori' => 'required|in:Pendapatan,Pengeluaran',
            'keterangan' => 'required|string',
            'file_bukti' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $anggaran = new TransparansiAnggaran();
        $anggaran->tahun = $request->input('tahun');
        $anggaran->sumber_dana = $request->input('sumber_dana');
        $anggaran->jumlah_anggaran = $request->input('jumlah_anggaran');
        $anggaran->jenis_penggunaan = $request->input('jenis_penggunaan');
        $anggaran->kategori = $request->input('kategori');
        $anggaran->keterangan = $request->input('keterangan');

        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/transparansiAnggaran', $filename, 'public');

            $anggaran->file_bukti = $filename;
        }

        $anggaran->status = $request->input('status');
        $anggaran->save();

        return redirect()->route('admin.transparansi-anggaran')->with('success', 'Data transparansi anggaran berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|digits:4',
            'sumber_dana' => 'required|string|max:255',
            'jumlah_anggaran' => 'required|numeric',
            'jenis_penggunaan' => 'required|string|max:255',
            'kategori' => 'required|in:Pendapatan,Pengeluaran',
            'keterangan' => 'required|string',
            'file_bukti' => 'nullable|mimes:pdf,xls,xlsx,doc,docx|max:5120',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $anggaran = TransparansiAnggaran::findOrFail($id);
        $anggaran->tahun = $request->input('tahun');
        $anggaran->sumber_dana = $request->input('sumber_dana');
        $anggaran->jumlah_anggaran = $request->input('jumlah_anggaran');
        $anggaran->jenis_penggunaan = $request->input('jenis_penggunaan');
        $anggaran->kategori = $request->input('kategori');
        $anggaran->keterangan = $request->input('keterangan');

        if ($request->hasFile('file_bukti')) {

            if ($anggaran->file_bukti) {
                Storage::disk('public')->delete('assets/documents/transparansiAnggaran/' . $anggaran->file_bukti);
            }

            $file = $request->file('file_bukti');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/assets/documents
            $file->storeAs('assets/documents/transparansiAnggaran', $filename, 'public');

            $anggaran->file_bukti = $filename;
        }

        $anggaran->status = $request->input('status');
        $anggaran->save();

        return redirect()->route('admin.transparansi-anggaran')->with('success', 'Data transparansi anggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transparansiAnggaran = TransparansiAnggaran::findOrFail($id);
        if ($transparansiAnggaran->file_bukti) {
            Storage::disk('public')->delete('assets/documents/transparansiAnggaran/' . $transparansiAnggaran->file_bukti);
        }

        $transparansiAnggaran->delete();
        return redirect()->route('admin.transparansi-anggaran')->with('success', 'Transparansi Anggaran berhasil dihapus.');
    }
}
