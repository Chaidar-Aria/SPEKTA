<?php
require_once 'head.php';
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
}
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
    $id_users = $d['id_users'];
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
}

date_default_timezone_set('Asia/Jakarta');
$a = date("H");
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kegiatan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
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
    <div class="col-lg-12 ">
        <?php if ($d['is_tolak'] == '1') { ?>
        <div class="card">
            <div class="card-body text-center">
                <img class="mb-3 img" src="<?php echo $url_assets . 'img/cancel.svg' ?>" alt="pending verval"
                    width="250">
                <h5>DATA VERIFIKASI DAN VALIDASI ANDA DITOLAK PANITIA SELEKSI</h5>
                <h6>ANDA TIDAK DAPAT MELAKUKAN INPUT KEGIATAN JIKA DATA ANDA DITOLAK PANITIA SELEKSI</h6>
            </div>
        </div>
        <?php  } else if ($d['is_verval'] == '0') { ?>
        <div class="card">
            <div class="card-body text-center">
                <img class="mb-3 img" src="<?php echo $url_assets . 'img/pending.svg' ?>" alt="pending verval"
                    width="250">
                <h5>DATA BELUM TERVERIFIKASI</h5>
                <h6>ANDA TIDAK DAPAT MELAKUKAN INPUT KEGIATAN JIKA DATA ANDA BELUM DIVERIFIKASI OLEH
                    PANITIA SELEKSI</h6>
            </div>
        </div>
        <?php  } else if (empty($d['id_spekta'])) { ?>
        <div class="card">
            <div class="card-body text-center">
                <img class="mb-3 img" src="<?php echo $url_assets . 'img/idcard.svg' ?>" alt="pending verval"
                    width="250">
                <h5>ID SPEKTA BELUM DIBUAT</h5>
                <h6>ANDA BELUM MEMILIKI ID SPEKTA. UNTUK MENGISI DATA KEGIATAN, PASTIKAN ID SPEKTA ADA TELAH DIBUAT OLEH
                    PANITIA SELEKSI</h6>
            </div>
        </div>
        <?php } else if ($d['is_tolak'] == '0') { ?>
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Kegiatan</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelkegiatan">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai Kegiatan</th>
                            <th>Tanggal Selesai Kegiatan</th>
                            <th>Status Kegiatan</th>
                            <th>Persetujuan Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai Kegiatan</th>
                            <th>Tanggal Selesai Kegiatan</th>
                            <th>Status Kegiatan</th>
                            <th>Persetujuan Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                $data = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra
                        INNER JOIN tb_users ON tb_kegiatan_ekstra.id_users = tb_users.id_users
                        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
                        WHERE tb_account.id_acc = '$id_acc'");
                                while ($d1 = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $d1['kode_kegiatan']; ?></td>
                            <td><?php echo strtoupper($d1['nama_kegiatan']); ?></td>
                            <td>
                                <?php echo tgl_indo($d1['tanggal_mulai_kegiatan']) ?>
                            </td>
                            <td>
                                <?php echo tgl_indo($d1['tanggal_selesai_kegiatan']) ?>
                            </td>
                            <td> <?php
                                                if (empty($d1['alasan_tolak'])) {
                                                    if ($d1['setuju_pembina'] == '1') {
                                                        if ($d1['status_kegiatan'] == '0') { ?>
                                <marquee direction="down">
                                    <div class="badge badge-success">BERLANGSUNG</div>
                                </marquee>
                                <?php } else if ($d1['status_kegiatan'] == '1') { ?>
                                <div class="badge badge-success">SELESAI</div>
                                <?php }
                                                    } else { ?>
                                <div class="badge badge-warning">PENDING</div> <br>
                                <small>
                                    <?php if ($d1['tinjau_admin'] == '0') {
                                                            echo "Data ditinjau admin";
                                                        } else {
                                                            echo "Data diserahkan ke pembina";
                                                        } ?>
                                </small>
                                <?php }
                                                } else { ?>
                                <div class="badge badge-danger">DITOLAK</div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (empty($d1['alasan_tolak'])) {
                                                if ($d1['setuju_pembina'] == '0') { ?>
                                <div class="badge badge-warning">PENDING</div>
                                <?php } else if ($d1['setuju_pembina'] == '1') { ?>
                                <div class="badge badge-success">DISETUJUI</div> <br>
                                <small>Kegiatan anda telah disetujui pembina. Silahkan unduh surat tugas</small> <br>
                                <?php }
                                            } else {  ?>
                                <div class="badge badge-danger">DITOLAK</div>
                                <?php } ?>
                            </td>
                            <td><a href="javascript:void(0);" class="btn btn-md btn-primary" data-toggle="modal"
                                    data-target="#modalkeg<?php echo $d1['id_kegiatan'] ?>"><i
                                        class="fas fa-search"></i></a></td>
                        </tr>
                        <div class="modal fade" id="modalkeg<?php echo $d1['id_kegiatan'] ?>" tabindex="-1"
                            aria-labelledby="modalberkasLabel" aria-hidden="true">
                            <form action="<?php echo $url_config . 'kegiatan.php?id=' . $d1['id_kegiatan'] ?>"
                                method="post" enctype="multipart/form-data" class="form-sample needs-validation "
                                novalidate onSubmit="return validasi(this);">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">EDIT DATA KEGIATAN
                                                <?php echo $d1['nama_kegiatan'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php if ($d1['setuju_pembina'] == '0') { ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Nama Kegiatan *</label>
                                                <input type="hidden" name="id_users" value="<?php echo $id_users ?>">
                                                <input type="text" class="form-control" id="name" name="name" required
                                                    autocomplete="off" value="<?php echo $d1['nama_kegiatan'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Penyelenggara Kegiatan *</label>
                                                <input type="text" class="form-control" id="penyelenggara"
                                                    name="penyelenggara" required autocomplete="off"
                                                    value="<?php echo $d1['penyelenggara_kegiatan'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Ekstrakurikuler *</label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="ekstra"
                                                        class="custom-control-input" value="<?php echo $ekskul1 ?>"
                                                        required <?php if ($d['id_ekstra_1'] == '$ekskul1') { ?> checked
                                                        <?php } ?>>
                                                    <label class=" custom-control-label" for="customRadio3">
                                                        <?php echo $ekstra1 ?></label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio4" name="ekstra"
                                                        class="custom-control-input" value="<?php echo $ekskul2 ?>"
                                                        required>
                                                    <label class=" custom-control-label"
                                                        for="customRadio4"><?php echo $ekstra2 ?></label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Tanggal Mulai Kegiatan
                                                    *</label>
                                                <input type="date" class="form-control" id="datekegmulai"
                                                    name="datekegmulai" required autocomplete="off"
                                                    value="<?php echo $d1['tanggal_mulai_kegiatan'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Tanggal Selesai Kegiatan
                                                    *</label>
                                                <input type="date" class="form-control" id="datekegselesai"
                                                    name="datekegselesai" required autocomplete="off"
                                                    value="<?php echo $d1['tanggal_selesai_kegiatan'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Unggah Berkas Kegiatan *</label>
                                                <p>Berkas dapat berupa surat edaran kegiatan, pamflet atau
                                                    undangan kegiatan, maupun berkas lain yang mendukung bahwa kegiatan
                                                    ini
                                                    adalah kegiatan asli</p>
                                                <p style="color: red">File dikirim dalam bentuk PDF</p>
                                                <p>File lama: <?php echo $d1['bukti_kegiatan'] ?></p>

                                                <input type="file" class="form-control" id="file" name="file" required>
                                            </div>
                                            <p style="color: red">* = wajib diisi
                                            </p>
                                        </div>
                                        <?php } else { ?>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">ID SPEKTA</label>
                                                <input type="hidden" name="id" id="id"
                                                    value="<?php echo $d['id_kegiatan'] ?>">
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <?php echo $d['id_spekta'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Nama
                                                    Peserta</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <?php echo strtoupper($d['name']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Nama
                                                    Kegiatan</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <?php echo strtoupper($d1['nama_kegiatan']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Penyelenggara
                                                    Kegiatan</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <?php echo $d1['penyelenggara_kegiatan']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Tanggal
                                                    Kegiatan</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <?php echo tgl_indo($d1['tanggal_mulai_kegiatan']) . " - " . tgl_indo($d1['tanggal_selesai_kegiatan']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Bukti
                                                    Kegiatan</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-2 tx-medium">
                                                        <a href="<?php echo $url_assets . 'file/kegiatan/' . $d1['bukti_kegiatan']; ?>"
                                                            target="_blank" class="btn btn-md btn-primary"><i
                                                                class="fas fa-search"></i> Lihat Bukti
                                                            Kegiatan</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="modal-footer">
                                            <?php if ($d1['setuju_pembina'] == '1' && $d1['status_kegiatan'] == '0') { ?>
                                            <a target="blank"
                                                href="<?php echo $url_assets . 'file/surat_tugas/' . $d1['surat_tugas'] ?>"
                                                type="button" class="btn btn-primary text-white"
                                                <?php if (empty($d1['surat_tugas'])) { ?> hidden <?php } ?>>Unduh
                                                Surat Tugas</a>
                                            <a href="<?php echo $url_config . "kegiatan?id=" . $d1['id_kegiatan'] . "&status=selesai" ?>"
                                                type="button" class="btn btn-success text-white">Kegiatan
                                                Selesai</a>
                                            <?php } else if ($d1['setuju_pembina'] == '1' && $d1['status_kegiatan'] == '1') { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <?php } else { ?>
                                            <a href="<?php echo $url_config . 'delkeg_users.php?id=' . $d1['id_kegiatan'] ?>"
                                                class="btn btn-md btn-danger">Hapus
                                                Data</a>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Batalkan</button>
                                            <button type="submit" name="editkegiatan"
                                                class="btn btn-success">Simpan</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="d-block text-center card-footer">
                    <a href="javascript:void(0);" class="btn-wide btn btn-primary" data-toggle="modal"
                        data-target="#addkegiatan">TAMBAH DATA KEGIATAN</a>
                </div>
                <div class="modal fade" id="addkegiatan" tabindex="-1" aria-labelledby="addkegiatanLabel"
                    aria-hidden="true">
                    <form action="<?php echo $url_config . 'kegiatan.php' ?>" method="post"
                        enctype="multipart/form-data" class="form-sample needs-validation " novalidate
                        onSubmit="return validasi(this);">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA KEGIATAN</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nofile" class="form-label">Nama Kegiatan *</label>
                                        <input type="hidden" name="id_users" value="<?php echo $id_users ?>">
                                        <input type="text" class="form-control" id="name" name="name" required
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nofile" class="form-label">Penyelenggara Kegiatan *</label>
                                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                            required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ekstrakurikuler *</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="ekstra"
                                                class="custom-control-input" value="<?php echo $ekskul1 ?>" required>
                                            <label class=" custom-control-label" for="customRadio3">
                                                <?php echo $ekstra1 ?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio4" name="ekstra"
                                                class="custom-control-input" value="<?php echo $ekskul2 ?>" required>
                                            <label class=" custom-control-label"
                                                for="customRadio4"><?php echo $ekstra2 ?></label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="namefile" class="form-label">Tanggal Mulai Kegiatan *</label>
                                        <input type="date" class="form-control" id="datekegmulai" name="datekegmulai"
                                            required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="namefile" class="form-label">Tanggal Selesai Kegiatan *</label>
                                        <input type="date" class="form-control" id="datekegselesai"
                                            name="datekegselesai" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Unggah Berkas Kegiatan *</label>
                                        <p>Berkas dapat berupa surat edaran kegiatan, pamflet atau
                                            undangan kegiatan, maupun berkas lain yang mendukung bahwa kegiatan ini
                                            adalah kegiatan asli</p>
                                        <p style="color: red">File dikirim dalam bentuk PDF</p>
                                        <input type="file" class="form-control" id="file" name="file" accept=".pdf"
                                            required>
                                    </div>
                                    <p style="color: red">* = wajib diisi
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="addkegiatan" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }
        } ?>
    </div>
    <?php

        require_once 'foot.php';
        ?>