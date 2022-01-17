<?php

require_once "koneksi.php";

if (isset($_POST['authsettings'])) {
    $dateoprec = $_POST['dateoprec'];
    $datecloserec = $_POST['datecloserec'];
    $annc = $_POST['annc'];

    $sql = "UPDATE tb_auth_settings SET date_open_reg = '$dateoprec', date_close_reg = '$datecloserec', updated_at = current_timestamp()";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "UPDATE tb_app_settings SET about_app = '$annc', updated_at = current_timestamp()";
        if ($conn->query($sql2) === TRUE) {
            header("location:../pages/superadmin/settings?mes=reg_open");
        } else {
            header("location:../pages/superadmin/settings?mes=error");
        }
    } else {
        header("location:../pages/superadmin/settings?mes=error");
    }
} else if (isset($_POST['appsettings'])) {
    $verapp = $_POST['verapp'];
    $reldate = $_POST['releasedate'];
    $aboutapp = $_POST['aboutapp'];

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