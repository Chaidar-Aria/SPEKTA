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
                            </td>
                            <td>
                                <a href="showekskul?id=<?php echo $d['id_ekstra']; ?>" class="btn btn-primary">EDIT
                                </a>
                            </td>
                        </tr>
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
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pembina</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-multiple form-control" name="pembina"
                                        multiple="multiple" required>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->
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