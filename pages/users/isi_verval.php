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
    $sql = "SELECT * FROM tb_users
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        WHERE tb_account.email = '$email'
        ";
    $r = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($r)) {
        $id_users = $d['id_users'];
        if ($d['isi_verval'] == '1') {
    ?>
    <script>
    window.location.href = "verval"
    </script>
    <?php
        }
    }
    ?>
    <form class="needs-validation text-start" novalidate
        action="<?php echo $url_config . 'verval.php?id_users=' . $id_users ?>" method="POST"
        enctype="multipart/form-data" id="formverval">
        <div class="col-12 grid-margin">
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
                                    <input type="text" class="form-control" name="name" id="name" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-3 form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="L"
                                            required>
                                        LAKI-LAKI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="P"
                                            required>
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
                                    <input type="number" class="form-control" name="nisn" id="nisn" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Induk Siswa</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="nis" id="nis" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="birth_place" id="birth_place" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="birth_date"
                                        id="birth_date" required autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="class" id="class" required>
                                        <option selected></option>
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
                                    <select class="form-control" name="religion" id="religion" required>
                                        <option selected></option>
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
                                    <textarea rows="4" class="form-control" name="street" id="street" required
                                        autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rt" id="rt" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="rw" id="rw" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Pos</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="poscode" id="poscode" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="province" id="province" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="regency" id="regency" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kecamatan/Distrik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="district" id="district" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="village" id="village" required
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Jalan</label>
                                <div class="col-sm-8">
                                    <textarea rows="4" class="form-control" name="street" id="street" required
                                        autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">RT</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="rt" id="rt" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">RW</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="rw" id="rw" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="village" id="village" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Kecamatan/Distrik</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="district" id="district" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Kabupaten/Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="regency" id="regency" required
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Provinsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="province" id="province" required
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Kode Pos</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="poscode" id="poscode" required />
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" name="addbiodata" id="addbiodata"
                                class="btn btn-success btn-lg btn-block">
                                SIMPAN DATA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
    $('#serahbtn').click(function() {
        $('#name').text($('#cname').val());
    });
    </script>
    <?php
    require_once 'foot.php';
    ?>