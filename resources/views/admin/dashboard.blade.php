@extends ('admin.layouts.app')
@section('dashboard')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard,  {{ Auth::guard('admin')->user()->name }}</h1>
</div>
<div class="row">
 {{-- Admins --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Admin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['admins'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Jumlah Berita</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['berita'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Pekerjaan Penduduk --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pekerjaan Penduduk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['data_pekerjaan_penduduk'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Penduduk --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Data Penduduk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['data_penduduk'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-id-card fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dokumen Publik --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Dokumen Publik</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['dokumen_publik'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Galeri --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Galeri</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['galeri'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-image fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Inventaris --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Inventaris</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['inventaris'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Karyawan --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Karyawan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['karyawan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Laporan Kegiatan --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Laporan Kegiatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['laporan_kegiatan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Kesra --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Layanan Kesra</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['layanan_kesra'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Pelayanan --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Layanan Pelayanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['layanan_pelayanan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-concierge-bell fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Pemerintahan --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Layanan Pemerintahan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['layanan_pemerintahan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-landmark fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Pengaduan --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Layanan Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['layanan_pengaduan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transparansi Anggaran --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Transparansi Anggaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['transparansi_anggaran'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Users --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['users'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Layanan Posyandu -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Layanan Posyandu</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['layanan_posyandu'] }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transparansi BUMDes -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Transparansi BUMDes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['transparansi_bumdes'] }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Transparansi BUMDes -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Kontak</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['kontak'] }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-phone-volume fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

