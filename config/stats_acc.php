<?php

include_once 'koneksi.php';

if (isset($_POST['aktif'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '1';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/superadmin/account?pesan=aktif');
    } else {
        header('location:../pages/superadmin/account?pesan=gagal');
    }
} else if (isset($_POST['nonaktif'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '0';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/superadmin/account?pesan=nonaktif');
    } else {
        header('location:../pages/superadmin/account?pesan=gagal');
    }
}