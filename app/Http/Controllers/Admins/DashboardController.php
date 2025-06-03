<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Berita;
use App\Models\DataPekerjaanPenduduk;
use App\Models\DataPenduduk;
use App\Models\DokumenPublik;
use App\Models\Galeri;
use App\Models\Inventaris;
use App\Models\Karyawan;
use App\Models\LaporanKegiatan;
use App\Models\LayananKesra;
use App\Models\LayananPelayanan;
use App\Models\LayananPemerintahan;
use App\Models\LayananPengaduan;
use App\Models\LayananPosyandu;
use App\Models\TransparansiAnggaran;
use App\Models\TransparansiBumdes;
use App\Models\User;
use App\Models\Kontak;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'admins' => Admin::count(),
            'berita' => Berita::count(),
            'data_pekerjaan_penduduk' => DataPekerjaanPenduduk::count(),
            'data_penduduk' => DataPenduduk::count(),
            'dokumen_publik' => DokumenPublik::count(),
            'galeri' => Galeri::count(),
            'inventaris' => Inventaris::count(),
            'karyawan' => Karyawan::count(),
            'laporan_kegiatan' => LaporanKegiatan::count(),
            'layanan_kesra' => LayananKesra::count(),
            'layanan_pelayanan' => LayananPelayanan::count(),
            'layanan_pemerintahan' => LayananPemerintahan::count(),
            'layanan_pengaduan' => LayananPengaduan::count(),
            'layanan_posyandu' => LayananPosyandu::count(),
            'transparansi_anggaran' => TransparansiAnggaran::count(),
            'transparansi_bumdes' => TransparansiBumdes::count(),
            'users' => User::count(),
            'kontak' => Kontak::count(),
        ];

        return view('admin.dashboard', compact('counts'));
    }
}
