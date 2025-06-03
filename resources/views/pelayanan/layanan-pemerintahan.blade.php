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
            <h1>Layanan Pemerintahan</h1>
            <p class="mb-0">
              Halaman ini menyajikan informasi lengkap layanan pemerintahan yang berada di Desa Batupute.
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
          <li class="current">Layanan Pemerintahan</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- Starter Section -->
  <section id="starter-section" class="starter-section section">
    <div  class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-12 col-md-6 d-none d-md-block">
                <!-- Gambar: hanya muncul di tablet ke atas -->
                <img src="{{ asset('profile/img/undraw_file-search_cbur.svg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-md-6 mx-auto px-3 px-md-4">
                <h2>Layanan Pemerintahan</h2>
                <p class="text-center">Berikut adalah beberapa layanan pemerintahan yang ada di Desa Batupute.</p>
                <div class="form-group text-center mt-4">
                    <select id="pelayananSelect" class="form-control w-100">
                        <option value="selected disabled" class="text-center">-- Pilih Layanan --</option>
                        @foreach($pemerintahans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="deskripsi-container" class="mt-3 text-center">
                    <div id="deskripsi" 
                        class="text-muted mx-auto p-3 border rounded" 
                        style="display:none; max-height: 200px; overflow-y: auto; text-align: left; width: 100%; max-width: 800px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- End Starter Section -->
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
      document.getElementById('pelayananSelect').addEventListener('change', function() {
          const id = this.value;
          const deskripsiDiv = document.getElementById('deskripsi');

          if (id) {
              // Tampilkan pesan loading
              deskripsiDiv.style.display = 'block';
              deskripsiDiv.innerHTML = '<p class="text-muted">Memuat deskripsi...</p>';

              fetch(`/layanan/pemerintahan/${id}`)
                  .then(res => {
                      if (!res.ok) {
                          throw new Error('Gagal mengambil data dari server');
                      }
                      return res.json();
                  })
                  .then(data => {
                      const escapedText = data.deskripsi
                          .replace(/&/g, "&amp;")
                          .replace(/</g, "&lt;")
                          .replace(/>/g, "&gt;")
                          .replace(/"/g, "&quot;")
                          .replace(/'/g, "&#039;")
                          .replace(/\n/g, "<br>");

                      deskripsiDiv.innerHTML = `
                      <p><strong>Syarat yang anda harus penuhi :</strong></p>
                      <p>${escapedText}</p>`;
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      deskripsiDiv.innerHTML = '<p class="text-danger">Gagal memuat deskripsi. Silakan coba lagi.</p>';
                  });
          } else {
              // Reset tampilan jika tidak ada pilihan
              deskripsiDiv.style.display = 'none';
              deskripsiDiv.innerHTML = '';
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
