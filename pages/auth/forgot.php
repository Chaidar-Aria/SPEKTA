<?php

use function Composer\Autoload\includeFile;

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
include 'head.php';
?>
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Selamat Datang di SPEKTA SMANSA</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">Silahkan masukkan email untuk mengirimkan link reset
                    password
                </h2>
                <p data-aos="fade-up" data-aos-delay="450">SPEKTA SMANSA berjalan optimal di Laptop/PC, tidak
                    direkomendasikan untuk menggunakan
                    <i>smartphone</i> saat pengisian data
                </p>
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up" data-aos-delay="400">Belum memiliki akun?</h2>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="regis"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Buat Akun</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up" data-aos-delay="600">Sudah memiliki akun?</h2>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="800">
                        <div class="text-center text-lg-start">
                            <a href="login"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Login</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <div class="login-wrap p-3 p-md-5">
                    <div class="text-center">
                        <img src="<?php echo $url_assets ?>img/logo_spekta.png" style="width: 50%;" alt="">
                    </div>

                    <form action="<?php echo $url_config ?>lupa_password.php" method="POST"
                        class="needs-validation text-start" novalidate>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control mt-2" name="email" id="email" placeholder="Email"
                                data-msg="Masukkan Email" required autocomplete="off" />
                            <div class="invalid-feedback">
                                Masukkan Email
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="send_link" id="btn-reset"
                                class="form-control btn btn-primary rounded submit px-3 mt-5">KIRIM LINK
                                RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- End Hero -->
<?php include 'foot.php';
require_once '../../template/script.php'; ?>
<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == 'gagal') {
?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal !',
    text: "Sistem sedang sibuk atau error",
    showConfirmButton: false,
    timer: 2000
})
</script>
<?php
    } elseif ($_GET['pesan'] == "berhasil") {
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil !',
    text: "Link reset telah dirikim ke Email anda",
    showConfirmButton: false,
    timer: 2000
})
</script>
<?php
    } elseif ($_GET['pesan'] == "email_null") {
    ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal !',
    text: "Akun tidak ada di database",
    showConfirmButton: false,
    timer: 2000
})
</script>
<?php
    } elseif ($_GET['pesan'] == "not_found") {
    ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'Data Tidak Ditemukan !',
    text: "Mungkin Password anda telah diubah sebelumnya. Jika menghendaki perubahan password, silahkan masukkan email untuk merubah password akun",
    showConfirmButton: false,
    timer: 2000
})
</script>
<?php
    }
}
?>

</body>

</html>