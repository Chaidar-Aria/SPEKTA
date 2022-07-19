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
                        WHERE tb_kegiatan_ekstra.id_ekstra = '$idekstra'");
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
                                <div class="badge badge-warning">PENDING</div> <br>
                                <small>
                                    <?php if ($d['tinjau_admin'] == '1') {
                                                    echo "Data diserahkan ke pembina";
                                                } ?>
                                </small>
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
                                <small>Kegiatan anda telah disetujui pembina. Silahkan unduh surat tugas</small> <br>
                                <?php }
                                    } else {  ?>
                                <div class="badge badge-danger">DITOLAK</div>
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
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">PENGAJUAN KEGIATAN
                                                <?php echo $d['nama_kegiatan'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
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
                                                        <?php echo strtoupper($d['nama_kegiatan']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label text-md-right">Penyelenggara
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
                                        </div>
                                        <div class="modal-footer">
                                            <?php if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '0') { ?>
                                            <a target="blank"
                                                href="<?php echo $url_assets . 'file/surat_tugas/' . $d1['surat_tugas'] ?>"
                                                type="button" class="btn btn-primary text-white"
                                                <?php if (empty($d['surat_tugas'])) { ?> hidden <?php } ?>>Unduh
                                                Surat Tugas</a>
                                            <?php } else if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '1') { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <?php } else { ?>
                                            <a href="<?php echo $url_config . 'delkeg_admin.php?id=' . $d['id_kegiatan'] ?>"
                                                class="btn btn-md btn-danger">Hapus
                                                Data</a>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Batalkan</button>
                                            <button type="submit" name="editkegiatan" class="btn btn-success">Ajukan
                                                kegiatan</button>
                                            <?php } ?>
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