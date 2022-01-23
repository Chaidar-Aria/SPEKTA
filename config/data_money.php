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
        header('location: ../pages/admin/pemasukan?mes=berhasil');
    } else {
        header('location: ../pages/admin/pemasukan?mes=error');
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
        header('location: ../pages/admin/pengeluaran?mes=berhasil');
    } else {
        header('location: ../pages/admin/pengeluaran?mes=error');
    }
} else if (isset($_POST['uangmasukekstra'])) {
    $idekstra = $_POST['ekstra'];
    $jumlah = $_POST['jumlahmasuk'];
    $tglmasuk = $_POST['tglmasuk'];
    $sumbermasuk = $_POST['sumbermasuk'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler WHERE id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($sql)) {

        //ID PEMASUKAN
        $kode = $d['id_ekskul'] . '-masuk-' . date("ymd") . "-" . time() * rand(0, 10);

        $sql = "INSERT INTO tb_uang_masuk (kode_uang_masuk, tgl_pemasukan, jumlah, id_sumber, id_ekstra) VALUES ('$kode','$tglmasuk','$jumlah','$sumbermasuk','$idekstra')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/admin/pemasukan?mes=berhasil');
        } else {
            header('location: ../pages/admin/pemasukan?mes=error');
        }
    }
} else if (isset($_POST['uangkeluarekstra'])) {
    $idekstra = $_POST['ekstra'];
    $jumlah = $_POST['jumlahkeluar'];
    $tglkeluar = $_POST['tglkeluar'];
    $sumberkeluar = $_POST['sumberkeluar'];
    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler WHERE id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($sql)) {

        //ID PENGELUARAN
        $kode = $d['id_ekskul'] . '-keluar-' . date("ymd") . "-" . time() * rand(0, 10);

        $sql = "INSERT INTO tb_uang_keluar (kode_uang_keluar, tgl_pengeluaran, jumlah, id_sumber, id_ekstra) VALUES ('$kode','$tglkeluar','$jumlah','$sumberkeluar','$idekstra')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/admin/pengeluaran?mes=berhasil');
        } else {
            header('location: ../pages/admin/pengeluaran?mes=error');
        }
    }
}