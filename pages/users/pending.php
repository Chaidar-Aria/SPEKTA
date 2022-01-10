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
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
    if ($r['is_active'] == '1') {
?>
<script>
window.location.href = "<?php echo $url_users ?>"
</script>
<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css"
        integrity="sha512-4wfcoXlib1Aq0mUtsLLM74SZtmB73VHTafZAvxIp/Wk9u1PpIsrfmTvK0+yKetghCL8SHlZbMyEcV8Z21v42UQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo $url_vendors ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.11.3/date-1.1.1/r-2.2.9/sc-2.0.5/sb-1.3.0/sp-1.4.0/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

    <link href="<?php echo $url_css ?>timeline.css" rel="stylesheet">
    <link href="<?php echo $url_css ?>ruang-admin.min.css" rel="stylesheet">
</head>


<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    <?php echo $r['email'] ?>
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
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column justify-content-center">
                            <h1 data-aos="fade-up">SELAMAT DATANG DI SPEKTA SMANSA</h1>
                            <h2 data-aos="fade-up" data-aos-delay="400">HALO SOMANSA
                            </h2>
                            <h3>Akun kamu belum aktif nih</h3>
                            <p data-aos="fade-up" data-aos-delay="450">Silahkan buka email anda untuk aktivasi akun
                            </p>
                            <div class="row">
                                <div class="col-lg-12 justify-content-center">
                                    <a href="https://gmail.com" class="button btn-lg btn-primary" target="_BLANK">BUKA
                                        EMAIL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Row-->
            <?php }
            ?>
            <!-- Modal Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Logout Sistem</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda ingin logout dari sistem?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            <a href="<?php echo $url_config ?>logout" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!---Container Fluid-->
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>copyright &copy; <script>
                    document.write(new Date().getFullYear());
                    </script> - SISTEM PENCATATAN KEUANGAN DAN KEANGGOTAAN EKSTRAKURIKULER
                </span>
            </div>
        </div>

        <div class="container my-auto py-2">
            <div class="copyright text-center my-auto">
                <h6>SMA NEGERI 1 MEJAYAN</h6>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.js"
        integrity="sha512-AsoAG+OFcSvtqlspW166UTUYg7F4GEu0yNhzTIRfOGysIQA8Dqk1WZwyoN4eX6mX4DaSk703Q1iM0M47rw25Kw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo $url_vendors ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $url_vendors ?>jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo $url_js ?>ruang-admin.min.js"></script>
    <script src="<?php echo $url_vendors ?>chart.<?php echo $url_js ?>Chart.min.js"></script>
    <script src="<?php echo $url_js ?>demo/chart-area-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo $url_js . 'spekta.js' ?>"></script>

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
    <!-- Page level custom scripts -->
</body>

</html>