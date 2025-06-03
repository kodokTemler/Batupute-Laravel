<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    //

    public function showView()
    {
        return view('admin.karyawan', ['karyawan' => Karyawan::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:karyawan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pendidikan_terakhir' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $karyawan = new Karyawan();
        $karyawan->nama = $request->input('nama');
        $karyawan->jabatan = $request->input('jabatan');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');
        $karyawan->agama = $request->input('agama');
        $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->nomor_hp = $request->input('nomor_hp');
        $karyawan->email = $request->input('email');
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/assets/image
            $file->storeAs('assets/image/karyawan', $filename, 'public');

            // Simpan nama file ke database
            $karyawan->foto = $filename;
        }
        $karyawan->pendidikan_terakhir = $request->input('pendidikan_terakhir');
        $karyawan->save();
        return redirect()->route('admin.karyawan')->with('success', 'Karyawan created successfully.');
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:karyawan,email,' . $karyawan->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pendidikan_terakhir' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $karyawan->nama = $request->input('nama');
        $karyawan->jabatan = $request->input('jabatan');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');
        $karyawan->agama = $request->input('agama');
        $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->nomor_hp = $request->input('nomor_hp');
        $karyawan->email = $request->input('email');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto && Storage::disk('public')->exists('assets/image/karyawan/' . $karyawan->foto)) {
                Storage::disk('public')->delete('assets/image/karyawan/' . $karyawan->foto);
            }

            // Upload foto baru
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('assets/image/karyawan', $filename, 'public');

            $karyawan->foto = $filename;
        }

        $karyawan->pendidikan_terakhir = $request->input('pendidikan_terakhir');
        $karyawan->save();

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan updated successfully.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        // Hapus foto jika ada
        if ($karyawan->foto && Storage::disk('public')->exists('assets/image/karyawan/' . $karyawan->foto)) {
            Storage::disk('public')->delete('assets/image/karyawan/' . $karyawan->foto);
        }
        $karyawan->delete();
        return redirect()->route('admin.karyawan')->with('success', 'Karyawan deleted successfully.');
    }
}
