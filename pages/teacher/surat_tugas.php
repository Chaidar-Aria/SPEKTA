<?php

require_once '../../app/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start();


require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
require_once '../../app/helper/romawi.php';
require_once '../../config/koneksi.php';
$idkeg = $_GET['id'];
$sql1 = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra 
        INNER JOIN tb_ekstrakurikuler ON tb_kegiatan_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
        INNER JOIN tb_bina_ekstra ON tb_bina_ekstra.id_ekstra = tb_ekstrakurikuler.id_ekstra
        INNER JOIN tb_pembina ON tb_pembina.id_pembina = tb_bina_ekstra.id_pembina
        INNER JOIN tb_users ON tb_kegiatan_ekstra.peserta_kegiatan = tb_users.id_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        WHERE tb_kegiatan_ekstra.id_kegiatan = '$idkeg'
        ");
while ($d1 = mysqli_fetch_array($sql1)) {
    $sql2 = mysqli_query($conn, "SELECT * FROM tb_data_sekolah WHERE id_data_Sekolah = '1'");
    while ($d2 = mysqli_fetch_array($sql2)) {
        $hitungsurat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra"));
        if ($hitungsurat <= 100) {
            $hitungsurat = "00" . $hitungsurat;
        } else {
            $hitungsurat;
        }
        $nama_dokumen = "SURAT TUGAS " . $d1['nama_kegiatan'] . " - " . date("r");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT TUGAS <?php echo $d1['nama_kegiatan'] . " - " . date("r") ?></title>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="10" align="center"><img src="<?php echo $url_assets . 'img/logo_smansa.png' ?>" width="125"></td>
            <td align="center">
                <h3>DINAS PENDIDIKAN PROVINSI JAWA TIMUR</h3>
                <h2>SMA NEGERI 1 MEJAYAN</h2>
                <h4>Alamat : Jl. P. Sudirman, No. 82, Kec. Mejayan, Kab. Madiun, Kode Pos: 63153 <br>
                    Website : www.sman1mejayan.sch.id - e-mail : sman1mjy@yahoo.co.id</h4>
            </td>
        </tr>
    </table>
    <hr>
    <h3 align="center">SURAT TUGAS</h3>
    <h4 align="center" style="margin-top: -20px;">
        Nomor: <?php echo $hitungsurat ?>/KEPSEK/SMANSA/<?php echo getRomawi(date("n")) ?>/<?php echo date("Y") ?></h4>

    <div class="surat" style="margin-left:20px;">
        <p>Yang Bertanda tangan dibawah ini:</p>
        <table class="table table-identity table-borderless" width="100%" style="margin-left: 20px;">
            <tbody>
                <tr>
                    <td width="25%">Nama</td>
                    <td>: <?php echo $d2['kepala_sekolah'] ?></td>
                </tr>
                <tr>
                    <td width="25%">NIP</td>
                    <td>: <?php echo $d2['nip_kepsek'] ?></td>
                </tr>
                <tr>
                    <td width="25%">Jabatan</td>
                    <td>: Kepala SMA Negeri 1 Mejayan</td>
                </tr>
            </tbody>
        </table><br>
        Dengan ini menugaskan:
        <table class="table table-identity table-borderless" width="100%" style="margin-left: 20px;">
            <tbody>
                <tr>
                    <td width="25%">Nama</td>
                    <td>: <?php echo $d1['name'] ?></td>
                </tr>
                <tr>
                    <td width="25%">Tanggal Lahir</td>
                    <td>: <?php echo tgl_indo($d1['birth_date']) ?></td>
                </tr>
                <tr>
                    <td width="25%">Kelas</td>
                    <td>: <?php echo $d1['class'] ?></td>
                </tr>
                <tr>
                    <td width="25%">Alamat</td>
                    <td>:
                        <?php echo $d1['street'] . " RT " . $d1['rt'] . "/" . " RW " . $d1['rw'] . " " . $d1['village'] . " " . $d1['district'] . " " . $d1['regency'] . " " . $d1['province'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>Untuk mengikuti kegiatan <?php echo $d1['nama_kegiatan'] ?> yang diselenggarakan oleh
            <?php echo $d1['penyelenggara_kegiatan'] ?> pada tanggal
            <?php echo tgl_indo($d1['tanggal_mulai_kegiatan']) . " - " . tgl_indo($d1['tanggal_selesai_kegiatan']) ?>
        </p>
        <p>Demikian surat tugas ini dibuat untuk dilaksanakan sebaik-baiknya dan segera melapor setelah selesai
            melaksanakan tugas</p>
        <div style="width: 27%; text-align: left; float: right;">Mejayan, <?php echo tgl_indo(date("Y-m-d")) ?></div>
        <br>
        <div style="width: 23%; text-align: left; float: right;">Kepala Sekolah</div><br><br><br><br><br>
        <div style="width: 23%; text-align: left; float: right;"><?php echo $d2['kepala_sekolah'] ?></div> <br>
        <div style="width: 32%; text-align: left; float: right;">NIP. <?php echo $d2['nip_kepsek'] ?></div>

    </div>
</body>

</html>
<?php }
}

$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen . ".pdf", 'I');

?>