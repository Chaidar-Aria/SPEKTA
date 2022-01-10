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
                                <button type="button" class="btn btn-outline-primary"
                                    data-dismiss="modal">Cancel</button>
                                <a href="<?php echo $url_config ?>logout" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <!---Container Fluid-->
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white mt-3">
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
                <script src="<?php echo $url_vendors ?>jquery/jquery.min.js"></script>
                <script src="<?php echo $url_vendors ?>bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="<?php echo $url_vendors ?>jquery-easing/jquery.easing.min.js"></script>
                <script src="<?php echo $url_js ?>ruang-admin.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"
                    integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="<?php echo $url_js ?>demo/chart-area-demo.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js">
                </script>
                <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                    rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js">
                </script>
                <script
                    src="<?php echo $url_vendors . 'bootstrap-duallistbox-4/dist/jquery.bootstrap-duallistbox.min.js' ?>">
                </script>
                <script src="<?php echo $url_js . 'bootstrap-switch.min.js' ?>"></script>
                <script src="<?php echo $url_js ?>spekta.js"></script>
                <?php
                if (isset($_GET['mes'])) {
                    if ($_GET['mes'] == 'ujian_berlangsung') {
                ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'TERLARANG',
    text: 'Anda tidak dapat mengakses halaman ini saat ujian berlangsung',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php
                    } else if ($_GET['mes'] == 'gagal_ukuran') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'UKURAN FOTO YANG DIUNGGAH TERLALU BESAR',
    text: 'Silahkan unggah foto dengan ukuran kurang dari 2 MB',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'error') { ?>
                <script>
Swal.fire({
    icon: 'error',
    title: 'SISTEM SEDANG SIBUK',
    text: 'Silahkan ulangi dalam 5 menit',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'regis_aktif') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'HALAMAN REGISTRASI DIAKTIFKAN',
    text: 'Penerimaan Calon Anggota Ekstrakurikuler Dimulai',
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'regis_nonaktif') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'HALAMAN REGISTRASI DINONAKTIFKAN',
    text: 'Penerimaan Calon Anggota Ekstrakurikuler Ditutup',
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'berhasil_app') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data Aplikasi Berhasil Diubah',
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } ?> <?php
                            }
                                ?>

                <script>
$(document).ready(function() {
    $("#tabeltolak").DataTable();
    $("#tabelverval").DataTable();
    $("#tabelmember").DataTable();
    $("#tabelaccount").DataTable();
    $("#tabeluangmasuk").DataTable();
    $("#tabeluangkeluar").DataTable();
    $("#tabelekskul").DataTable();
    $("#tabelpembina").DataTable();
});
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