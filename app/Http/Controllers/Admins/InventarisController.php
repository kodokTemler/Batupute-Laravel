<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventaris;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    //
    public function showView()
    {
        return view('admin.inventaris', [
            'inventaris' => Inventaris::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|in:Baik,Rusak',
            'tahun_pengadaan' => 'required|digits:4',
            'sumber_dana' => 'required|string',
            'harga_per_barang' => 'required|numeric',
            'lokasi_penyimpanan' => 'required|string',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $inventaris = new Inventaris();
        $inventaris->nama_barang = $request->input('nama_barang');
        $inventaris->kategori = $request->input('kategori');
        $inventaris->jumlah = $request->input('jumlah');
        $inventaris->kondisi = $request->input('kondisi');
        $inventaris->tahun_pengadaan = $request->input('tahun_pengadaan');
        $inventaris->sumber_dana = $request->input('sumber_dana');
        $inventaris->harga_per_barang = $request->input('harga_per_barang');
        $inventaris->lokasi_penyimpanan = $request->input('lokasi_penyimpanan');
        $inventaris->keterangan = $request->input('keterangan');
        if ($request->hasFile('foto_barang')) {
            $file = $request->file('foto_barang');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/inventaris', $filename, 'public');

            // Simpan nama file ke database
            $inventaris->foto_barang = $filename;
        }
        $inventaris->save();
        return redirect()->route('admin.inventaris')->with('success', 'Inventaris created successfully.');
    }

    public function update(Request $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|in:Baik,Rusak',
            'tahun_pengadaan' => 'required|digits:4',
            'sumber_dana' => 'required|string',
            'harga_per_barang' => 'required|numeric',
            'lokasi_penyimpanan' => 'required|string',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $inventaris->nama_barang = $request->input('nama_barang');
        $inventaris->kategori = $request->input('kategori');
        $inventaris->jumlah = $request->input('jumlah');
        $inventaris->kondisi = $request->input('kondisi');
        $inventaris->tahun_pengadaan = $request->input('tahun_pengadaan');
        $inventaris->sumber_dana = $request->input('sumber_dana');
        $inventaris->harga_per_barang = $request->input('harga_per_barang');
        $inventaris->lokasi_penyimpanan = $request->input('lokasi_penyimpanan');
        $inventaris->keterangan = $request->input('keterangan');

        if ($request->hasFile('foto_barang')) {
            if ($inventaris->foto_barang) {
                Storage::disk('public')->delete('assets/image/inventaris/' . $inventaris->foto_barang);
            }
            $file = $request->file('foto_barang');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/inventaris', $filename, 'public');

            // Simpan nama file ke database
            $inventaris->foto_barang = $filename;
        }
        $inventaris->save();
        return redirect()->route('admin.inventaris')->with('success', 'Inventaris updated successfully.');
    }
    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        if ($inventaris->foto_barang) {
            Storage::disk('public')->delete('assets/image/inventaris/' . $inventaris->foto_barang);
        }
        $inventaris->delete();
        return redirect()->route('admin.inventaris')->with('success', 'Inventaris deleted successfully.');
    }
}
