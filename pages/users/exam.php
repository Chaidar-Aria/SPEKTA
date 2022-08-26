<?php
require_once 'head.php';
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
}

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PENDAFTARAN CBT SPEKTA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Ujian</li>
            <li class="breadcrumb-item active" aria-current="page">CBT SPEKTA</li>
        </ol>
    </div>

    <?php
    $sql = "SELECT * FROM tb_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_account.id_acc = '$id_acc'
        ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($result)) {
    ?>
    <div class="col-12 grid-margin">
        <?php if ($d['is_tolak'] == '1') { ?>
        <div class="card">
            <div class="card-body text-center">
                <img class="mb-3 img" src="<?php echo $url_assets . 'img/cancel.svg' ?>" alt="pending verval"
                    width="250">
                <h5>DATA VERIFIKASI DAN VALIDASI ANDA DITOLAK PANITIA SELEKSI</h5>
                <h6>ANDA TIDAK DAPAT MELAKUKAN PENDAFTARAN EKSTRAKURIKULER JIKA DATA ANDA DITOLAK PANITIA SELEKSI</h6>
            </div>
        </div>
        <?php } else if ($d['is_verval'] == '1') { ?>
        <div class="alert alert-success" role="alert">
            <h5>DATA ANDA TELAH TERVERIFIKASI</h5>
            <h6>SILAHKAN MELAKUKAN PENDAFTARAN CBT SPEKTA DAN MEMILIH EKSTRAKURIKULER</h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalekstra">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img class="mb-3 img" src="<?php echo $url_assets . 'img/activity.svg' ?>"
                                alt="pilih ekstrakurikuler" width="250">
                            <h5>PILIH EKSTRAKURIKULER</h5>
                            <h6>silahkan pilih ekstrakurikuler yang anda minati</h6>
                        </div>
                    </div>
                </a>

            </div>
            <?php if ($d['pilih_ekstra'] == '0') { ?>
            <div class="col-lg-6">
                <a href="javascript:void(0);" onclick="belumPilihEkstra()">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img class="mb-3 img" src="<?php echo $url_assets . 'img/exam.svg' ?>" alt="daftar ujian"
                                width="250">
                            <h5>DAFTAR CBT SPEKTA</h5>
                            <h6>silahkan mendaftar CBT SPEKTA</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php } else { ?>
            <div class="col-lg-6">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalcbt">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img class="mb-3 img" src="<?php echo $url_assets . 'img/exam.svg' ?>" alt="daftar ujian"
                                width="250">
                            <h5>DAFTAR CBT SPEKTA</h5>
                            <h6>silahkan mendaftar CBT SPEKTA</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } else if ($d['is_verval'] == '0') { ?>
        <div class="card">
            <div class="card-body text-center">
                <img class="mb-3 img" src="<?php echo $url_assets . 'img/pending.svg' ?>" alt="pending verval"
                    width="250">
                <h5>DATA BELUM TERVERIFIKASI</h5>
                <h6>ANDA TIDAK DAPAT MELAKUKAN PENDAFTARAN EKSTRAKURIKULER JIKA DATA ANDA BELUM DIVERIFIKASI OLEH
                    PANITIA SELEKSI</h6>
            </div>
        </div>
        <?php } ?>
        <!-- Modal ekstra -->
        <div class="modal fade" id="modalekstra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php if ($d['pilih_ekstra'] == '0') { ?>
            <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                action="<?php echo $url_config . 'ekstrakurikuler.php?id_users=' . $d['id_users']; ?>" method="POST">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Halo <?php echo $d['name'] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">SILAHKAN PILIH EKSTRAKURIKULER</h4>
                                    <p class="card-description">
                                        Pastikan anda memilih sesuai dengan skala prioritas anda pada ekstrakurikuler
                                        tersebut <br>
                                    <p style="color: red;">data ekstrakurikuler tidak dapat dirubah setelah anda
                                        menyimpan
                                        data</p>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ekstrakurikuler Pertama</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="ekstra1" id="ekstra1"
                                                        autocomplete="off" required>
                                                        <option selected value="NULL">PILIH EKSTRAKURIKULER PERTAMA
                                                        </option>
                                                        <?php
                                                                $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                                                                while ($d = mysqli_fetch_array($data)) {
                                                                    echo '<option value="' . $d['id_ekstra'] . '">' . strtoupper($d["ekstrakurikuler"]) . '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ekstrakurikuler Kedua</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="ekstra2" id="ekstra2"
                                                        autocomplete="off" required>
                                                        <option selected value="NULL">PILIH EKSTRAKURIKULER KEDUA
                                                        </option>
                                                        <?php
                                                                $data = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler");
                                                                while ($d = mysqli_fetch_array($data)) {
                                                                    echo '<option value="' . $d['id_ekstra'] . '">' . strtoupper($d["ekstrakurikuler"]) . '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="addekstrausers"
                                id="addekstrausers">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php } else if ($d['pilih_ekstra'] == '1') {
                    $ekskul1 = $d['id_ekstra_1'];
                    $ekskul2 = $d['id_ekstra_2'];
                    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 
                                            WHERE tb_users.id_ekstra_1= '$ekskul1'");
                    while ($data1 = mysqli_fetch_array($sql)) {
                        $ekstra1 = $data1['ekstrakurikuler'];
                    }
                    $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2
                                            WHERE tb_users.id_ekstra_2 = '$ekskul2'");
                    while ($data2 = mysqli_fetch_array($sql2)) {
                        $ekstra2 = $data2['ekstrakurikuler'];
                    }
                ?>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Halo <?php echo $d['name'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ANDA SUDAH MEMILIH EKSTRAKURIKULER</h4>
                                <p class="card-description">
                                    Berikut adalah ekstrakurikuler yang anda pilih

                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Ekstrakurikuler Pertama</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $ekstra1 ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Ekstrakurikuler Kedua</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $ekstra2 ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="kartu_ekstra" type="button" class="btn btn-primary text-white" target="_BLANK">KARTU
                            EKSTRAKURIKULER</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Modal cbt -->
        <div class="modal fade" id="modalcbt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php if ($d['pilih_jadwal_cbt'] == '0') { ?>
            <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                action="<?php echo $url_config . 'cbt.php?id_users=' . $d['id_users']; ?>" method="POST">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">PENDAFTARAN CBT SPKETA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">SILAHKAN PILIH JADWAL CBT</h4>
                                    <p class="card-description" style="color: red;">
                                        Jadwal yang telah anda pilih tidak dapat diubah
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama CBT</label>
                                                <div class="col-sm-9">
                                                    <?php
                                                            $data = mysqli_query($conn2, "SELECT * FROM tb_test WHERE cbt_status = '1'");
                                                            while ($d = mysqli_fetch_array($data)) {
                                                                $testname = $d['test_name'];
                                                                $test_id = $d['test_id'];
                                                                $cbtmulai = $d['cbt_date_start'];
                                                                $cbtend = $d['cbt_date_end'];
                                                            }
                                                            ?>
                                                    <input type="text" class="form-control" name="test_id" id="test_id"
                                                        value="<?php echo $test_id ?>" hidden />
                                                    <p class="mt-2"><?php echo $testname ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Jadwal CBT</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" autocomplete="off" required type="date"
                                                        id="cbtdate" name="cbtdate" min="<?php echo $cbtmulai ?>"
                                                        max="<?php echo $cbtend ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="addcbt" id="addcbt">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php } else if ($d['pilih_jadwal_cbt'] == '1') {
                    $id_users = $d['id_users'];
                    $sql = mysqli_query($conn, "SELECT * FROM db_cbt_spekta.tb_users_cbt 
                        INNER JOIN db_spekta_3.tb_users ON db_spekta_3.tb_users.id_users = db_cbt_spekta.tb_users_cbt.id_users
                        INNER JOIN db_cbt_spekta.tb_users_cbt_date ON db_cbt_spekta.tb_users_cbt.id_users_cbt = db_cbt_spekta.tb_users_cbt_date.id_users_cbt
                        INNER JOIN db_cbt_spekta.tb_users_cbt_choice ON db_cbt_spekta.tb_users_cbt.id_users_cbt = db_cbt_spekta.tb_users_cbt_choice.id_users_cbt
                        INNER JOIN db_cbt_spekta.tb_test ON db_cbt_spekta.tb_users_cbt_choice.test_id = db_cbt_spekta.tb_test.test_id
                        WHERE db_cbt_spekta.tb_users_cbt.id_users = '$id_users' AND db_cbt_spekta.tb_test.cbt_status = '1'");
                    while ($d = mysqli_fetch_array($sql)) {

                    ?>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Halo <?php echo $d['name'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ANDA SUDAH MEMIILIH JADWAL</h4>
                                <p class="card-description">
                                    Berikut adalah jadwal beserta akun CBT SPEKTA
                                </p>
                                <p style="color: red;">
                                    Pastikan anda tidak melewatkan CBT SPEKTA karena CBT ini hanya bisa dilakukan 1
                                    (satu) kali dalam 1 (satu) periode
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama CBT</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $d['test_name']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jadwal CBT</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo tgl_indo($d['users_cbt_date']); ?></p>
                                                <P class="mt-2">
                                                    <?php echo $d['cbt_start_time'] . ' ~ ' . $d['cbt_end_time'] ?>
                                                </P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nomor Peserta CBT</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $d['username']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Username CBT</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $d['username']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Password CBT</label>
                                            <div class="col-sm-9">
                                                <p class="mt-2"><?php echo $d['password']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="kartu_ujian" type="button" class="btn btn-primary text-white" target="_BLANK">KARTU
                            UJIAN CBT</a>
                    </div>
                </div>
            </div>
            <?php }
                } ?>
        </div>
    </div>
    <?php } ?>

    <!--Row-->
    <?php
    require_once 'foot.php';
    ?>