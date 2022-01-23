<?php

include_once 'koneksi.php';

if (isset($_POST['aktif'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '1';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/superadmin/account?mes=aktif');
    } else {
        header('location:../pages/superadmin/account?mes=gagal');
    }
} else if (isset($_POST['nonaktif'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '0';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/superadmin/account?mes=nonaktif');
    } else {
        header('location:../pages/superadmin/account?mes=gagal');
    }
} elseif (isset($_POST['aktifteach'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '1';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/teacher/account?mes=aktif');
    } else {
        header('location:../pages/teacher/account?mes=gagal');
    }
} else if (isset($_POST['nonaktifteach'])) {
    $id_acc = $_GET['id_acc'];
    $is_active = '0';

    $sql = "UPDATE tb_account SET is_active = '$is_active' WHERE id_acc='$id_acc'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/teacher/account?mes=nonaktif');
    } else {
        header('location:../pages/teacher/account?mes=gagal');
    }
}