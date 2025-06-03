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
            <h1>Layanan Kesra</h1>
            <p class="mb-0">
              Halaman ini menyajikan informasi lengkap layanan kesra yang berada di Desa Batupute.
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
          <li class="current">Layanan Kesra</li>
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
                <h2>Layanan Kesra</h2>
                <p class="text-center">Berikut adalah beberapa informasi bantuan yang ada di Desa Batupute.</p>
                <div class="form-group text-center mt-4">
                    <select id="layananKesraSelect" class="form-control w-100">
                        <option value="selected disabled" class="text-center">-- Pilih Bantuan --</option>
                        @foreach($layananKesra as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_layanan }} {{$p->tahun}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="infoKesra" style="display:none; margin-top: 1rem;" class="p-3 border rounded bg-light"></div>
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
        document.getElementById('layananKesraSelect').addEventListener('change', function () {
            const id = this.value;
            const infoDiv = document.getElementById('infoKesra');

            if (id) {
                // Tampilkan indikator loading sementara
                infoDiv.style.display = 'block';
                infoDiv.innerHTML = '<p class="text-muted">Memuat data...</p>';

                fetch(`/layanan/kesra/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Respon jaringan tidak OK');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Tampilkan deskripsi (jika ada)
                        const deskripsiHTML = data.deskripsi
                            ? `
                                <div style="max-height: 200px; overflow-y: auto; padding-right: 10px;">
                                    ${data.deskripsi.replace(/\n/g, '<br>')}
                                </div>
                              `
                            : '<p class="text-muted">Tidak ada deskripsi tersedia.</p>';

                        // Tampilkan tombol download file (jika ada)
                        const fileLinkHTML = data.file_dokumen
                            ? `<a href="/layanan/kesra/download/${data.file_dokumen}" class="btn btn-primary mt-3" download>Download Dokumen</a>`
                            : '<p class="text-muted mt-3">Tidak ada dokumen tersedia.</p>';

                        // Gabungkan ke dalam info div
                        infoDiv.innerHTML = `
                            <h5 class="text-start">Deskripsi:</h5>
                            ${deskripsiHTML}
                            ${fileLinkHTML}
                        `;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        infoDiv.innerHTML = `
                            <div class="alert alert-danger" role="alert">
                                Gagal mengambil data. Silakan coba lagi nanti.
                            </div>
                        `;
                    });
            } else {
                // Kosongkan tampilan jika tidak ada pilihan
                infoDiv.style.display = 'none';
                infoDiv.innerHTML = '';
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
