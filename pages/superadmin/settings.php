<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$query = "SELECT * FROM tb_auth_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $query2 = "SELECT * FROM tb_web_settings";
    $result2 = $conn->query($query2);
    while ($row2 = $result2->fetch_assoc()) {
        $query3 = "SELECT * FROM tb_app_settings";
        $result3 = $conn->query($query3);
        while ($row3 = $result3->fetch_assoc()) {
?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <strong>Setelan Aplikasi</strong>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $url_superadmin ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setelan Aplikasi</li>
        </ol>
    </div>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Aplikasi</h5>
                <div class="row">
                    <form class="row g-3 ml-3 mr-3">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Nama Aplikasi</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Versi Aplikasi</label>
                            <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2"
                                placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Halaman Registrasi Akun
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <form action="<?php echo $url_config . 'settings.php' ?>" method="post" id="setregis">
                                    <?php if ($row['is_regis'] == '1') { ?>
                                    <button type="submit" name="regisoff" id="regisoff"
                                        class="btn-shadow btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                                        title="Klik untuk menonaktifkan">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-check fa-w-20"></i>
                                        </span>
                                        Nonaktifkan Halaman Registrasi
                                    </button>
                                    <?php } else { ?>
                                    <button type="submit" name="regison" id="regisoff"
                                        class="btn-shadow btn btn-success" data-toggle="tooltip" data-placement="bottom"
                                        title="Klik untuk mengaktifkan">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        Aktifkan Halaman Registrasi
                                    </button>
                                    <?php } ?>
                                </form>
                            </div>
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
                                <span class="text-danger mr-2d"><i class="fas fa-arrow-down"></i>
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
        }
    }
}
    ?>