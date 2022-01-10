                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
                                </script> - developed by
                                <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                            </span>
                        </div>
                    </div>

                    <div class="container my-auto py-2">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy; <script>
                                    document.write(new Date().getFullYear());
                                </script> - distributed by
                                <b><a href="https://themewagon.com/" target="_blank">themewagon</a></b>
                            </span>
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
                <script src="<?php echo $url_vendors ?>chart.<?php echo $url_js ?>Chart.min.js"></script>
                <script src="<?php echo $url_js ?>demo/chart-area-demo.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js">
                </script>
                <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <!-- Page level custom scripts -->
                <script>
                    $(".js-example-basic-multiple").select2({
                        maximumSelectionLength: 2
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#tabeltolak').DataTable();
                        $('#tabelverval').DataTable();
                        $('#tabelmember').DataTable();
                        $('#tabelaccount').DataTable();
                        $('#tabeluangmasuk').DataTable();
                        $('#tabeluangkeluar').DataTable();
                        $('#tabelekskul').DataTable();

                    });
                </script>
                <script>
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
                    var check = function() {
                        if (document.getElementById('password').value ==
                            document.getElementById('confirm_password').value) {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'SESUAI';
                        } else {
                            document.getElementById('message').style.color = 'red';
                            document.getElementById('message').innerHTML = 'TIDAK SESUAI';
                        }
                    }

                    function validasi(form) {

                        if (form.password.value.length < 8) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'PERINGATAN !',
                                text: "Password harus terdiri dari angka, huruf besar, huruf kecil, dan minimal 8 karakter ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return false;
                        }
                    }

                    // timeout before a callback is called

                    let timeout;

                    // traversing the DOM and getting the input and span using their IDs

                    let password = document.getElementById('password')
                    let strengthBadge = document.getElementById('StrengthDisp')

                    // The strong and weak password Regex pattern checker

                    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
                    let mediumPassword = new RegExp(
                        '((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))'
                    )

                    function StrengthChecker(PasswordParameter) {
                        // We then change the badge's color and text based on the password strength

                        if (strongPassword.test(PasswordParameter)) {
                            strengthBadge.style.backgroundColor = "green"
                            strengthBadge.textContent = 'KUAT'
                        } else if (mediumPassword.test(PasswordParameter)) {
                            strengthBadge.style.backgroundColor = 'blue'
                            strengthBadge.textContent = 'SEDANG'
                        } else {
                            strengthBadge.style.backgroundColor = 'red'
                            strengthBadge.textContent = 'LEMAH'
                        }
                    }

                    // Adding an input event listener when a user types to the  password input 

                    password.addEventListener("input", () => {

                        //The badge is hidden by default, so we show it

                        strengthBadge.style.display = 'block'
                        clearTimeout(timeout);

                        //We then call the StrengChecker function as a callback then pass the typed password to it

                        timeout = setTimeout(() => StrengthChecker(password.value), 500);

                        //Incase a user clears the text, the badge is hidden again

                        if (password.value.length !== 0) {
                            strengthBadge.style.display != 'block'
                        } else {
                            strengthBadge.style.display = 'none'
                        }
                    });
                </script>
                </body>

                </html>