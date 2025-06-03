<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\KaryawanController;
use App\Http\Controllers\Admins\InventarisController;
use App\Http\Controllers\Admins\BeritaController;
use App\Http\Controllers\Admins\GaleriController;
use App\Http\Controllers\Admins\DataPendudukController;
use App\Http\Controllers\Admins\DataPekerjaanPendudukController;
use App\Http\Controllers\Admins\TransparansiAnggaranController;
use App\Http\Controllers\Admins\LaporanKegiatanController;
use App\Http\Controllers\Admins\DokumenPublikController;
use App\Http\Controllers\Admins\LayananPemerintahanController;
use App\Http\Controllers\Admins\LayananPelayananController;
use App\Http\Controllers\Admins\LayananPosyanduController;
use App\Http\Controllers\Admins\LayananKesraController;
use App\Http\Controllers\Admins\LayananPengaduanController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\TransparansiBumdesController;
use App\Http\Controllers\Admins\KontakController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\TrackAdminLogin;

Route::middleware(['auth:admin', PreventBackHistory::class, TrackAdminLogin::class])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin
    Route::get('/admin', [AdminController::class, 'showView'])->name('admins');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('store');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('delete');

    // user
    Route::get('/user', [UserController::class, 'showView'])->name('users');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'showView'])->name('karyawan');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::post('/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.delete');

    // inventaris
    Route::get('/inventaris', [InventarisController::class, 'showView'])->name('inventaris');
    Route::post('/inventaris/store', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::post('/inventaris/update/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/inventaris/delete/{id}', [InventarisController::class, 'destroy'])->name('inventaris.delete');

    // berita
    Route::get('/berita', [BeritaController::class, 'showView'])->name('berita');
    Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::post('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/delete/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');

    // galeri
    Route::get('/galeri', [GaleriController::class, 'showView'])->name('galeri');
    Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
    Route::post('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.delete');

    // transparansi anggaran
    Route::get('/transparansi-anggaran', [TransparansiAnggaranController::class, 'showView'])->name('transparansi-anggaran');
    Route::post('/transparansi-anggaran/store', [TransparansiAnggaranController::class, 'store'])->name('transparansi-anggaran.store');
    Route::post('/transparansi-anggaran/update/{id}', [TransparansiAnggaranController::class, 'update'])->name('transparansi-anggaran.update');
    Route::delete('/transparansi-anggaran/delete/{id}', [TransparansiAnggaranController::class, 'destroy'])->name('transparansi-anggaran.delete');

    // Data Penduduk
    Route::get('/data-penduduk', [DataPendudukController::class, 'showView'])->name('data-penduduk');
    Route::post('/data-penduduk/store', [DataPendudukController::class, 'store'])->name('data-penduduk.store');
    Route::post('/data-penduduk/update/{id}', [DataPendudukController::class, 'update'])->name('data-penduduk.update');
    Route::delete('/data-penduduk/delete/{id}', [DataPendudukController::class, 'destroy'])->name('data-penduduk.delete');

    // Data Pekerjaan Penduduk
    Route::get('/data-pekerjaan-penduduk', [DataPekerjaanPendudukController::class, 'showView'])->name('data-pekerjaan-penduduk');
    Route::post('/data-pekerjaan-penduduk/store', [DataPekerjaanPendudukController::class, 'store'])->name('data-pekerjaan-penduduk.store');
    Route::post('/data-pekerjaan-penduduk/update/{id}', [DataPekerjaanPendudukController::class, 'update'])->name('data-pekerjaan-penduduk.update');
    Route::delete('/data-pekerjaan-penduduk/delete/{id}', [DataPekerjaanPendudukController::class, 'destroy'])->name('data-pekerjaan-penduduk.delete');

    // laporan kegiatan
    Route::get('/laporan-kegiatan', [LaporanKegiatanController::class, 'showView'])->name('laporan-kegiatan');
    Route::post('/laporan-kegiatan/store', [LaporanKegiatanController::class, 'store'])->name('laporan-kegiatan.store');
    Route::post('/laporan-kegiatan/update/{id}', [LaporanKegiatanController::class, 'update'])->name('laporan-kegiatan.update');
    Route::delete('/laporan-kegiatan/delete/{id}', [LaporanKegiatanController::class, 'destroy'])->name('laporan-kegiatan.delete');

    //dokumen publik
    Route::get('/dokumen-publik', [DokumenPublikController::class, 'showView'])->name('dokumen-publik');
    Route::post('/dokumen-publik/store', [DokumenPublikController::class, 'store'])->name('dokumen-publik.store');
    Route::post('/dokumen-publik/update/{id}', [DokumenPublikController::class, 'update'])->name('dokumen-publik.update');
    Route::delete('/dokumen-publik/delete/{id}', [DokumenPublikController::class, 'destroy'])->name('dokumen-publik.delete');

    // layanan pemerintahan
    Route::get('/layanan-pemerintahan', [LayananPemerintahanController::class, 'showView'])->name('layanan-pemerintahan');
    Route::post('/layanan-pemerintahan/store', [LayananPemerintahanController::class, 'store'])->name('layanan-pemerintahan.store');
    Route::post('/layanan-pemerintahan/update/{id}', [LayananPemerintahanController::class, 'update'])->name('layanan-pemerintahan.update');
    Route::delete('/layanan-pemerintahan/delete/{id}', [LayananPemerintahanController::class, 'destroy'])->name('layanan-pemerintahan.delete');

    // layanan pelayanan
    Route::get('/layanan-pelayanan', [LayananPelayananController::class, 'showView'])->name('layanan-pelayanan');
    Route::post('/layanan-pelayanan/store', [LayananPelayananController::class, 'store'])->name('layanan-pelayanan.store');
    Route::post('/layanan-pelayanan/update/{id}', [LayananPelayananController::class, 'update'])->name('layanan-pelayanan.update');
    Route::delete('/layanan-pelayanan/delete/{id}', [LayananPelayananController::class, 'destroy'])->name('layanan-pelayanan.delete');

    // layanan posyandu
    Route::get('/layanan-posyandu', [LayananPosyanduController::class, 'showView'])->name('layanan-posyandu');
    Route::post('/layanan-posyandu/store', [LayananPosyanduController::class, 'store'])->name('layanan-posyandu.store');
    Route::post('/layanan-posyandu/update/{id}', [LayananPosyanduController::class, 'update'])->name('layanan-posyandu.update');
    Route::delete('/layanan-posyandu/delete/{id}', [LayananPosyanduController::class, 'destroy'])->name('layanan-posyandu.delete');

    // layanan kesra
    Route::get('/layanan-kesra', [LayananKesraController::class, 'showView'])->name('layanan-kesra');
    Route::post('/layanan-kesra/store', [LayananKesraController::class, 'store'])->name('layanan-kesra.store');
    Route::post('/layanan-kesra/update/{id}', [LayananKesraController::class, 'update'])->name('layanan-kesra.update');
    Route::delete('/layanan-kesra/delete/{id}', [LayananKesraController::class, 'destroy'])->name('layanan-kesra.delete');

    // layanan pengaduan
    Route::get('/layanan-pengaduan', [LayananPengaduanController::class, 'showView'])->name('layanan-pengaduan');
    Route::post('/layanan-pengaduan/store', [LayananPengaduanController::class, 'store'])->name('layanan-pengaduan.store');
    Route::post('/layanan-pengaduan/update/{id}', [LayananPengaduanController::class, 'update'])->name('layanan-pengaduan.update');
    Route::delete('/layanan-pengaduan/delete/{id}', [LayananPengaduanController::class, 'destroy'])->name('layanan-pengaduan.delete');

    // transparansi bumdes
    Route::get('/transparansi-bumdes', [TransparansiBumdesController::class, 'showView'])->name('transparansi-bumdes');
    Route::post('/transparansi-bumdes/store', [TransparansiBumdesController::class, 'store'])->name('transparansi-bumdes.store');
    Route::post('/transparansi-bumdes/update/{id}', [TransparansiBumdesController::class, 'update'])->name('transparansi-bumdes.update');
    Route::delete('/transparansi-bumdes/delete/{id}', [TransparansiBumdesController::class, 'destroy'])->name('transparansi-bumdes.delete');

    // kontak
    Route::get('/kontak', [KontakController::class, 'showView'])->name('kontak');
    Route::post('/kontak/update/{id}', [KontakController::class, 'update'])->name('kontak.update');
    Route::delete('/kontak/delete/{id}', [KontakController::class, 'destroy'])->name('kontak.delete');
});
