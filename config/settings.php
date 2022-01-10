<?php

require_once "koneksi.php";

if (isset($_POST['regison'])) {
    $sql = "UPDATE tb_auth_settings SET is_regis = '1', updated_at = current_timestamp()";
    if ($conn->query($sql) === TRUE) {
        header("location:../pages/superadmin/settings?mes=regis_aktif");
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
} else if (isset($_POST['regisoff'])) {
    $sql = "UPDATE tb_auth_settings SET is_regis = '0', updated_at = current_timestamp()";
    if ($conn->query($sql) === TRUE) {
        header("location:../pages/superadmin/settings?mes=regis_nonaktif");
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
} else if (isset($_POST['appsettings'])) {
    $verapp = $_POST['verapp'];
    $reldate = $_POST['releasedate'];
    $aboutapp = $_POST['aboutapp'];

    echo $verapp . $reldate . $aboutapp;

    $sql = "UPDATE tb_app_settings SET app_version = '$verapp', release_date = '$reldate', updated_at = current_timestamp()";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "UPDATE tb_web_settings SET about_spekta = '$aboutapp', updated_at = current_timestamp()";
        if ($conn->query($sql2) === TRUE) {
            header("location:../pages/superadmin/settings?mes=berhasil_app");
        } else {
            header("location:../pages/superadmin/settings?mes=error");
        }
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
}