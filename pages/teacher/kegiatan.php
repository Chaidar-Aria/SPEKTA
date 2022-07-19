<?php
require_once 'head.php';
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


    <div class="col-lg-12">
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
                            <th>Peserta</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Status Kegiatan</th>
                            <th>Persetujuan Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Peserta</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Status Kegiatan</th>
                            <th>Persetujuan Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra
                            INNER JOIN tb_users ON tb_kegiatan_ekstra.id_users = tb_users.id_users 
                        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users 
                        INNER JOIN tb_ekstrakurikuler ON tb_kegiatan_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
                        WHERE tb_kegiatan_ekstra.tinjau_admin = '1' AND tb_kegiatan_ekstra.id_ekstra = '$idekstra'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $d['kode_kegiatan']; ?></td>
                            <td><?php echo strtoupper($d['nama_kegiatan']); ?></td>
                            <td>
                                <?php echo  $d['name'] ?>
                            </td>
                            <td>
                                <?php echo tgl_indo($d['tanggal_mulai_kegiatan']) . '~' . tgl_indo($d['tanggal_selesai_kegiatan']) ?>
                            </td>
                            <td> <?php
                                        if (empty($d['alasan_tolak'])) {
                                            if ($d['setuju_pembina'] == '1') {
                                                if ($d['status_kegiatan'] == '0') { ?>
                                <marquee direction="down">
                                    <div class="badge badge-success">BERLANGSUNG</div>
                                </marquee>
                                <?php } else if ($d['status_kegiatan'] == '1') { ?>
                                <div class="badge badge-success">SELESAI</div>
                                <?php }
                                            } else { ?>
                                <div class="badge badge-warning">PENDING</div>
                                <?php }
                                        } else { ?>
                                <div class="badge badge-danger">DITOLAK</div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (empty($d['alasan_tolak'])) {
                                        if ($d['setuju_pembina'] == '0') { ?>
                                <div class="badge badge-warning">PENDING</div>
                                <?php } else if ($d['setuju_pembina'] == '1') { ?>
                                <div class="badge badge-success">DISETUJUI</div> <br>
                                <small>Anda telah menyetujui kegiatan ini. Silahkan mencetak surat tugas</small> <br>
                                <?php }
                                    } else {  ?>
                                <div class="badge badge-danger">DITOLAK</div>
                                <p>Alasan: <?php echo $d['alasan_tolak'] ?></p>
                                <?php } ?>
                            </td>
                            <td><a href="javascript:void(0);" class="btn btn-md btn-primary" data-toggle="modal"
                                    data-target="#modalkeg<?php echo $d['id_kegiatan'] ?>"><i
                                        class="fas fa-search"></i></a></td>
                        </tr>
                        <div class="modal fade" id="modalkeg<?php echo $d['id_kegiatan'] ?>" tabindex="-1"
                            aria-labelledby="modalberkasLabel" aria-hidden="true">
                            <form action="<?php echo $url_config . 'kegiatan.php?id=' . $d['id_kegiatan'] ?>"
                                method="post" enctype="multipart/form-data" class="form-sample needs-validation "
                                novalidate onSubmit="return validasi(this);">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">DATA KEGIATAN
                                                <?php echo $d['nama_kegiatan'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">ID
                                                            SPEKTA</label>
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
                                                                <?php echo strtoupper($d['nama_kegiatan']) ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-4 col-form-label text-md-right">Penyelenggara
                                                            Kegiatan</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                <?php echo $d['penyelenggara_kegiatan']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">Tanggal
                                                            Kegiatan</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                <?php echo tgl_indo($d['tanggal_mulai_kegiatan']) . " - " . tgl_indo($d['tanggal_selesai_kegiatan']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">Bukti
                                                            Kegiatan</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                <a href="<?php echo $url_assets . 'file/kegiatan/' . $d['bukti_kegiatan']; ?>"
                                                                    target="_blank" class="btn btn-md btn-primary"><i
                                                                        class="fas fa-search"></i> Lihat Bukti
                                                                    Kegiatan</a>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php if ($d['setuju_pembina'] == '1' && (empty($d['surat_tugas']))) { ?>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">Unggah
                                                            Surat Tugas</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                <input type="file" class="form-control" id="surattugas"
                                                                    name="surattugas" required>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php } else if (empty($d['surat_tugas']) && $d['setuju_pembina'] == '0') { ?>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">Unggah
                                                            Surat Tugas</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                Kegiatan belum mendapat persetujuan. Surat tugas tidak
                                                                dapat dibuat
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php } else if (!empty($d['surat_tugas']) && $d['setuju_pembina'] == '1') { ?>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label text-md-right">Surat
                                                            Tugas</label>
                                                        <div class="col-sm-8">
                                                            <p class="mt-2 tx-medium">
                                                                <a href="<?php echo $url_assets . 'file/surat_tugas/' . $d['surat_tugas']; ?>"
                                                                    target="_blank" class="btn btn-md btn-primary"><i
                                                                        class="fas fa-search"></i> Lihat Surat Tugas</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '0' && empty($d['surat_tugas'])) { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="upsurat" class="btn btn-success">SIMPAN SURAT
                                                TUGAS</button>
                                            <a target="blank" href="surat_tugas?id=<?php echo $d['id_kegiatan'] ?>"
                                                type="button" class="btn btn-primary text-white">Cetak
                                                Surat Tugas</a>
                                            <?php } else if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '1') { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <?php } else if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '0') { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#modaltolak<?php echo $d['id_kegiatan'] ?>"
                                                class="btn btn-danger">TOLAK
                                                KEGIATAN</a>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Batalkan</button>
                                            <button type="submit" name="setujukegiatan" class="btn btn-success">SETUJUI
                                                KEGIATAN</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="modaltolak<?php echo $d['id_kegiatan'] ?>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                            <form class="form-sample needs-validation text-start" novalidate
                                onSubmit="return validasi(this);"
                                action="<?php echo $url_config . 'kegiatan.php?id=' . $d['id_kegiatan']; ?>"
                                method="POST">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelLogout">TOLAK KEGIATAN
                                                <?php echo $d['nama_kegiatan'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>APAKAH ANDA INGIN MENOLAK KEGIATAN INI?</p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">BERIKAN ALASAN</label>
                                                        <div class="col-sm-9">
                                                            <textarea rows="4" class="form-control" name="alasantolak"
                                                                id="alasantolak" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="tolakkegiatan" id="tolakkegiatan"
                                                class="btn btn-danger">
                                                TOLAK</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php

    require_once 'foot.php';
    ?>