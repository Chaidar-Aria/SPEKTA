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

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembina</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelpembina">
                    <thead class="thead-light">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tb_pembina");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td>
                                <?php echo $d['nip'] ?>
                            </td>
                            <td>
                                <?php echo strtoupper($d['name']); ?>
                            </td>
                            <td><a href="<?php echo $url_superadmin . 'showmember?id_pembina=' . $d['id_pembina']; ?>"
                                    class="badge badge-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin" id="tambahPembina">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Pembina</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config ?>ekstrakurikuler.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Pembina</label>
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
                                <label class="col-sm-3 col-form-label">NIP Pembina</label>
                                <div class="col-sm-9">
                                    <input type="number" name="nip" id="nip" class="form-control" autocomplete="off"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="addpembina">Submit</button>
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