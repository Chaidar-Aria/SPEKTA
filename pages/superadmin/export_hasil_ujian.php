<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../auth/login.php?pesan=belum_login");
} else if ($_SESSION['level'] != "SUPERADMIN") {
    header("location:../auth/login.php?pesan=forbidden");
}
require_once '../../config/koneksi.php';
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
$tes_id = $_GET['tes_id'];
$no = 1;
$query = "SELECT * FROM tb_test 
                            INNER JOIN tb_cbt_time ON tb_test.test_id = tb_cbt_time.test_id
                            INNER JOIN tb_users_cbt ON tb_test.test_id = tb_users_cbt.test_id
                            INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
                            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                            INNER JOIN tb_users_cbt_date ON tb_users_cbt.id_users_cbt = tb_users_cbt_date.id_users_cbt
                            INNER JOIN tb_users_cbt_grade ON tb_users_cbt.id_users_cbt = tb_users_cbt_grade.id_users_cbt
                            WHERE tb_users_cbt.test_id = $tes_id ";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    if (date("Y-m-d") > $row['cbt_date_start'] && date("Y-m-d") < $row['cbt_date_end']) { ?>
<script>
window.location.href = "exam?mes=ujian_berlangsung";
</script>
<?php
    }

    // hitung total peserta cbt
    $cbtUser = mysqli_query($conn, "SELECT * FROM tb_users_cbt
    INNER JOIN tb_level ON tb_level.id_users_cbt = tb_users_cbt.id_users_cbt
    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
    INNER JOIN tb_test ON tb_test.test_id = tb_users_cbt.test_id
    WHERE tb_level_name.level_name = 'USER' AND tb_test.test_id='$tes_id'");
    $totalCbtUser = mysqli_num_rows($cbtUser);
    ?>
<!DOCTYPE html>
<html lang=" en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $url_assets ?>img/Logo SS.png" rel=" icon">
    <title><?php echo "HASIL REKAPITULASI" . $row['test_name'] . " TAHUN " . date("Y") ?></title>
    <link href="<?php echo $url_vendors ?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
    @page {
        size: legal;
    }

    /* Large rounded green border */
    hr {
        border: 5px solid black;
        border-radius: 5px;
    }

    .table-identity {
        margin: auto;
        width: 75% !important;
    }

    .penetapan {
        text-align: right;
    }

    .tombol-aksi {
        text-align: center;
        margin: 5px 5px 5px 5px;
    }

    @media print {
        .tombol-aksi {
            display: none;
            overflow: hidden !important
        }

        .toolbar {
            display: none;
        }

        body {
            margin: 0mm;
        }

    }
    </style>

</head>

<body>
    <div class="tombol-aksi">
        <button onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        <a href="detailexam?test_id=<?php echo $tes_id ?>"><button class="btn btn-info"><i class="fa fa-arrow-left"></i>
                Kembali</button></a>
    </div>
    <div id="rekap">
        <div class="text-center">
            <img class="mb-3" src="<?php echo $url_assets . 'img/logo_spekta_baru.png' ?>" alt="logo spekta baru"
                width="25%">
            <h4>SISTEM PENCATATAN KEUANGAN DAN KEANGGOTAAN EKSTRAKURIKULER SMA NEGERI 1 MEJAYAN</h4>
            <hr>
            REKAPITULASI HASIL SELEKSI<br>EKSTRAKURIKULER TAHUN
            <?php echo date("Y") ?>
        </div>
        <!-- container-fluid -->
        <div id=" pricing" class="container-fluid">
            <table class="table table-identity table-borderless  ">
                <tbody>
                    <tr>
                        <td>Nama Ujian</td>
                        <td><?php echo $row['test_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Ujian</td>
                        <td><?php echo tgl_indo(date("Y-m-d", strtotime($row['cbt_date_start']))) . ' - ' . tgl_indo(date("Y-m-d", strtotime($row['cbt_date_end']))); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Peserta Ujian</td>
                        <td><?php echo $totalCbtUser ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- container -->
            <div id="pricing" class="container mt-3">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Peserta</th>
                            <th>Nomor Peserta Ujian</th>
                            <th>Tanggal Ujian</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <tr>
                            <td class="text-center text-muted"><?php echo $no++ ?></td>
                            <td>
                                <div class="widget-heading"><?php echo $row['name'] ?></div>
                            </td>
                            <td>
                                <div class="widget-heading"><?php echo $row['username'] ?></div>
                            </td>
                            <td>
                                <?php echo tgl_indo(date("Y-m-d", strtotime($row['users_cbt_date']))) ?>
                            </td>
                            <td>
                                <?php if ($row['grade'] < $row['test_min_grade']) { ?>
                                TIDAK LOLOS UJIAN
                                <?php } else { ?>
                                LOLOS UJIAN
                                <?php ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <div class="penetapan mb-3">
                    <h6>Ditetapkan di Mejayan</h6>
                    <h6>Pada Tanggal <?php echo tgl_indo(date('Y-m-d', strtotime($row['cbt_date_end'] . "+1 days"))); ?>
                    </h6>
                </div>
            </table>
            <div class="d-flex justify-content-around text-center">
                <h6>KETUA PENGAWAS SELEKSI SPEKTA <?php echo date("Y") ?></h6>
                <h6>KETUA PANITIA SELEKSI SPEKTA <?php echo date("Y") ?></h6>
            </div>
            <br>
            <div class="d-flex justify-content-around mt-5 text-center">
                <h6>____________________________</h6>
                <h6>____________________________</h6>
            </div>
            <br>
            <div class="d-flex justify-content-around text-center">
                <h6>PENANGGUNG JAWAB <br> SELEKSI SPEKTA <?php echo date("Y") ?></h6>
                <h6>WAKIL KEPALA SEKOLAH <br> BIDANG KESISWAAN </h6>
            </div>
            <br>
            <div class="d-flex justify-content-around mt-5 text-center">
                <h6>____________________________</h6>
                <?php $sql2 = mysqli_query($conn, "SELECT * FROM tb_data_sekolah WHERE id_data_Sekolah = '1'");
                                        while ($d2 = mysqli_fetch_array($sql2)) { ?>
                <h6><?php echo $d2['waka_kesiswaan'] . "<br> NIP. " . $d2['nip_waka_kesiswaan'] ?></h6>
                <?php } ?>
            </div>
            <br>
            <div class="d-flex justify-content-center text-center">
                <h6>Mengetahui,</h6>
            </div>
            <div class="d-flex justify-content-center text-center">
                <h6>KEPALA SEKOLAH <br> SMA NEGERI 1 MEJAYAN</h6>
            </div>
            <br>
            <div class="d-flex justify-content-center mt-5  text-center">
                <?php $sql2 = mysqli_query($conn, "SELECT * FROM tb_data_sekolah WHERE id_data_Sekolah = '1'");
                                        while ($d2 = mysqli_fetch_array($sql2)) { ?>
                <h6><?php echo $d2['kepala_sekolah'] . "<br> NIP. " . $d2['nip_kepsek'] ?></h6>
                <h6></h6>

                <?php } ?>
            </div>
        </div>
        <footer class="sticky-footer bg-white mt-3">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>copyright &copy; <script>
                        document.write(new Date().getFullYear());
                        </script> - SISTEM PENCATATAN KEUANGAN DAN KEANGGOTAAN EKSTRAKURIKULER
                    </span>
                </div>
            </div>

            <div class="container my-auto py-2">
                <div class="copyright text-center my-auto">
                    <h6>SMA NEGERI 1 MEJAYAN</h6>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
                                    }
                                } ?>