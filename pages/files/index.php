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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Vendor CSS Files -->
    <link href="<?php echo $url_assets ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url_assets ?>vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo $url_assets ?>vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo $url_assets ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />
    <!-- Template Main CSS File -->
    <link href="<?php echo $url_assets ?>css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="<?php echo $actual_link ?>" class="logo d-flex align-items-center">
                <img src="<?php echo $url_assets ?>img/logo_spekta_baru.png" alt="">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="<?php echo $actual_link ?>">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="">Berkas</a></li>
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

    <!-- ======= About Section ======= -->
    <section id="about" class="about">

        <div class="container mt-5" data-aos="fade-up">
            <header class="section-header">
                <p>Berkas Pengumuman</p>
            </header>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tablefiles">
                    <thead class="thead-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                    $query = mysqli_query($conn, "select * from tb_files");
                                    while ($data = mysqli_fetch_assoc($query)) {
                                    ?>
                        <tr>
                            <td><?php echo $data['no_file']; ?></td>
                            <td><?php echo $data['name_file']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($data['date_file'])); ?></td>
                            <td>
                                <a href="<?php echo $url_assets . 'file/pengumuman/' . $data['file_berkas']; ?>"
                                    download><span class="badge bg-success">Unduh</span></a>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section><!-- End About Section -->

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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo $url_assets ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo $url_assets ?>vendor/aos/aos.js"></script>
    <script src="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/purecounter/purecounter.js"></script>
    <script src="<?php echo $url_assets ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/glightbox/js/glightbox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#tablefiles').DataTable();
    });
    </script>
    <!-- Template Main JS File -->
    <script src="<?php echo $url_assets ?>js/main.js"></script>
</body>

</html>