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
  .accent {
    color: #2a9d8f;
    font-weight: bold;
  }

  .besar {
    font-size: 2rem; /* atau pakai 150% jika ingin proporsional */
  }

  @media (min-width: 768px) {
    .besar {
      font-size: 2.5rem;
    }
  }
</style>
  </head>

  <body class="index-page">
    <header id="header" class="header fixed-top">
      <x-navbar-profil></x-navbar-profil>
    </header>


    <main class="main">
              <!-- Hero Section -->
      <section id="hero" class="hero section accent-background">
        <div
          class="container position-relative"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="row gy-5 justify-content-between">
            <div
              class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
            >
              <h2>
                <span id="typed-text" class="h3 fw-bold accent"></span>
              </h2>
              <p>
                Media informasi dan komunikasi warga Desa Batupute, Kecamatan
                Soppeng Riaja, Kabupaten Barru. Bersama kita bangun desa yang
                maju, mandiri, dan sejahtera.
              </p>
              <div class="d-flex">
                <h6>Motto : "Utamakan Sholat Dan Pelayanan Prima".</h6>
              </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
              <div class="portfolio-details-slider swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "navigation": {
                  "nextEl": ".swiper-button-next",
                  "prevEl": ".swiper-button-prev"
                },
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                }
              }
            </script>
            <div class="swiper-wrapper align-items-center">
              <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa1.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa1.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
              <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa2.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa2.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
              <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa3.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa3.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
              
            </div>
            
          </div>
             {{-- <div class="swiper-slide">
               <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa1.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa1.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
              <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa2.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa2.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
              <div class="swiper-slide">
                <a href="{{asset('profile/img/kantordesa3.jpg')}}" class="glightbox" >
                    <img src="{{asset('profile/img/kantordesa3.jpg')}}" class="img-fluid" alt="" />
                </a>
              </div>
             </div> --}}
              
            </div>
          </div>
        </div>

        <div
          class="icon-boxes position-relative"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <div class="container position-relative">
            <div class="row gy-4 mt-5">
              <div class="col-xl-3 col-md-6">
                <div class="icon-box">
                  <div class="icon"><i class="bi bi-images"></i></div>
                  <h4 class="title">
                    <a href="{{route('galeri')}}" class="stretched-link">Galeri</a>
                  </h4>
                </div>
              </div>
              <!--End Icon Box -->

              <div class="col-xl-3 col-md-6">
                <div class="icon-box">
                  <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                  <h4 class="title">
                    <a href="{{route('transparansi-anggaran')}}" class="stretched-link">Transparansi</a>
                  </h4>
                </div>
              </div>
              <!--End Icon Box -->

              <div class="col-xl-3 col-md-6">
                <div class="icon-box">
                  <div class="icon"><i class="bi bi-newspaper"></i></div>
                  <h4 class="title">
                    <a href="{{route('berita')}}" class="stretched-link">Berita</a>
                  </h4>
                </div>
              </div>
              <!--End Icon Box -->

              <div class="col-xl-3 col-md-6">
                <div class="icon-box">
                  <div class="icon"><i class="bi bi-people"></i></div>
                  <h4 class="title">
                    <a href="{{route('struktur-pemdes')}}" class="stretched-link">Struktur Organisasi</a>
                  </h4>
                </div>
              </div>
              <!--End Icon Box -->
            </div>
          </div>
        </div>
      </section>
      <!-- /Hero Section -->

      <!-- About Section -->
      <section id="about" class="about section py-5">
        <div class="container">
          <div class="row gy-4 align-items-center">
            <!-- Gambar Kepala Desa -->
            <div class="col-lg-5 text-center text-lg-start" data-aos="fade-up" data-aos-delay="100">
              <img
                src="{{asset('profile/img/kadesputih.png')}}"
                class="img-fluid rounded-circle rounded-4 w-lg-100 w-75 w-md-50 mx-auto mx-lg-0 "
                alt="Foto Kepala Desa"
              />
            </div>

            <!-- Sambutan Konten -->
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="250">
              <div class="content ps-0 ps-lg-4">
                <!-- Judul Section -->
                <div class="section-title">
                  <h2 class="mb-2">Sambutan Kepala Desa</h2>
                  <p class="text-muted">
                    Berikut ini adalah sambutan dari Kepala Desa Batupute, dan
                    beberapa fitur yang ada di website ini.
                  </p>
                </div>

                <!-- Kontainer Scrollable -->
                <div
                  style="
                    max-height: 200px;
                    overflow-y: auto;
                    padding-right: 10px;
                  "
                >
                  <p>
                    <strong>
                      Assalamu'alaikum Warahmatullahi Wabarakatuh
                    </strong>
                    <br />
                    Selamat datang di Website Resmi Desa Batupute. Website ini
                    kami hadirkan sebagai sarana informasi dan komunikasi antara
                    pemerintah desa dan masyarakat. Harapan kami, website ini
                    dapat menjadi media transparansi, pelayanan publik, dan
                    promosi potensi desa. Kami mengajak seluruh warga untuk
                    bersama-sama membangun Desa Batupute agar semakin maju,
                    mandiri, dan sejahtera.
                  </p>
                  <p>
                    Berikut ini adalah beberapa fitur yang ada di website kami.
                  </p>
                  <!-- List Point -->
                  <ul class="list-unstyled mb-4">
                    <li class="mb-2">
                      <i class="bi bi-check-circle-fill text-success me-2"></i>
                      <strong>Galeri</strong> - Menampilkan foto-foto kegiatan
                    </li>
                    <li class="mb-2">
                      <i class="bi bi-check-circle-fill text-success me-2"></i>
                      <strong>Transparansi</strong> - Menampilkan laporan
                    </li>
                    <li class="mb-2">
                      <i class="bi bi-check-circle-fill text-success me-2"></i>
                      <strong>Berita</strong> - Menampilkan berita terbaru
                    </li>
                    <li class="mb-2">
                      <i class="bi bi-check-circle-fill text-success me-2"></i>
                      <strong>Pengaduan</strong> - Fitur untuk mengajukan
                      pengaduan
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /About Section -->

      <section id="faq" class="faq section">
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
              <div class="faq-container">
                <!-- Judul Section -->
                <div class="section-title">
                  <h2 class="mb-2">Visi Misi</h2>
                  <p class="text-muted">
                    Berikut ini adalah Visi Misi dari Kepala Desa Batupute yang
                    ingin di capai oleh.
                  </p>
                </div>
                <div class="faq-item">
                  <h3>
                    <span>Visi</span>
                  </h3>
                  <div class="faq-content">
                    <p>
                      “TERWUJUDNYA DESA BATUPUTE SEBAGAI DESA MANDIRI YANG ISTIQAMAH MENJALANKAN AMAR MA’RUF NAHI MUNKAR MENUJU KERIDHAAN ALLAH SUBHANAHU WATA’ALA”.
                    </p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>
                <!-- End Faq item-->

                <div class="faq-item">
                  <h3>
                    <span>Misi</span>
                  </h3>
                  <div class="faq-content">
                    <ol type="1">
                      <li>Mewujudkan penduduk Desa Batupute menjadi insan yang bertaqwa kepada Allah Subhanahu Wa Ta'ala, patuh dan taat terhadap segala peraturan yang berlaku.</li>
                      <li>Mewujudkan SDM mandiri dan optimalisasi SDA.</li>
                      <li>Mewujudkan pelayanan prima melalui kelembagaan pemerintahan yang bersih, transparan, akuntable, dan profesional.</li>
                      <li>Mewujudkan perekonomian desa yang mandiri dan pemberdayaan masyarakat dalam mengentaskan kemiskinan.</li>
                      <li>Mewujudkan layanan kesehatan masyarakat dan lingkungan.</li>
                    </ol>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>
                
                <!-- End Faq item-->
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block" data-aos="fade-up" data-aos-delay="100">
              <div class="content px-xl-5">
                <img
                  src="{{ asset('profile/img/undraw_job-hunt_5umi.svg') }}"
                  alt=""
                  class="w-100"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

    <!-- Stats Section -->
    <section id="stats" class="stats section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Administrasi Penduduk</h2>
        <p>
          Berikut ini adalah data administrasi penduduk Desa Batupute yang terdata
        </p>
      </div>
    
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 align-items-center">
          <!-- Gambar - hanya muncul di layar besar -->
          <div class="col-lg-5 d-none d-lg-block">
            <img
              src="{{ asset('profile/img/undraw_data-trends_kv5v.svg') }}"
              alt=""
              class="img-fluid"
            />
          </div>
    
          <!-- Data Stats -->
          <div class="col-lg-7">
            <div class="row gy-4">
              {{-- tampil --}}
              @if ($dataPenduduk)
              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-people flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Jumlah Penduduk'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Jumlah Penduduk</strong></p>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-gender-male flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Laki-laki'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Laki - laki</strong></p>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-gender-female flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Perempuan'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Perempuan</strong></p>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-person-lines-fill flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Kepala Keluarga'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Kepala Keluarga</strong></p>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-person-fill-exclamation flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Penduduk Sementara'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Penduduk Sementara</strong></p>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-arrow-left-right flex-shrink-0"></i>
                  <div>
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahData['Penduduk Mutasi'] }}" data-purecounter-duration="1"></span>
                    <p><strong>Mutasi Penduduk</strong></p>
                  </div>
                </div>
              </div>
              @endif
              <div class="d-flex justify-content-end mt-4">
                <a href="/dapen-detail" class="text-decoration-none" style="color: #008374;">
                  Lihat Selengkapnya &rarr;
                </a>
              </div>
            </div>
          </div>
          <!-- End Data Stats -->
        </div>
      </div>
    </section>
    
    <!-- /Stats Section -->

    <!-- Call To Action Section -->
    <section
          id="call-to-action"
          class="call-to-action section dark-background"
        >
          <div class="container">
            <img src="{{asset('profile/img/batuputebersama.jpg')}}" alt="" />
            <div
              class="content row justify-content-center"
              data-aos="zoom-in"
              data-aos-delay="100"
            >
              <div class="col-xl-10">
                <div class="text-center">
                  <a
                    href="https://youtu.be/b8itw7A3dMI?si=1zXggXspIkyzdIsq"
                    class="glightbox play-btn"
                  ></a>
                  <h3>Menelusuri Keindahan Tersembunyi Desa Batupute</h3>
                  <p>
                    Desa Batupute menyimpan keindahan yang tak banyak orang tahu—semuanya terekam dalam video berikut.
                  </p>
                </div>
              </div>
            </div>
          </div>
    </section>
    <!-- /Call To Action Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Layanan Kami</h2>
              <p>Layanan utama yang tersedia di Desa Batupute</p>
            </div>
            <!-- End Section Title -->
    
            <div class="container">
              <div class="row gy-4">
                <div
                  class="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="bi bi-person-badge"></i>
                    </div>
                    <h3>Bagian Pemerintahan</h3>
                    <p>KTP, KK, KIA, akta kelahiran, akta kematian, surat pindah dan pertanahan.</p>
                    <a href="{{route('layanan-pemerintahan')}}" class="readmore stretched-link"
                      >Read more <i class="bi bi-arrow-right"></i
                    ></a>
                  </div>
                </div>
                <!-- End Service Item -->
    
                <div
                  class="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h3>Bagian Pelayanan</h3>
                    <p>SKTM, Pengantar Nikah, Izin Keramaian,Pengantar BBM, Sket Lain-lain.</p>
                    <a href="{{route('layanan-pelayanan')}}" class="readmore stretched-link"
                      >Read more <i class="bi bi-arrow-right"></i
                    ></a>
                  </div>
                </div>
                <!-- End Service Item -->
    
                <div
                  class="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay="300"
                >
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="bi bi-cash-coin"></i>
                    </div>
                    <h3>Bagian Kesra</h3>
                    <p>Informasi dan pengajuan bantuan seperti BLT dan PKH.</p>
                    <a href="{{route('layanan-kesra')}}" class="readmore stretched-link"
                      >Read more <i class="bi bi-arrow-right"></i
                    ></a>
                  </div>
                </div>
                <!-- End Service Item -->
    
                <div
                  class="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay="400"
                >
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>Pelayanan Kesehatan & Posyandu</h3>
                    <p>Layanan pemeriksaan gratis dan jadwal posyandu.</p>
                    <a href="{{route('layanan-posyandu')}}" class="readmore stretched-link"
                      >Read more <i class="bi bi-arrow-right"></i
                    ></a>
                  </div>
                </div>
                <!-- End Service Item -->
    
                <div
                  class="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay="500"
                >
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="bi bi-chat-left-dots"></i>
                    </div>
                    <h3>Layanan Aspirasi & Pengaduan Masyarakat</h3>
                    <p>
                      Sampaikan aspirasi, saran, atau keluhan Anda secara mudah.
                    </p>
                    <a href="{{route('pelayanan.layanan-pengaduan')}}" class="readmore stretched-link"
                      >Read more <i class="bi bi-arrow-right"></i
                    ></a>
                  </div>
                </div>
                <!-- End Service Item -->
              </div>
            </div>
    </section>
    <!-- /Services Section -->
  
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Struktur Organisasi</h2>
        <p>
          Berikut ini adalah struktur organisasi dan tata kerja Desa Batupute
        </p>
      </div>
      <!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if($karyawan->isEmpty())
          <div class="col-12 col-lg-10 mt-3 text-center mx-auto">
            <div class="alert alert-warning" role="alert">
              Data Pemerintah Desa tidak tersedia.
            </div>
          </div>
        @else
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "0": {
                  "slidesPerView": 1,
                  "spaceBetween": 20
                },
                "768": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "992": {
                  "slidesPerView": 4,
                  "spaceBetween": 20
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            @foreach ($karyawan as $krywan)
            <div class="swiper-slide">
              <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2); height: 100%;">
                <div style="width: 100%; height: 250px; overflow: hidden;">
                  @if(empty($krywan->foto))
                        @if($krywan->jenis_kelamin === 'Laki-laki')
                            <img src="{{ asset('profile/img/karyawan/lakilaki.png') }}" style="width: 100%; height: 250px; object-fit: cover;" alt="{{ $krywan->nama }}" />
                        @else
                            <img src="{{ asset('profile/img/karyawan/perempuan.png') }}" style="width: 100%; height: 250px; object-fit: cover;" alt="{{ $krywan->nama }}" />
                        @endif
                    @else
                        <img src="{{ asset('storage/assets/image/karyawan/' . $krywan->foto) }}" style="width: 100%; height: 250px; object-fit: cover;" alt="{{ $krywan->nama }}" />
                    @endif
                </div>
                <div style="background-color: #008374; padding: 1rem; text-align: center;">
                  <h5 style="margin: 0; font-weight: bold; color: white;">{{ $krywan->nama }}</h5>
                  <p style="margin: 0; color: white;">{{ $krywan->jabatan }}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
        @endif
      </div>
    </section>
    <!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Kontak</h2>
          <p>
            Hubungi kami untuk pertanyaan, saran, atau informasi lebih lanjut
            tentang Desa Batupute.
          </p>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gx-lg-0 gy-4">
            <!-- Peta -->
            <div class="col-lg-6 col-12">
              <div class="info-container d-flex flex-column align-items-center justify-content-center">
                <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30257.17762742951!2d119.60813523934414!3d-4.2151407785506265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d9590f36507084f%3A0xd9f5cb7996d2cd7c!2sBatupute%2C%20Kec.%20Soppeng%20Riaja%2C%20Kabupaten%20Barru%2C%20Sulawesi%20Selatan!5e1!3m2!1sid!2sid!4v1745518117686!5m2!1sid!2sid" 
                  class="img-fluid" 
                  style="border:0; width: 100%; height: 100%; min-height: 300px;" 
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade">
                </iframe>
              </div>
            </div>
        
            <!-- Formulir Kontak -->
            <div class="col-lg-6 col-12">
              <form 
                action="{{route('kontak.store')}}" 
                method="post" 
                class="php-email-form" 
                data-aos="fade" 
                data-aos-delay="100">
                @csrf
                <div class="row gy-4">
                  <div class="col-md-6 col-12">
                    <input 
                      type="text" 
                      name="nama" 
                      class="form-control" 
                      placeholder="Your Name" 
                      required />
                  </div>
        
                  <div class="col-md-6 col-12">
                    <input 
                      type="email" 
                      class="form-control" 
                      name="email" 
                      placeholder="Your Email" 
                      required />
                  </div>
        
                  <div class="col-md-12">
                    <input 
                      type="text" 
                      class="form-control" 
                      name="subject" 
                      placeholder="Subject" 
                      required />
                  </div>
        
                  <div class="col-md-12">
                    <textarea 
                      class="form-control" 
                      name="message" 
                      rows="8" 
                      placeholder="Message" 
                      required></textarea>
                  </div>
        
                  <div class="col-md-12 text-center">
                    <div class="my-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <button type="submit">Send Message</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- End Contact Form -->
          </div>
        </div>
        
    </section>
    <!-- /Contact Section -->
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
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      new Typed('#typed-text', {
        strings: [
          'Selamat Datang, Website Resmi<br><span class="accent besar">Desa Batupute.</span>'
        ],
        typeSpeed: 50,
        backSpeed: 25,
        smartBackspace: true,
        showCursor: true,
        cursorChar: '|',
        loop: true, // ini membuat efeknya terus berulang
        backDelay: 2000 // jeda sebelum mengetik ulang
      });
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