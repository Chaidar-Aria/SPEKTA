<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Diri Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
        </ol>
    </div>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM tb_admin 
    INNER JOIN tb_ekstrakurikuler ON tb_ekstrakurikuler.id_ekstra = tb_admin.id_ekstra
    WHERE tb_admin.id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($sql)) {
    ?>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config . 'verval.php?id_admin=' . $d['id_admin']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="<?php echo $d['name']; ?>" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Admin Ekstrakurikuler</label>
                                <div class="col-sm-9 mt-2">
                                    <p><?php echo $d['ekstrakurikuler'] ?></p>
                                    <p style="color:red">Bila ingin mengajukan pergantian admin ekstrakurikuler harap
                                        menghubungi
                                        administrator</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-block text-center card-footer">
                        <button type="submit" class="btn-wide btn btn-success" name="editadmin">SIMPAN DATA</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    require_once 'foot.php';
    ?>