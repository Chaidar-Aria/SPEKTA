<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Akun SPEKTA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Data Akun SPEKTA</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Akun SPEKTA</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelaccount">
                    <thead class="thead-light">
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status Akun</th>
                            <th>Dibuat tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status Akun</th>
                            <th>Dibuat tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        $data = mysqli_query($conn, "SELECT * FROM tb_account 
                                                    INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                                    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                                    WHERE tb_level.id_level_name != '1'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $d['email']; ?></td>
                            <td><?php echo $d['level_name']; ?></td>
                            <td class="font-weight-medium">
                                <form action="<?php echo $url_config . 'stats_acc.php?id_acc=' . $d['id_acc'] ?>"
                                    method="post">
                                    <?php if ($d['is_active'] == 0) { ?>
                                    <button type="submit" name="aktif" class="btn btn-sm btn-danger">NON
                                        AKTIF
                                    </button>
                                    <?php } else { ?>
                                    <button type="submit" name="nonaktif" class="btn btn-sm btn-success">AKTIF
                                    </button>
                                    <?php } ?>
                                </form>
                            </td>
                            <td>
                                <?php echo $d['created_at']; ?>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm"
                                    href="<?php echo $url_config . 'del_acc.php?id_acc=' . $d['id_acc']; ?>">
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
    <div class="col-12 grid-margin" id="tambahAkun">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Akun</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config ?>create_acc.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" class="form-control" autocomplete="off"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input name="password" id="password" type="password" class="form-control"
                                        onkeyup='check();' autocomplete="off" required />
                                    <span id="StrengthDisp" class="badge displayBadge mt-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input name="confirm_password" id="confirm_password" type="password"
                                        class="form-control" onkeyup='check();' autocomplete="off" required />
                                    <span id='message' class="mt-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="level" id="level" required>
                                        <?php
                                        $lv_sql = mysqli_query($conn, "SELECT * FROM tb_level_name WHERE id_level_name !='1'") or die(mysqli_error($conn));
                                        while ($lv = mysqli_fetch_array($lv_sql)) {
                                            echo '<option value="' . $lv['id_level_name'] . '">' . $lv["level_name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="addacc">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    require_once 'foot.php';
    ?>