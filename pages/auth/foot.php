<?php
include '../../config/koneksi.php';
$query = "SELECT * FROM tb_app_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
?>

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
<?php
}
?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var y = document.getElementById("confirm_password");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}
</script>