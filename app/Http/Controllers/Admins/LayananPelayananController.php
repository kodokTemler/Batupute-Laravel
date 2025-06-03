<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananPelayanan;
use Illuminate\Support\Facades\Validator;

class LayananPelayananController extends Controller
{
    //
    public function showView()
    {
        return view('admin.layanan-pelayanan', [
            'layananPelayanan' => LayananPelayanan::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Logic to store the service
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:Draft,Publish',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananPelayanan = new LayananPelayanan();
        $layananPelayanan->nama_layanan = $request->nama_layanan;
        $layananPelayanan->deskripsi = $request->deskripsi;
        $layananPelayanan->status = $request->status;
        $layananPelayanan->save();

        return redirect()->route('admin.layanan-pelayanan')->with('success', 'Layanan created successfully.');
    }
    public function update(Request $request, $id)
    {
        // Logic to update the service
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:Draft,Publish',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $layananPelayanan = LayananPelayanan::findOrFail($id);
        if (!$layananPelayanan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan!.');
        }
        $layananPelayanan->nama_layanan = $request->nama_layanan;
        $layananPelayanan->deskripsi = $request->deskripsi;
        $layananPelayanan->status = $request->status;
        $layananPelayanan->save();
        return redirect()->route('admin.layanan-pelayanan')->with('success', 'Layanan updated successfully.');
    }
    public function destroy($id)
    {
        // Logic to delete the service
        $layananPelayanan = LayananPelayanan::findOrFail($id);
        if (!$layananPelayanan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan!.');
        }
        $layananPelayanan->delete();
        return redirect()->route('admin.layanan-pelayanan')->with('success', 'Layanan deleted successfully.');
    }
}
