<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Desa Batupute</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/barru.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="{{asset('profile/vendor/bootstrap/css/bootstrap.min.css')}}"
      rel="stylesheet"
    />
    <link
      href="{{asset('profile/vendor/bootstrap-icons/bootstrap-icons.css')}}"
      rel="stylesheet"
    />
    <link href="{{asset('profile/vendor/aos/aos.css')}}" rel="stylesheet" />
    <link
      href="{{asset('profile/vendor/glightbox/css/glightbox.min.css')}}"
      rel="stylesheet"
    />
    <link href="{{asset('profile/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{asset('profile/css/main.css')}}" rel="stylesheet" />

  </head>

  <body class="starter-page-page">
    <header id="header" class="header fixed-top">
        <x-navbar-profil></x-navbar-profil>
    </header>

<main class="main">
  <!-- Page Title -->
  <div class="page-title">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Layanan Pengaduan</h1>
            <p class="mb-0">
              Halaman ini berguna untuk menerima segala pengaduan warga yang berada di Desa Batupute.
            </p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="/">Home</a></li>
          <li><a href="/#services">Layanan</a></li>
          <li class="current">Layanan Pengaduan</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->
<section id="contact" class="contact section py-5">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center">
      <!-- Gambar hanya tampil di layar md ke atas -->
      <div class="col-md-6 d-none d-md-block">
        <img src="{{ asset('profile/img/undraw_collaborative-writing_ir40.svg') }}" class="img-fluid" alt="Ilustrasi" style="max-height: 450px; object-fit: contain;">
      </div>

      <!-- Formulir -->
      <div class="col-12 col-md-6 px-3">
       @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form
          action="{{ route('layanan-pengaduan.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="php-email-forme"
          data-aos="fade"
          data-aos-delay="100"
        >
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" required>
            </div>

            <div class="col-md-6">
              <label for="nomor_hp" class="form-label">Nomor HP</label>
              <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Masukkan Nomor HP Anda" required>
            </div>

            <div class="col-md-6">
                <label for="foto_bukti" class="form-label">Foto Bukti</label>
                <input type="file" class="form-control" name="foto_bukti" id="foto_bukti">
                <small id="formatError" class="text-danger d-none">Format gambar tidak sesuai! (Hanya jpeg, jpg, png, gif, heic, heif)</small>
                <small id="sizeError" class="text-danger d-none">Ukuran gambar tidak boleh melebihi 2 MB.</small>
            </div>

            <div class="col-md-6">
              <label for="kategori" class="form-label">Kategori</label>
              <select name="kategori" id="kategori" class="form-select" required>
                <option selected disabled>- Pilih Kategori -</option>
                <option value="Umum">Umum</option>
                <option value="Sosial">Sosial</option>
                <option value="Keamanan">Keamanan</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Kebersihan">Kebersihan</option>
              </select>
            </div>

            <div class="col-12">
              <label for="isi_pengaduan" class="form-label">Isi Pengaduan</label>
              <textarea class="form-control" name="isi_pengaduan" id="isi_pengaduan" rows="5" placeholder="Tulis pengaduan Anda di sini secara lengkap..." required></textarea>
            </div>

            <div class="col-12 text-center justify-content-between d-flex">
                <button type="reset" class="btn btn-warning px-4 py-2">Reset</button>
              <button type="submit" class="btn btn-primary px-4 py-2">Kirim Pengaduan</button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Form -->
    </div>
  </div>
</section>

</main>


    <footer id="footer" class="footer accent-background">
      <x-footer-profil></x-footer-profil>
    </footer>

    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>
<script>
  document.getElementById('foto_bukti').addEventListener('change', function () {
    const allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'heic', 'heif'];
    const maxSize = 2 * 1024 * 1024; // 2MB dalam byte
    const file = this.files[0];

    const formatError = document.getElementById('formatError');
    const sizeError = document.getElementById('sizeError');

    // Reset pesan error
    formatError.classList.add('d-none');
    sizeError.classList.add('d-none');

    if (file) {
      const fileExtension = file.name.split('.').pop().toLowerCase();
      const fileSize = file.size;

      let hasError = false;

      // Cek format
      if (!allowedExtensions.includes(fileExtension)) {
        formatError.classList.remove('d-none');
        hasError = true;
      }

      // Cek ukuran
      if (fileSize > maxSize) {
        sizeError.classList.remove('d-none');
        hasError = true;
      }

      // Jika ada error, kosongkan input
      if (hasError) {
        this.value = '';
      }
    }
  });
</script>

    <!-- Vendor JS Files -->
    <script src="{{asset('profile/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('profile/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('profile/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('profile/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('profile/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('profile/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('profile/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('profile/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('profile/js/main.js')}}"></script>
  </body>
</html>
