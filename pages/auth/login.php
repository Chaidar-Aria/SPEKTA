<?php
session_start();
if ($_SESSION) {
    if ($_SESSION['level'] == "SUPERADMIN") {
        header("Location: ../superadmin/");
    }
    if ($_SESSION['level'] == "ADMIN") {
        header("Location: ../admin/");
    }
    if ($_SESSION['level'] == "TEACHER") {
        header("Location: ../teacher/");
    }
    if ($_SESSION['level'] == "USER") {
        header("Location: ../users/");
    }
}
include 'head.php';
?>


<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Selamat Datang di SPEKTA SMANSA</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">SIlahkan login untuk masuk ke SPEKTA SMANSA
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
                </div>
                <br>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <div class="login-wrap p-3 p-md-5">
                    <div class="text-center">
                        <img src="<?php echo $url_assets . 'img/logo_spekta_baru.png' ?>" style="width: 50%;" alt="">
                    </div>
                    <form action="<?php echo $url_config . 'login.php' ?>" method="POST"
                        class="needs-validation text-start" novalidate>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control mt-2" name="email" id="email" placeholder="Email"
                                data-msg="Masukkan Email" required autocomplete="off" autofocus />
                            <div class="invalid-feedback">
                                Masukkan Email
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control mt-2" name="password" id="password"
                                placeholder="Password" data-msg="Masukkan Password" required autocomplete="off" />
                            <div class="invalid-feedback">
                                Masukkan Password
                            </div>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="Show Password" id="flexCheckDefault"
                                onclick="showPassword()">
                            <label class="form-check-label" for="flexCheckDefault">
                                Show Password
                            </label>
                        </div>
                        <p class="mt-2">
                            <a href="forgot">Lupa Password?</a>
                        </p>
                        <div class="form-group">
                            <button type="submit" name="login" id="btn-submit"
                                class="form-control btn btn-primary rounded submit px-3">Log
                                In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- End Hero -->

<?php
require_once 'foot.php';
require_once '../../template/script.php'; ?>
<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == 'gagal_login') {
?>
<script>
Swal.fire({
    icon: 'error',
    title: 'LOGIN GAGAL',
    text: 'Email atau Password yang anda masukkan salah!',
    showConfirmButton: false,
    timer: 5000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == 'belum_login') {
    ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'ANDA HARUS LOGIN !',
    text: 'Untuk masuk ke Spekta Smansa anda harus login terlebih dahulu',
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == 'sesi_habis') {
    ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'SESI LOGIN HABIS',
    text: 'Anda tidak melakukan aktivitas selama beberapa saat, silahkan login kembali',
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == 'forbidden') {
    ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'FORBIDDEN',
    text: 'Anda tidak diperbolehkan untuk masuk ke halaman ini !',
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == "berhasil_logout") {
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'LOGOUT BERHASIL',
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == "berhasil_aktif") {
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'AKUN TELAH AKTIF',
    text: "Silahkan login untuk melanjutkan",
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == "sudah_aktif") {
    ?>
<script>
Swal.fire({
    icon: 'info',
    title: 'AKUN TELAH AKTIF',
    text: "Anda tidak perlu melakukan aktivasi akun",
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == "password") {
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'PASSSWORD BERHASIL DIUBAH',
    text: "Silahkan login untuk melanjutkan",
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    } elseif ($_GET['pesan'] == "not_found") {
    ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal !',
    text: "data tidak ditemukan di database",
    showConfirmButton: false,
    timer: 2000
})
</script>
<?php
    } elseif ($_GET['pesan'] == "gagal") {
    ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'GAGAL !',
    text: "Sistem sedang sibuk atau error",
    showConfirmButton: false,
    timer: 2000,
}).then((result) => {
    window.location.href = "?";
});
</script>
<?php
    }
}
?>
</body>

</html>