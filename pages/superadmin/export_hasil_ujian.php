<?php
require_once '../../config/koneksi.php';
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
$tes_id = $_GET['tes_id'];
// hitung total peserta cbt
$cbtUser = mysqli_query($conn, "SELECT * FROM tb_users_cbt 
                                INNER JOIN tb_level ON tb_level.id_users_cbt = tb_users_cbt.id_users_cbt
                                INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                INNER JOIN tb_test ON tb_test.test_id = tb_users_cbt.test_id
                                WHERE tb_level_name.level_name = 'USER' AND tb_test.test_id='$tes_id'");
$totalCbtUser = mysqli_num_rows($cbtUser);

// hitung lolos cbt
$cbtlolos = mysqli_query($conn, "SELECT * FROM tb_users_cbt 
                                INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
                                INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                                INNER JOIN tb_level ON tb_level.id_users_cbt = tb_users_cbt.id_users_cbt
                                INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                INNER JOIN tb_test ON tb_test.test_id = tb_users_cbt.test_id
                                WHERE tb_level_name.level_name = 'USER' AND tb_users_status.work_status = '1' AND tb_users_cbt.grade > 60 AND tb_test.test_id='$tes_id'");
$loloscbt = mysqli_num_rows($cbtlolos);

// hitung tidak lolos cbt
$cbttidaklolos = mysqli_query($conn, "SELECT * FROM tb_users_cbt 
                                INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
                                INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                                INNER JOIN tb_level ON tb_level.id_users_cbt = tb_users_cbt.id_users_cbt
                                INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                INNER JOIN tb_test ON tb_test.test_id = tb_users_cbt.test_id
                                WHERE tb_level_name.level_name = 'USER' AND tb_users_status.work_status = '1' AND tb_users_cbt.grade < 60 AND tb_test.test_id='$tes_id'");
$tidakloloscbt = mysqli_num_rows($cbttidaklolos);

$query = "SELECT * FROM tb_test 
                            INNER JOIN tb_cbt_time ON tb_test.test_id = tb_cbt_time.test_id
                            INNER JOIN tb_users_cbt ON tb_test.test_id = tb_users_cbt.test_id
                            INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
                            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                            WHERE tb_users_cbt.test_id = $tes_id";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    if (date("Y-m-d") > $row['cbt_date_start'] && date("Y-m-d") < $row['cbt_date_end']) { ?>
<script>
window.location.href = "exam?mes=ujian_berlangsung";
</script>
<?php
    }

    ?>
<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>HASIL UJIAN <?php echo $row['test_name'] ?></title>
    <link rel="stylesheet" href="<?php echo $url_assets . 'css/exam.css'; ?>">
    <script src="<?php echo $url_vendors ?>jquery/jquery.min.js"></script>
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <style>
    @media print {

        body {
            margin: 0mm;
        }
    }
    </style>
</head>

<body class="u-body">
    <header class="u-align-center u-clearfix u-header u-header" id="sec-be67">
        <div class="u-align-left u-clearfix u-sheet u-sheet-1">
            <img class="u-image u-image-default u-image-1" src="<?php echo $url_assets . 'img/logo_smansa.png'; ?>"
                alt="">
            <img class="u-image u-image-default u-image-2" src="<?php echo $url_assets . 'img/logo_spekta_baru.png'; ?>"
                alt="">
            <p class="u-align-center u-text u-text-1">HASIL SELEKSI COMPUTER BASED TEST EKSTRAKURIKULER<br>DI LINGKUNGAN
                SMAN
                NEGERI 1 MEJAYAN<br>TAHUN AJARAN 2021/2022
            </p>
            <div class="u-border-10 u-border-grey-dark-1 u-expanded-width u-line u-line-horizontal u-line-1"></div>
        </div>
    </header>
    <section class="u-align-center u-clearfix u-section-1" id="sec-07ab">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <h4 class="u-align-center u-text u-text-1">REKAPITULASI HASIL COMPUTER BASED TEST <br>EKSTRAKURIKULER TAHUN
                2021
            </h4>
            <div class="u-expanded-width u-table u-table-responsive u-table-1">
                <table class="u-table-entity u-table-entity-1">
                    <colgroup>
                        <col width="50%">
                        <col width="50%">
                    </colgroup>
                    <tbody class="u-table-alt-palette-1-light-3 u-table-body">
                        <tr style="height: 65px;">
                            <td class="u-table-cell">Nama Tes</td>
                            <td class="u-table-cell"><?php echo $row['test_name'] ?></td>
                        </tr>
                        <tr style="height: 65px;">
                            <td class="u-table-cell">ID Ekstra</td>
                            <td class="u-table-cell">Description</td>
                        </tr>
                        <tr style="height: 65px;">
                            <td class="u-table-cell">Total Peserta CBT</td>
                            <td class="u-table-cell"><?php echo $totalCbtUser ?></td>
                        </tr>
                        <tr style="height: 65px;">
                            <td class="u-table-cell">Total Lulus CBT</td>
                            <td class="u-table-cell"><?php echo $loloscbt ?></td>
                        </tr>
                        <tr style="height: 65px;">
                            <td class="u-table-cell">Total Tidak Lulus CBT</td>
                            <td class="u-table-cell"><?php echo $tidakloloscbt ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-cb01">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-expanded-width u-table u-table-responsive u-table-1">
                <table class="u-table-entity u-table-entity-1">
                    <colgroup>
                        <col width="7.3%">
                        <col width="23.8%">
                        <col width="28.7%">
                        <col width="40.2%">
                    </colgroup>
                    <thead class="u-palette-4-base u-table-header u-table-header-1">
                        <tr style="height: 31px;">
                            <th class="u-border-1 u-border-palette-4-base u-table-cell">No</th>
                            <th class="u-border-1 u-border-palette-4-base u-table-cell">Nomor Peserta</th>
                            <th class="u-border-1 u-border-palette-4-base u-table-cell">Nama</th>
                            <th class="u-border-1 u-border-palette-4-base u-table-cell">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="u-table-body">
                        <tr style="height: 75px;">
                            <td class="u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-5">
                                Row 1</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                        </tr>
                        <tr style="height: 76px;">
                            <td class="u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-9">
                                Row 2</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                        </tr>
                        <tr style="height: 76px;">
                            <td
                                class="u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-13">
                                Row 3</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                        </tr>
                        <tr style="height: 76px;">
                            <td
                                class="u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-17">
                                Row 4</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                            <td class="u-border-1 u-border-grey-30 u-table-cell">Description</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <h6>Ditetapkan di Mejayan</h6>
                <h6>Pada Tanggal <?php
                                        echo tgl_indo(date("Y-m-d")); ?></h6>
            </div>
            <p class="u-text u-text-2">Ketua Ekstrakurikuler<br>
                <br>
                <br>
                <br>________________
            </p>
            <p class="u-text u-text-3">Ketua Panitia Seleksi SPEKTA<br>
                <br>
                <br>
                <br>________________
            </p>
            <p class="u-text u-text-4">Pembina Ekstrakurikuler<br>
                <br>
                <br>
                <br>________________
            </p>
        </div>
    </section>


    <footer class="u-align-center u-clearfix u-footer u-palette-1-base u-footer" id="sec-f85b">
        <div class="u-clearfix u-sheet u-sheet-1">
            <p class="u-align-center u-small-text u-text u-text-variant u-text-1">Laporan dibuat secara otomatis melalui
                aplikasi SPEKTA SMANSA ​© SPEKTA SMANSA<br>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler
                SMA Negeri 1 Mejayan
            </p>
        </div>
    </footer>
</body>

</html>
<?php } ?>