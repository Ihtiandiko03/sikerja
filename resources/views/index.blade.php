<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Kerjasama | Institut Teknologi Sumatera</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="{{ asset('assets/img/favicon.png') }}"
    />
    <!-- Place favicon.ico in the root directory -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ======== preloader start ======== -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->

    <!-- ======== header start ======== -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/" style="color: white; font-weight: bolder;">
                  <img src="{{ asset('assets/img/logo_itera_bulet.png') }}" width="20%"> Kerjasama ITERA
                </a>
                
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div
                  class="collapse navbar-collapse sub-menu-bar"
                  id="navbarSupportedContent"
                >
                  {{-- <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#features">Alumni Beasiswa</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#about">Jenis Beasiswa</a>
                    </li>

                    <li class="nav-item">
                      <a class="page-scroll" href="#faq">FAQ</a>
                    </li>
                  </ul> --}}
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
        <div class="container">
          <div class="row align-items-center position-relative">
            <div class="col-lg-6">
              <div class="hero-content">
                <h1 class="wow fadeInUp" data-wow-delay=".4s">
                  Sistem Informasi Kerjasama ITERA
                </h1>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Sistem Kerjasama ITERA digunakan untuk mengelola kerjasama yang dilakukan oleh Institut Teknologi Sumatera. 
                    Sistem ini bertujuan untuk mempermudah pengelolaan administrasi kerjasama dengan berbagai pihak, baik itu lembaga pemerintah, perusahaan, maupun organisasi lainnya.
                </p>
                <br>
                <a
                  href="{{ url('/login') }}"
                  class="main-btn border-btn btn-hover wow fadeInUp"
                  data-wow-delay=".6s"
                  >Masuk</a
                >
                {{-- <a href="#features" class="scroll-bottom">
                  <i class="lni lni-arrow-down"></i
                ></a> --}}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                <img src="{{ asset('assets/img/animation.gif') }}" width="120%"  style="border-radius: 70px;" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ======== hero-section end ======== -->
  
      <!-- ======== feature-section start ======== -->
      <section id="features" class="feature-section pt-120">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 col-sm-10">
              <div class="single-feature">
                <div class="icon">
                  <p id="counter" style="font-size: 50px;">0</p>
                </div>
                <div class="content">
                  <h3>Memorandum of Understanding (MOU)</h3>
                  <p>
                  Memorandum of Understanding (MOU) adalah dokumen yang menjelaskan kesepakatan awal antara dua pihak sebelum perjanjian resmi dibuat.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
              <div class="single-feature">
                <div class="icon">
                  <p id="counter2" style="font-size: 50px;">0</p>
                </div>
                <div class="content">
                  <h3>Memorandum of Agreement (MOA)</h3>
                  <p>
                  Memorandum of Agreement (MOA) adalah dokumen yang menjelaskan perjanjian resmi antara dua pihak yang telah disepakati sebelumnya.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
              <div class="single-feature">
                <div class="icon">
                  <p id="counter3" style="font-size: 50px;">0</p>
                </div>
                <div class="content">
                  <h3>Implementation Arrangement (IA)</h3>
                  <p>
                  Implementation Arrangement (IA) adalah dokumen yang menjelaskan rincian pelaksanaan dari perjanjian yang telah disepakati sebelumnya.
                  </p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- ======== feature-section end ======== -->

      <!-- ======== about-section start ======== -->
        <section id="about" class="about-section pt-150">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
            <div class="section-title mb-30 text-center">
              <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Jenis Kerjasama
              </h2>
              <p class="wow fadeInUp" data-wow-delay=".4s">
                  Berikut adalah daftar jenis kerjasama yang dilakukan oleh Institut Teknologi Sumatera. Setiap kerjasama memiliki informasi terkait Mitra, Periode, dan Deskripsi yang berbeda-beda.
              </p>
            </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive wow fadeInUp" data-wow-delay=".6s">
                    <table class="table table-bordered">
                      <thead style="background-color: #5864ff; color: white; font-size: 18px; text-align: center;">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Jenis Kerjasama</th>
                          <th scope="col">Mitra</th>
                          <th scope="col">Periode</th>
                          <th scope="col">Deskripsi</th>
                        </tr>
                      </thead>
                      <tbody style="font-size: 18px;">
                        <tr>
                          <th scope="row">1</th>
                          <td>Penelitian Bersama</td>
                          <td>PT Inovasi Teknologi</td>
                          <td>2023-2025</td>
                          <td>Kerjasama dalam bidang penelitian teknologi ramah lingkungan.</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Pengabdian Masyarakat</td>
                          <td>Yayasan Peduli Desa</td>
                          <td>2023-2024</td>
                          <td>Program pengembangan desa berbasis teknologi.</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Magang Mahasiswa</td>
                          <td>PT Industri Kreatif</td>
                          <td>2023-2024</td>
                          <td>Kerjasama untuk menyediakan program magang bagi mahasiswa.</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- ======== about-section end ======== -->
    <footer class="footer">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
              <div class="footer-widget">
                <div class="logo mb-30">
                  <p style="font-size: 20pt; color: white;">Kerjasama</p>
                </div>
                <p class="desc mb-30 text-white">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  dinonumy eirmod tempor invidunt.
                </p>
                {{-- <ul class="socials">
                  <li>
                    <a href="javascript:void(0)">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                </ul> --}}
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6">
              <div class="footer-widget">
                <h3>ITERA</h3>
                <ul class="links">
                  <li><a href="http://siakad.itera.ac.id/">Siakad</a></li>
                  <li><a href="https://pmb.itera.ac.id/">PMB ITERA</a></li>
                  <li><a href="http://tik.itera.ac.id/id/">UPT TIK</a></li>
                  <li><a href="http://pusatbahasa.itera.ac.id//">UPT Bahasa</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <br><br>
                <ul class="links">
                  <li><a href="javascript:void(0)">UPT K3L</a></li>
                  <li><a href="http://perpustakaan.itera.ac.id//">UPT Perpustakaan</a></li>
                  <li><a href="https://ilab.itera.ac.id/">UPT Laboratorium</a></li>
                  <li><a href="http://iao-essecs.itera.ac.id//">UPT OAIL</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <br><br>
                <ul class="links">
                  <li><a href="http://kebunraya.itera.ac.id//">UPT Kebun Raya</a></li>
                  <li><a href="http://mkg.itera.ac.id//">UPT MKG</a></li>
                  <li><a href="https://www.itera.ac.id/humas-itera//">Humas</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ======== footer end ======== -->

    <!-- ======== scroll-top ======== -->
    {{-- <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a> --}}

    <script>
      document.addEventListener("DOMContentLoaded", function () {
      var totalMOU = @json($totalMOU);
      var totalMOA = @json($totalMOA);
      var totalIA = @json($totalIA);

      function animateValue(id, start, end, duration) {
        var obj = document.getElementById(id);
        var range = end - start;
        var minTimer = 50;
        var stepTime = Math.abs(Math.floor(duration / range));
        stepTime = Math.max(stepTime, minTimer);
        var startTime = new Date().getTime();
        var endTime = startTime + duration;
        var timer;

        function run() {
        var now = new Date().getTime();
        var remaining = Math.max((endTime - now) / duration, 0);
        var value = Math.round(end - (remaining * range));
        obj.innerHTML = value;
        if (value == end) {
          clearInterval(timer);
        }
        }

        timer = setInterval(run, stepTime);
        run();
      }

      animateValue("counter", 0, totalMOU, 3000);
      animateValue("counter2", 0, totalMOA, 3000);
      animateValue("counter3", 0, totalIA, 3000);
      });
    </script>

    <!-- ======== JS here ======== -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/mainlanding.js') }}"></script>
  </body>
</html>
