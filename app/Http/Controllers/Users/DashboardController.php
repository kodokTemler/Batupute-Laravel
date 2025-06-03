<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\LayananPengaduan;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $counts = [
            'layanan_pengaduan' => LayananPengaduan::count(),
            'diterima' => LayananPengaduan::where('status', 'Diterima')->count(),
            'diproses' => LayananPengaduan::where('status', 'Diproses')->count(),
            'selesai' => LayananPengaduan::where('status', 'Selesai')->count(),
        ];

        return view('user.dashboard', compact('counts'));
    }
}
