<?php
include '../../config/koneksi.php';
$query = "SELECT * FROM tb_app_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
?>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>SPEKTA PRAMUKA</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Spekta Pramuka Versi: <?php echo $row['app_version']; ?>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
            Sistem Pencatatan Keuangan dan Keanggotaan Pramuka Ambalan
            Brawijaya-Tribhuwana Gugus Depan 11075-11076 Pangkalan SMA Negeri 1 Mejayan
        </div>
    </div>
</footer><!-- End Footer -->
<?php } ?>