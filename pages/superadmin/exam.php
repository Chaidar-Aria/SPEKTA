<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data CBT SPEKTA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">CBT SPEKTA</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data CBT SPEKTA</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelmember">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Ujian</th>
                            <th>Tanggal Ujian</th>
                            <th>Waktu Ujian</th>
                            <th>Durasi Ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Ujian</th>
                            <th>Tanggal Ujian</th>
                            <th>Waktu Ujian</th>
                            <th>Durasi Ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query2 = "SELECT * FROM tb_test INNER JOIN tb_cbt_time ON tb_test.test_id = tb_cbt_time.test_id";
                        $result2 = $conn->query($query2);
                        while ($row2 = $result2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo strtoupper($row2['test_name']) ?></td>
                            <td><?php echo tgl_indo(date("Y-m-d", strtotime($row2['cbt_date_start']))) . ' ~ ' . tgl_indo(date("Y-m-d", strtotime($row2['cbt_date_end']))); ?>
                            <td><?php echo date("h:i", strtotime($row2['cbt_time_start'])) . "~" . date("h:i", strtotime($row2['cbt_time_end'])) ?>
                            </td>
                            <td><?php echo $row2['cbt_timer'] . ' menit'; ?></td>
                            <td>
                                <?php if ($row2['cbt_status'] == "1") { ?>
                                <a onclick="sudahMulai()" id="sudahMulai" class="badge badge-primary"><i
                                        class="fas fa-search"></i></a>
                                <?php } else {
                                    ?>
                                <a href="<?php echo $url_superadmin . 'detailexam?test_id=' . $row2['test_id']; ?>"
                                    class="badge badge-primary"><i class="fas fa-search"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    function sudahMulai() {
        Swal.fire({
            icon: 'warning',
            title: 'UJIAN SEDANG BERLANGSUNG',
            text: 'Silahkan menunggu sampai ujian selesai untuk melihat data',
        });
    }
    </script>
    <?php
    require_once 'foot.php';
    ?>