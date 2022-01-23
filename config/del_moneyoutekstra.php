<?php
include_once 'koneksi.php';

$id_pengeluaran = $_GET['id_pengeluaran'];

$sql = "DELETE FROM tb_uang_keluar WHERE id_pengeluaran = '$id_pengeluaran'";
if ($conn->query($sql) === TRUE) {
    header('location: ../pages/admin/pengeluaran?mes=hapus');
} else {
    header('location: ../pages/admin/pengeluaran?mes=error');
}