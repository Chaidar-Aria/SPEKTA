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
            <li class="breadcrumb-item active" aria-current="page">Data Ekstrakurikuler</li>
        </ol>
    </div>

    <?php
    $id_ekstra = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                        INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra
                        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
                        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc WHERE tb_account.level = 'TEACHER'
                        ");
    while ($d = mysqli_fetch_array($data)) { ?>
    <div class="col-12 grid-margin" id="editEkstrakurikuler">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Ekstrakurikuler <?php echo $d['ekstrakurikuler']; ?></h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config . 'ekstrakurikuler.php?id_ekstra=' . $id_ekstra ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Ekstrakurikuler</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ekstrakurikuler" id="ekstrakurikuler" class="form-control"
                                        autocomplete="off" required value="<?php echo $d['ekstrakurikuler']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pembina</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pembina" required>
                                        <?php
                                            echo '<option value="' . $d['id_users'] . '">' . $d["name"] . '</option>';
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="editekstra">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php } ?>

    <?php
    require_once 'foot.php';
    ?>