<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananPemerintahan;
use Illuminate\Support\Facades\Validator;

class LayananPemerintahanController extends Controller
{
    public function showView()
    {
        return view('admin.layanan-pemerintahan', [
            'layananPemerintahan' => LayananPemerintahan::all(),
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
        $layananPemerintahan = new LayananPemerintahan();
        $layananPemerintahan->nama_layanan = $request->nama_layanan;
        $layananPemerintahan->deskripsi = $request->deskripsi;
        $layananPemerintahan->status = $request->status;
        $layananPemerintahan->save();

        return redirect()->route('admin.layanan-pemerintahan')->with('success', 'Layanan created successfully.');
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
        $layananPemerintahan = LayananPemerintahan::findOrFail($id);
        if (!$layananPemerintahan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan!.');
        }
        $layananPemerintahan->nama_layanan = $request->nama_layanan;
        $layananPemerintahan->deskripsi = $request->deskripsi;
        $layananPemerintahan->status = $request->status;
        $layananPemerintahan->save();
        return redirect()->route('admin.layanan-pemerintahan')->with('success', 'Layanan updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete the service
        $layananPemerintahan = LayananPemerintahan::findOrFail($id);
        if (!$layananPemerintahan) {
            return redirect()->back()->with('error', 'Layanan not found.');
        }
        $layananPemerintahan->delete();
        return redirect()->route('admin.layanan-pemerintahan')->with('success', 'Layanan deleted successfully.');
    }
}
