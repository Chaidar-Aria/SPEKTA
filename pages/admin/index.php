<?php
error_reporting(0);

require_once 'head.php';
$tanggal = mktime(date("m"), date("d"), date("Y"));
date_default_timezone_set('Asia/Jakarta');
$a = date("H");
$bulan = date('m');
$tahun = date('Y');


// NAMA EKSTRA
$sqlekstra = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
INNER JOIN tb_admin ON tb_ekstrakurikuler.id_ekstra = tb_admin.id_ekstra
WHERE tb_ekstrakurikuler.id_ekstra = '$idekstra'");
while ($data = mysqli_fetch_array($sqlekstra)) {

    // DANA SEKOLAH SEKARANG
    $danasekolah = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '1' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($danasekolah)) {
        $array_danasekolah[] = $d['jumlah'];
    }
    $hitungarray_danasekolah = array_sum($array_danasekolah);
    $danasekolahsekarang = "Rp " . number_format($hitungarray_danasekolah, 2, ',', '.');

    // DANA KAS SEKARANG
    $danakas = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '2' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($danakas)) {
        $array_danakas[] = $d['jumlah'];
    }
    $hitungarray_danakas = array_sum($array_danakas);
    $danakassekarang = "Rp " . number_format($hitungarray_danakas, 2, ',', '.');

    // UANG SISA SEKARANG
    $uangsisa = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '3' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($uangsisa)) {
        $array_uangsisa[] = $d['jumlah'];
    }
    $hitungarray_uangsisa = array_sum($array_uangsisa);
    $uangsisasekarang = "Rp " . number_format($hitungarray_uangsisa, 2, ',', '.');

    // UANG USAHA SEKARANG
    $uangusaha = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '4' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($uangusaha)) {
        $array_uangusaha[] = $d['jumlah'];
    }
    $hitungarray_uangusaha = array_sum($array_uangusaha);
    $uangusahasekarang = "Rp " . number_format($hitungarray_uangusaha, 2, ',', '.');

    // UANG HIBAH SEKARANG
    $uanghibah = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '5' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($uanghibah)) {
        $array_uanghibah[] = $d['jumlah'];
    }
    $hitungarray_uanghibah = array_sum($array_uanghibah);
    $danahibahsekarang = "Rp " . number_format($hitungarray_uanghibah, 2, ',', '.');

    // UANG TAK TERDUGA SEKARANG
    $uangtakterduga = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '6' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($uangtakterduga)) {
        $array_uangtakterduga[] = $d['jumlah'];
    }
    $hitungarray_uangtakterduga = array_sum($array_uangtakterduga);
    $danatakterdugasekarang = "Rp " . number_format($hitungarray_uangtakterduga, 2, ',', '.');

    // UANG LAIN SEKARANG
    $uanglain = mysqli_query($conn, "SELECT * from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_sumber = '7' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($uanglain)) {
        $array_uanglain[] = $d['jumlah'];
    }
    $hitungarray_uanglain = array_sum($array_uanglain);
    $danalainsekarang = "Rp " . number_format($hitungarray_uanglain, 2, ',', '.');

    // KEGIATAN TAHUNAN SEKARANG
    $kegiatantahunan = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '8' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatantahunan)) {
        $array_kegiatantahunan[] = $d['jumlah'];
    }
    $hitungarray_kegiatantahunan = array_sum($array_kegiatantahunan);
    $kegiatantahunansekarang = "Rp " . number_format($hitungarray_kegiatantahunan, 2, ',', '.');


    // KEGIATAN BESAR SEKARANG
    $kegiatanbesar = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '9' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatanbesar)) {
        $array_kegiatanbesar[] = $d['jumlah'];
    }
    $hitungarray_kegiatanbesar = array_sum($array_kegiatanbesar);
    $kegiatanbesarsekarang = "Rp " . number_format($hitungarray_kegiatanbesar, 2, ',', '.');

    // KEGIATAN RUTIN SEKARANG
    $kegiatanrutin = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '10' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatanrutin)) {
        $array_kegiatanrutin[] = $d['jumlah'];
    }
    $hitungarray_kegiatanrutin = array_sum($array_kegiatanrutin);
    $kegiatanrutinsekarang = "Rp " . number_format($hitungarray_kegiatanrutin, 2, ',', '.');

    // KEGIATAN LOMBA SEKARANG
    $kegiatanlomba = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '11' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatanlomba)) {
        $array_kegiatanlomba[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlomba = array_sum($array_kegiatanlomba);
    $kegiatanlombasekarang = "Rp " . number_format($hitungarray_kegiatanlomba, 2, ',', '.');

    // KEGIATAN KHUSUS SEKARANG
    $kegiatankhusus = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '12' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatankhusus)) {
        $array_kegiatankhusus[] = $d['jumlah'];
    }
    $hitungarray_kegiatankhusus = array_sum($array_kegiatankhusus);
    $kegiatankhusussekarang = "Rp " . number_format($hitungarray_kegiatankhusus, 2, ',', '.');

    // KEGIATAN LAIN SEKARANG
    $kegiatanlain = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_sumber = '13' AND id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($kegiatanlain)) {
        $array_kegiatanlain[] = $d['jumlah'];
    }
    $hitungarray_kegiatanlain = array_sum($array_kegiatanlain);
    $kegiatanlainsekarang = "Rp " . number_format($hitungarray_kegiatanlain, 2, ',', '.');



    // PEMASUKAN BULANAN

    $masukbulanan = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan' AND id_ekstra = '$idekstra' AND id_ekstra = '$idekstra'");
    while ($hasilmasukbulanan = mysqli_fetch_array($masukbulanan)) {
        $arraymasukbulanan[] = $hasilmasukbulanan['jumlah'];
    }

    // PENGELUARAN BULANAN
    $keluarbulanan = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan' AND id_ekstra = '$idekstra'");
    while ($hasilkeluarbulanan = mysqli_fetch_array($keluarbulanan)) {
        $arraykeluarbulanan[] = $hasilkeluarbulanan['jumlah'];
    }

    //PEMASUKAN TAHUNAN
    $masuktahun = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE YEAR(tgl_pemasukan) = '$tahun' AND id_ekstra = '$idekstra'");
    while ($hasilmasuktahunan = mysqli_fetch_array($masuktahun)) {
        $arraymasuktahun[] = $hasilmasuktahunan['jumlah'];
    }

    //PENGELUARAN TAHUNAN
    $keluartahun = mysqli_query($conn, "SELECT jumlah from tb_uang_keluar WHERE YEAR(tgl_pengeluaran) = '$tahun' AND id_ekstra = '$idekstra'");
    while ($hasilkeluartahunan = mysqli_fetch_array($keluartahun)) {
        $arraykeluartahun[] = $hasilkeluartahunan['jumlah'];
    }
    $bulanseb = date('m', strtotime(date('Y-m') . " -1 month")); //BULAN SEBELUMNYA

    // PERSENTASE PEMASUKAN PERBULAN

    $masukbulananseb = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulanseb' AND id_ekstra = '$idekstra'");
    while ($hasilmasukbulananseb = mysqli_fetch_array($masukbulananseb)) {
        $arraymasukbulananseb[] = $hasilmasukbulananseb['jumlah'];
    }
    $hitunghasilmasukbulananseb = array_sum($arraymasukbulananseb);

    // PERSENTASE PENGELUARAN BULANAN
    $keluarbulananseb = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulanseb' AND id_ekstra = '$idekstra'");
    while ($hasilkeluarbulananseb = mysqli_fetch_array($keluarbulananseb)) {
        $arraykeluarbulananseb[] = $hasilkeluarbulananseb['jumlah'];
    }
    $hitunghasilkeluarbulananseb = array_sum($arraykeluarbulananseb);


    $tahunseb = date('Y', strtotime(date('Y-m') . " -1 years")); //TAHUN SEBELUMNYA

    // PERSENTASE PEMASUKAN TAHUNAN
    $masuktahunseb = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE YEAR(tgl_pemasukan) = '$tahunseb' AND id_ekstra = '$idekstra'");
    while ($hasilmasuktahunanseb = mysqli_fetch_array($masuktahunseb)) {
        $arraymasuktahunseb[] = $hasilmasuktahunanseb['jumlah'];
    }
    $hitunghasilmasuktahunseb = array_sum($arraymasuktahunseb);


    // PERSENTASE PENGELUARAN TAHUNAN
    $keluartahunseb = mysqli_query($conn, "SELECT jumlah from tb_uang_keluar WHERE YEAR(tgl_pengeluaran) = '$tahunseb' AND id_ekstra = '$idekstra'");
    while ($hasilkeluartahunanseb = mysqli_fetch_array($keluartahunseb)) {
        $arraykeluartahunseb[] = $hasilkeluartahunanseb['jumlah'];
    }
    $hitunghasilkeluartahunseb = array_sum($arraykeluartahunseb);

    //HITUNG PEMBINA
    $hitungteacher = mysqli_query($conn, "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        INNER JOIN tb_pembina ON tb_pembina.id_acc = tb_account.id_acc
        INNER JOIN tb_bina_ekstra ON tb_pembina.id_pembina = tb_bina_ekstra.id_pembina
        INNER JOIN tb_ekstrakurikuler ON tb_ekstrakurikuler.id_ekstra = tb_bina_ekstra.id_ekstra
        WHERE tb_level_name.level_name = 'TEACHER' AND tb_ekstrakurikuler.id_ekstra='$idekstra'");
    $totalteacher = mysqli_num_rows($hitungteacher);

    //HITUNG USER 1 
    $hitungusers = mysqli_query($conn, "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        INNER JOIN tb_users ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_level_name.level_name = 'USER' AND tb_users.id_ekstra_1='$idekstra' OR tb_users.id_ekstra_2='$idekstra'");
    $totalusers = mysqli_num_rows($hitungusers);

    //HITUNG KEGIATAN
    $totalkeg = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra WHERE id_ekstra = '$idekstra'"));

?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <?php if (($a >= 6) && ($a <= 10)) {
                    echo "<b>Selamat Pagi !!</b>";
                } else if (($a > 10) && ($a <= 15)) {
                    echo "Selamat Siang !!";
                } else if (($a > 15) && ($a <= 18)) {
                    echo "Selamat Sore !!";
                } else {
                    echo "<b> Selamat Malam </b>";
                } ?>
            <strong>ADMIN-<?php echo $data['id_ekskul'] . "-" . $data['ekstrakurikuler'] ?></strong>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $url_admin ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pembina</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalteacher ?></div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Anggota</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php echo $totalusers ?></div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Kegiatan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalkeg ?></div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pemasukan (Bulanan)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $hitunghasilmasukbulanan = array_sum($arraymasukbulanan);
                                    echo "Rp " . number_format($hitunghasilmasukbulanan, 2, ',', '.'); ?>
                            </div>
                            <?php if ($hitunghasilmasukbulananseb > $hitunghasilmasukbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                </span>
                                <span>Terjadi Penurunan</span>
                            </div>
                            <?php } else if ($hitunghasilmasukbulananseb < $hitunghasilmasukbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                </span>
                                <span>Terjadi Kenaikan</span>
                            </div>
                            <?php } else if ($hitunghasilmasukbulananseb == $hitunghasilmasukbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai Sama</span>
                            </div>
                            <?php }  ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pengeluaran (Bulanan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $hitunghasilkeluarbulanan = array_sum($arraykeluarbulanan);

                                    echo "Rp " . number_format($hitunghasilkeluarbulanan, 2, ',', '.');
                                    ?></div>
                            <?php if ($hitunghasilkeluarbulananseb > $hitunghasilkeluarbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                </span>
                                <span>Terjadi Penurunan</span>
                            </div>
                            <?php } else if ($hitunghasilkeluarbulananseb < $hitunghasilkeluarbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                </span>
                                <span>Terjadi Kenaikan</span>
                            </div>
                            <?php } else if ($hitunghasilkeluarbulananseb == $hitunghasilkeluarbulanan) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai Sama</span>
                            </div>
                            <?php }  ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pemasukan (Tahunan)</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                    $hitunghasilmasuktahun = array_sum($arraymasuktahun);
                                    echo "Rp " . number_format($hitunghasilmasuktahun, 2, ',', '.');
                                    ?>
                            </div>
                            <?php if ($hitunghasilmasuktahunseb > $hitunghasilmasuktahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                </span>
                                <span>Terjadi Penurunan</span>
                            </div>
                            <?php } else if ($hitunghasilmasuktahunseb < $hitunghasilmasuktahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                </span>
                                <span>Terjadi Kenaikan</span>
                            </div>
                            <?php } else if ($hitunghasilmasuktahunseb == $hitunghasilmasuktahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai Sama</span>
                            </div>
                            <?php }  ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengeluaran (Tahunan)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $hitunghasilkeluartahun = array_sum($arraykeluartahun);
                                    echo "Rp " . number_format($hitunghasilkeluartahun, 2, ',', '.');
                                    ?>
                            </div>
                            <?php if ($hitunghasilkeluartahunseb > $hitunghasilkeluartahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                </span>
                                <span>Terjadi Penurunan</span>
                            </div>
                            <?php } else if ($hitunghasilkeluartahunseb < $hitunghasilkeluartahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                </span>
                                <span>Terjadi Kenaikan</span>
                            </div>
                            <?php } else if ($hitunghasilkeluartahunseb == $hitunghasilkeluartahun) { ?>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai Sama</span>
                            </div>
                            <?php }  ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pemasukan Bulanan (dalam rupiah)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="grafik_garis1"></canvas>
                    </div>
                    <script>
                    var ctx = document.getElementById("grafik_garis1").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Dana Sekolah", "Uang Kas", "Uang Sisa", "Uang Usaha", "Uang Hibah",
                                "Uang Tak Terduga", "Uang lain-lain"
                            ],
                            datasets: [{
                                label: '',
                                data: [
                                    <?php echo $hitungarray_danasekolah ?>,
                                    <?php echo $hitungarray_danakas ?>,
                                    <?php echo $hitungarray_uangsisa ?>,
                                    <?php echo $hitungarray_uangusaha ?>,
                                    <?php echo $hitungarray_uanghibah ?>,
                                    <?php echo $hitungarray_uangtakterduga ?>,
                                    <?php echo $hitungarray_uanglain ?>
                                ],
                                backgroundColor: [
                                    '#EA2027',
                                    '#EE5A24',
                                    '#F79F1F',
                                    '#FFC312',
                                    '#C4E538',
                                    '#A3CB38',
                                    '#009432'
                                ],
                                borderColor: [
                                    '#EA2027',
                                    '#EE5A24',
                                    '#F79F1F',
                                    '#FFC312',
                                    '#C4E538',
                                    '#A3CB38',
                                    '#009432'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran Bulanan (dalam rupiah)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="grafik_garis2"></canvas>
                    </div>
                    <script>
                    var ctx = document.getElementById("grafik_garis2").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Kegiatan Tahunan", "Kegiatan Besar", "Kegiatan Rutin", "Kegiatan Lomba",
                                "Kegiatan Khusus", "Kegiatan lain-lain"
                            ],
                            datasets: [{
                                label: '',
                                data: [
                                    <?php echo $hitungarray_kegiatantahunan ?>,
                                    <?php echo $hitungarray_kegiatanbesar ?>,
                                    <?php echo $hitungarray_kegiatanrutin ?>,
                                    <?php echo $hitungarray_kegiatanlomba ?>,
                                    <?php echo $hitungarray_kegiatankhusus ?>,
                                    <?php echo $hitungarray_kegiatanlain ?>,
                                ],
                                backgroundColor: [
                                    '#EA2027',
                                    '#EE5A24',
                                    '#F79F1F',
                                    '#FFC312',
                                    '#C4E538',
                                    '#A3CB38'
                                ],
                                borderColor: [
                                    '#EA2027',
                                    '#EE5A24',
                                    '#F79F1F',
                                    '#FFC312',
                                    '#C4E538',
                                    '#A3CB38'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    <?php
}
require_once 'foot.php';
    ?>