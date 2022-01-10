<?php
require_once 'koneksi.php';

if (isset($_POST['uangmasuk'])) {
    $jumlah = $_POST['jumlahmasuk'];
    $tglmasuk = $_POST['tglmasuk'];
    $sumbermasuk = $_POST['sumbermasuk'];

    //ID PEMASUKAN
    $idmasuk = substr(number_format(time() * rand(), 0, '', ''), 0, 2);
    $kode = 'uang-masuk-' . date("dmy") . $idmasuk;

    $sql = "INSERT INTO tb_uang_masuk (kode_uang_masuk, tgl_pemasukan, jumlah, id_sumber) VALUES ('$kode','$tglmasuk','$jumlah','$sumbermasuk')";
    if ($conn->query($sql) === TRUE) {
        header('location: ../pages/admin/pemasukan?pesan=berhasil');
    } else {
        header('location: ../pages/admin/pemasukan?pesan=gagal');
    }
} else if (isset($_POST['uangkeluar'])) {
    $jumlah = $_POST['jumlahkeluar'];
    $tglkeluar = $_POST['tglkeluar'];
    $sumberkeluar = $_POST['sumberkeluar'];

    //ID PENGELUARAN
    $idkeluar = substr(number_format(time() * rand(), 0, '', ''), 0, 2);
    $kode = 'uang-keluar-' . date("dmy") . $idkeluar;

    $sql = "INSERT INTO tb_uang_keluar (kode_uang_keluar, tgl_pengeluaran, jumlah, id_sumber) VALUES ('$kode','$tglkeluar','$jumlah','$sumberkeluar')";
    if ($conn->query($sql) === TRUE) {
        header('location: ../pages/admin/pengeluaran?pesan=berhasil');
    } else {
        header('location: ../pages/admin/pengeluaran?pesan=gagal');
    }
}