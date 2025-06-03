<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Desa Batupute</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
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

<body class="portfolio-details-page">
    <header id="header" class="header fixed-top">
      <x-navbar-profil></x-navbar-profil>
    </header>

    <main class="main">
    @if ($galeriDetail)
      <!-- Page Title -->
      <div class="page-title">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1>Galeri Detail</h1>
                <p class="mb-0">
                    Berikut ini adalah penjelasan tentang Galeri {{$galeriDetail->title}}</p>
                </p>
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="/">Home</a></li>
              <li><a href="/galeri">Galeri</a></li>
              <li class="current">Galeri Detail</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->

      <!-- Portfolio Details Section -->
      <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up">
          <div class="portfolio-details-slider swiper init-swiper">
            <div class="swiper-wrapper align-items-center">
              <div class="swiper-slide">
                <img src="{{asset('storage/assets/image/galeri/'.$galeriDetail->gambar)}}" alt="" />
              </div>
            </div>
          </div>

          <div class="row justify-content-between gy-4 mt-4">
            <div class="col-lg-8" data-aos="fade-up">
              <div class="portfolio-description">
                <h2>{{$galeriDetail->title}}</h2>
                {!! nl2br(e($galeriDetail->deskripsi)) !!}
              </div>
            </div>

            <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <div class="portfolio-info">
                <h3>Informasi Gambar</h3>
                <ul>
                  <li><strong>Lokasi</strong> Batupute</li>
                  <li><strong>Kategori</strong>{{$galeriDetail->kategori}}</li>
                  <li><strong>Tanggal</strong>{{$galeriDetail->created_at}}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Portfolio Details Section -->
      @endif
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