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

$email64 = $_GET['e'];
$pass64 = $_GET['p'];

include 'head.php';
?>

<script src="https://www.google.com/recaptcha/api.js?render=6LdyPWQhAAAAAAQ7nAyDZ3fydXpZ_3sJW4SzSrcS"></script>

<body>
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">KEAMANAN AUTENTIKASI SPEKTA SMANSA</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Silakan masukkan kode OTP yang telah dikirimkan ke email
                        anda
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
                        <form action="<?php echo $url_config ?>login.php" method="POST"
                            class="needs-validation text-start" novalidate>
                            <div class="form-group">
                                <input type="email" class="form-control " name="email" id="email"
                                    value="<?php echo $email64 ?>" hidden />
                                <input type="password" class="form-control " name="password" id="passowrd"
                                    value="<?php echo $pass64 ?>" hidden />
                                <input type="hidden" name="g-token" id="g-token">

                            </div>
                            <div class="form-group">
                                <label for="OTP">OTP</label>
                                <input type="text" class="form-control mt-2" name="otp" id="otp"
                                    placeholder="Masukkan OTP" data-msg="Masukkan OTP" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" name="otp_verif" id="btn-reset"
                                    class="form-control btn btn-primary rounded submit px-3">Login</button>
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
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == 'gagal') {
    ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'KODE OTP SALAH !',
        text: "Masukkan kembali kode OTP",
        showConfirmButton: false,
        timer: 2000
    }).then((result) => {
        window.location.href = "?e=<?php echo $email64 ?>&p=<?php echo $pass64 ?>";
    });
    </script>
    <?php
        }
    } ?>
</body>

</html>