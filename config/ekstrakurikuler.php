<?php

require_once 'koneksi.php';

if (isset($_POST['addpembina'])) {
    $name = $_POST['name'];
    $nip = $_POST['nip'];

    $sql = "INSERT INTO tb_pembina (nip, name) VALUES ('$nip','$name')";
    if ($conn->query($sql) === TRUE) {
        header('location: ../pages/superadmin/pembina?pesan=berhasil');
    } else {
        header('location: ../pages/superadmin/pembina?pesan=gagal');
    }
} else if (isset($_POST['editesktra'])) {
    $id_ekstra = $_GET['id_ekstra'];
    $ekstrakurikuler = $_POST['ekstrakurikuler'];
    $teacher = $_POST['pembina'];

    $query = "UPDATE tb_ekstrakurikuler INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra
                        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
                        SET ekstrakurikuler = '$ekstrakurikuler', id_ekstra = '$teacher' WHERE tb_ekstrakurikuler.id_ekstra = '$id_ekstra'";

    if ($conn->query($query) === TRUE) {
        header('location: ../pages/superadmin/ekstrakurikuler?pesan=berhasil');
    } else {
        header('location: ../pages/superadmin/ekstrakurikuler?pesan=gagal');
    }
} else if (isset($_POST['addekstra'])) {
    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler ORDER BY id_ekskul DESC LIMIT 1");
    while ($d = mysqli_fetch_array($sql)) {
        $idekskul = $d['id_ekskul'] + 1;
        $ekstrakurikuler = $_POST['ekstrakurikuler'];

        $sql = "INSERT INTO tb_ekstrakurikuler (id_ekskul, ekstrakurikuler) VALUES ('$idekskul','$ekstrakurikuler')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/ekstrakurikuler?pesan=berhasil');
        } else {
            header('location: ../pages/superadmin/ekstrakurikuler?pesan=gagal');
        }
    }
} else if (isset($_POST['addekstrausers'])) {
    $id_users = $_GET['id_users'];
    $ekstra1 = $_POST['ekstra1'];
    $ekstra2 = $_POST['ekstra2'];

    if ($ekstra1 == $ekstra2) {
        header('location: ../pages/users/exam?pesan=ganda');
    } else {
        $sql = "UPDATE tb_users 
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            id_ekstra_1 = '$ekstra1',
            id_ekstra_2 = '$ekstra2',
            pilih_ekstra = '1'
            WHERE tb_users.id_users = '$id_users'
            ";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/users/exam?pesan=berhasil');
        } else {
            // echo $conn->connect_error;
            header('location: ../pages/users/exam?pesan=gagal');
        }
    }
} else {
    // echo $conn->connect_error;
    header('location: ../pages/users/exam?pesan=gagal');
}