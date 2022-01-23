<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Akun SPEKTA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Data Akun SPEKTA</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Akun SPEKTA</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelaccount">
                    <thead class="thead-light">
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status Akun</th>
                            <th>Dibuat tanggal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status Akun</th>
                            <th>Dibuat tanggal</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        $data = mysqli_query($conn, "SELECT * FROM tb_account 
                                                    INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
                                                    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
                                                    INNER JOIN tb_users ON tb_users.id_acc = tb_account.id_acc
                                                    WHERE tb_level.id_level_name != '1' AND tb_users.id_ekstra_1 = '$idekstra' OR tb_users.id_ekstra_2 = '$idekstra'");
                        while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $d['email']; ?></td>
                            <td><?php echo $d['level_name']; ?></td>
                            <td class="font-weight-medium">
                                <form action="<?php echo $url_config . 'stats_acc.php?id_acc=' . $d['id_acc'] ?>"
                                    method="post">
                                    <?php if ($d['is_active'] == 0) { ?>
                                    <button type="submit" name="aktifteach" class="btn btn-sm btn-danger">NON
                                        AKTIF
                                    </button>
                                    <?php } else { ?>
                                    <button type="submit" name="nonaktifteach" class="btn btn-sm btn-success">AKTIF
                                    </button>
                                    <?php } ?>
                                </form>
                            </td>
                            <td>
                                <?php echo $d['created_at']; ?>
                            </td>
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