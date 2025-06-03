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

  <body class="index-page">
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
                <h1>Galeri</h1>
                <p class="mb-0">Berikut ini adalah beberapa foto kegiatan yang ada di Desa Batupute.</p>
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="current">Galeri</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="portfolio section">
        <div class="container">
          @if ($galeri->isEmpty())
            <div class="col-12 text-center">
              <p>Tidak ada galeri yang tersedia.</p>
            </div>
          @else
          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order" >
            <!-- End Portfolio Filters -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200" >
            @foreach ($galeri as $glri)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item" >
              <div class="portfolio-content h-100">
                <a href="{{asset('storage/assets/image/galeri/'.$glri->gambar)}}" data-gallery="portfolio-gallery-app" class="glightbox" >
                  <img src="{{asset('storage/assets/image/galeri/'.$glri->gambar)}}" class="img-fluid" alt="" />
                </a>
                <div class="portfolio-info">
                  <h4>
                    <a href="{{route('galeri-detail', $glri->id)}}" title="More Details" >{{$glri->title}}</a>
                  </h4>
                  <p>{{ \Illuminate\Support\Str::limit($glri->deskripsi, 50) }}</p>
                </div>
              </div>
            </div>
            @endforeach
            </div>
          </div>
          
        </div>
      </section>
      <section id="blog-pagination" class="blog-pagination section">
        <div class="container">
          <div class="d-flex justify-content-center">
            <!-- Custom Pagination Links -->
            <ul class="pagination justify-content-center">
              <!-- Previous Page Link -->
              @if ($galeri->onFirstPage())
                <li class="page-item disabled">
                  <a href="#" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @else
                <li class="page-item">
                  <a href="{{ $galeri->previousPageUrl() }}" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @endif
      
              <!-- Page Number Links -->
              @php
                $totalPages = $galeri->lastPage();
                $currentPage = $galeri->currentPage();
                $pagesToShow = 3;
              @endphp
      
              <!-- Conditionally Display Pagination Items -->
              @if ($totalPages <= $pagesToShow)
                @foreach(range(1, $totalPages) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $galeri->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
              @else
                <!-- Always Show First Page -->
                <li class="page-item {{ 1 == $currentPage ? 'active' : '' }}">
                  <a href="{{ $galeri->url(1) }}" class="page-link">1</a>
                </li>
                
                <!-- Show Ellipsis if Current Page is Not Near the First or Last Page -->
                @if ($currentPage > 2)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Show Middle Pages (Up to 3 Pages) -->
                @foreach(range(max(2, $currentPage - 1), min($totalPages - 1, $currentPage + 1)) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $galeri->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
      
                <!-- Show Ellipsis if Current Page is Not Near the Last Page -->
                @if ($currentPage < $totalPages - 1)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Always Show Last Page -->
                <li class="page-item {{ $totalPages == $currentPage ? 'active' : '' }}">
                  <a href="{{ $galeri->url($totalPages) }}" class="page-link">{{ $totalPages }}</a>
                </li>
              @endif
      
              <!-- Next Page Link -->
              @if ($galeri->hasMorePages())
                <li class="page-item">
                  <a href="{{ $galeri->nextPageUrl() }}" class="page-link"><i class="bi bi-chevron-right"></i></a>
                </li>
              @else
                <li class="page-item disabled">
                  <a href="#" class="page-link"><i class="bi bi-chevron-right"></i></a>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </section>
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