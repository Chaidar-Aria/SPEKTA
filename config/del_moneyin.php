<?php
include_once 'koneksi.php';

$id_pemasukan = $_GET['id_pemasukan'];

$sql = "DELETE FROM tb_uang_masuk WHERE id_pemasukan = '$id_pemasukan'";
if ($conn->query($sql) === TRUE) {
    header('location: ../pages/admin/pemasukan?pesan=hapus');
} else {
    header('location: ../pages/admin/pemasukan?pesan=berhasil');
}