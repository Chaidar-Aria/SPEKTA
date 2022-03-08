<?php
require_once 'head.php';
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
    if ($r['is_active'] == '0') { ?>
<script>
window.location.href = "pending";
</script>
<?php }
}

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        <div class="alert alert-danger" role="alert">
            <h5>STATUS VERVAL ANDA DITOLAK OLEH PANITIA SELEKSI</h5>
            <h6>ALASAN</h6>
            <p><?php echo $d['alasan_tolak'] ?></p>
        </div>
        <?php } else if ($d['is_verval'] == '1') { ?>
        <div class="alert alert-success" role="alert">
            <h5>STATUS VERVAL ANDA TELAH DITERIMA OLEH PANITIA SELEKSI</h5>
            <p>Waktu simpan: <?php echo $d['permanent_at'] ?></p>
            <p>Waktu verval: <?php echo $d['verval_at'] ?></p>
            <h6>Silahkan Unduh Kartu Permohonan Verval <a href="kartu_permanen" style="color:blue"
                    target="_blank">Disini</a></h6>
            <p>Silahkan Unduh Bukti Verval <a href="kartu_verval" style="color:blue" target="_blank">Disini</a></p>
        </div> <?php } else if ($d['is_verval'] == '0') { ?>
        <div class=" alert alert-warning" role="alert">
            <h5>STATUS VERVAL ANDA SEDANG DITINJAU OLEH PANITIA SELEKSI</h5>
            <?php if (empty($d['foto_users'])) { ?>
            <h6 class="blink">Anda belum mengunggah foto. Silahkan mengunggah foto anda pada menu administrasi berkas
            </h6>
            <?php } else { ?>
            <h6>Silahkan Unduh Kartu Permohonan Verval <a href="kartu_permanen" style="color:blue"
                    target="_blank">Disini</a></h6>
            <?php } ?>
            <p>Waktu simpan: <?php echo $d['permanent_at'] ?></p>
        </div>
        <?php } ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Diri Anggota</h5>
                <p class="card-description">
                    Biodata
                </p>
                <div class="row mt-5">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">ID SPEKTA</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php if (empty($d['id_spekta'])) {
                                            echo "ID SPEKTA BELUM DIBUAT";
                                        } else {
                                            echo $d['id_spekta'];
                                        } ?> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['name']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Nomor Induk Siswa Nasional</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo $d['nisn']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Nomor Induk Siswa</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo $d['nis']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php if ($d['gender'] == 'L') { ?>
                                    LAKI-LAKI
                                    <?php } else if ($d['gender'] == 'P') { ?>
                                    PEREMPUAN
                                    <?php } ?> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Tempat
                                Lahir</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo $d['birth_place']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo tgl_indo($d['birth_date']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Kelas</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['class']) ?> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Agama</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['religion']) ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
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
                    Alamat
                </p>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Jalan</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['street']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">RT</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo $d['rt']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">RW</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo $d['rw']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Desa/Kelurahan</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['village']) ?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Kecamatan/Distrik</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['district']) ?> </p>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Kabupaten/Kota</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['regency']) ?>
                                </p>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Provinsi</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['province']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Kode Pos</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($d['poscode']) ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!--Row-->
    <?php
    require_once 'foot.php';
    ?>