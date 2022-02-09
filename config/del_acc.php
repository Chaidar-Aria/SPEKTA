<?php
include_once 'koneksi.php';

$id_acc = $_GET['id_acc'];

$sql = "DELETE FROM tb_account WHERE id_acc = '$id_acc'";
if ($conn->query($sql) === TRUE) {
    header('location:../pages/superadmin/account?mes=hapus');
} else {
    header('location:../pages/superadmin/account?mes=error');
}