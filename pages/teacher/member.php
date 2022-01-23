<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelmember">
                    <thead class="thead-light">
                        <tr>
                            <th>Foto</th>
                            <th>ID SPEKTA</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Foto</th>
                            <th>ID SPEKTA</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        $data = mysqli_query($conn, "SELECT * FROM tb_users
                                            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
                                            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users 
                                            WHERE tb_users_status.is_verval = '1' AND tb_users.id_ekstra_1 ='$idekstra' OR tb_users.id_ekstra_2 ='$idekstra'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo strtoupper($d['name']); ?></td>
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
                            <td>
                                <?php echo strtoupper($d['birth_place']); ?>
                            </td>
                            <td><?php echo tgl_indo($d['birth_date']) ?></td>
                            <td><a href="<?php echo $url_teacher . 'showmember?id_users=' . $d['id_users']; ?>"
                                    class="badge badge-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    require_once 'foot.php';
    ?>