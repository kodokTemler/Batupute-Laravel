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
    <style>
      @media (max-width: 768px) {
        #blog-pagination .pagination {
          font-size: 12px; /* Smaller text size for mobile */
          padding: 0.5rem;
        }
    
        #blog-pagination .pagination .page-item {
          margin: 0 5px; /* Reduce space between page items */
        }
    
        #blog-pagination .pagination .page-link {
          padding: 0.5rem 0.75rem; /* Adjust padding */
        }
      }
    
      @media (max-width: 576px) {
        #blog-pagination .pagination {
          font-size: 10px; /* Further smaller font on very small screens */
          padding: 0.25rem;
        }
    
        #blog-pagination .pagination .page-item {
          margin: 0 3px; /* Even smaller space on very small screens */
        }
      }
    </style>
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
                <h1>Berita</h1>
                <p class="mb-0">Berikut ini adalah beberapa berita terbaru yang ada di Desa Batupute.</p>
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="current">Berita</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->
      <!-- Blog Posts Section -->
      <section id="blog-posts" class="blog-posts section">
        <div class="container">
          @if ($berita->isEmpty())
            <div class="col-12 text-center">
              <p>Tidak ada berita yang tersedia.</p>
            </div>
          @else
          <div class="row gy-4">
            @foreach ($berita as $brta)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <article>
                <div class="post-img">
                  <img
                    src="{{asset('storage/assets/image/berita/'.$brta->gambar)}}"
                    alt=""
                    class="img-fluid"
                  />
                </div>
                <p class="post-category">{{$brta->kategori}}</p>
                <h4 class="title">
                  <a href="{{ route('berita-detail', $brta->id) }}"
                    >{{ \Illuminate\Support\Str::limit($brta->judul, 50) }}</a
                  >
                </h4>

                <div class="d-flex align-items-center">
                  <img
                    src="{{asset('assets/img/undraw_profile.svg')}}"
                    alt=""
                    class="img-fluid post-author-img flex-shrink-0"
                  />
                  <div class="post-meta">
                    <p class="post-author">Administrator</p>
                    <p class="post-date">
                      <time datetime="{{$brta->created_at}}">{{$brta->created_at}}</time>
                    </p>
                  </div>
                </div>
              </article>
            </div>
            <!-- End post list item -->
            @endforeach
          </div>
        </div>
      </section>
      <!-- /Blog Posts Section -->

      <section id="blog-pagination" class="blog-pagination section">
        <div class="container">
          <div class="d-flex justify-content-center">
            <!-- Custom Pagination Links -->
            <ul class="pagination justify-content-center">
              <!-- Previous Page Link -->
              @if ($berita->onFirstPage())
                <li class="page-item disabled">
                  <a href="#" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @else
                <li class="page-item">
                  <a href="{{ $berita->previousPageUrl() }}" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @endif
      
              <!-- Page Number Links -->
              @php
                $totalPages = $berita->lastPage();
                $currentPage = $berita->currentPage();
                $pagesToShow = 3;
              @endphp
      
              <!-- Conditionally Display Pagination Items -->
              @if ($totalPages <= $pagesToShow)
                @foreach(range(1, $totalPages) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $berita->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
              @else
                <!-- Always Show First Page -->
                <li class="page-item {{ 1 == $currentPage ? 'active' : '' }}">
                  <a href="{{ $berita->url(1) }}" class="page-link">1</a>
                </li>
                
                <!-- Show Ellipsis if Current Page is Not Near the First or Last Page -->
                @if ($currentPage > 2)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Show Middle Pages (Up to 3 Pages) -->
                @foreach(range(max(2, $currentPage - 1), min($totalPages - 1, $currentPage + 1)) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $berita->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
      
                <!-- Show Ellipsis if Current Page is Not Near the Last Page -->
                @if ($currentPage < $totalPages - 1)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Always Show Last Page -->
                <li class="page-item {{ $totalPages == $currentPage ? 'active' : '' }}">
                  <a href="{{ $berita->url($totalPages) }}" class="page-link">{{ $totalPages }}</a>
                </li>
              @endif
      
              <!-- Next Page Link -->
              @if ($berita->hasMorePages())
                <li class="page-item">
                  <a href="{{ $berita->nextPageUrl() }}" class="page-link"><i class="bi bi-chevron-right"></i></a>
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

