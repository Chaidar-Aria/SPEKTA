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

            $id_users = $_GET['id_users'];
            $query = "SELECT * FROM tb_users
                        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
                        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
                        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
                        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
                        WHERE tb_users.id_users = '$id_users'
            ";
            $r_sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($d = mysqli_fetch_array($r_sql)) {
    ?>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Diri Anggota</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="<?php echo $url_config . 'verval.php?id_users=' . $d['id_users']; ?>" method="POST">
                    <p class="card-description">
                        Biodata
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="<?php echo strtoupper($d['name']); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-3 form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="L"
                                            <?php if ($d['gender'] === 'L') echo 'checked="checked"'; ?>>
                                        LAKI-LAKI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="P"
                                            <?php if ($d['gender'] === 'P') echo 'checked="checked"'; ?>>
                                        PEREMPUAN
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa Nasional</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nisn" id="nisn"
                                        value="<?php echo $d['nisn']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nis" id="nis"
                                        value="<?php echo $d['nis']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="birth_place" id="birth_place"
                                        value="<?php echo strtoupper($d['birth_place']); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="birth_date"
                                        id="birth_date" value="<?php echo $d['birth_date']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="class" id="class">
                                        <option selected value="<?php echo strtoupper($d['id_class']) ?>">
                                            <?php echo $d['class'] ?></option>
                                        <?php
                                                    $cl_sql = mysqli_query($conn, "SELECT * FROM tb_class") or die(mysqli_error($conn));
                                                    while ($class = mysqli_fetch_array($cl_sql)) {
                                                        echo '<option value="' . $class['id_class'] . '">' . $class["class"] . '</option>';
                                                    }
                                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="religion" id="religion">
                                        <option selected value="<?php echo strtoupper($d['id_religion']) ?>">
                                            <?php echo $d['religion'] ?></option>
                                        <?php
                                                    $rl_sql = mysqli_query($conn, "SELECT * FROM tb_religion") or die(mysqli_error($conn));
                                                    while ($class = mysqli_fetch_array($rl_sql)) {
                                                        echo '<option value="' . $class['id_religion'] . '">' . $class["religion"] . '</option>';
                                                    }
                                                    ?>
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
                                    <textarea rows="4" class="form-control" name="street" id="street" required
                                        autocomplete="off"><?php echo strtoupper($d['street']); ?> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rt" id="rt" required
                                        autocomplete="off" value="<?php echo $d['rt']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rw" id="rw" required
                                        autocomplete="off" value="<?php echo $d['rw']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Pos</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="poscode" id="poscode" required
                                        autocomplete="off" value="<?php echo $d['poscode']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="village" id="village"
                                        value="<?php echo strtoupper($d['village']); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kecamatan/Distrik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="district" id="district"
                                        value="<?php echo strtoupper($d['district']); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="regency" id="regency"
                                        value="<?php echo strtoupper($d['regency']); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="province" id="province"
                                        value="<?php echo strtoupper($d['province']); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Foto Calon Anggota
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image text-center">
                                <?php if ($d['foto_users'] == NULL) { ?>
                                <img src="<?php echo $actual_link . '/assets/img/logo SS.png' ?>" alt="img user"
                                    width="200">
                                <?php } else { ?>
                                <img src="<?php echo $actual_link . '/assets/img/user/' . $d['foto_users']; ?>"
                                    alt="img user" width="200">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Aksi
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" name="setujuvervaladmin" id="setujuvervaladmin"
                                        class="btn btn-success btn-lg btn-block">
                                        VERIFIKASI</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#tolakverval"
                                        class="btn btn-danger btn-lg btn-block">TOLAK
                                        VERIFIKASI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tolak Verval -->
    <div class="modal fade" id="tolakverval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
            action="<?php echo $url_config . 'verval.php?id_users=' . $d['id_users']; ?>" method="POST">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">TOLAK VERIFIKASI DAN VALIDASI DATA CALON
                            ANGGOTA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>APAKAH ANDA INGIN MENOLAK VERVAL DATA CALON ANGGOTA?</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">BERIKAN ALASAN</label>
                                    <div class="col-sm-9">
                                        <textarea rows="4" class="form-control" name="alasantolak" id="alasantolak"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="tolakvervaladmin" id="tolakvervaladmin" class="btn btn-danger">
                            TOLAK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php }
        } else { ?>
    <script>
    window.location.href = "verval"
    </script>
    <?php }
    } ?>

    <?php
    require_once 'foot.php';
    ?>