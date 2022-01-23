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
                        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
                        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
                        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
                        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
                        WHERE tb_users.id_users = '$id_users'
            ";
    $r_sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($r_sql)) {
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
    <div class="col-12 grid-margin">
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
                                        } ?>
                                </p>
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
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Ekstrakurikuler Pertama</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($ekstra1) ?> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Ekstrakurikuler Kedua</label>
                            <div class="col-sm-8">
                                <p class="mt-2 tx-medium">
                                    <?php echo strtoupper($ekstra2) ?> </p>
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

    <?php
    require_once 'foot.php';
    ?>