<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$bulan = date('m');
$tahun = date('Y');

// PEMASUKAN BULANAN

$masukbulanan = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE MONTH(tgl_pemasukan) = '$bulan'");
while ($hasilmasukbulanan = mysqli_fetch_array($masukbulanan)) {
    $arraymasukbulanan[] = $hasilmasukbulanan['jumlah'];
}

// PENGELUARAN BULANAN
$keluarbulanan = mysqli_query($conn, "SELECT * from tb_uang_keluar WHERE MONTH(tgl_pengeluaran) = '$bulan'");
while ($hasilkeluarbulanan = mysqli_fetch_array($keluarbulanan)) {
    $arraykeluarbulanan[] = $hasilkeluarbulanan['jumlah'];
}

//PEMASUKAN TAHUNAN
$masuktahun = mysqli_query($conn, "SELECT jumlah from tb_uang_masuk WHERE YEAR(tgl_pemasukan) = '$tahun'");
while ($hasilmasuktahunan = mysqli_fetch_array($masuktahun)) {
    $arraymasuktahun[] = $hasilmasuktahunan['jumlah'];
}

//PENGELUARAN TAHUNAN
$keluartahun = mysqli_query($conn, "SELECT jumlah from tb_uang_keluar WHERE YEAR(tgl_pengeluaran) = '$tahun'");
while ($hasilkeluartahunan = mysqli_fetch_array($keluartahun)) {
    $arraykeluartahun[] = $hasilkeluartahunan['jumlah'];
}



?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Keuangan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keuangan</li>
        </ol>
    </div>

    <div class="row">
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
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                    3.48%</span>
                                <span>Since last month</span>
                            </div>
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
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    12%</span>
                                <span>Since last years</span>
                            </div>
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
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    20.4%</span>
                                <span>Since last month</span>
                            </div>
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
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                    1.10%</span>
                                <span>Since yesterday</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">LAPORAN KEUANGAN (BULANAN)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo 'Laporan Bulan ' . date('F', strtotime(date('Y-m') . " -1 month")); ?> Telah
                                Tersedia !
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Laporan keuangan bulanan ini berlaku sampai dengan dikeluarkannya laporan keuangan
                                    bulan selanjutnnya</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="money_report" target="BLANK"><i class="fas fa-download fa-2x text-success"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">LAPORAN KEUANGAN (TAHUNAN)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo 'Laporan Akhir Tahun ' . date('Y', strtotime(date('Y') . " -1 year")); ?>
                                Telah
                                Tersedia !
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Laporan keuangan tahunan ini berlaku sampai dengan dikeluarkannya laporan keuangan
                                    tahunan selanjutnnya</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="tabeluangmasuk">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Uang Masuk</th>
                                <th>Tanggal Uang Masuk</th>
                                <th>Jumlah Uang Masuk</th>
                                <th>Sumber Uang Masuk</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kode Uang Masuk</th>
                                <th>Tanggal Uang Masuk</th>
                                <th>Jumlah Uang Masuk</th>
                                <th>Sumber Uang Masuk</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php

                            $data = mysqli_query($conn, "SELECT * FROM tb_uang_masuk
                                                    INNER JOIN tb_sumber_uang ON tb_uang_masuk.id_sumber = tb_sumber_uang.id_sumber");
                            while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?php echo $d['kode_uang_masuk']; ?></td>
                                <td><?php echo $d['tgl_pemasukan']; ?></td>
                                <td><?php echo "Rp " . number_format($d['jumlah'], 2, ',', '.'); ?></td>
                                <td><?php echo $d['nama']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="tabeluangkeluar">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Uang Keluar</th>
                                <th>Tanggal Uang Keluar</th>
                                <th>Jumlah Uang Keluar</th>
                                <th>Sumber Uang Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kode Uang Keluar</th>
                                <th>Tanggal Uang Keluar</th>
                                <th>Jumlah Uang Keluar</th>
                                <th>Sumber Uang Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php

                            $data = mysqli_query($conn, "SELECT * FROM tb_uang_keluar
                                                    INNER JOIN tb_sumber_uang ON tb_uang_keluar.id_sumber = tb_sumber_uang.id_sumber");
                            while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?php echo $d['kode_uang_keluar']; ?></td>
                                <td><?php echo $d['tgl_pengeluaran']; ?></td>
                                <td><?php echo "Rp " . number_format($d['jumlah'], 2, ',', '.'); ?></td>
                                <td><?php echo $d['nama']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    <?php
    require_once 'foot.php';
    ?>