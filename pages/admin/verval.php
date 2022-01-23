<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi dan Validasi anggota</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi dan Validasi</li>
        </ol>
    </div>
    <?php
    $query = "SELECT * FROM tb_auth_settings";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        if (date("Y-m-d") >= $row['date_open_reg'] && date("Y-m-d") <= $row['date_close_reg']) {

    ?>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Verfiikasi dan Validasi</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelverval">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Calon Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Calon Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                                $data = mysqli_query($conn, "SELECT * FROM tb_users
                                        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
                                        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users 
                                        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                        WHERE tb_level.id_level_name = '4' AND tb_users_status.is_permanent = '1' AND tb_users_status.is_tolak = '0'");
                                while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo strtoupper($d['name']); ?></td>
                            <td>
                                <?php if ($d['gender'] == 'L') { ?>
                                LAKI-LAKI
                                <?php } else if ($d['gender'] == 'P') { ?>
                                PEREMPUAN
                                <?php } ?>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($d['updated_at'])); ?></td>
                            <td> <?php if ($d['is_verval'] == '0') { ?>
                                <div class="badge badge-warning">PENDING</div>
                                <?php } else if ($d['is_verval'] == '1') { ?>
                                <div class="badge badge-success">TERVERIFIKASI</div> <br>
                                <small>
                                    <?php echo $d['verval_at']; ?>
                                </small>
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo $url_admin . 'showverval?id_users=' . $d['id_users']; ?>"
                                    class="badge badge-primary">Edit</a></td>
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
                <h6 class="m-0 font-weight-bold text-primary">Data Tolak Verfikasi dan Validasi</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabeltolak">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Calon Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Calon Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                                $data = mysqli_query($conn, "SELECT * FROM tb_users
                                        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
                                        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users 
                                        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                        WHERE tb_level.id_level_name = '4' AND tb_users_status.is_permanent = '1' AND tb_users_status.is_tolak = '1'");
                                while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo strtoupper($d['name']); ?></td>
                            <td>
                                <?php if ($d['gender'] == 'L') { ?>
                                LAKI-LAKI
                                <?php } else if ($d['gender'] == 'P') { ?>
                                PEREMPUAN
                                <?php } ?>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($d['updated_at'])); ?></td>
                            <td> <?php if ($d['is_tolak'] == '1') { ?>
                                <div class="badge badge-danger">DITOLAK</div>
                                <?php } ?>
                            </td>
                            <td><?php echo $d['alasan_tolak']; ?></td>
                            <td><a href="<?php echo $url_admin . 'showverval?id_users=' . $d['id_users']; ?>"
                                    class="badge badge-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-lg-12">
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column justify-content-center">
                        <h5 data-aos="fade-up">PENDAFTARAN ANGGOTA BARU EKSTRAKURIKULER SMA NEGERI 1 MEJAYAN TAHUN
                            <?php echo date("Y") ?> DITUTUP</h5>
                        <h6 data-aos="fade-up" data-aos-delay="400">HALAMAN VERIFIKASI DAN VALIDASI DITUTUP
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
    } ?>
    <?php
    require_once 'foot.php';
    ?>