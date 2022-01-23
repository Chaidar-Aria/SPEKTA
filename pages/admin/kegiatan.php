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
                            <th>Tanggal Mulai Kegiatan</th>
                            <th>Tanggal Selesai Kegiatan</th>
                            <th>Peserta Kegiatan</th>
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
                            <th>Peserta Kegiatan</th>
                            <th>Status Kegiatan</th>
                            <th>Persetujuan Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra
                        INNER JOIN tb_ekstrakurikuler ON tb_kegiatan_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
                        WHERE tb_kegiatan_ekstra.id_ekstra = '$idekstra'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $d['kode_kegiatan']; ?></td>
                            <td><?php echo strtoupper($d['nama_kegiatan']); ?></td>
                            <td>
                                <?php echo tgl_indo($d['tanggal_mulai_kegiatan']) ?>
                            </td>
                            <td>
                                <?php echo tgl_indo($d['tanggal_selesai_kegiatan']) ?>
                            </td>
                            <td><?php echo $d['peserta_kegiatan'] ?></td>
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
                                            <h5 class="modal-title" id="exampleModalLabel">EDIT DATA KEGIATAN
                                                <?php echo $d['nama_kegiatan'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Nama Kegiatan *</label>
                                                <input type="hidden" name="idekstra" value="<?php echo $idekstra ?>">
                                                <input type="text" class="form-control" id="name" name="name" required
                                                    autocomplete="off" value="<?php echo $d['nama_kegiatan'] ?>"
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Penyelenggara Kegiatan *</label>
                                                <input type="text" class="form-control" id="penyelenggara"
                                                    name="penyelenggara" required autocomplete="off"
                                                    value="<?php echo $d['penyelenggara_kegiatan'] ?>"
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Tanggal Mulai Kegiatan
                                                    *</label>
                                                <input type="date" class="form-control" id="datekegmulai"
                                                    name="datekegmulai" required autocomplete="off"
                                                    value="<?php echo $d['tanggal_mulai_kegiatan'] ?>"
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Tanggal Selesai Kegiatan
                                                    *</label>
                                                <input type="date" class="form-control" id="datekegselesai"
                                                    name="datekegselesai" required autocomplete="off"
                                                    value="<?php echo $d['tanggal_selesai_kegiatan'] ?>"
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="datefile" class="form-label">Peserta Kegiatan *</label>
                                                <select name="pesertakeg" id="pesertakeg" class="form-control" required
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                                    <?php
                                                        $sql1 = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra WHERE id_ekstra ='$idekstra'");
                                                        while ($d1 = mysqli_fetch_array($sql1)) {
                                                            $sql2 = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_ekstra_1 ='$idekstra' OR id_ekstra_2 ='$idekstra'");
                                                            while ($d2 = mysqli_fetch_array($sql2)) { ?>
                                                    <option
                                                        <?php if ($d1['peserta_kegiatan'] == $d2['id_users']) echo "selected" ?>
                                                        value="<?php echo $d2['id_users'] ?>">
                                                        <?php echo $d2['name'] ?>
                                                    </option>
                                                    <?php
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Unggah Berkas Kegiatan *</label>
                                                <p>Berkas dapat berupa surat edaran kegiatan, pamflet atau
                                                    undangan kegiatan, maupun berkas lain yang mendukung bahwa kegiatan
                                                    ini
                                                    adalah kegiatan asli</p>
                                                <p style="color: red">File dikirim dalam bentuk PDF</p>
                                                <p>File lama: <?php echo $d['bukti_kegiatan'] ?></p>

                                                <input type="file" class="form-control" id="file" name="file" required
                                                    <?php if ($d['setuju_pembina'] == '1') echo "disabled" ?>>
                                            </div>
                                            <p style="color: red">* = wajib diisi
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '0') { ?>
                                            <a target="blank"
                                                href="<?php echo $url_assets . 'file/surat_tugas/' . $d['surat_tugas'] ?>"
                                                type="button" class="btn btn-primary text-white">Unduh
                                                Surat Tugas</a>
                                            <a href="<?php echo $url_config . "kegiatan?id=" . $d['id_kegiatan'] . "&status=selesai" ?>"
                                                type="button" class="btn btn-success text-white">Kegiatan
                                                Selesai</a>
                                            <?php } else if ($d['setuju_pembina'] == '1' && $d['status_kegiatan'] == '1') { ?>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Tutup</button>
                                            <?php } else { ?>
                                            <a href="<?php echo $url_config . 'delkeg.php?id=' . $d['id_kegiatan'] ?>"
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
                                        <input type="hidden" name="idekstra" value="<?php echo $idekstra ?>">
                                        <input type="text" class="form-control" id="name" name="name" required
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nofile" class="form-label">Penyelenggara Kegiatan *</label>
                                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                            required autocomplete="off">
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
                                        <label for="datefile" class="form-label">Peserta Kegiatan *</label>
                                        <select name="pesertakeg" id="pesertakeg" class="form-control" required>
                                            <option value="" selected></option>
                                            <?php $data = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_ekstra_1 ='$idekstra' OR id_ekstra_2 ='$idekstra'");
                                            while ($d = mysqli_fetch_array($data)) {
                                                echo '<option value="' . $d['id_users'] . '">' . $d['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Unggah Berkas Kegiatan *</label>
                                        <p>Berkas dapat berupa surat edaran kegiatan, pamflet atau
                                            undangan kegiatan, maupun berkas lain yang mendukung bahwa kegiatan ini
                                            adalah kegiatan asli</p>
                                        <p style="color: red">File dikirim dalam bentuk PDF</p>
                                        <input type="file" class="form-control" id="file" name="file" required>
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
    </div>
    <?php

    require_once 'foot.php';
    ?>