<?php
session_start();
include_once 'config/koneksi.php';
include_once 'app/helper/base_url.php';
$query = "SELECT * FROM tb_auth_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $query2 = "SELECT * FROM tb_web_settings";
    $result2 = $conn->query($query2);
    while ($row2 = $result2->fetch_assoc()) {
        $query3 = "SELECT * FROM tb_app_settings";
        $result3 = $conn->query($query3);
        while ($row3 = $result3->fetch_assoc()) {
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler Smansa | SMA Negeri 1 Mejayan</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo $url_assets ?>img/Logo SS.png " rel="icon">
    <link href="<?php echo $url_assets ?>img/Logo SS.png " rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?php echo $url_vendors . 'bootstrap-icons/bootstrap-icons.css' ?>">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="<?php echo $url_vendors ?>fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $url_assets ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url_assets ?>vendor/aos/aos.css">
    <link rel="stylesheet" href="<?php echo $url_assets ?>vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo $url_assets ?>vendor/glightbox/css/glightbox.min.css">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="<?php echo $url_assets ?>css/style.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="<?php echo $actual_link ?>" class="logo d-flex align-items-center">
                <img src="<?php echo $url_assets ?>img/logo_spekta_baru.png" alt="Logo Spekta">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#information">Informasi</a></li>
                    <li><a class="nav-link scrollto" href="#timeline">Alur</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $url_page ?>files/">Berkas</a>
                    </li>
                    <li><a class="nav-link scrollto" href="<?php echo $url_page ?>announcement/">Pengumuman</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Layanan Informasi</a></li>
                    <?php
                                if (!$_SESSION) {
                                ?>
                    <li><a class="getstarted scrollto" href="<?php echo $url_login ?>">Login</a></li>
                    <?php } else { ?>
                    <li><a class="getstarted scrollto" href="<?php echo $url_login ?>">Dashboard</a></li>
                    <?php } ?>
                </ul>
                <i class="fas fa-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Selamat Datang di SPEKTA SMANSA</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Sistem Pencatatan Keuangan dan Keanggotaaan
                        Ekstrakurikuler SMA Negeri 1 Mejayan
                    </h2>
                    <div class="row">
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <h2 data-aos="fade-up" data-aos-delay="400">Daftarkan diri kamu..!!</h2>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="text-center text-lg-start">
                                <a href="<?php echo $url_regis ?>"
                                    class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Buat Akun</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <h5 data-aos="fade-up" data-aos-delay="400">Informasi Pendaftaran</h5>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="text-center text-lg-start">
                                <a href="#information"
                                    class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Cek Disini</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-6 hero-img mt-5" data-aos="zoom-out" data-aos-delay="200">
                    <img src="<?php echo $url_assets ?>img/spekta_all.png" class="img-fluid" alt="logo all">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content" style="text-align: justify;">
                            <h3>Tentang Kami</h3>
                            <h2>Sistem Pencatatan Keuangan dan Keanggotaan Ekstrakurikuler SMA Negeri 1 Mejayan</h2>
                            <p>
                                <?php
                                            $isi_data = $row2['about_spekta'];
                                            $pecah = explode("\r\n\r\n", $isi_data);

                                            $text = "";

                                            // untuk setiap substring hasil pecahan, sisipkan <p> di awal dan </p> di akhir
                                            // lalu menggabungnya menjadi satu string utuh $text
                                            for ($i = 0; $i <= count($pecah) - 1; $i++) {
                                                $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
                                                $text .= $part;
                                            }

                                            // menampilkan outputnya
                                            echo $text;
                                            ?>
                            </p>
                        </div>
                    </div>
                    <div class=" col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="<?php echo $url_assets ?>img/about.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->


        <!-- ======= Features Section ======= -->
        <section id="information" class="features">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <p>Informasi</p>
                </header>
                <!-- Feature Tabs -->
                <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-12">
                        <h3>Semua informasi berada disini</h3>
                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">
                                <div class="d-flex align-items-center mb-2" style="text-align: justify;">
                                    <h4>
                                        <?php
                                                    $isi =  $row3['about_app'];
                                                    $pecah = explode("\r\n\r\n", $isi);

                                                    $text = "";

                                                    // untuk setiap substring hasil pecahan, sisipkan <p> di awal dan </p> di akhir
                                                    // lalu menggabungnya menjadi satu string utuh $text
                                                    for ($i = 0; $i <= count($pecah) - 1; $i++) {
                                                        $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
                                                        $text .= $part;
                                                    }

                                                    // menampilkan outputnya
                                                    echo $text;
                                                    ?>
                                    </h4>
                                </div>
                            </div><!-- End Tab 1 Content -->
                        </div>
                    </div>

                </div><!-- End Feature Tabs -->
            </div>
        </section><!-- End Features Section -->

        <!-- ======= Timeline Section ======= -->
        <?php
                    if (date("Y-m-d") >= $row['date_open_reg'] && date("Y-m-d") <= $row['date_close_reg']) {
                    ?>
        <section id="timeline" class="services">
            <div class="container">

                <div class="section-title" data-aos="zoom-out">

                    <header class="section-header">
                        <p>Alur Pendaftaran</p>
                    </header>
                </div>
                <div class="row content">
                    <div class="col-md-5" data-aos="fade-right">
                        <img src="<?php echo $url_assets ?>img/timeline/1.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 pt-4" data-aos="fade-left">
                        <h3>1. Pengumuman Pendaftaran Anggota Baru</h3>
                        <p class="">
                            Pengumuman tentang pendaftaran anggota baru Ekstrakurikuler di lingkungan SMA Negeri 1
                            Mejayan akan diumumkan sesuai dengan jadwal pada SE Sekolah
                        </p>
                    </div>
                    <div class="row content">
                        <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                            <img src="<?php echo $url_assets ?>img/timeline/2.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
                            <h3>2. Pendaftaran</h3>
                            <p>
                                Proses pendaftaran anggota baru anggota baru Ekstrakurikuler di lingkungan SMA Negeri 1
                                Mejayan
                            </p>
                            <p class="fst-italic">
                                *Pastikan mengecek kembali data sebelum melakukan finalisasi. Kesalahan dan kekeliruan
                                setelah tahap
                                finalisasi tidak dapat diubah kembali*
                            </p>
                        </div>
                    </div>
                    <div class="row content">
                        <div class="col-md-5" data-aos="fade-right">
                            <img src="<?php echo $url_assets ?>img/timeline/3.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-7 pt-5" data-aos="fade-left">
                            <h3>3. Seleksi Administrasi</h3>
                            <p>
                                Proses seleksi administrasi dan pengumuman hasil seleksi administrasi dilaksanakan mulai
                                tanggal
                                seperti yang tertera pada SE Sekolah
                            </p>
                        </div>
                    </div>
                    <div class="row content">
                        <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                            <img src="<?php echo $url_assets ?>img/timeline/4.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
                            <h3>4. Seleksi oleh Ekstrakurikuler</h3>
                            <p> Pelaksanaan Seleksi akan dilaksanakan oleh masing-masing ekstrakurikuler sesuai dengan
                                jadwal yang tertera pada SE Sekolah
                            </p>
                        </div>
                    </div>
                    <div class="row content">
                        <div class="col-md-5" data-aos="fade-right">
                            <img src="<?php echo $url_assets ?>img/timeline/5.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-7 pt-5" data-aos="fade-left">
                            <h3>5. Pengumuman Seleksi </h3>
                            <p>Pengumuman penerimaan anggota baru Ekstrakurikuler di lingkungan SMA Negeri 1
                                Mejayan akan diumumkan sesuai dengan SE Sekolah</p>
                        </div>
                    </div>

                </div>

        </section><!-- End Timeline Section -->
        <?php } else { ?>
        <!-- ======= Timeline Section ======= -->
        <section id="timeline" class="services">
            <div class="container">

                <div class="section-title" data-aos="zoom-out">

                    <header class="section-header">
                        <p>PENDAFTARAN DITUTUP</p>
                    </header>
                </div>
                <div class="text-center" data-aos="zoom-out" data-aos-delay="400">
                    <h2>TERIMA KASIH</h2>
                </div>

        </section><!-- End Timeline Section -->
        <?php }
                    ?>

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Layanan Informasi</h2>
                    <p>hubungi Kami</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-12 text-center">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Jl.P.Sudirman, No.82,<br>Mejayan, Kab.Madiun 63153</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="fas fa-phone"></i>
                                    <h3>Telepon</h3>
                                    <p>+62 0123 4567 890</p>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="fas fa-envelope"></i>
                                    <h3>Email</h3>
                                    <p>info@example.com<br>contact@example.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="fas fa-clock"></i>
                                    <h3>Jam Kerja</h3>
                                    <p>Senin - Jumat<br>7:00AM - 3:00PM</p>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->



    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>SPEKTA SMANSA</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Spekta Smansa Versi:
                <?php echo $row3['app_version']; ?>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
                Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan
            </div>
        </div>
    </footer><!-- End Footer -->
    <?php
        }
    }
}

    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="fas fa-sm fa-arrow-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo $url_assets ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo $url_assets ?>vendor/aos/aos.js"></script>
    <script src="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/purecounter/purecounter.js"></script>
    <script src="<?php echo $url_assets ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo $url_assets ?>js/main.js"></script>

</body>

</html>