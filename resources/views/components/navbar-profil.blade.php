<div class="branding d-flex align-items-center">
    <div
      class="container position-relative d-flex align-items-center justify-content-between"
    >
      <a
        href="{{route('index')}}"
        class="d-flex align-items-center text-decoration-none"
      >
        <div class="d-flex align-items-center">
          <img
            src="{{asset('profile/img/barru.png')}}"
            alt="Logo"
            width="60"
            height="auto"
            class="me-2"
          />
          <!-- Teks sekarang tampil di semua ukuran layar -->
          <div class="text">
            <h4 class="sitename mb-0 font-weight-bold fw-bold">
              Desa Batupute
            </h4>
            <h6>Kabupaten Barru</h6>
          </div>
        </div>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('index')}}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="/profil-desa" class="{{ Request::is('profil-desa') ? 'active' : '' }}">Profile Desa</a></li>
          <li><a href="/galeri" class="{{ Request::is('galeri') ? 'active' : '' }}">Galeri</a></li>
      
          <li class="dropdown {{ Request::is('transparansi/*') ? 'active' : '' }}">
            <a href="#">
              <span>Transparansi</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li><a href="/transparansi/transparansi-anggaran" class="{{ Request::is('transparansi/transparansi-anggaran') ? 'active' : '' }}">Transparansi Anggaran</a></li>
              <li><a href="/transparansi/laporan-kegiatan" class="{{ Request::is('transparansi/laporan-kegiatan') ? 'active' : '' }}">Laporan Kegiatan</a></li>
              <li><a href="/transparansi/dokumen-publik" class="{{ Request::is('transparansi/dokumen-publik') ? 'active' : '' }}">Dokumen Publik</a></li>
              <li><a href="/transparansi/transparansi-bumdes" class="{{ Request::is('transparansi/transparansi-bumdes') ? 'active' : '' }}">Bumdes dan Kopdes MP</a></li>
            </ul>
          </li>
      
          <li><a href="/berita" class="{{ Request::is('berita') ? 'active' : '' }}">Berita</a></li>
      
          <li class="dropdown {{ Request::is('struktur/*') ? 'active' : '' }}">
            <a href="#">
              <span>Struktur</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li><a href="{{route('struktur-pemdes')}}" class="{{ Request::is('struktur/pemerintah-desa') ? 'active' : '' }}">Pemerintah Desa</a></li>
              <li><a href="{{route('struktur-bpd')}}" class="{{ Request::is('struktur/bpd') ? 'active' : '' }}">BPD</a></li>
              <li><a href="{{route('struktur-pkk')}}" class="{{ Request::is('struktur/pkk') ? 'active' : '' }}">PKK</a></li>
              <li><a href="{{route('struktur-lpm')}}" class="{{ Request::is('struktur/lpm') ? 'active' : '' }}">LPM</a></li>
              <li><a href="{{route('struktur-karang-taruna')}}" class="{{ Request::is('struktur/karang-taruna') ? 'active' : '' }}">Karang Taruna</a></li>
              <li><a href="{{route('struktur-posyandu')}}" class="{{ Request::is('struktur/posyandu') ? 'active' : '' }}">Posyandu</a></li>
            </ul>
          </li>
      
          <li><a href="{{ route('pelayanan.layanan-pengaduan') }}" class="{{ Request::is('layanan/layanan-pengaduan') ? 'active' : '' }}">Pengaduan</a></li>
          <li><a href="/#contact">Kontak</a></li>
      
          <li>
            <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">
              Log in
            </a>
          </li>
        </ul>
      
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      
    </div>
  </div>