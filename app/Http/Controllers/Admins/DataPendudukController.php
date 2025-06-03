<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\Validator;

class DataPendudukController extends Controller
{
    public function showView()
    {
        // Ambil semua kategori yang sudah pernah disimpan
        $kategori = DataPenduduk::pluck('kategori')->toArray();

        // Daftar semua kategori
        $semuaKategori = [
            "Jumlah Penduduk",
            "Laki-laki",
            "Perempuan",
            "Kepala Keluarga",
            "Penduduk Sementara",
            "Penduduk Mutasi",
            "Usia 0-17 Tahun",
            "Usia 18-55 Tahun",
            "Usia 55 ke-atas"
        ];

        return view('admin.data-penduduk', [
            'dataPenduduk'   => DataPenduduk::all(),
            'semuaKategori'  => $semuaKategori,
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataPenduduk = new DataPenduduk();
        $dataPenduduk->kategori = $request->input('kategori');
        $dataPenduduk->jumlah = $request->input('jumlah');
        $dataPenduduk->save();
        return redirect()->route('admin.data-penduduk')->with('success', 'Data Penduduk created successfully.');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataPenduduk = DataPenduduk::findOrFail($id);
        $dataPenduduk->kategori = $request->input('kategori');
        $dataPenduduk->jumlah = $request->input('jumlah');
        $dataPenduduk->save();
        return redirect()->route('admin.data-penduduk')->with('success', 'Data Penduduk updated successfully.');
    }
    public function destroy($id)
    {
        $dataPenduduk = DataPenduduk::findOrFail($id);
        $dataPenduduk->delete();
        return redirect()->route('admin.data-penduduk')->with('success', 'Data Penduduk deleted successfully.');
    }
}
