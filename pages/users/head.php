<?php
session_start();
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
require_once '../../config/koneksi.php';
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../auth/login.php?pesan=belum_login");
} else if ($_SESSION['level'] != "USER") {
    header("location:../auth/login.php?pesan=forbidden");
}
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account 
            INNER JOIN tb_users ON tb_account.id_acc = tb_users.id_acc
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            WHERE tb_account.email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($d = mysqli_fetch_array($r_email)) {
    $d_email = $d['email'];
    $foto = $d['foto_users'];
}
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
    <link rel="stylesheet" href="<?php echo $url_vendors ?>dropzone/dropzone.min.css">
    <link rel="stylesheet" href="<?php echo $url_css ?>ruang-admin.min.css">
    <!-- end css -->

    <!-- script -->
    <script src="<?php echo $url_vendors . 'sweetalert2/sweetalert2.all.min.js' ?>"></script>
    <!-- end script -->
    <style>
    .drop-zone {
        max-width: 200px;
        height: 200px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-family: "Quicksand", sans-serif;
        font-weight: 500;
        font-size: 20px;
        cursor: pointer;
        color: #cccccc;
        border: 4px dashed #009578;
        border-radius: 10px;
    }

    .drop-zone--over {
        border-style: solid;
    }

    .drop-zone__input {
        display: none;
    }

    .drop-zone__thumb {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        background-color: #cccccc;
        background-size: cover;
        position: relative;
    }

    .drop-zone__thumb::after {
        content: attr(data-label);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 0;
        color: #ffffff;
        background: rgba(0, 0, 0, 0.75);
        font-size: 14px;
        text-align: center;
    }
    </style>
</head>

<body id="page-top" onload="startTime()">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $url_users ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo $url_assets ?>img/Logo SS.png">
                </div>
                <div class="sidebar-brand-text mx-3" id="element1">SPEKTA SMANSA</div>
            </a>
            <hr class="sidebar-divider my-0">
            <div class="text-center">
                <p class="mt-2" id="tgl"></p>
                <p style="margin-top:-10px" id="clock"></p>
            </div>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $url_users ?>">
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
                        <a class="collapse-item" href="verval">Verifikasi
                            dan
                            Validasi</a>
                        <a class="collapse-item" href="upload_foto">Berkas</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fas fa-pen-alt"></i>
                    <span>Ujian</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ujian</h6>
                        <a class="collapse-item" href="exam">CBT SPEKTA</a>
                        <a class="collapse-item" href="<?php echo $url_page . "announcement/" ?>" target="_BLANK">Hasil
                            Ujian</a>
                    </div>
                </div>
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
                                <?php if (empty($foto)) { ?>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $actual_link . '/assets/img/logo SS.png' ?>"
                                    style="max-width: 60px">
                                <?php } else { ?>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $actual_link . '/assets/img/user/' . $foto; ?>"
                                    style="max-width: 60px">
                                <?php } ?>
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    <?php echo $d_email ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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