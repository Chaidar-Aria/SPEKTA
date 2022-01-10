<?php
$data = mysqli_query($conn, "select * from tb_app_settings");
while ($d = mysqli_fetch_array($data)) {
?>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>SPEKTA PRAMUKA</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Spekta Pramuka Brawana Versi:
            <?php echo $d['app_version']; ?>
            <br>
            <?php
                echo 'PHP Versi: ' . phpversion();
                ?>
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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>