<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    @if (Auth::guard('admin')->check())
        <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('assets/img/logo/barru.png')}}" alt="" width="50px" height="auto">
        </div>
        <div class="sidebar-brand-text mx-3">Batupute</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('admin.admins') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.admins') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin</span>
        </a>
    </li>
    
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs(['admin.karyawan', 'admin.users']) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(['admin.karyawan', 'admin.users']) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="{{ request()->routeIs(['admin.karyawan', 'admin.users']) ? 'true' : 'false' }}" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage User</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ request()->routeIs(['admin.karyawan', 'admin.users']) ? 'show' : '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Option</h6>
                <a class="collapse-item {{ request()->routeIs('admin.karyawan') ? 'active' : '' }}" href="{{ route('admin.karyawan') }}">Karyawan</a>
                <a class="collapse-item {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">User</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs(['admin.transparansi-anggaran', 'admin.laporan-kegiatan', 'admin.dokumen-publik', 'admin.transparansi-bumdes']) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(['admin.transparansi-anggaran', 'admin.laporan-kegiatan', 'admin.dokumen-publik', 'admin.transparansi-bumdes']) ? '' : 'collapsed' }}" 
           href="#" 
           data-toggle="collapse" 
           data-target="#collapseUtilitiesTransparansi"
           aria-expanded="{{ request()->routeIs(['admin.transparansi-anggaran', 'admin.laporan-kegiatan', 'admin.dokumen-publik', 'admin.transparansi-bumdes']) ? 'true' : 'false' }}"
           aria-controls="collapseUtilitiesTransparansi">
           <i class="fas fa-fw fa-chart-line"></i>
           <span>Transparansi</span>
        </a>
        <div id="collapseUtilitiesTransparansi" class="collapse {{ request()->routeIs(['admin.transparansi-anggaran', 'admin.laporan-kegiatan', 'admin.dokumen-publik', 'admin.transparansi-bumdes']) ? 'show' : '' }}"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Option</h6>
                <a class="collapse-item {{ request()->routeIs('admin.transparansi-anggaran') ? 'active' : '' }}" href="{{ route('admin.transparansi-anggaran') }}">Transparansi Anggaran</a>
                <a class="collapse-item {{ request()->routeIs('admin.laporan-kegiatan') ? 'active' : '' }}" href="{{ route('admin.laporan-kegiatan') }}">Laporan Kegiatan</a>
                <a class="collapse-item {{ request()->routeIs('admin.dokumen-publik') ? 'active' : '' }}" href="{{ route('admin.dokumen-publik') }}">Dokumen Publik</a>
                <a class="collapse-item {{ request()->routeIs('admin.transparansi-bumdes') ? 'active' : '' }}" href="{{ route('admin.transparansi-bumdes') }}">Transparansi Bumdes</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.inventaris') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inventaris') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Inventaris</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.berita') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.berita') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Berita</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.galeri') }}">
            <i class="fas fa-fw fa-image"></i>
            <span>Galeri</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs(['admin.data-penduduk', 'admin.data-pekerjaan-penduduk']) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(['admin.data-penduduk', 'admin.data-pekerjaan-penduduk']) ? '' : 'collapsed' }}" 
           href="#" 
           data-toggle="collapse" 
           data-target="#collapseUtilitiesDataPenduduk"
           aria-expanded="{{ request()->routeIs(['admin.data-penduduk', 'admin.data-pekerjaan-penduduk']) ? 'true' : 'false' }}"
           aria-controls="collapseUtilitiesDataPenduduk">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Data Penduduk</span>
        </a>
        <div id="collapseUtilitiesDataPenduduk" class="collapse {{ request()->routeIs(['admin.data-penduduk', 'admin.data-pekerjaan-penduduk']) ? 'show' : '' }}"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Option</h6>
                <a class="collapse-item {{ request()->routeIs('admin.data-penduduk') ? 'active' : '' }}" href="{{ route('admin.data-penduduk') }}">Jumlah Penduduk</a>
                <a class="collapse-item {{ request()->routeIs('admin.data-pekerjaan-penduduk') ? 'active' : '' }}" href="{{ route('admin.data-pekerjaan-penduduk') }}">Data Pekerjaan</a>
            </div>
        </div>
    </li>

     <li class="nav-item {{ request()->routeIs('admin.dokumen-khusus') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dokumen-khusus') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Dokumen Khusus</span>
        </a>
    </li>
        <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Pelayanan
    </div>

    <li class="nav-item {{ request()->routeIs(['admin.layanan-pemerintahan', 'admin.layanan-pelayanan', 'admin.layanan-kesra', 'admin.layanan-posyandu']) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(['admin.layanan-pemerintahan', 'admin.layanan-pelayanan', 'admin.layanan-pelayanan', 'admin.layanan-posyandu']) ? '' : 'collapsed' }}" 
           href="#" 
           data-toggle="collapse" 
           data-target="#collapseUtilitiesLayananDesa"
           aria-expanded="{{ request()->routeIs(['admin.layanan-pemerintahan', 'admin.layanan-pelayanan', 'admin.layanan-kesra', 'admin.layanan-posyandu']) ? 'true' : 'false' }}"
           aria-controls="collapseUtilitiesLayananDesa"">
            <i class="fas fa-fw fa-laptop"></i>
            <span>Layanan Desa</span>
        </a>
        <div id="collapseUtilitiesLayananDesa" class="collapse {{ request()->routeIs(['admin.layanan-pemerintahan', 'admin.layanan-pelayanan', 'admin.layanan-kesra', 'admin.layanan-posyandu']) ? 'show' : '' }}"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Option</h6>
                <a class="collapse-item {{ request()->routeIs('admin.layanan-pemerintahan') ? 'active' : '' }}" href="{{ route('admin.layanan-pemerintahan') }}">Pemerintahan</a>
                <a class="collapse-item {{ request()->routeIs('admin.layanan-pelayanan') ? 'active' : '' }}" href="{{ route('admin.layanan-pelayanan') }}">Pelayanan</a>
                <a class="collapse-item {{ request()->routeIs('admin.layanan-kesra') ? 'active' : '' }}" href="{{ route('admin.layanan-kesra') }}">Kesra</a>
                <a class="collapse-item {{ request()->routeIs('admin.layanan-posyandu') ? 'active' : '' }}" href="{{ route('admin.layanan-posyandu') }}">Posyandu</a>
            </div>
        </div>
    </li>

     <li class="nav-item {{ request()->routeIs('admin.layanan-pengaduan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.layanan-pengaduan') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengaduan</span>
        </a>
    </li>

     <li class="nav-item {{ request()->routeIs('admin.kontak') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kontak') }}">
            <i class="fas fa-fw fa-phone-volume"></i>
            <span>Kontak</span>
        </a>
    </li>

    @elseif(Auth::guard('web')->check())
            <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user.dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('assets/img/logo/barru.png')}}" alt="" width="50px" height="auto">
        </div>
        <div class="sidebar-brand-text mx-3">Batupute</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

        <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item {{ request()->routeIs('user.layanan-pengaduan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.layanan-pengaduan') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengaduan</span>
        </a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->