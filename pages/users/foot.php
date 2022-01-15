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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.js"
                    integrity="sha512-AsoAG+OFcSvtqlspW166UTUYg7F4GEu0yNhzTIRfOGysIQA8Dqk1WZwyoN4eX6mX4DaSk703Q1iM0M47rw25Kw=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="<?php echo $url_vendors ?>bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="<?php echo $url_vendors ?>jquery-easing/jquery.easing.min.js"></script>
                <script src="<?php echo $url_js ?>ruang-admin.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js">
                </script>
                <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
                <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
                <script src="<?php echo $url_js . 'spekta.js' ?>"></script>
                <?php
                if (isset($_GET['mes'])) {
                    if ($_GET['mes'] == 'gagal_ekstensi') {
                ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'EKSTENSI FOTO TIDAK DIPERBOLEHKAN',
    text: 'Silahkan unggah foto dengan ekstensi JPG atau JPEG',
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
                <?php } else if ($_GET['mes'] == 'ekstra_cbt_null') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'ANDA TIDAK DIPERBOLEHKAN MENGAKSES HALAMAN INI!',
    text: 'Silahkan memilih Ekstrakurikuler serta Jadwal CBT untuk mencetak kartu ujian',
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
                <?php } else if ($_GET['mes'] == 'berhasil_cbt') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'ANDA TELAH MEMILIH JADWAL CBT',
    text: 'Jangan lupa untuk mengikuti ujian sesuai dengan jadwal \n silahkan mencetak kartu ujian',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } ?>
                <?php
                }
                ?>
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

// FORM VERVAL
// $(document).on('click', '#addbiodata', function(e) {
//     e.preventDefault();
//     Swal.fire({
//         title: 'KONFIRMASI',
//         text: "Data yang telah tersimpan tidak dapat diubah",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Simpan',
//         cancelButtonText: 'Batalkan',
//         confirmButtonColor: 'green',
//         cancelButtonColor: 'red',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Swal.fire(
//                 'Deleted!',
//                 'Your file has been deleted.',
//                 'success'
//             ).then(function(result) {
//                 $('#formverval').submit();
//             });
//         }
//     })
// });
                </script>
                <!-- Page level custom scripts -->
                </body>

                </html>