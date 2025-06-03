<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Users\ShowDataController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\Users\LayananPengaduanController;
use App\Http\Controllers\Users\KontakController;
use App\Http\Middleware\PreventBackHistory;



Route::get('/', [ShowDataController::class, 'showData'])->name('index');

// kontak
Route::post('/kontak/store', [KontakController::class, 'store'])->name('kontak.store');

// Berita
Route::get('/berita', [ShowDataController::class, 'showDataBerita'])->name('berita');

Route::get('/berita/berita-detail/{id}', [ShowDataController::class, 'detailBerita'])->name('berita-detail');

// data penduduk
Route::get('/dapen-detail', [ShowDataController::class, 'dataPendudukChart'])->name('dapen-detail');

Route::get('/profil-desa', function () {
    return view('profil-desa');
})->name('profil-desa');

// Stuktur
Route::get('/struktur/bpd', function () {
    return view('struktur.bpd');
})->name('struktur-bpd');

Route::get('/struktur/karang-taruna', function () {
    return view('struktur.karang-taruna');
})->name('struktur-karang-taruna');

Route::get('/struktur/pemdes', [ShowDataController::class, 'showDataKaryawanPemdes'])->name('struktur-pemdes');

Route::get('/struktur/pkk', function () {
    return view('struktur.pkk');
})->name('struktur-pkk');

Route::get('/struktur/posyandu', function () {
    return view('struktur.posyandu');
})->name('struktur-posyandu');

Route::get('/struktur/lpm', function () {
    return view('struktur.lpm');
})->name('struktur-lpm');

// layanan pengaduan
Route::get('/layanan/layanan-pengaduan', [LayananPengaduanController::class, 'showFormLayananPengaduan'])->name('pelayanan.layanan-pengaduan');

Route::post('/layanan/layanan-pengaduan/store', [LayananPengaduanController::class, 'store'])->name('layanan-pengaduan.store');

// layanan kesra
Route::get('/layanan/kesra', [ShowDataController::class, 'showDataKesra'])->name('layanan-kesra');

Route::get('/layanan/kesra/{id}', [ShowDataController::class, 'showDataLayananKesra']);

Route::get('/layanan/kesra/download/{filename}', [ShowDataController::class, 'downloadDokumenPelayananKesra'])->name('layanan-kesra.download');

// layanan posyandu
Route::get('/layanan/posyandu', [ShowDataController::class, 'showDataPosyandu'])->name('layanan-posyandu');

Route::get('/layanan/posyandu/{id}', [ShowDataController::class, 'showDataLayananPosyandu']);

// layanan pemerintahan
Route::get('/layanan/pemerintahan', [ShowDataController::class, 'showDataPemerintahan'])->name('layanan-pemerintahan');

Route::get('/layanan/pemerintahan/{id}', [ShowDataController::class, 'showDataLayananPemerintahan']);

// layanan pelayanan
Route::get('/layanan/pelayanan', [ShowDataController::class, 'showDataPelayanan'])->name('layanan-pelayanan');

Route::get('/layanan/pelayanan/{id}', [ShowDataController::class, 'showDataLayananPelayanan']);

// Transparansi Bumdes
Route::get('transparansi/transparansi-bumdes', [ShowDataController::class, 'dataTranparansiBumdes'])->name('transparansi-bumdes');

Route::get('/transparansi/transparansi-bumdes/{filename}', [ShowDataController::class, 'previewTransparansiBumdes']);

Route::get('/transparansi/transparansi-bumdes/download/{filename}', [ShowDataController::class, 'downloadTransparansiBumdes'])->name('transparansi-bumdes.download');

// LaporanKegiatan
Route::get('/transparansi/laporan-kegiatan', [ShowDataController::class, 'dataLaporanKegiatan'])->name('laporan-kegiatan');

Route::get('/transparansi/laporan-kegiatan/{filename}', [ShowDataController::class, 'previewLaporanKegiatan']);

Route::get('/transparansi/laporan-kegiatan/download/{filename}', [ShowDataController::class, 'downloadLaporanKegiatan'])->name('laporan-kegiatan.download');

// Transparansi Anggaran
Route::get('/transparansi/transparansi-anggaran/data', [ShowDataController::class, 'transparansiAnggaran'])->name('transparansi-anggaran.data');

Route::get('/transparansi/transparansi-anggaran/{filename}', [ShowDataController::class, 'previewTransparansiAnggaran']);

Route::get('/transparansi/transparansi-anggaran', [ShowDataController::class, 'dataTransparansiAnggaran'])->name('transparansi-anggaran');

Route::get('/transparansi/transparansi-anggaran/download/{filename}', [ShowDataController::class, 'downloadTransparansiAnggaran'])->name('transparansi-anggaran.download');

// Dokumen Publik
Route::get('/transparansi/dokumen-publik', [ShowDataController::class, 'dataDokumenPublik'])->name('dokumen-publik');

Route::get('/transparansi/dokumen-publik/{filename}', [ShowDataController::class, 'previewDokumenPublik']);

Route::get('/transparansi/dokumen-publik/download/{filename}', [ShowDataController::class, 'downloadDokumenPublik'])->name('dokumen-publik.download');

// Galeri
Route::get('/galeri', [ShowDataController::class, 'showDataGaleri'])->name('galeri');

Route::get('/galeri/galeri-detail/{id}', [ShowDataController::class, 'detailGaleri'])->name('galeri-detail');

// Lupa Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Halaman register
// Route::get('/register', [RegisterController::class, 'showLoginRegister'])->name('register');

// Proses simpan register
// Route::post('/register/store', [RegisterController::class, 'storeRegister'])->name('register.store');

// Halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Halaman logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Layanan Pengaduan
    Route::get('/user/layanan-pengaduan', [LayananPengaduanController::class, 'showView'])->name('user.layanan-pengaduan');
    Route::post('/user/layanan-pengaduan/update/{id}', [LayananPengaduanController::class, 'update'])->name('user.layanan-pengaduan.update');
});
