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
} else if (isset($_POST['datasekolah'])) {
    $id = $_POST['id'];
    $namasekolah = $_POST['nameschool'];
    $alamat = $_POST['alamatsekolah'];
    $email = $_POST['emailsekolah'];
    $notelp = $_POST['notelpsekolah'];
    $kepsek = $_POST['kepsek'];
    $nipkepsek = $_POST['nipkepsek'];
    $wakakurikulum = $_POST['wakakurikulum'];
    $nipwakakurikulum = $_POST['nipwakakurikulum'];
    $asswakakurikulum = $_POST['asswakakurikulum'];
    $nipasswakakurikulum = $_POST['nipasswakakurikulum'];
    $wakakesiswaan = $_POST['wakakesiswaan'];
    $nipwakakesiswaan = $_POST['nipwakakesiswaan'];
    $asswakakesiswaan = $_POST['asswakakesiswaan'];
    $nipasswakakesiswaan = $_POST['nipasswakakesiswaan'];

    $sql = "SELECT * FROM tb_data_sekolah";
    $r = $conn->query($sql);
    if ($r->num_rows < 1) {
        $sql2 = "INSERT INTO `tb_data_sekolah` (`nama_sekolah`, `alamat_sekolah`, `kepala_sekolah`, `nip_kepsek`, `waka_kesiswaan`, `nip_waka_kesiswaan`, `waka_kurikulum`, `nip_waka_kurikulum`, `ass_waka_kesiswaan`, `nip_ass_waka_kesiswaan`, `ass_waka_kurikulum`, `nip_ass_waka_kurikulum`, `email_sekolah`, `no_telp_sekolah`) 
        VALUES (NULL, '$namasekolah', '$alamat', '$kepsek', '$nipkepsek', '$wakakesiswaan', '$nipasswakakesiswaan', '$wakakurikulum', '$nipasswakakurikulum', '$asswakakesiswaan', '$nipasswakakesiswaan', '$asswakakurikulum', '$nipasswakakurikulum', '$email', '$notelp');";
        if ($conn->query($sql2) === TRUE) {
            header("location:../pages/superadmin/settings?mes=datasekolah_buat");
        } else {
            header("location:../pages/superadmin/settings?mes=error");
        }
    } else {
        $sql3 = "UPDATE `tb_data_sekolah` 
        SET `nama_sekolah` = '$namasekolah',
        `alamat_sekolah` = '$alamat', 
        `kepala_sekolah` = '$kepsek', 
        `nip_kepsek` = '$nipkepsek', 
        `waka_kesiswaan` = '$wakakesiswaan', 
        `nip_waka_kesiswaan` = '$nipwakakesiswaan', 
        `waka_kurikulum` = '$wakakurikulum', 
        `nip_waka_kurikulum` = '$nipwakakurikulum', 
        `ass_waka_kesiswaan` = '$asswakakesiswaan', 
        `nip_ass_waka_kesiswaan` = '$nipasswakakesiswaan', 
        `ass_waka_kurikulum` = '$asswakakurikulum', 
        `nip_ass_waka_kurikulum` = '$nipasswakakurikulum', 
        `email_sekolah` = '$email', 
        `no_telp_sekolah` = '$notelp',
        `updated_at` = current_timestamp()
        WHERE `tb_data_sekolah`.`id_data_sekolah` = '$id';";
        if ($conn->query($sql3) === TRUE) {
            header("location:../pages/superadmin/settings?mes=datasekolah_edit");
        } else {
            header("location:../pages/superadmin/settings?mes=error");
        }
    }
}