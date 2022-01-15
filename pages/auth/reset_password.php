<?php
session_start();
if ($_SESSION) {
    if ($_SESSION['level'] == "SUPERADMIN") {
        header("Location: ../superadmin/");
    }
    if ($_SESSION['level'] == "ADMIN") {
        header("Location: ../admin/");
    }
    if ($_SESSION['level'] == "GURU") {
        header("Location: ../teacher/");
    }
    if ($_SESSION['level'] == "USER") {
        header("Location: ../users/");
    }
}
include '../../config/koneksi.php';
include '../../app/helper/base_url.php';

$code = $_GET['code'];

$query = $conn->query("SELECT email FROM tb_account WHERE code = '$code' ");
if ($query->num_rows === 0) {
    header("location: forgot.php?pesan=not_found");
}
$row = $query->fetch_array();
include 'head.php';
?>


<body>
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Reset kata sandi akun SPEKTA SMANSA</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Silahkan reset password anda dengan password terbaru.
                        Password harus terdiri dari angka, huruf
                        besar, huruf kecil,
                        dan
                        minimal 8 karakter
                    </h2>
                    <p data-aos="fade-up" data-aos-delay="450">SPEKTA SMANSA berjalan optimal di Laptop/PC, tidak
                        direkomendasikan untuk menggunakan
                        <i>smartphone</i> saat pengisian data
                    </p>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <div class="login-wrap p-3 p-md-5">
                        <div class="text-center">
                            <img src="<?php echo $url_assets ?>img/logo_spekta_baru.png" style="width: 50%;" alt="">
                        </div>
                        <form action="<?php echo $url_config ?>forgotpass.php" method="POST"
                            class="needs-validation text-start" novalidate>
                            <div class="form-group">
                                <input type="email" class="form-control " name="email" id="email"
                                    value="<?php echo $row["email"] ?>" hidden />
                                <input type="text" class="form-control " name="code" id="code"
                                    value="<?php echo $code ?>" hidden />
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control mt-2" name="password" id="password"
                                    placeholder="Password" data-msg="Masukkan Password" required
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Show Password"
                                        id="flexCheckDefault" onclick="showPassword()">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Show Password
                                    </label>
                                </div>
                                <br>
                                <span id="StrengthDisp" class="badge displayBadge"></span>
                                <p style="color: red;">Password harus terdiri dari angka, huruf besar, huruf kecil,
                                    dan
                                    minimal 8 karakter</p>
                                <div class="invalid-feedback">
                                    Masukkan Password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="reset_password" id="btn-reset"
                                    class="form-control btn btn-primary rounded submit px-3">RESET PASSWORD</button>
                            </div>
                        </form>
                        <!-- <a href="../../"><button type=""
                                    class="form-control btn btn-primary rounded submit">Kembali</button></a> -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->
    <?php
    include 'foot.php';
    include '../../template/script.php'; ?>
    <script>
    function validasi(form) {

        if (form.password.value.length < 8) {
            Swal.fire({
                icon: 'warning',
                title: 'PERINGATAN!',
                text: 'password harus sedikitnya 8 karakter',
            })
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