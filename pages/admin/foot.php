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
                <script src="<?php echo $url_vendors ?>chart.<?php echo $url_js ?>Chart.min.js"></script>
                <script src="<?php echo $url_vendors ?>datatables/jquery.dataTables.min.js"></script>
                <script src="<?php echo $url_vendors ?>datatables/dataTables.bootstrap4.min.js"></script>
                <script src="<?php echo $url_js ?>ruang-admin.min.js"></script>
                <!-- Page level custom scripts -->
                <?php
                if (isset($_GET['mes'])) {
                    if ($_GET['mes'] == 'berhasil') {
                ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data telah berhasil ditambahkan',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php
                    } else if ($_GET['mes'] == 'hapus') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data telah berhasil dihapus',
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
                <?php } else if ($_GET['mes'] == 'successidspekta') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'ID SPEKTA berhasil dibuat',
    timer: 5000,
}).then((result) => {
    window.location.href = "<?php echo "?id_users=" . $_GET['id_users'] ?>";
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
                <?php } else if ($_GET['mes'] == 'gagal_kegeukuran') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'UKURAN BERKAS YANG DIUNGGAH TERLALU BESAR',
    text: 'Silahkan unggah berkas dengan ukuran kurang dari 10 MB',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'gagal_kegekstensi') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'EKSTENSI BERKAS TIDAK DIPERBOLEHKAN',
    text: 'Silahkan unggah berkas dengan ekstensi PDF',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'keg_hapus') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'DATA KEGIATAN BERHASIL DIHAPUS',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'verval') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data telah terverifikasi',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'tolak') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'VERVAL DITOLAK',
    text: 'Data verval ditolak',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'keged_success') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data kegiatan sudah berhasil diubah',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'kegadd_success') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data kegiatan sudah berhasil ditambahkan',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'berhasil_edekstra') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data Ekstrakurikuler Berhasil Diubah',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'berhasil_addpembina') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data Pembina Berhasil Ditambahkan',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'prof_sukses') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data Admin berhasil diubah',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'berhasil_editpembina') { ?>
                <script>
Swal.fire({
    icon: 'success',
    title: 'BERHASIL',
    text: 'Data Pembina Berhasil Diubah',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
                </script>
                <?php } else if ($_GET['mes'] == 'dataganda') { ?>
                <script>
Swal.fire({
    icon: 'warning',
    title: 'PERINGATAN',
    text: 'Ditemukan data ganda',
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
$(document).ready(function() {
    $('#tabeltolak').DataTable();
    $('#tabelverval').DataTable();
    $('#tabelmember').DataTable();
    $('#tabelaccount').DataTable();
    $('#tabeluangmasuk').DataTable();
    $('#tabeluangkeluar').DataTable();
    $('#tabelekskul').DataTable();
    $('#tabelkegiatan').DataTable();

});
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
    'November', 'Desember'
];
var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
var date = new Date();
var day = date.getDate();
var month = date.getMonth();
var thisDay = date.getDay(),
    thisDay = myDays[thisDay];
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;

document.getElementById("tgl").innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById("clock").innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    } // add zero in front of numbers < 10
    return i;
}
                </script>
                </body>

                </html>