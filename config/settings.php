<?php

require_once "koneksi.php";

if (isset($_POST['regison'])) {
    $sql = "UPDATE tb_auth_settings SET is_regis = '1'";
    if ($conn->query($sql) === TRUE) {
        header("location:../pages/superadmin/settings?mes=regis_aktif");
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
} else if (isset($_POST['regisoff'])) {
    $sql = "UPDATE tb_auth_settings SET is_regis = '0'";
    if ($conn->query($sql) === TRUE) {
        header("location:../pages/superadmin/settings?mes=regis_nonaktif");
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
}