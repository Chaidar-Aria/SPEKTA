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
            <li class="breadcrumb-item active" aria-current="page">Data Pembina</li>
        </ol>
    </div>
    <?php
    $idpembina = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM tb_pembina WHERE id_pembina='$idpembina'");
    while ($d = mysqli_fetch_array($data)) {
        $sql = "SELECT * FROM tb_bina_ekstra WHERE id_pembina = '" . $d['id_pembina'] . "'";
        $r = mysqli_query($conn, $sql);
        $r_cek = mysqli_num_rows($r);
        if ($r_cek == 0) { ?>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembina Ekstrakurikuler</h6>
            </div>
            <form action="<?php echo $url_config . 'ekstrakurikuler.php' ?>" method="POST"
                class="form-sample needs-validation " novalidate onSubmit="return validasi(this);">
                <div class="card-body">
                    <h4 class="card-title">SILAHKAN PILIH EKSTRAKURIKULER YANG DIBINA OLEH
                        <?php echo $d['name'] ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ekstrakurikuler yang dibina</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="acc" id="acc" value="<?php echo $idpembina ?>">
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
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" name="addbinaekstra" id="addbinaekstra"
                                    class="btn btn-info btn-md btn-block">
                                    SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php } else {
            $sql = "SELECT * FROM tb_bina_ekstra
                        INNER JOIN tb_ekstrakurikuler ON tb_bina_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
                        INNER JOIN tb_pembina ON tb_bina_ekstra.id_pembina = tb_pembina.id_pembina
                        WHERE tb_pembina.id_pembina = '" . $d['id_pembina'] . "'";
            $r = mysqli_query($conn, $sql);
            while ($d1 = mysqli_fetch_array($r)) {
            ?>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembina Ekstrakurikuler</h6>
            </div>
            <form action="<?php echo $url_config . 'ekstrakurikuler.php?acc=' . $idpembina . '' ?>" method="POST"
                class="form-sample needs-validation " novalidate onSubmit="return validasi(this);">
                <div class="card-body">
                    <h4 class="card-title">SILAHKAN PILIH EKSTRAKURIKULER YANG DIBINA OLEH
                        <?php echo $d['name'] ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ekstrakurikuler yang dibina</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ekstra" id="ekstra" autocomplete="off" required>
                                        <option selected value="<?php echo $d1['id_ekstra'] ?>">
                                            <?php echo $d1['id_ekskul'] . '-' . $d1['ekstrakurikuler'] ?>
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
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" name="editbinaekstra" id="editbinaekstra"
                                    class="btn btn-info btn-md btn-block">
                                    SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php }
        }
    } ?>
    <?php
    require_once 'foot.php';
    ?>