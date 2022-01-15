<?php
//Jika download plugin mpdf tanpa composer (versi lama)
// define('_MPDF_PATH', 'mpdf/');
// include(_MPDF_PATH . "mpdf.php");
// $mpdf = new mPDF('utf-8', 'A4', 11, 'Georgia');

//Jika download plugin mpdf dengan composer (versi baru)
require_once  '../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

//Menggabungkan dengan file koneksi yang telah kita buat
include '../../config/koneksi.php';
require_once '../helper/base_url.php';
$monthname = strtoupper(date('F', strtotime(date('Y-m') . " -1 month")));

$nama_dokumen = 'LAPORAN KEUANGAN BULAN ' . $monthname;

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <title>LAPORAN KEUANGAN EKSTRAKURIKULER SMA NEGERI 1 MEJAYAN</title>
    <style>
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 1em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 12px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }

        .toolbar {
            display: none;
        }

        body {
            margin: 0mm;
        }

    }

    @page {
        size: auto;
        margin: 5px 0px 0px 0px;

    }

    #blah {
        margin-top: 5rem;
        width: 10rem;

    }
    </style>
    <!-- PHP -->

    <?php
    // STATUS ERROR
    error_reporting(0);
    // PEMASUKAN SEBELUMNYA //
    $bulan = date('m') - 2; //BULAN SEBELUMNYA
    // DANA SEKOLAH SEBELUMNYA
    $danasekolah_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '1'");
    while ($d = mysqli_fetch_array($danasekolah_prev)) {
        $array_danasekolah_prev[] = $d['jumlah'];
    }
    $hitungarray_danasekolah_prev = array_sum($array_danasekolah_prev);
    $danasekolahsebelumnya = "Rp " . number_format($hitungarray_danasekolah_prev, 2, ',', '.');

    // DANA KAS SEBELUMNYA
    $danakas_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '2'");
    while ($d = mysqli_fetch_array($danakas_prev)) {
        $array_danakas_prev[] = $d['jumlah'];
    }
    $hitungarray_danakas_prev = array_sum($array_danakas_prev);
    $danakassebelumnya = "Rp " . number_format($hitungarray_danakas_prev, 2, ',', '.');

    // UANG SISA SEBELUMNYA
    $uangsisa_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '3'");
    while ($d = mysqli_fetch_array($uangsisa_prev)) {
        $array_uangsisa_prev[] = $d['jumlah'];
    }
    $hitungarray_uangsisa_prev = array_sum($array_uangsisa_prev);
    $uangsisasebelumnya = "Rp " . number_format($hitungarray_uangsisa_prev, 2, ',', '.');


    // UANG USAHA SEBELUMNYA
    $uangusaha_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '4'");
    while ($d = mysqli_fetch_array($uangusaha_prev)) {
        $array_uangusaha_prev[] = $d['jumlah'];
    }
    $hitungarray_uangusaha_prev = array_sum($array_uangusaha_prev);
    $uangusahasebelumnya = "Rp " . number_format($hitungarray_uangusaha_prev, 2, ',', '.');

    // UANG HIBAH SEBELUMNYA
    $uanghibah_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '5'");
    while ($d = mysqli_fetch_array($uanghibah_prev)) {
        $array_uanghibah_prev[] = $d['jumlah'];
    }
    $hitungarray_uanghibah_prev = array_sum($array_uanghibah_prev);
    $danahibahsebelumnya = "Rp " . number_format($hitungarray_uanghibah_prev, 2, ',', '.');

    // UANG TAK TERDUGA SEBELUMNYA
    $uangtakterduga_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '6'");
    while ($d = mysqli_fetch_array($uangtakterduga_prev)) {
        $array_uangtakterduga_prev[] = $d['jumlah'];
    }
    $hitungarray_uangtakterduga_prev = array_sum($array_uangtakterduga_prev);
    $danatakterdugasebelumnya = "Rp " . number_format($hitungarray_uangtakterduga_prev, 2, ',', '.');

    // UANG LAIN SEBELUMNYA
    $uanglain_prev = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '7'");
    while ($d = mysqli_fetch_array($uanglain_prev)) {
        $array_uanglain_prev[] = $d['jumlah'];
    }
    $hitungarray_uanglain_prev = array_sum($array_uanglain_prev);
    $danalainsebelumnya = "Rp " . number_format($hitungarray_uanglain_prev, 2, ',', '.');

    // KEGIATAN TAHUNAN SEBELUMNYA
    $kegiatantahunan_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '8'");
    while ($d = mysqli_fetch_array($kegiatantahunan_prev)) {
        $array_kegiatantahunan_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatantahunan_prev = array_sum($array_kegiatantahunan_prev);
    $kegiatantahunansebelumnya = "Rp " . number_format($hitungarray_kegiatantahunan_prev, 2, ',', '.');

    // KEGIATAN BESAR SEBELUMNYA
    $kegiatanbesar_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '9'");
    while ($d = mysqli_fetch_array($kegiatanbesar_prev)) {
        $array_kegiatanbesar_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatanbesar_prev = array_sum($array_kegiatanbesar_prev);
    $kegiatanbesarsebelumnya = "Rp " . number_format($hitungarray_kegiatanbesar_prev, 2, ',', '.');

    // KEGIATAN RUTIN SEBELUMNYA
    $kegiatanrutin_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '10'");
    while ($d = mysqli_fetch_array($kegiatanrutin_prev)) {
        $array_kegiatanrutin_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatanrutin_prev = array_sum($array_kegiatanrutin_prev);
    $kegiatanrutinsebelumnya = "Rp " . number_format($hitungarray_kegiatanrutin_prev, 2, ',', '.');

    // KEGIATAN LOMBA SEBELUMNYA
    $kegiatanlomba_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '11'");
    while ($d = mysqli_fetch_array($kegiatanlomba_prev)) {
        $array_kegiatanlomba_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlomba_prev = array_sum($array_kegiatanlomba_prev);
    $kegiatanlombasebelumnya = "Rp " . number_format($hitungarray_kegiatanlomba_prev, 2, ',', '.');

    // KEGIATAN KHUSUS SEBELUMNYA
    $kegiatankhusus_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '12'");
    while ($d = mysqli_fetch_array($kegiatankhusus_prev)) {
        $array_kegiatankhusus_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatankhusus_prev = array_sum($array_kegiatankhusus_prev);
    $kegiatankhusussebelumnya = "Rp " . number_format($hitungarray_kegiatankhusus_prev, 2, ',', '.');

    // KEGIATAN LAIN SEBELUMNYA
    $kegiatanlain_prev = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '13'");
    while ($d = mysqli_fetch_array($kegiatanlain_prev)) {
        $array_kegiatanlain_prev[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlain_prev = array_sum($array_kegiatanlain_prev);
    $kegiatanlainsebelumnya = "Rp " . number_format($hitungarray_kegiatanlain_prev, 2, ',', '.');

    // TOTAL MASUK SEBELUMNYA
    $totalmasukprev = mysqli_query($conn, "SELECT * FROM tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan'");
    while ($d = mysqli_fetch_array($totalmasukprev)) {
        $array_total_masuk_prev[] = $d['jumlah'];
    }

    $hitung_total_masuk_prev = array_sum($array_total_masuk_prev);
    $totalmasuksebelumnya = "Rp " . number_format($hitung_total_masuk_prev, 2, ',', '.');

    // TOTAL KELUAR SEBELUMNYA
    $totalkeluarprev = mysqli_query($conn, "SELECT * FROM tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan'");
    while ($d = mysqli_fetch_array($totalkeluarprev)) {
        $array_total_keluar_prev[] = $d['jumlah'];
    }

    $hitung_total_keluar_prev = array_sum($array_total_keluar_prev);
    $totalkeluarsebelumnya = "Rp " . number_format($hitung_total_keluar_prev, 2, ',', '.');

    // PEMASUKAN BULAN INI
    $bulan = date('m') - 1;
    // DANA SEKOLAH SEKARANG
    $danasekolah = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '1'");
    while ($d = mysqli_fetch_array($danasekolah)) {
        $array_danasekolah[] = $d['jumlah'];
    }
    $hitungarray_danasekolah = array_sum($array_danasekolah);
    $danasekolahsekarang = "Rp " . number_format($hitungarray_danasekolah, 2, ',', '.');

    // DANA KAS SEKARANG
    $danakas = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '2'");
    while ($d = mysqli_fetch_array($danakas)) {
        $array_danakas[] = $d['jumlah'];
    }
    $hitungarray_danakas = array_sum($array_danakas);
    $danakassekarang = "Rp " . number_format($hitungarray_danakas, 2, ',', '.');

    // UANG SISA SEKARANG
    $uangsisa = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '3'");
    while ($d = mysqli_fetch_array($uangsisa)) {
        $array_uangsisa[] = $d['jumlah'];
    }
    $hitungarray_uangsisa = array_sum($array_uangsisa);
    $uangsisasekarang = "Rp " . number_format($hitungarray_uangsisa, 2, ',', '.');

    // UANG USAHA SEKARANG
    $uangusaha = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '4'");
    while ($d = mysqli_fetch_array($uangusaha)) {
        $array_uangusaha[] = $d['jumlah'];
    }
    $hitungarray_uangusaha = array_sum($array_uangusaha);
    $uangusahasekarang = "Rp " . number_format($hitungarray_uangusaha, 2, ',', '.');

    // UANG HIBAH SEKARANG
    $uanghibah = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '5'");
    while ($d = mysqli_fetch_array($uanghibah)) {
        $array_uanghibah[] = $d['jumlah'];
    }
    $hitungarray_uanghibah = array_sum($array_uanghibah);
    $danahibahsekarang = "Rp " . number_format($hitungarray_uanghibah, 2, ',', '.');

    // UANG TAK TERDUGA SEKARANG
    $uangtakterduga = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '6'");
    while ($d = mysqli_fetch_array($uangtakterduga)) {
        $array_uangtakterduga[] = $d['jumlah'];
    }
    $hitungarray_uangtakterduga = array_sum($array_uangtakterduga);
    $danatakterdugasekarang = "Rp " . number_format($hitungarray_uangtakterduga, 2, ',', '.');

    // UANG LAIN SEKARANG
    $uanglain = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '7'");
    while ($d = mysqli_fetch_array($uanglain)) {
        $array_uanglain[] = $d['jumlah'];
    }
    $hitungarray_uanglain = array_sum($array_uanglain);
    $danalainsekarang = "Rp " . number_format($hitungarray_uanglain, 2, ',', '.');

    // KEGIATAN TAHUNAN SEKARANG
    $kegiatantahunan = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '8'");
    while ($d = mysqli_fetch_array($kegiatantahunan)) {
        $array_kegiatantahunan[] = $d['jumlah'];
    }
    $hitungarray_kegiatantahunan = array_sum($array_kegiatantahunan);
    $kegiatantahunansekarang = "Rp " . number_format($hitungarray_kegiatantahunan, 2, ',', '.');


    // KEGIATAN BESAR SEKARANG
    $kegiatanbesar = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '9'");
    while ($d = mysqli_fetch_array($kegiatanbesar)) {
        $array_kegiatanbesar[] = $d['jumlah'];
    }
    $hitungarray_kegiatanbesar = array_sum($array_kegiatanbesar);
    $kegiatanbesarsekarang = "Rp " . number_format($hitungarray_kegiatanbesar, 2, ',', '.');

    // KEGIATAN RUTIN SEKARANG
    $kegiatanrutin = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '10'");
    while ($d = mysqli_fetch_array($kegiatanrutin)) {
        $array_kegiatanrutin[] = $d['jumlah'];
    }
    $hitungarray_kegiatanrutin = array_sum($array_kegiatanrutin);
    $kegiatanrutinsekarang = "Rp " . number_format($hitungarray_kegiatanrutin, 2, ',', '.');

    // KEGIATAN LOMBA SEKARANG
    $kegiatanlomba = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '11'");
    while ($d = mysqli_fetch_array($kegiatanlomba)) {
        $array_kegiatanlomba[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlomba = array_sum($array_kegiatanlomba);
    $kegiatanlombasekarang = "Rp " . number_format($hitungarray_kegiatanlomba, 2, ',', '.');

    // KEGIATAN KHUSUS SEKARANG
    $kegiatankhusus = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '12'");
    while ($d = mysqli_fetch_array($kegiatankhusus)) {
        $array_kegiatankhusus[] = $d['jumlah'];
    }
    $hitungarray_kegiatankhusus = array_sum($array_kegiatankhusus);
    $kegiatankhusussekarang = "Rp " . number_format($hitungarray_kegiatankhusus, 2, ',', '.');

    // KEGIATAN LAIN SEKARANG
    $kegiatanlain = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '13'");
    while ($d = mysqli_fetch_array($kegiatanlain)) {
        $array_kegiatanlain[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlain = array_sum($array_kegiatanlain);
    $kegiatanlainsekarang = "Rp " . number_format($hitungarray_kegiatanlain, 2, ',', '.');

    // TOTAL MASUK SEKARANG
    $totalmasuk = mysqli_query($conn, "SELECT * FROM tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan'");
    while ($d = mysqli_fetch_array($totalmasuk)) {
        $array_total_masuk_now[] = $d['jumlah'];
    }
    $hitung_total_masuk_now = array_sum($array_total_masuk_now);
    $totalmasuksekarang = "Rp " . number_format($hitung_total_masuk_now, 2, ',', '.');

    // TOTAL KELUAR sekarang
    $totalkeluarnow = mysqli_query($conn, "SELECT * FROM tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan'");
    while ($d = mysqli_fetch_array($totalkeluarnow)) {
        $array_total_keluar_now[] = $d['jumlah'];
    }

    $hitung_total_keluar_now = array_sum($array_total_keluar_now);
    $totalkeluarsekarang = "Rp " . number_format($hitung_total_keluar_now, 2, ',', '.');

    // // TOTAL HUTANG SELURUH
    // $bulan = date('m') - 1;
    // $totalhutang = mysqli_query($conn, "SELECT * FROM users_money_hutang");
    // while ($d = mysqli_fetch_array($totalhutang)) {
    //     $array_total_hutang[] = $d['jumlah'];
    // }

    // $hitung_total_hutang = array_sum($array_total_hutang);
    // $totalhutang = "Rp " . number_format($hitung_total_hutang, 2, ',', '.');

    ?>
</head>

<body>


    <!--Author      : @arboshiki-->
    <div id="invoice">

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <img src="<?php echo $url_assets ?>img/logo_smansa.png" data-holder-rendered="true"
                                id="blah" />
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                LAPORAN KEUANGAN
                            </h2>
                            <div>SISTEM PENCATATAN KEUANGAN EKSTRAKURIKULER</div>
                            <div>SMA NEGERI 1 MEJAYAN</div>
                            <div>JL. PANGLIMA SUDIRMAN NO.82</div>
                            <div>MEJAYAN, MADIUN, JAWA TIMUR</div>
                            <br>
                            <div class="date">
                                <?php
                                // KODE LAPORAN
                                $kode_awal = "LAPKEU";
                                $kode_akhir = substr(str_shuffle("1234567890"), 0, 6);

                                $kode_laporan = $kode_awal . -$kode_akhir;

                                // TANGGAL LAPORAN
                                $date = new DateTime();
                                $date->modify("last day of previous month");
                                ?>
                                Kode Laporan: <?php echo $kode_laporan ?></div>
                            <div class="date">Tanggal Laporan: <?php echo $date->format("Y-m-d"); ?></div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-details">
                            <h1 class="invoice-id">PEMASUKAN BULAN
                                <?php echo strtoupper(date('F', strtotime(date('Y-m') . " -1 month"))); ?>
                            </h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESKRIPSI</th>
                                <th class="text-right">BULAN SEBELUMNYA</th>
                                <th class="text-right">BULAN INI</th>
                                <th class="text-right">KEADAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">01</td>
                                <td class="text-left">
                                    <h3>DANA SEKOLAH
                                    </h3>
                                </td>
                                <td class="unit"><?php echo $danasekolahsebelumnya ?></td>
                                <td class="qty"><?php echo $danasekolahsekarang ?></td>
                                <td class="total">
                                    <?php if ($danasekolahsebelumnya > $danasekolahsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($danasekolahsebelumnya == $danasekolahsekarang) { ?>
                                    NILAI TETEAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">02</td>
                                <td class="text-left">
                                    <h3>DANA KAS
                                </td>
                                <td class="unit"><?php echo $danakassebelumnya ?></td>
                                <td class="qty"><?php echo $danakassekarang ?></td>
                                <td class="total">
                                    <?php if ($danakassebelumnya > $danakassekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($danakassebelumnya == $danakassekarang) { ?>
                                    NILAI TETEAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">03</td>
                                <td class="text-left">
                                    <h3>UANG SISA</h3>
                                </td>
                                <td class="unit"><?php echo $uangsisasebelumnya ?></td>
                                <td class="qty"><?php echo $uangsisasekarang ?></td>
                                <td class="total">
                                    <?php if ($uangsisasebelumnya > $uangsisasekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($uangsisasebelumnya === $uangsisasekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">04</td>
                                <td class="text-left">
                                    <h3>UANG USAHA</h3>
                                </td>
                                <td class="unit"><?php echo $uangusahasebelumnya ?></td>
                                <td class="qty"><?php echo $uangusahasekarang ?></td>
                                <td class="total">
                                    <?php if ($uangusahasebelumnya > $uangusahasekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($uangusahasebelumnya == $uangusahasekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">05</td>
                                <td class="text-left">
                                    <h3>DANA HIBAH</h3>
                                </td>
                                <td class="unit"><?php echo $danahibahsebelumnya ?></td>
                                <td class="qty"><?php echo $danahibahsekarang ?></td>
                                <td class="total">
                                    <?php if ($danahibahsebelumnya > $danahibahsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($danahibahsebelumnya == $danahibahsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">06</td>
                                <td class="text-left">
                                    <h3>DANA TAK TERDUGA</h3>
                                </td>
                                <td class="unit"><?php echo $danatakterdugasebelumnya ?></td>
                                <td class="qty"><?php echo $danatakterdugasekarang ?></td>
                                <td class="total">
                                    <?php if ($danatakterdugasebelumnya > $danatakterdugasekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($danatakterdugasebelumnya == $danatakterdugasekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">07</td>
                                <td class="text-left">
                                    <h3>DANA LAIN</h3>
                                </td>
                                <td class="unit"><?php echo $danalainsebelumnya ?></td>
                                <td class="qty"><?php echo $danalainsekarang ?></td>
                                <td class="total">
                                    <?php if ($danalainsebelumnya > $danalainsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($danalainsebelumnya == $danalainsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">PEMASUKAN BULAN SEBELUMNYA</td>
                                <td><?php echo $totalmasuksebelumnya ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">PEMASUKAN BULAN INI</td>
                                <td><?php echo $totalmasuksekarang ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL PEMASUKAN</td>
                                <td><?php echo $totalmasuksekarang ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="row contacts mt-5">
                        <div class="col invoice-details">
                            <h1 class="invoice-id">PENGELUARAN BULAN
                                <?php echo strtoupper(date('F', strtotime(date('Y-m') . " -1 month"))); ?>
                            </h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESKRIPSI</th>
                                <th class="text-right">BULAN SEBELUMNYA</th>
                                <th class="text-right">BULAN INI</th>
                                <th class="text-right">KEADAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">01</td>
                                <td class="text-left">
                                    <h3>
                                        KEGIATAN TAHUNAN
                                    </h3>
                                </td>
                                <td class="unit"><?php echo $kegiatantahunansebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatantahunansekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatantahunansebelumnya > $kegiatantahunansekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatantahunansebelumnya == $kegiatantahunansekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">02</td>
                                <td class="text-left">
                                    <h3>KEGIATAN BESAR</h3>
                                </td>
                                <td class="unit"><?php echo $kegiatanbesarsebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatanbesarsekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatanbesarsebelumnya > $kegiatanbesarsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatanbesarsebelumnya == $kegiatanbesarsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">03</td>
                                <td class="text-left">
                                    <h3>KEGIATAN RUTIN</h3>
                                </td>
                                <td class="unit"><?php echo $kegiatanrutinsebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatanrutinsekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatanrutinsebelumnya > $kegiatanrutinsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatanrutinsebelumnya == $kegiatanrutinsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">04</td>
                                <td class="text-left">
                                    <h3>KEGIATAN LOMBA</h3>
                                </td>
                                <td class="unit"><?php echo $kegiatanlombasebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatanlombasekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatanlombasebelumnya > $kegiatanlombasekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatanlombasebelumnya == $kegiatanlombasekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">05</td>
                                <td class="text-left">
                                    <h3>KEGIATAN KHUSUS</h3>
                                </td>
                                <td class="unit"><?php echo $kegiatankhusussebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatankhusussekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatankhusussebelumnya > $kegiatankhusussekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatankhusussebelumnya == $kegiatankhusussekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">06</td>
                                <td class="text-left">
                                    <h3>KEGIATAN LAIN-LAIN</h3>
                                </td>
                                <td class="unit"><?php echo $kegiatanlainsebelumnya ?></td>
                                <td class="qty"><?php echo $kegiatanlainsekarang ?></td>
                                <td class="total">
                                    <?php if ($kegiatanlainsebelumnya > $kegiatanlainsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($kegiatanlainsebelumnya == $kegiatanlainsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">PENGELUARAN BULAN SEBELUMNYA</td>
                                <td><?php echo $totalkeluarsebelumnya ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">PENGELUARAN BULAN INI</td>
                                <td><?php echo $totalkeluarsekarang ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL PENGELUARAN</td>
                                <td><?php echo $totalkeluarsekarang ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="row contacts" id="totaluang">
                        <div class="col invoice-details">
                            <h1 class="invoice-id">TOTAL UANG</h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESKRIPSI</th>
                                <th class="text-right">BULAN SEBELUMNYA</th>
                                <th class="text-right">BULAN INI</th>
                                <th class="text-right">KEADAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">01</td>
                                <td class="text-left">
                                    <h3>
                                        PEMASUKAN
                                    </h3>
                                </td>
                                <td class="unit"><?php echo $totalmasuksebelumnya ?></td>
                                <td class="qty"><?php echo $totalmasuksekarang ?></td>
                                <td class="total">
                                    <?php if ($totalmasuksebelumnya > $totalmasuksekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($totalmasuksebelumnya == $totalmasuksekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="no">02</td>
                                <td class="text-left">
                                    <h3>PENGELUARAN</h3>
                                </td>
                                <td class="unit"><?php echo $totalkeluarsebelumnya ?></td>
                                <td class="qty"><?php echo $totalkeluarsekarang ?></td>
                                <td class="total">
                                    <?php if ($totalkeluarsebelumnya > $totalkeluarsekarang) { ?>
                                    TERJADI PENURUNAN
                                    <?php } elseif ($totalkeluarsebelumnya == $totalkeluarsekarang) { ?>
                                    NILAI TETAP
                                    <?php } else { ?>
                                    TERJADI KENAIKAN
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL UANG BULAN SEBELUMNYA</td>
                                <td><?php
                                    $hitunguangsebelum = $hitung_total_masuk_prev - $hitung_total_keluar_prev;

                                    $totaluangsebelum = "Rp " . number_format($hitunguangsebelum, 2, ',', '.');
                                    echo $totaluangsebelum ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL UANG BULAN INI</td>
                                <td><?php
                                    $hitunguangsekarang = $hitung_total_masuk_now - $hitung_total_keluar_now;

                                    $totaluangsekarang = "Rp " . number_format($hitunguangsekarang, 2, ',', '.');
                                    echo $totaluangsekarang ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL UANG SEKARANG</td>
                                <td><?php
                                    $hitungtotaluang = $hitunguangsebelum + $hitunguangsekarang;

                                    $totaluang = "Rp " . number_format($hitungtotaluang, 2, ',', '.');
                                    echo $totaluang ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <div class="text-right">
                            <h6>Ditetapkan di Mejayan</h6>
                            <h6>Pada Tanggal <?php echo $date->format("d F Y"); ?></h6>
                        </div>
                    </table>
                    <div class="d-flex justify-content-around">
                        <h6>KETUA EKSTRAKURIKULER</h6>
                        <h6>BENDAHARA EKSTRAKURIKULER</h6>
                    </div>
                    <br>
                    <div class="d-flex justify-content-around mt-5">
                        <h6>____________________________</h6>
                        <h6>____________________________</h6>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <h6>Mengetahui,</h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h6>PEMBINA EKSTRAKURIKULER</h6>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mt-5">
                        <h6>____________________________</h6>
                    </div>
                    <div class="notices">
                        <div>CATATAN:</div>
                        <div class="notice">Laporan Keuangan ini hanya berlaku selama 1 bulan kedepan. Jika
                            dalam
                            laporan ini terdapat kesalahan penulisan harap untuk segera mengganti
                        </div>
                    </div>
                </main>
                <footer>
                    Laporan ini dibuat oleh komputer <br> <strong><span>Sistem Pencatatan Keuangan dan Keanggotaaan
                            Ekstrakurikuler SMA Negeri 1 Mejayan</span></strong>
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>

</body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("" . $nama_dokumen . ".pdf", 'D');
$db1->close();
?>