<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ekstrakurikuler</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Ekstrakurikuler</li>
            <li class="breadcrumb-item active" aria-current="page">Data Admin Ekstra</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Admin Ekstra</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelpembina">
                    <thead class="thead-light">
                        <tr>
                            <th>REG ADMIN</th>
                            <th>Nama Admin</th>
                            <th>Edit Data Admin</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>REG ADMIN</th>
                            <th>Nama Admin</th>
                            <th>Edit Data Admin</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tb_admin 
                        INNER JOIN tb_ekstrakurikuler ON tb_admin.id_ekstra = tb_ekstrakurikuler.id_ekstra
                        ");
                        while ($d = mysqli_fetch_array($data)) {
                            $idadmin = $d['id_admin'];
                        ?>
                        <tr>
                            <td>
                                <?php echo "ADMIN-" . $d['id_ekskul'] . "-" . $d['ekstrakurikuler'] ?>
                            </td>
                            <td>
                                <?php echo strtoupper($d['name']); ?>
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-toggle="modal"
                                    data-target="#modaladmin<?php echo $d['id_admin'] ?>"
                                    class="btn btn-primary btn-sm">EDIT DATA ADMIN
                                </a>
                            </td>

                        </tr>
                        <div class="modal fade" id="modaladmin<?php echo $d['id_admin'] ?>" tabindex="-1"
                            aria-labelledby="modalberkasLabel" aria-hidden="true">
                            <form
                                action="<?php echo $url_config . 'ekstrakurikuler.php?idadmin=' . $d['id_admin'] . '' ?>"
                                method="POST" class="form-sample needs-validation " novalidate
                                onSubmit="return validasi(this);">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                <?php echo strtoupper($d['name']) ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">REGISTRASI ADMIN</label>
                                                <p style="color: red">Dibuat oleh sistem
                                                </p>
                                                <input disabled type="text" class="form-control" id="noregadmin"
                                                    name="noregadmin"
                                                    value="<?php echo "ADMIN-" . $d['id_ekskul'] . "-" . $d['ekstrakurikuler'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Nama Admin *</label>
                                                <input type="hidden" name="idadmin" id="idadmin"
                                                    value="<?php echo $d['id_admin'] ?>">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="<?php echo $d['name'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Admin Ekstrakurikuler *</label>
                                                <select class="form-control" name="ekstra" id="ekstra" required>
                                                    <?php
                                                        $ekstradmin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_ekstra = '" . $d['id_ekstra'] . "'");
                                                        while ($d = mysqli_fetch_array($ekstradmin)) {
                                                            $ekstra = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                                                            while ($d2 = mysqli_fetch_array($ekstra)) {
                                                        ?>
                                                    <option
                                                        <?php if ($d['id_ekstra'] == $d2['id_ekstra']) echo "selected " ?>value="<?php echo $d2['id_ekstra'] ?>">
                                                        <?php echo $d2['ekstrakurikuler'] ?></option>
                                                    <?php }
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Akun SPEKTA Admin *</label>
                                                <select class="form-control" name="acc" id="acc" required>
                                                    <?php
                                                        $accadmin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin = '$idadmin'");
                                                        while ($d3 = mysqli_fetch_array($accadmin)) {
                                                            $akun = mysqli_query($conn, "SELECT * FROM tb_account 
                                                            INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                                            WHERE tb_level.id_level_name = '2'");
                                                            while ($d4 = mysqli_fetch_array($akun)) {
                                                        ?>
                                                    <option
                                                        <?php if ($d3['id_acc'] == $d4['id_acc']) echo "selected " ?>value="<?php echo $d4['id_acc'] ?>">
                                                        <?php echo $d4['email'] ?></option>
                                                    <?php }
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <p style="color: red">* = wajib diisi
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="editadmin"
                                                class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin" id="tambahPembina">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Admin</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config ?>ekstrakurikuler.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Admin</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control" autocomplete="off"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Admin Ekstrakurikuler</label>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">AKUN Admin</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="acc" id="acc" required>
                                        <?php
                                        $akun = mysqli_query($conn, "SELECT * FROM tb_account 
                                                    INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                                    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                                    WHERE tb_level.id_level_name = '2'");
                                        while ($d = mysqli_fetch_array($akun)) {
                                            echo '<option value="' . $d['id_acc'] . '">' . $d["email"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" name="addadmin" id="addadmin"
                                        class="btn btn-primary btn-md btn-block">
                                        SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once 'foot.php';
    ?>