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

<body class="blog-details-page">

  <header id="header" class="header fixed-top">
    <x-navbar-profil></x-navbar-profil>
  </header>

  <main class="main">
    @if ($beritaDetail)
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Berita Detail</h1>
              <p class="mb-0">Berikut ini adalah penjelasan tentang Berita {{$beritaDetail->judul}}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/">Home</a></li>
            <li><a href="/berita">Berita</a></li>
            <li class="current">Berita Detail</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{asset('storage/assets/image/berita/'.$beritaDetail->gambar)}}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{$beritaDetail->judul}}</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="{{$beritaDetail->created_at->locale('id')->translatedFormat('l, d/m/Y')}}">{{$beritaDetail->created_at->locale('id')->translatedFormat('l, d/m/Y')}}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-geo-alt"></i> <a href="#">Desa Batupute</a></li>
                  </ul>
                </div>
                <!-- End meta top -->

                <div class="content">
                  <p>
                    {!! nl2br(e($beritaDetail->isi_berita)) !!}
                  </p>
                </div>
                <!-- End post content -->

              </article>

            </div>
          </section>
          <!-- /Blog Details Section -->
        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Berita Lainnya</h3>
                @foreach ($beritaLainnya as $berita)
                <div class="post-item">
                    <img src="{{asset('storage/assets/image/berita/'.$berita->gambar)}}" alt="" class="flex-shrink-0" style="width: 100px; height: 100px; object-fit: cover;">
                    <div>
                    <h4><a href="{{route('berita-detail', $berita->id)}}">{{$berita->judul}}</a></h4>
                    <time datetime="{{$berita->created_at}}">{{$berita->created_at}}</time>
                    </div>
                </div>
              <!-- End recent post item-->
              @endforeach
            </div>
            <!--/Recent Posts Widget -->
          </div>

        </div>

      </div>
    </div>
    @endif
  </main>

  <footer id="footer" class="footer accent-background">
    <x-footer-profil></x-footer-profil>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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