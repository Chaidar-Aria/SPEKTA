<?php
ob_start();

//Menggabungkan dengan file koneksi yang telah kita buat
require_once '../../config/koneksi.php';
require_once '../helper/base_url.php';
require_once '../helper/tgl_indo.php';


$nama_dokumen = 'Kartu Peserta CBT';
$id_users = $_GET['id'];
?>


<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KARTU UJIAN CBT SPEKTA | Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan
    </title>

    <style>
    .txt-center {
        text-align: center;
    }

    .border- {
        border: 1px solid #000 !important;
    }

    .padding {
        padding: 15px;
    }

    .mar-bot {
        margin-bottom: 15px;
    }

    .admit-card {
        border: 2px solid #000;
        padding: 15px;
        margin: 20px 0;
    }

    .BoxA h5,
    .BoxA p {
        margin: 0;
    }

    h5 {
        text-transform: uppercase;
    }

    table img {
        width: 100%;
        margin: 0 auto;
    }

    .table-bordered td,
    .table-bordered th,
    .table thead th {
        border: 1px solid #000000 !important;
    }
    </style>

</head>

<body>
    <?php

    $sql = "SELECT * FROM tb_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        INNER JOIN tb_users_cbt ON tb_users.id_users = tb_users_cbt.id_users
        INNER JOIN tb_test ON tb_users_cbt.test_id = tb_test.test_id
        WHERE tb_users.id_users = '$id_users'
        ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($result)) {
    ?>
    <section>
        <div class="container">
            <div class="admit-card">
                <div class="BoxA border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>SMA NEGERI 1 MEJAYAN</h5>
                            <p>Jl.P.Sudirman, No.82, <br>Mejayan, Kab.Madiun 63153</p>
                        </div>
                        <div class="col-sm-4 txt-center">
                            <img src="../../assets/img/logo_smansa.png" width="100px;" />
                        </div>
                        <div class="col-sm-4">
                            <h5>CBT SPEKTA</h5>
                            <p>SPEKTA SMANSA</p>
                        </div>
                    </div>
                </div>
                <div class="BoxC border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Username CBT: <?php echo $d['username'] ?></h5>
                            <h5>Password CBT: <?php echo $d['password'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="BoxD border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Nomor Peserta : <?php echo $d['username'] ?></b></td>
                                        <td><b>Nama Ujian: </b> <?php echo $d['test_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Nama Peserta: </b><?php echo $d['name'] ?></td>
                                        <td><b>Jenis Kelamin:
                                            </b><?php if ($d['gender'] == "L") {
                                                        echo "LAKI-LAKI";
                                                    } else {
                                                        echo "PEREMPUAN";
                                                    } ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ruang Ujian: </b>dd-mm-yyy <br><b>Kursi Ujian: </b>HH-MM~HH-MM</td>
                                        <td><b>Tanggal Ujian: </b><?php echo tgl_indo($d['users_cbt_date']) ?> <br>
                                            <b>Jam Ujian:
                                            </b><?php echo date("h:i", strtotime($d['cbt_time_start'])) . "~" . date("h:i", strtotime($d['cbt_time_end'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="    height: 125px;">Saya menyatakan bahwa seluruh
                                            informasi/data yang saya isikan dalam
                                            aplikasi pendaftaran adalah benar. <br><br><br>
                                            <b>
                                                <p style="text-align: right;"> Yang membuat pernyataan
                                                    <br><br><br>
                                                    <?php echo $d['name'] ?>
                                                </p>
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-2 txt-center">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row txt-center">
                                            <?php if ($d['foto_users'] == NULL) { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/Logo SS.png' ?>"
                                                alt="img user" width="150px">
                                            <?php } else { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/user/' . $d['foto_users']; ?>"
                                                alt="img user" wwidth="150px">
                                            <?php } ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="BoxE border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Peserta Wajib:</h5>
                            <p>
                                1. Melihat/cek lokasi 1 (satu) hari sebelum hari pelaksanaan CBT UM UGM; <br>
                                2. Hadir di lokasi ujian 60 menit sebelum ujian dimulai; <br>
                                3. Membawa hasil tes PCR/Swab Antigen/GNose dengan hasil negatif yang masih berlaku pada
                                saat pelaksanaan CBT UM UGM; <br>
                                4. Membawa Kartu Ujian CBT UM UGM; <br>
                                5. Membawa Kartu Identitas Diri (KTP atau KK bagi yg belum memiliki KTP atau SIM atau
                                Passpor);<br>
                                6. Membawa: <br>
                                a.Ijazah (untuk lulusan Tahun 2020 dan 2019); atau <br>
                                b.Surat Keterangan Lulus (SKL)/Surat Keterangan Kelas 12 asli yang memuat identitas dan
                                <br>
                                foto atau fotokopi yang sudah dilegalisir dengan cap basah sekolah (untuk lulusan Tahun
                                2021) <br>
                                7. Turun di area drop zone dan tidak diperbolehkan untuk ditunggui di lokasi tes untuk
                                menghindari kerumunan.

                            </p>
                        </div>
                    </div>
                </div>
                <footer class="txt-center">
                    <p>PANITIA SELEKSI SPEKTA SMA NEGERI 1 MEJAYAN</p>
                    <p>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan</p>
                </footer>

            </div>
        </div>

    </section>

    <?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
//Meload library mPDF
require_once '../vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->Output("KARTU PESERTA CBT.pdf", "D");
?>