<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$email = $_SESSION['email'];

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi dan Validasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi dan Validasi</li>
        </ol>
    </div>

    <?php
    $c_email = "SELECT * FROM tb_account 
                INNER JOIN tb_users ON tb_users.id_acc = tb_account.id_acc 
                WHERE tb_account.email = '$email'";
    $r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($r_email)) {
        $id_users = $d['id_users'];
    }
    $sql = "SELECT * FROM tb_users 
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_account.email = '$email';
        ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($result)) {
        if ($d['isi_verval'] == '0') {
    ?>
    <script>
    window.location.href = "isi_verval"
    </script>
    <?php
        } else if ($d['is_permanent'] == '1' && ($d['is_tolak'] == '0')) {
        ?>
    <script>
    window.location.href = "<?php echo $url_users ?>"
    </script>
    <?php
        }
    }
    ?>
    <form class="needs-validation text-start" novalidate
        action="<?php echo $url_config . 'verval.php?id_users=' . $id_users ?>" method="POST">
        <?php
        $sql = "SELECT * FROM tb_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_users.id_users = '$id_users'
        ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($d = mysqli_fetch_array($result)) {
        ?>
        <div class="col-12 grid-margin">
            <?php if ($d['is_tolak'] == '1') { ?>
            <div class="alert alert-danger" role="alert">
                <h5>STATUS VERVAL ANDA DITOLAK OLEH PANITIA SELEKSI</h5>
                <h6>ALASAN</h6>
                <p><?php echo $d['alasan_tolak'] ?></p>
            </div>
            <?php } else if ($d['is_verval'] == '1' || ($d['is_tolak'] == '0')) { ?>
            <div class="alert alert-success" role="alert">
                <h5>STATUS VERVAL ANDA TELAH DITERIMA OLEH PANITIA SELEKSI</h5>
            </div> <?php } else if ($d['is_verval'] == '0') { ?>
            <div class="alert alert-warning" role="alert">
                <h5>STATUS VERVAL ANDA SEDANG DITINJAU OLEH PANITIA SELEKSI</h5>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Diri Anggota</h4>
                    <p class="card-description">
                        Biodata
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="id_users" id="id_users"
                                        value="<?php echo $id_users ?>" hidden />
                                    <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                        required value="<?php echo strtoupper($d['name']) ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-3 form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="L"
                                            autocomplete="off" required <?php if ($d['gender'] == 'L') { ?> checked
                                            <?php } ?>>
                                        LAKI-LAKI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="P"
                                            autocomplete="off" required <?php if ($d['gender'] == 'P') { ?> checked
                                            <?php } ?>>
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
                                    <input type="number" class="form-control" name="nisn" id="nisn" autocomplete="off"
                                        required value="<?php echo $d['nisn'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="nis" id="nis" autocomplete="off"
                                        required value="<?php echo $d['nis'] ?>" />
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
                                        autocomplete="off" required
                                        value="<?php echo strtoupper($d['birth_place']) ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="birth_date"
                                        id="birth_date" autocomplete="off" required
                                        value="<?php echo $d['birth_date'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="class" id="class" autocomplete="off" required>
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
                                    <select class="form-control" name="religion" id="religion" autocomplete="off"
                                        required>
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
                </div>
                <div class="card-body">
                    <p class="card-description">
                        Alamat
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jalan</label>
                                <div class="col-sm-9">
                                    <textarea rows="4" class="form-control" name="street" id="street" autocomplete="off"
                                        required> <?php echo strtoupper($d['street']) ?> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rt" id="rt" autocomplete="off"
                                        required value="<?php echo $d['rt'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rw" id="rw" autocomplete="off"
                                        required value="<?php echo $d['rw'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="province" id="province"
                                        value="<?php echo strtoupper($d['province']) ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="regency" id="regency"
                                        value="<?php echo strtoupper($d['regency']) ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kecamatan/Distrik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="district" id="district"
                                        value="<?php echo strtoupper($d['district']) ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="village" id="village"
                                        value="<?php echo strtoupper($d['village']) ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <p class="card-description">
                        Berkas
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto Calon Anggota</label>
                                <div class="col-sm-9">
                                    <img src="../images/faces/face1.jpg" alt="foto users" width=250>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ekstrakurikuler</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ekstrakurikuler" id="ekstrakurikuler"
                                        autocomplete="off" required>
                                        <?php
                                        $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                                        while ($d = mysqli_fetch_array($data)) {
                                            echo '<option value="' . $d['id_ekstra'] . '">' . $d["ekstrakurikuler"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-12">
                        <button type="submit" name="addbiodata" id="addbiodata"
                            class="btn btn-success btn-lg btn-block">
                            SIMPAN DATA</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </form>

    <script type="text/javascript">
    $('#serahbtn').click(function() {
        $('#name').text($('#cname').val());
    });
    </script>
    <?php
    require_once 'foot.php';
    ?>