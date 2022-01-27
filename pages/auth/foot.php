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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>


<!-- Vendor JS Files -->
<script src="<?php echo $url_assets ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?php echo $url_assets ?>vendor/aos/aos.js"></script>
<script src="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo $url_assets ?>vendor/purecounter/purecounter.js"></script>
<script src="<?php echo $url_assets ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo $url_assets ?>vendor/glightbox/js/glightbox.min.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo $url_assets ?>js/main.js"></script>
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
})
</script>