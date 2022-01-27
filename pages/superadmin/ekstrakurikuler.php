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

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Ekstrakurikuler</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelekskul">
                    <thead class="thead-light">
                        <tr>
                            <th>ID EKSTRAKURIKULER</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID EKSTRAKURIKULER</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td>
                                <?php echo $d['id_ekskul'] ?>
                            </td>
                            <td><?php echo strtoupper($d['ekstrakurikuler']); ?>
                                <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM tb_bina_ekstra WHERE id_ekstra = '" . $d['id_ekstra'] . "'";
                                    $r = mysqli_query($conn, $sql);
                                    $r_cek = mysqli_num_rows($r);
                                    if ($r_cek > 0) {
                                        echo "<br>Pembina:";
                                        $sql = "SELECT * FROM tb_bina_ekstra
                        INNER JOIN tb_ekstrakurikuler ON tb_bina_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
                        INNER JOIN tb_pembina ON tb_bina_ekstra.id_pembina = tb_pembina.id_pembina
                        WHERE tb_ekstrakurikuler.id_ekstra = '" . $d['id_ekstra'] . "'";
                                        $r = mysqli_query($conn, $sql);
                                        while ($d1 = mysqli_fetch_array($r)) { ?>
                                <p><?php echo $no++ . ' . ' . $d1['nip'] . '-' . $d1['name'] ?></p>
                                <?php }
                                    } else { ?>
                                <p>Pembina belum ditambahkan</p>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-toggle="modal"
                                    data-target="#modalekskul<?php echo $d['id_ekstra'] ?>" class="btn btn-primary">EDIT
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="modalekskul<?php echo $d['id_ekstra'] ?>" tabindex="-1"
                            aria-labelledby="modalberkasLabel" aria-hidden="true">
                            <form action="<?php echo $url_config . 'ekstrakurikuler.php' ?>" method="POST"
                                class="form-sample needs-validation " novalidate onSubmit="return validasi(this);">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                <?php echo $d['ekstrakurikuler'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">ID Ekstrakurikuler</label>
                                                <p style="color: red">ID ini dibuat otomatis oleh sistem
                                                </p>
                                                <input type="number" class="form-control" id="idekskul" name="idekskul"
                                                    value="<?php echo $d['id_ekskul'] ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Nama Ekstrakurikuler *</label>
                                                <input type="hidden" name="idekstra" id="idekstra"
                                                    value="<?php echo $d['id_ekstra'] ?>">
                                                <input type="text" class="form-control" id="ekstrakurikuler"
                                                    name="ekstrakurikuler" value="<?php echo $d['ekstrakurikuler'] ?>">
                                            </div>
                                            <p style="color: red">* = wajib diisi
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="editekstra"
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
    <div class="col-12 grid-margin" id="tambahEkstrakurikuler">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Ekstrakurikuler</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config ?>ekstrakurikuler.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Ekstrakurikuler</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ekstrakurikuler" id="ekstrakurikuler" class="form-control"
                                        autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="addekstra">Submit</button>
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