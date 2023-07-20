<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Aplikasi CCC Online - Kospin Jasa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon/ayda.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/beranda.css" rel="stylesheet">

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
  <a href="./beranda"><i class="material-icons">arrow_backlos</i></a>
  <h1 class="logo me-auto"><img class="text-left" src="assets/img/logokospin.png" alt=""></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        
          
          <li class="nav-item dropdown pe-5">
          <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">
            <img src="assets/img/user.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span class="name" aria-haspopup="true" aria-expended="false"><b><?php echo $_SESSION['userId'];?><b></span>
                <div class="name" aria-haspopup="true" aria-expended="false"><b><?php echo $_SESSION['nama'];?>
              </div>  
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php" onclick="return confirm('Apakah anda yakin ingin Logout?')">
                  <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/bck1.jpeg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2><center><span>MASIH DALAM TAHAP PEMBUATAN</span></center></h2>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->
  <main id="main">
  </section><!-- End Our Clients Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container md-flex py-4">
      <div class="text-center text-md-start">
        <div class="copyright " style="text-align: center;">
         &copy; <strong><span>KOSPIN JASA</span></strong>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/beranda.js"></script>

</body>

</html>