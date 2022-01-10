<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$tanggal = mktime(date("m"), date("d"), date("Y"));
date_default_timezone_set('Asia/Jakarta');
$a = date("H");
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

//HITUNG ADMIN
$hitungadmin = mysqli_query($conn, "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        WHERE tb_level_name.level_name = 'ADMIN'");
$totaladmin = mysqli_num_rows($hitungadmin);

//HITUNG TEACHER
$hitungteacher = mysqli_query($conn, "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        WHERE tb_level_name.level_name = 'TEACHER'");
$totalteacher = mysqli_num_rows($hitungteacher);

//HITUNG USER
$hitungusers = mysqli_query($conn, "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        WHERE tb_level_name.level_name = 'USER'");
$totalusers = mysqli_num_rows($hitungusers);

//HITUNG EKSTRAKURIKULER
$hitungekskul = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
$totalekskul = mysqli_num_rows($hitungekskul);
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <?php if (($a >= 6) && ($a <= 10)) {
                echo "<b>Selamat Pagi</b>";
            } else if (($a > 10) && ($a <= 15)) {
                echo "Selamat Siang";
            } else if (($a > 15) && ($a <= 18)) {
                echo "Selamat Sore";
            } else {
                echo "<b> Selamat Malam </b>";
            } ?>
            <strong>ADMIN</strong>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $url_superadmin ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaladmin ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                    3.48%</span>
                                <span>Since last month</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalteacher ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    12%</span>
                                <span>Since last years</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Users</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalusers ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    20.4%</span>
                                <span>Since last month</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Ekstrakurikuler
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalekskul ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                    1.10%</span>
                                <span>Since yesterday</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
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
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                    3.48%</span>
                                <span>Since last month</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
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
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
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
                            <i class="fas fa-users fa-2x text-info"></i>
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
                            <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" height="20">
                        <canvas id="userchart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Month <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Select Periode</div>
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Week</a>
                            <a class="dropdown-item active" href="#">Month</a>
                            <a class="dropdown-item" href="#">This Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="small text-gray-500">Oblong T-Shirt
                            <div class="small float-right"><b>600 of 800 Items</b></div>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Gundam 90'Editions
                            <div class="small float-right"><b>500 of 800 Items</b></div>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Rounded Hat
                            <div class="small float-right"><b>455 of 800 Items</b></div>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Indomie Goreng
                            <div class="small float-right"><b>400 of 800 Items</b></div>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Remote Control Car Racing
                            <div class="small float-right"><b>200 of 800 Items</b></div>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-primary card-link" href="#">View More <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Invoice Example -->
        <div class="col-xl-8 col-lg-7 mb-4 mt-5">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                    <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">RA0449</a></td>
                                <td>Udin Wayang</td>
                                <td>Nasi Padang</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA5324</a></td>
                                <td>Jaenab Bajigur</td>
                                <td>Gundam 90' Edition</td>
                                <td><span class="badge badge-warning">Shipping</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA8568</a></td>
                                <td>Rivat Mahesa</td>
                                <td>Oblong T-Shirt</td>
                                <td><span class="badge badge-danger">Pending</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA1453</a></td>
                                <td>Indri Junanda</td>
                                <td>Hat Rounded</td>
                                <td><span class="badge badge-info">Processing</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA1998</a></td>
                                <td>Udin Cilok</td>
                                <td>Baby Powder</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <!-- Message From Customer-->
        <div class="col-xl-4 col-lg-5 ">
            <div class="card">
                <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
                </div>
                <div>
                    <div class="customer-message align-items-center">
                        <a class="font-weight-bold" href="#">
                            <div class="text-truncate message-title">Hi there! I am wondering if you can
                                help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok ·
                                58m</div>
                        </a>
                    </div>
                    <div class="customer-message align-items-center">
                        <a href="#">
                            <div class="text-truncate message-title">But I must explain to you how all
                                this mistaken idea
                            </div>
                            <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                        </a>
                    </div>
                    <div class="customer-message align-items-center">
                        <a class="font-weight-bold" href="#">
                            <div class="text-truncate message-title">Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit
                            </div>
                            <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau
                                · 25m</div>
                        </a>
                    </div>
                    <div class="customer-message align-items-center">
                        <a class="font-weight-bold" href="#">
                            <div class="text-truncate message-title">At vero eos et accusamus et iusto
                                odio dignissimos
                                ducimus qui blanditiis
                            </div>
                            <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang ·
                                54m</div>
                        </a>
                    </div>
                    <div class="card-footer text-center">
                        <a class="m-0 small text-primary card-link" href="#">View More <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    <?php
    require_once 'foot.php';
    ?>