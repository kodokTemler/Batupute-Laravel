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
    .card-custom {
      border: 1px solid #dee2e6;
      background-color: #f8f9fa;
    }
    .icon-text {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
    }
    .btn-outline-custom {
      border-color: #dee2e6;
      background-color: white;
    }
    .btn-outline-custom:hover {
      background-color: #f1f1f1;
    }
    .icon-btn {
      font-size: 1.2rem;
    }
  </style>
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
                <h1>Dokumen Publik</h1>
                <p class="mb-0">
                  Halaman ini menyajikan informasi lengkap mengenai dokumen publik yang ada di Desa Batupute.
                </p>
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="/">Home</a></li>
              <li><a href="/">Transparansi</a></li>
              <li class="current">Dokumen Publik</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->

      <!-- Starter Section Section -->
      <section id="starter-section" class="starter-section section py-5">
        <div class="container section-title" data-aos="fade-up">
          <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-10">
              <h2>Dokumen Publik</h2>
              <p>
                Berikut adalah daftar dokumen publik yang dapat diakses oleh masyarakat.
              </p>
            </div>
            @if ($dokumenPublik->isEmpty())
            <div class="col-12 col-lg-10 mt-3">
                <div class="alert alert-warning" role="alert">
                  Data belum ada.
                </div>
            </div>
            @else
            @foreach ($dokumenPublik as $doPuk)
            <div class="col-12 col-lg-10 mt-3">
                <div class="card card-custom p-4 mb-3">
                  <div class="row align-items-center g-4">
                    
                    <!-- Left Content -->
                    <div class="col-12 col-md-8">
                      <h5 class="fw-bold text-start text-md-start">{{ $doPuk->nama_dokumen }} {{ $doPuk->tahun }}</h5>
                      <div class="d-flex align-items-center text-secondary mb-1">
                        <i class="bi bi-file-earmark-text fs-5 me-2"></i>
                        <span>{{ $doPuk->kategori }}</span>
                      </div>
                      <div class="d-flex align-items-center text-secondary">
                        <i class="bi bi-clock fs-5 me-2"></i>
                        <span>{{ $doPuk->created_at->locale('id')->translatedFormat('l, d/m/Y') }}</span>
                      </div>
                    </div>

                    <!-- Right Content (Buttons) -->
                    <div class="col-12 col-md-4">
                      <div class="d-flex flex-md-column flex-wrap justify-content-md-end justify-content-center gap-2">
                        <a href="javascript:void(0);" onclick="openModal('{{ $doPuk->file_dokumen }}')" 
                          class="btn btn-outline-danger d-flex align-items-center justify-content-center w-100">
                          <i class="bi bi-filetype-pdf me-2"></i> Lihat Berkas
                        </a>
                        <a href="{{ route('dokumen-publik.download', $doPuk->file_dokumen) }}" 
                          class="btn btn-outline-success d-flex align-items-center justify-content-center w-100">
                          <i class="bi bi-download me-2"></i> Download
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
              @endforeach
          
          <div class="col-12 col-lg-10 mt-4">
            <div class="container">
              <div class="d-flex justify-content-center">
                <!-- Custom Pagination Links -->
                <ul class="pagination justify-content-center">
                  <!-- Previous Page Link -->
                  @if ($dokumenPublik->onFirstPage())
                    <li class="page-item disabled">
                      <a href="#" class="page-link"><i class="bi bi-chevron-left"></i></a>
                    </li>
                  @else
                    <li class="page-item">
                      <a href="{{ $dokumenPublik->previousPageUrl() }}" class="page-link"><i class="bi bi-chevron-left"></i></a>
                    </li>
                  @endif
          
                  <!-- Page Number Links -->
                  @php
                    $totalPages = $dokumenPublik->lastPage();
                    $currentPage = $dokumenPublik->currentPage();
                    $pagesToShow = 3;
                  @endphp
          
                  <!-- Conditionally Display Pagination Items -->
                  @if ($totalPages <= $pagesToShow)
                    @foreach(range(1, $totalPages) as $i)
                      <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                        <a href="{{ $dokumenPublik->url($i) }}" class="page-link">{{ $i }}</a>
                      </li>
                    @endforeach
                  @else
                    <!-- Always Show First Page -->
                    <li class="page-item {{ 1 == $currentPage ? 'active' : '' }}">
                      <a href="{{ $dokumenPublik->url(1) }}" class="page-link">1</a>
                    </li>
                    
                    <!-- Show Ellipsis if Current Page is Not Near the First or Last Page -->
                    @if ($currentPage > 2)
                      <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
          
                    <!-- Show Middle Pages (Up to 3 Pages) -->
                    @foreach(range(max(2, $currentPage - 1), min($totalPages - 1, $currentPage + 1)) as $i)
                      <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                        <a href="{{ $dokumenPublik->url($i) }}" class="page-link">{{ $i }}</a>
                      </li>
                    @endforeach
          
                    <!-- Show Ellipsis if Current Page is Not Near the Last Page -->
                    @if ($currentPage < $totalPages - 1)
                      <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
          
                    <!-- Always Show Last Page -->
                    <li class="page-item {{ $totalPages == $currentPage ? 'active' : '' }}">
                      <a href="{{ $dokumenPublik->url($totalPages) }}" class="page-link">{{ $totalPages }}</a>
                    </li>
                  @endif
          
                  <!-- Next Page Link -->
                  @if ($dokumenPublik->hasMorePages())
                    <li class="page-item">
                      <a href="{{ $dokumenPublik->nextPageUrl() }}" class="page-link"><i class="bi bi-chevron-right"></i></a>
                    </li>
                  @else
                    <li class="page-item disabled">
                      <a href="#" class="page-link"><i class="bi bi-chevron-right"></i></a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          @endif
          </div>
        </div>
      </section>
      <!-- /Starter Section Section -->
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
              <!-- Modal -->
            <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Preview File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                  </div>
                  <div class="modal-body">
                    <iframe id="fileFrame" src="" width="100%" height="600px" frameborder="0"></iframe>
                  </div>
                </div>
              </div>
            </div>
<script>
    function openModal(filename) {
    const modal = new bootstrap.Modal(document.getElementById('fileModal'));
    document.getElementById('fileFrame').src = `/transparansi/dokumen-publik/${filename}`;
    modal.show();
  }
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
