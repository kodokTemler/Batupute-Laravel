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
                <h1>Data Penduduk</h1>
                <p class="mb-0">
                  Halaman ini menyajikan informasi lengkap mengenai data penduduk yang telah dikelompokkan berdasarkan rentang usia serta jenis pekerjaan, guna memudahkan analisis demografis dan perencanaan kebijakan yang lebih tepat sasaran.
                </p>
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="/">Home</a></li>
              <li><a href="/#stats">Administrasi</a></li>
              <li class="current">Data Penduduk</li>
            </ol>
          </div>
        </nav>
      </div>
      <!-- End Page Title -->

      <!-- Starter Section Section -->
      <section id="starter-section" class="starter-section section py-5">
        <div class="container" data-aos="fade-up">
            <h4 class="mb-3 text-center">1. Grafik Umur Penduduk</h4>
    
            <!-- Bar Chart -->
            <div class="row mb-5">
                <div class="col-12">
                    <canvas id="umurChart" class="w-100" style="max-height: 400px;"></canvas>
                </div>
            </div>
    
            <!-- Pie Chart dan Tabel -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h5 class="text-center mb-3">2. Distribusi Usia (Pie Chart)</h5>
                    <canvas id="umurPieChart" class="w-100" style="max-height: 400px;"></canvas>
                </div>
    
                <div class="col-md-6">
                    <h5 class="text-center mb-3">3. Tabel Jumlah Penduduk</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th style="background-color: #008374; color: white;">Kategori Usia</th>
                                    <th style="background-color: #008374; color: white;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($labels as $index => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>{{ $values[$index] ?? 0 }} Jiwa</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Data belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-4">
                    <h5 class="text-center mb-3">4. Tabel Jumlah Pekerjaan</h5>
                    <div class="table-responsive" style=" max-height: 350px;overflow-y: auto;">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                  <th style="background-color: #008374; color: white;">Pekerjaan</th>
                                  <th style="background-color: #008374; color: white;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($pekerjaanLabels as $index => $pekerjaan)
                                <tr>
                                  <td>{{ $pekerjaan }}</td>
                                  <td>{{ $pekerjaanJumlah[$index] ?? 0 }} Jiwa</td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="2">Data belum tersedia</td>
                                </tr>
                              @endforelse
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-8 mb-4 mb-md-0">
                  <h5 class="text-center mb-3">5. Line Chart Pekerjaan</h5>
                  <canvas id="pekerjaanLineChart" class="w-100" style="max-height: 400px;"></canvas>
              </div>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
      const labels = @json($labels);
      const data = @json($values);
      const pekerjaanLabels = @json($pekerjaanLabels);
      const pekerjaanJumlah = @json($pekerjaanJumlah);
      const backgroundColors = @json($colors);
      const borderColors = @json($borderColors);

      // Bar Chart
      new Chart(document.getElementById('umurChart').getContext('2d'), {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Jumlah Penduduk',
                  data: data,
                  backgroundColor: backgroundColors,
                  borderColor: borderColors,
                  borderWidth: 2
              }]
          },
          options: {
              responsive: true,
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      // Pie Chart
      new Chart(document.getElementById('umurPieChart').getContext('2d'), {
          type: 'pie',
          data: {
              labels: labels,
              datasets: [{
                  data: data,
                  backgroundColor: backgroundColors,
                  borderColor: borderColors,
                  borderWidth: 2
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  datalabels: {
                      formatter: (value, context) => {
                          const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                          const percentage = ((value / total) * 100).toFixed(1) + '%';
                          return percentage;
                      },
                      color: '#fff',
                      font: {
                          weight: 'bold',
                          size: 14
                      }
                  },
                  tooltip: {
                      callbacks: {
                          label: function (context) {
                              const label = context.label || '';
                              const value = context.parsed;
                              const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                              const percentage = ((value / total) * 100).toFixed(1);
                              return `${label}: ${value} (${percentage}%)`;
                          }
                      }
                  }
              }
          },
          plugins: [ChartDataLabels]
      });

      // Polar Area Chart Pekerjaan
      new Chart(document.getElementById('pekerjaanLineChart').getContext('2d'), {
    type: 'line',  // Mengubah tipe chart menjadi line
    data: {
        labels: pekerjaanLabels,  // Menampilkan label sesuai data yang ada
        datasets: [{
            label: 'Jumlah Penduduk',
            data: pekerjaanJumlah,  // Data yang digunakan untuk grafik
            borderColor: 'rgba(255, 159, 64, 1)',  // Warna garis grafik
            backgroundColor: 'rgba(255, 159, 64, 0.2)',  // Warna latar belakang area di bawah garis
            borderWidth: 2,  // Ketebalan garis
            fill: true,  // Mengisi area di bawah garis
            tension: 0.4  // Mengatur kelengkungan garis (0 untuk garis lurus)
        }]
    },
    options: {
        responsive: true,  // Menyesuaikan ukuran grafik secara responsif
        plugins: {
            legend: {
                position: 'top'  // Posisi legenda di atas grafik
            }
        },
        scales: {
            y: {
                beginAtZero: true  // Memastikan skala Y mulai dari 0
            }
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
