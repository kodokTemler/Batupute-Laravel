<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPekerjaanPenduduk;
use Illuminate\Support\Facades\Validator;

class DataPekerjaanPendudukController extends Controller
{
    //
    public function showView()
    {
        return view('admin.data-pekerjaan-penduduk', [
            'dataPekerjaanPenduduk' => DataPekerjaanPenduduk::all()
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required|string|max:255',
            'jumlah' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataPekerjaanPenduduk = new DataPekerjaanPenduduk();
        $dataPekerjaanPenduduk->pekerjaan = $request->input('pekerjaan');
        $dataPekerjaanPenduduk->jumlah = $request->input('jumlah');
        $dataPekerjaanPenduduk->save();
        return redirect()->route('admin.data-pekerjaan-penduduk')->with('success', 'Data Pekerjaan Penduduk created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required|string|max:255',
            'jumlah' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataPekerjaanPenduduk = DataPekerjaanPenduduk::findOrFail($id);
        $dataPekerjaanPenduduk->pekerjaan = $request->input('pekerjaan');
        $dataPekerjaanPenduduk->jumlah = $request->input('jumlah');
        $dataPekerjaanPenduduk->save();
        return redirect()->route('admin.data-pekerjaan-penduduk')->with('success', 'Data Pekerjaan Penduduk updated successfully.');
    }
    public function destroy($id)
    {
        $dataPekerjaanPenduduk = DataPekerjaanPenduduk::findOrFail($id);
        $dataPekerjaanPenduduk->delete();
        return redirect()->route('admin.data-pekerjaan-penduduk')->with('success', 'Data Pekerjaan Penduduk deleted successfully.');
    }
}
