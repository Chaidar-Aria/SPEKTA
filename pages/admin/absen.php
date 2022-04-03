<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Absensi Anggota</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi Anggota</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelmember">
                    <thead class="thead-light">
                        <tr>
                            <th>ID SPEKTA</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Absen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID SPEKTA</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Absen</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $hariIni = date("Y-m-d");
                        $data = mysqli_query($conn, "SELECT * FROM tb_users
                                            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                                            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users 
                                            INNER JOIN tb_absensi_ekstra ON tb_users.id_users = tb_absensi_ekstra.id_users
                                            WHERE tb_users_status.is_verval = '1'  AND tb_absensi_ekstra.tgl_absen = '$hariIni' AND tb_absensi_ekstra.id_ekstra ='$idekstra'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td>
                                <?php echo $d['id_spekta'] ?>
                            </td>
                            <td><?php echo strtoupper($d['name']); ?></td>
                            <td> <?php if ($d['gender'] == 'L') { ?>
                                LAKI-LAKI
                                <?php } else if ($d['gender'] == 'P') { ?>
                                PEREMPUAN
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($d['hadir'] == '1') { ?>
                                <div class="badge badge-success">HADIR</div><br>
                                <small>
                                    <?php echo $d['created_at']; ?>
                                </small>
                                <?php } else if ($d['ijin'] == '1') { ?>
                                <div class="badge badge-info">IJIN</div> <br>
                                <small>
                                    <?php echo $d['created_at']; ?>
                                </small>
                                <?php } else if ($d['sakit'] == '1') { ?>
                                <div class="badge badge-warning">SAKIT</div> <br>
                                <small>
                                    <?php echo $d['created_at']; ?>
                                </small>
                                <?php } else if ($d['alpa'] == '1') { ?>
                                <div class="badge badge-danger">ALPA</div> <br>
                                <small>
                                    <?php echo $d['created_at']; ?>
                                </small>
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo $url_admin . 'showmember?id_users=' . $d['id_users']; ?>"
                                    class="badge badge-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin" id="tambahAkun">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Absen</h4>
                <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                    action="#" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Absen</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dateabsen" id="dateabsen" class="form-control"
                                        autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Anggota</label>
                                <div class="col-sm-9">
                                    <select name="namaAnggota" id="namaAnggota" class="form-control">
                                        <?php
                                        $sql2 = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_ekstra_1 ='$idekstra' OR id_ekstra_2 ='$idekstra'");
                                        while ($d2 = mysqli_fetch_array($sql2)) { ?>
                                        <option value="<?php echo $d2['id_users'] ?>">
                                            <?php echo $d2['name'] ?>
                                        </option>
                                        <?php
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
                                <label class="col-sm-3 col-form-label">Status Absensi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="stabsen" id="stabsen" required>
                                        <option value="" selected></option>
                                        <option value="hadir">Hadir</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="ijin">Ijin</option>
                                        <option value="alpa">Alpa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2" name="addacc">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin mt-3" id="tambahAkun">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Unduh Data Absen</h4>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mr-2" name="addacc">Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once 'foot.php';
    ?>