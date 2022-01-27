<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Keuangan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Keuangan</li>
            <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
        </ol>
    </div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Uang Masuk</th>
                            <th>Tanggal Uang Masuk</th>
                            <th>Jumlah Uang Masuk</th>
                            <th>Sumber Uang Masuk</th>
                            <th>Aksi</th>
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
                            <td>
                                <a class="btn btn-danger btn-sm"
                                    href="<?php echo $url_config . 'del_moneyin.php?id_pemasukan=' . $d['id_pemasukan']; ?>">
                                    DELETE
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin" id="tambahPemasukan">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Pemasukan</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config ?>data_money.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah Uang</label>
                                <div class="col-sm-9">
                                    <input type="number" name="jumlahmasuk" id="jumlahmasuk" class="form-control"
                                        autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Masuk Uang</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tglmasuk" id="tglmasuk" class="form-control"
                                        autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Sumber Uang</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="sumbermasuk" id="sumbermasuk" required>
                                        <option selected value="">PILIH SUMBER UANG
                                        </option>
                                        <?php
                                        $data = mysqli_query($conn, "SELECT * FROM tb_sumber_uang LIMIT 0,7");
                                        $no = 1;
                                        $noo = 1;
                                        while ($d = mysqli_fetch_array($data)) {
                                            echo '<option value="' . $no++ . '">' . $d["nama"] . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ekstrakurikuler</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ekstra" id="ekstra" autocomplete="off" required>
                                        <option selected value="">PILIH EKSTRAKURIKULER
                                        </option>
                                        <?php
                                        $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                                        while ($d = mysqli_fetch_array($data)) {
                                            echo '<option value="' . $d['id_ekstra'] . '">' . $d['id_ekskul'] . '-' . strtoupper($d["ekstrakurikuler"]) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="uangmasuk">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Row-->

    <?php
    require_once 'foot.php';
    ?>