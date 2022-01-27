<?php
session_start();
include '../../config/koneksi.php';
include '../../app/helper/base_url.php';
$query = "SELECT * FROM tb_app_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $query2 = "SELECT * FROM tb_web_settings";
    $result2 = $conn->query($query2);
    while ($row2 = $result2->fetch_assoc()) {
        $query3 = "SELECT * FROM tb_auth_settings";
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
                <img src="<?php echo $url_assets ?>img/logo_spekta_baru.png" alt="logo spekta">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="<?php echo $actual_link ?>">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $url_page ?>files/">Berkas</a></li>
                    <li><a class="nav-link scrollto" href="">Pengumuman</a></li>
                    <?php
                                if (!$_SESSION) {
                                ?>
                    <li><a class="getstarted scrollto" href="../auth/login">Login</a></li>
                    <?php } else { ?>
                    <li><a class="getstarted scrollto" href="../auth/login">Dashboard</a></li>
                    <?php } ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Pengumuman SPEKTA</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Silahkan masukkan 15 digit nomor peserta tanpa tanda (-)
                    </h2>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <div class="login-wrap p-3 p-md-5">
                        <div class="text-center img mb-3">
                            <img src="<?php echo $url_assets ?>img/logo_spekta_baru.png" style="width: 50%;"
                                alt="logo spekta">
                        </div>
                        <form action="" method="POST" class="needs-validation text-start" novalidate>
                            <div class="form-group">
                                <label for="noPreserta">Nomor Peserta</label>
                                <input type="text" class="form-control mt-2" name="noPeserta" id="noPeserta"
                                    placeholder="Nomor Peserta" data-msg="Masukkan Nomor Peserta" required
                                    autocomplete="off" />
                                <div class="invalid-feedback">
                                    Masukkan Nomor Peserta
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggalLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control mt-2" name="tanggalLahir" id="tanggalLahir"
                                    placeholder="Tanggal Lahir" data-msg="Masukkan Tanggal Lahir" required
                                    autocomplete="off" />
                                <div class="invalid-feedback">
                                    Masukkan Tanggal Lahir
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" name="searchNomor" id="btn-noPoserta"
                                    class="form-control btn btn-primary rounded submit px-3">CARI</button>
                            </div>
                        </form>
                        <!-- <a href="../../"><button type=""
                                    class="form-control btn btn-primary rounded submit">Kembali</button></a> -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- ======= Announcement Section ======= -->
    <?php
                if (isset($_POST['searchNomor'])) {
                    $nopes = $_POST['noPeserta'];
                    $ttl = $_POST['tanggalLahir'];

                    $sql = "SELECT * FROM tb_users 
                INNER JOIN tb_users_cbt ON tb_users_cbt.id_users = tb_users.id_users
                INNER JOIN tb_test ON tb_test.test_id = tb_users_cbt.test_id
                INNER JOIN tb_users_cbt_grade ON tb_users_cbt.id_users_cbt = tb_users_cbt_grade.id_users_cbt
                WHERE tb_users_cbt.username = '$nopes' AND tb_users.birth_date = '$ttl'
                ";
                    $result = mysqli_query($conn, $sql);
                    while ($d = mysqli_fetch_array($result)) {
                        if ($d['grade'] > $d['test_min_grade']) {
                ?>
    <section id="about" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="col-lg-3 d-flex align-items-center mb-3" data-aos="zoom-out" data-aos-delay="200">
                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $url_page . "announcement/show?no=" . $d['username'] ?>"
                        class="img-fluid" alt="qrcode">
                </div>
                <div class="col-lg-9 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content bg-success text-white" style="text-align: justify;">
                        <table class="table table-borderless text-white">
                            <tbody>
                                <tr>
                                    <td style="width:50%;">Nomor Peserta</td>
                                    <td>: <?php echo $d['username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?php echo $d['name'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>Selamat, anda dinyatakan lolos <?php echo $d['test_name'] ?></h5>
                        <h6>Silahkan melihat informasi selanjutnya <a href="../" style="color: blue;">Disini</a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Announcement Section -->
    <!-- ======= Announcement Section ======= -->
    <?php } else { ?>
    <section id="about" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="col-lg-12 d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="content bg-danger text-white" style="text-align: justify;">
                        <table class="table table-borderless text-white">
                            <tbody>
                                <tr>
                                    <td style="width:50%;">Nomor Peserta</td>
                                    <td>: <?php echo $d['username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?php echo $d['name'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>Mohon maaf, anda dinyatakan tidak lolos <?php echo $d['test_name'] ?>
                        </h5>
                        <h6>Anda bisa melakukan sanggahan bila terjadi kesalahan dalam proses seleksi ini <a
                                href="../../" style="color: blue;">Klik Disini</a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Announcement Section -->
    <?php }
                    }
                } ?>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>SPEKTA SMANSA</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Spekta Smansa Versi:
                <?php echo $row['app_version']; ?>
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
    <?php }
    }
} ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>


    <!-- Vendor JS Files -->
    <script src="<?php echo $url_assets ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo $url_assets ?>vendor/aos/aos.js"></script>
    <script src="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/purecounter/purecounter.js"></script>
    <script src="<?php echo $url_assets ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo $url_vendors . 'sweetalert2/sweetalert2.all.min.js' ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo $url_assets ?>js/main.js"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener(
                "submit",
                function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
    </script>
</body>

</html>