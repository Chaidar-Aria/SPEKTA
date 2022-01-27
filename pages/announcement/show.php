<?php
session_start();
include '../../config/koneksi.php';
include '../../app/helper/base_url.php';
include '../../app/helper/tgl_indo.php';
$query = "SELECT * FROM tb_app_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $query2 = "SELECT * FROM tb_web_settings";
    $result2 = $conn->query($query2);
    while ($row2 = $result2->fetch_assoc()) {
        $query3 = "SELECT * FROM tb_auth_settings";
        $result3 = $conn->query($query3);
        while ($row3 = $result3->fetch_assoc()) {
            $username = $_GET['no'];
            $sql = "SELECT * FROM tb_users_cbt 
INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
WHERE tb_users_cbt.username = '$username'";
            $result4 = $conn->query($sql);
            while ($d = mysqli_fetch_array($result4)) {
                $ekskul1 = $d['id_ekstra_1'];
                $ekskul2 = $d['id_ekstra_2'];
                $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 
                                            WHERE tb_users.id_ekstra_1= '$ekskul1'");
                while ($data1 = mysqli_fetch_array($sql)) {
                    $ekstra1 = $data1['ekstrakurikuler'];
                }
                $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2
                                            WHERE tb_users.id_ekstra_2 = '$ekskul2'");
                while ($data2 = mysqli_fetch_array($sql2)) {
                    $ekstra2 = $data2['ekstrakurikuler'];
                }
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
                    <li><a class="nav-link scrollto" href="<?php echo $url_page ?>announcement/">Pengumuman</a></li>
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
            <h3 class="text-center">SELAMAT ANDA TELAH LOLOS SELEKSI </h3>
            <table class="table table-striped text-start">
                <tbody>
                    <tr>
                        <td style="width:50%;">Nomor Peserta</td>
                        <td>: <?php echo $d['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: <?php echo $d['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>: <?php echo $d['birth_place'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?php echo tgl_indo($d['birth_date']) ?></td>
                    </tr>
                    <tr>
                        <td>Ekstrakurikuler Pertama</td>
                        <td>: <?php echo $ekstra1 ?></td>
                    </tr>
                    <tr>
                        <td>Ekstrakurikuler Kedua</td>
                        <td>: <?php echo $ekstra2 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </section>

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

    <!-- Template Main JS File -->
    <script src="<?php echo $url_assets ?>js/main.js"></script>
</body>

</html>