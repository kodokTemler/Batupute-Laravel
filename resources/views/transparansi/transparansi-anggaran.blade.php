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
                <h1>Transparansi Anggaran</h1>
                <p class="mb-0">
                  Halaman ini menyajikan informasi lengkap mengenai transparansi anggaran yang pernah dikelolah oleh Desa Batupute.
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
              <li class="current">Transparansi Anggaran</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->

      <!-- Starter Section Section -->
      <section id="starter-section" class="starter-section section py-5">
        <div class="container section-title" data-aos="fade-up">
          <h2>Laporan Transparani Anggaran</h2>
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-start">
              <h4>1. Transparansi Anggaran</h4>
              <p>Berikut ini adalah data data mengenai transparansi anggaran yang dikelolah oleh pemerintah Desa Batupute.</p>
            </div>

            <!-- Bagian Judul Tahun -->
            <div class="col-12 col-md-4 mb-3 mt-4">
              <h3 class="pt-md-5 pt-0">
                <strong id="judulTahun">{{ date('Y') }}</strong>
              </h3>
            </div>

            <!-- Bagian Rekap -->
             <div class="col-12 col-md-6 mt-4">
              <div class="container px-0">
                <div class="d-flex flex-row justify-content-between align-items-center mb-3 gap-2 flex-wrap">
                  <h4 class="mb-0">Rekap Keuangan</h4>
                  <select id="tahunSelect" class="form-select w-auto">
                    @for($y = date('Y'); $y >= 2024; $y--)
                      <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                  </select>
                </div>

                <div class="row g-3">
                  <div class="col-sm-6">
                    <div class="card border-success h-100">
                      <div class="card-body">
                        <h5><i class="bi bi-caret-up-fill text-success"></i> Pemasukan</h5>
                        <h4 class="text-green" id="pemasukan">Rp0,00</h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="card border-danger h-100">
                      <div class="card-body">
                        <h5><i class="bi bi-caret-down-fill text-danger"></i> Pengeluaran</h5>
                        <h4 class="text-red" id="pengeluaran">Rp0,00</h4>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card mt-2">
                  <div class="card-body text-center">
                    <h5>Surplus/Defisit <span class="text-green" id="surplus">Rp0,00</span></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="row pt-md-5 pt-0">
            
          </div> --}}
          <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-10 text-start">
              <h4 class="">2. Grafik Transparansi Anggaran</h4>
              <p>Berikut ini adalah data data mengenai transparansi anggaran yang dikelolah oleh pemerintah Desa Batupute yang di tampilkan dalam bentuk grafik batang.</p>
            </div>
              <div class="col-12 col-md-10">
                  <!-- Grafik responsif -->
                  <div class="ratio ratio-16x9">
                      <canvas id="chartAnggaran"></canvas>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-start">
                <h4>3. Daftar Transparansi Anggaran</h4>
                <p>Berikut ini adalah data data mengenai transparansi anggaran yang dikelolah oleh pemerintah Desa Batupute.</p>
            </div>
            @if ($transparansiAnggaran->isEmpty())
                <div class="col-12 col-lg-10 mt-3">
                    <div class="alert alert-warning" role="alert">
                    Data belum ada.
                    </div>
                </div>
            @else
            @foreach ($transparansiAnggaran as $anggaran)
              <div class="col-12 col-lg-10 mt-3">
                <div class="card card-custom p-4 mb-3">
                  <div class="row align-items-center g-4">
                    
                    <!-- Left Content -->
                    <div class="col-12 col-md-8">
                      <h5 class="fw-bold text-start text-md-start">{{$anggaran->sumber_dana}} {{$anggaran->tahun}}</h5>
                      <div class="d-flex align-items-center text-secondary mb-1">
                        <i class="bi bi-file-earmark-text fs-5 me-2"></i>
                        <span>{{$anggaran->jenis_penggunaan}}</span>
                      </div>
                      <div class="d-flex align-items-center text-secondary">
                        <i class="bi bi-clock fs-5 me-2"></i>
                        <span>{{ $anggaran->created_at->locale('id')->translatedFormat('l, d/m/Y') }}</span>
                      </div>
                    </div>

                    <!-- Right Content (Buttons) -->
                    <div class="col-12 col-md-4">
                      <div class="d-flex flex-md-column flex-wrap justify-content-md-end justify-content-center gap-2">
                        <a href="javascript:void(0);"onclick="openModal('{{ $anggaran->file_bukti }}')" 
                          class="btn btn-outline-danger d-flex align-items-center justify-content-center w-100">
                          <i class="bi bi-filetype-pdf me-2"></i> Lihat Berkas
                        </a>
                        <a href="{{route('transparansi-anggaran.download', $anggaran->file_bukti)}}" 
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
              @if ($transparansiAnggaran->onFirstPage())
                <li class="page-item disabled">
                  <a href="#" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @else
                <li class="page-item">
                  <a href="{{ $transparansiAnggaran->previousPageUrl() }}" class="page-link"><i class="bi bi-chevron-left"></i></a>
                </li>
              @endif
      
              <!-- Page Number Links -->
              @php
                $totalPages = $transparansiAnggaran->lastPage();
                $currentPage = $transparansiAnggaran->currentPage();
                $pagesToShow = 3;
              @endphp
      
              <!-- Conditionally Display Pagination Items -->
              @if ($totalPages <= $pagesToShow)
                @foreach(range(1, $totalPages) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $transparansiAnggaran->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
              @else
                <!-- Always Show First Page -->
                <li class="page-item {{ 1 == $currentPage ? 'active' : '' }}">
                  <a href="{{ $transparansiAnggaran->url(1) }}" class="page-link">1</a>
                </li>
                
                <!-- Show Ellipsis if Current Page is Not Near the First or Last Page -->
                @if ($currentPage > 2)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Show Middle Pages (Up to 3 Pages) -->
                @foreach(range(max(2, $currentPage - 1), min($totalPages - 1, $currentPage + 1)) as $i)
                  <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ $transparansiAnggaran->url($i) }}" class="page-link">{{ $i }}</a>
                  </li>
                @endforeach
      
                <!-- Show Ellipsis if Current Page is Not Near the Last Page -->
                @if ($currentPage < $totalPages - 1)
                  <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
      
                <!-- Always Show Last Page -->
                <li class="page-item {{ $totalPages == $currentPage ? 'active' : '' }}">
                  <a href="{{ $transparansiAnggaran->url($totalPages) }}" class="page-link">{{ $totalPages }}</a>
                </li>
              @endif
      
              <!-- Next Page Link -->
              @if ($transparansiAnggaran->hasMorePages())
                <li class="page-item">
                  <a href="{{ $transparansiAnggaran->nextPageUrl() }}" class="page-link"><i class="bi bi-chevron-right"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function fetchKeuangan(tahun) {
    $.ajax({
      url: "{{ route('transparansi-anggaran.data') }}", // route yang kamu buat
      method: "GET",
      data: { tahun: tahun },
      success: function(response) {
        $('#pemasukan').text('Rp' + response.pemasukan);
        $('#pengeluaran').text('Rp' + response.pengeluaran);
        $('#surplus').text('Rp' + response.surplus);
        $('#judulTahun').text('Transparansi Anggaran Tahun ' + tahun);
      }
    });
  }

  $(document).ready(function() {
    fetchKeuangan($('#tahunSelect').val()); // load awal

    $('#tahunSelect').on('change', function() {
      let tahun = $(this).val();
      fetchKeuangan(tahun);
    });
  });

    const ctx = document.getElementById('chartAnggaran').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: {!! json_encode($pendapatan) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Pengeluaran',
                        data: {!! json_encode($pengeluaran) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
              responsive: true,
              scales: {
                  y: {
                      ticks: {
                          // Mengecek ukuran layar untuk menentukan visibilitas ticks
                          callback: function(value) {
                              if (window.innerWidth >= 768) {  // 768px untuk tablet dan ke atas
                                  return 'Rp ' + value.toLocaleString('id-ID');
                              }
                              return ''; // Tidak menampilkan ticks pada perangkat mobile
                          }
                      }
                  }
              }
          }
        });

  function openModal(filename) {
    const modal = new bootstrap.Modal(document.getElementById('fileModal'));
    document.getElementById('fileFrame').src = `/transparansi/transparansi-anggaran/${filename}`;
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
