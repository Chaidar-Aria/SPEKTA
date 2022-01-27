<?php
session_start();
require_once '../../config/koneksi.php';
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../auth/login.php?pesan=belum_login");
} else if ($_SESSION['level'] != "ADMIN") {
    header("location:../auth/login.php?pesan=forbidden");
}

$idekstra = $_SESSION['ekstra'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $url_assets ?>img/Logo SS.png" rel=" icon">
    <title>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler Smansa | SMA Negeri 1 Mejayan</title>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo $url_vendors ?>fontawesome-free /css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $url_vendors ?>bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $url_vendors ?>datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $url_vendors ?>bootstrap-duallistbox-4/src/bootstrap-duallistbox.css">
    <link rel="stylesheet" href="<?php echo $url_vendors ?>bootstrap-toogle/bootstrap4-toggle.min.css">
    <link rel="stylesheet" href="<?php echo $url_css ?>ruang-admin.min.css">
    <!-- end css -->

    <!-- script -->
    <script src="<?php echo $url_vendors . 'sweetalert2/sweetalert2.all.min.js' ?>"></script>
    <script src="<?php echo $url_vendors . 'ckeditor/ckeditor.js' ?>"></script>
    <script src="<?php echo $url_vendors . 'chart.js/Chart.min.js' ?>"></script>
    <!-- end script -->
</head>

<body id="page-top" onload="startTime()">
    <?php
    require_once '../../config/koneksi.php';
    $query = "SELECT * FROM tb_auth_settings";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        if (date("Y-m-d") >= $row['date_open_reg'] && date("Y-m-d") <= $row['date_close_reg']) {
    ?>
    <marquee class="mt-2" behavior="scroll" direction="left">PENDAFTARAN ANGGOTA BARU EKSTRAKURIKULER MELALUI SPEKTA
        SMANSA TAHUN <?php echo date("Y") ?>
        DIMULAI | Halaman Verifikasi dan Validasi hanya dapat diakses selama masa pendaftaran</marquee>
    <?php } else { ?>
    <?php }
    } ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $url_admin ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo $url_assets ?>img/Logo SS.png">
                </div>
                <div class="sidebar-brand-text mx-3">SPEKTA SMANSA</div>
            </a>
            <hr class="sidebar-divider my-0">
            <div class="text-center">
                <p class="mt-2" id="tgl"></p>
                <p style="margin-top:-10px" id="clock"></p>
            </div>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $url_admin ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Menu
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                    aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Administrasi</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administrasi</h6>
                        <a class="collapse-item" href="verval">Verifikasi dan Validasi</a>
                        <a class="collapse-item" href="member">Keanggotaan</a>
                        <a class="collapse-item" href="absen">Absensi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Keuangan</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Keuangan</h6>
                        <a class="collapse-item" href="keuangan">Data Keuangan</a>
                        <a class="collapse-item" href="pemasukan">Data Pemasukan</a>
                        <a class="collapse-item" href="pengeluaran">Data Pengeluaran</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kegiatan">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Kegiatan</span></a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="<?php echo $url_assets ?>img/Logo SS.png"
                                    style=" max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    <?php // NAMA EKSTRA
                                    $sqlekstra = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                    INNER JOIN tb_admin ON tb_ekstrakurikuler.id_ekstra = tb_admin.id_ekstra
                                    WHERE tb_ekstrakurikuler.id_ekstra = '$idekstra'");
                                    while ($data = mysqli_fetch_array($sqlekstra)) {
                                        echo "ADMIN-" . $data['id_ekskul'];
                                    } ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->