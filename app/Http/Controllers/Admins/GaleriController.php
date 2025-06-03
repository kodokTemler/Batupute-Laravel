<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    //
    public function showView()
    {
        return view('admin.galeri', [
            'galeri' => Galeri::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'kategori' => 'required|string|max:255',
            'status' => 'required|in:Draf,Publish',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $galeri = new Galeri();
        $galeri->title = $request->input('title');
        $galeri->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/galeri', $filename, 'public');

            // Simpan nama file ke database
            $galeri->gambar = $filename;
        }
        $galeri->kategori = $request->input('kategori');
        $galeri->status = $request->input('status');
        $galeri->save();
        return redirect()->route('admin.galeri')->with('success', 'Galeri created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'kategori' => 'required|string|max:255',
            'status' => 'required|in:Draf,Publish',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $galeri = Galeri::findOrFail($id);
        $galeri->title = $request->input('title');
        $galeri->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($galeri->gambar) {
                Storage::disk('public')->delete('assets/image/galeri/' . $galeri->gambar);
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/galeri', $filename, 'public');

            // Simpan nama file ke database
            $galeri->gambar = $filename;
        }
        $galeri->kategori = $request->input('kategori');
        $galeri->status = $request->input('status');
        $galeri->save();
        return redirect()->route('admin.galeri')->with('success', 'Galeri updated successfully.');
    }
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar) {
            Storage::disk('public')->delete('assets/image/galeri/' . $galeri->gambar);
        }
        $galeri->delete();
        return redirect()->route('admin.galeri')->with('success', 'Galeri deleted successfully.');
    }
}
