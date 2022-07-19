<?php

require_once 'koneksi.php';

$id = $_GET['id'];

// pilih data yang akan dihapus berdasarkan id
$sql1 = "SELECT * FROM tb_kegiatan_ekstra WHERE id_kegiatan='$id'";
$query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
$data = mysqli_fetch_array($query1);

// lakukan eksekusi hapus data dengan menggunakan query sql DELETE
$sql2 = "DELETE FROM tb_kegiatan_ekstra WHERE id_kegiatan='$id'";
$query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

// tentukan direktori penyimpanan file yang akan dihapus
$path = "../assets/file/kegiatan/" . $data["bukti_kegiatan"];

// cek jika ada file
if (file_exists($path)) {

    // gunakan fungsi php unlink
    unlink($path);
    header('location:../pages/users/kegiatan?mes=keg_hapus');
} else {
    header('location:../pages/users/kegiatan?mes=error');
}