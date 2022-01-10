    <?php
    include '../../app/helper/base_url.php';
    ?>
    <!-- Vendor JS Files -->
    <script src="<?php echo $url_assets ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo $url_assets ?>vendor/aos/aos.js"></script>
    <script src="<?php echo $url_assets ?>vendor/php-email-form/validate.js"></script>
    <script src="<?php echo $url_assets ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/purecounter/purecounter.js"></script>
    <script src="<?php echo $url_assets ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo $url_assets ?>vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo $url_assets ?>js/main.js"></script>
    <!-- Select2 -->
    <script src="<?php echo $url_assets ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- jQuery -->
    <script src="<?php echo $url_assets ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $url_assets ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
$.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo $url_assets ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo $url_assets ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $url_assets ?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo $url_assets ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo $url_assets ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $url_assets ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo $url_assets ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo $url_assets ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo $url_assets ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="<?php echo $url_assets ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo $url_assets ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $url_assets ?>js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $url_assets ?>js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $url_assets ?>js/pages/dashboard.js"></script>
    <!-- DROPZONE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- IDLE JS -->
    <script src="<?php echo $url_assets ?>js/jquery.idle.js"></script>

    <!-- SWEETALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?php echo $url_js ?>app.js"></script>
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
// The Calender
$("#calendar").datetimepicker({
    format: "L",
    inline: true,
});
// // logout sesi
// $(document).idle({
// onIdle: function() {
// let timerInterval
// Swal.fire({
// icon: 'warning',
// title: 'SESI LOGIN HABIS',
// text: 'Mengarahkan ke halaman login',
// showConfirmButton: false,
// timerProgressBar: true,
// timer: 5000,
// didOpen: () => {
// Swal.showLoading()
// const b = Swal.getHtmlContainer().querySelector('b')
// timerInterval = setInterval(() => {
// b.textContent = Swal.getTimerLeft()
// }, 100)
// },
// willClose: () => {
// clearInterval(timerInterval)
// }
// }).then(function() {
// window.location = "../../../app/config/logout_sesi.php";
// })
// },
// idle: 600000,
// keepTracking: true
// });
// alert logout

//
// <!--Page specific script-- >
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {
        placeholder: "dd/mm/yyyy",
    });
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {
        placeholder: "mm/dd/yyyy",
    });
    //Money Euro
    $("[data-mask]").inputmask();

    //Date picker
    $("#reservationdate").datetimepicker({
        format: "L",
    });

    //Date and time picker
    $("#reservationdatetime").datetimepicker({
        icons: {
            time: "far fa-clock",
        },
    });

    //Date range picker
    $("#reservation").daterangepicker();
    //Date range picker with time picker
    $("#reservationtime").daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: "MM/DD/YYYY hh:mm A",
        },
    });
    //Date range as a button
    $("#daterange-btn").daterangepicker({
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
            startDate: moment().subtract(29, "days"),
            endDate: moment(),
        },
        function(start, end) {
            $("#reportrange span").html(
                start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
            );
        }
    );

    //Timepicker
    $("#timepicker").datetimepicker({
        format: "LT",
    });

    //Bootstrap Duallistbox
    $(".duallistbox").bootstrapDualListbox();

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    $(".my-colorpicker2").on("colorpickerChange", function(event) {
        $(".my-colorpicker2 .fa-square").css("color", event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch("state", $(this).prop("checked"));
    });
});
// BS-Stepper Init
document.addEventListener("DOMContentLoaded", function() {
    window.stepper = new Stepper(document.querySelector(".bs-stepper"));
});

// DropzoneJS Demo Code Start
Dropzone.autoDiscover = false;

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, {
    // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
        myDropzone.enqueueFile(file);
    };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width =
        progress + "%";
});

myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement
        .querySelector(".start")
        .setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
};
// DropzoneJS Demo Code End
    </script>