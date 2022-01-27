<?php
include_once '../../app/helper/base_url.php';
?>
<!DOCTYPE html>
<html lang="en">

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

    <script src="<?php echo $url_vendors . 'sweetalert2/sweetalert2.all.min.js' ?>"></script>

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="<?php echo $url_assets ?>css/style.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="<?php echo $actual_link ?>" class="logo d-flex align-items-center">
                <img src="<?php echo $url_assets . 'img/logo_spekta_baru.png' ?>" alt="">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="<?php echo $base_url_public ?>">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $url_page . 'files/' ?>">Berkas</a>
                    </li>
                    <li><a class="nav-link scrollto" href="<?php echo $url_page . 'announcement/' ?>">Pengumuman</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->