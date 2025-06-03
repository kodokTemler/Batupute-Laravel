<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    //
    public function showView()
    {
        return view('admin.berita', [
            'berita' => Berita::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'kategori' => 'required|string|max:255',
            'status' => 'required|in:Publish,Draf,Arsip',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $berita = new Berita();
        $berita->judul = $request->input('judul');
        $berita->isi_berita = $request->input('isi_berita');
        $berita->kategori = $request->input('kategori');
        $berita->status = $request->input('status');
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/berita', $filename, 'public');

            // Simpan nama file ke database
            $berita->gambar = $filename;
        }
        $berita->save();
        return redirect()->route('admin.berita')->with('success', 'Berita created successfully.');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'kategori' => 'required|string|max:255',
            'status' => 'required|in:Publish,Draf,Arsip',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $berita->judul = $request->input('judul');
        $berita->isi_berita = $request->input('isi_berita');
        $berita->kategori = $request->input('kategori');
        $berita->status = $request->input('status');
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete('assets/image/berita/' . $berita->gambar);
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/berita', $filename, 'public');

            // Simpan nama file ke database
            $berita->gambar = $filename;
        }
        $berita->save();
        return redirect()->route('admin.berita')->with('success', 'Berita updated successfully.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete('assets/image/berita/' . $berita->gambar);
        }
        $berita->delete();
        return redirect()->route('admin.berita')->with('success', 'Berita deleted successfully.');
    }
}
