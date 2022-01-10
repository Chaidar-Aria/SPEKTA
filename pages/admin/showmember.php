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
    $id_users = $_GET['id_users'];
    $query = "SELECT * FROM tb_users
                        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users WHERE tb_users.id_users = '$id_users'
            ";
    $r_sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($r_sql)) {
    ?>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Diri Anggota</h4>
                <form class="form-sample">
                    <p class="card-description">
                        Biodata
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['name']); ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID SPEKTA</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $d['id_spekta']; ?>"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa Nasional</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $d['nisn']; ?>"
                                        disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $d['nis']; ?>" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['birth_place']); ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input class="form-control" placeholder="dd/mm/yyyy"
                                        value="<?php echo $d['birth_date']; ?>" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled>
                                        <option selected><?php echo strtoupper($d['class']); ?></option>
                                        <option value="XAI">XA1</option>
                                        <option value="XA2">XA2</option>
                                        <option value="XA3">XA3</option>
                                        <option value="XA4">XA4</option>
                                        <option value="XA5">XA5</option>
                                        <option value="XA6">XA6</option>
                                        <option value="XSI">XS1</option>
                                        <option value="XS2">XS2</option>
                                        <option value="XS3">XS3</option>
                                        <option value="XIA1">XIA1</option>
                                        <option value="XIA2">XIA2</option>
                                        <option value="XIA3">XIA3</option>
                                        <option value="XIA4">XIA4</option>
                                        <option value="XIA5">XIA5</option>
                                        <option value="XIA6">XIA6</option>
                                        <option value="XISI">XIS1</option>
                                        <option value="XIS2">XIS2</option>
                                        <option value="XIS3">XIS3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled>
                                        <option selected><?php echo strtoupper($d['religion']); ?></option>
                                        <option value="ISLAM">ISLAM</option>
                                        <option value="KRISTEN">KRISTEN</option>
                                        <option value="KATHOLIK">KATHOLIK</option>
                                        <option value="HINDU">HINDU</option>
                                        <option value="BUDDHA">BUDDHA</option>
                                        <option value="KONGHUCU">KONGHUCU</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Alamat
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jalan</label>
                                <div class="col-sm-9">
                                    <textarea rows="4" class="form-control"
                                        disabled> <?php echo strtoupper($d['street']); ?> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="<?php echo $d['rt']; ?>"
                                        disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="<?php echo $d['rw']; ?>"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['village']); ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kecamatan/Distrik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['district']); ?>" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['regency']); ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="<?php echo strtoupper($d['province']); ?>" disabled />
                                </div>
                            </div>
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