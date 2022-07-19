<?php
session_start();
require_once '../../config/koneksi.php';
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../auth/login.php?pesan=belum_login");
} else if ($_SESSION['level'] != "ADMIN") {
    header("location:../auth/login.php?pesan=forbidden");
}

$idekstra = $_SESSION['ekstra'];
// NAMA EKSTRA
$sqlekstra = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
INNER JOIN tb_admin ON tb_ekstrakurikuler.id_ekstra = tb_admin.id_ekstra
WHERE tb_ekstrakurikuler.id_ekstra = '$idekstra'");
while ($data = mysqli_fetch_array($sqlekstra)) {
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $url_assets ?>img/Logo SS.png" rel=" icon">
    <title>ABSENSI EKSTRAKURIKULER <?php echo $data['id_ekskul'] . "-" . $data['ekstrakurikuler'] ?></title>
    <link rel="stylesheet" href="<?php echo $url_css ?>qrcode.css">
</head>

<body>

    <body>
        <div class="container">
            <!-- TOP CONTAINER -->
            <div class="top-container">
                <h1>QR CODE ABSENSI EKSTRAKURIKULER</h1>
                <div class="flight">
                    <h2>ID Ekstra <?php echo $data['id_ekstra'] . "-" . $data['id_ekskul'] ?> ///
                        <?php echo tgl_indo(date("Y-m-d")) ?></h2>
                    <div class="circle"></div>
                </div>

                <div class="info-container">
                    <div class="passenger">
                        <p><?php echo $data['ekstrakurikuler'] ?></p>
                        <h4>Nama Ekstrakurikuler</h4>
                    </div>
                    <div class="boarding">
                        <p><?php echo tgl_indo(date('Y-m-d')) ?></p>
                        <h4>Tanggal Absensi</h4>
                    </div>
                    <div class="gate">
                        <p><?php echo $data['id_ekstra'] . "-" . $data['id_ekskul'] ?></p>
                        <h4>ID Ekstra</h4>
                    </div>
                </div>
            </div>

            <!-- BOTTOM CONTAINER -->
            <div class="bottom-container">
                <div class="qr-code">
                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php $url_ ?>&choe=UTF-8" />
                </div>
            </div>
        </div>
    </body>
</body>

</html>
<?php } ?>