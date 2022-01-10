<?php

include_once 'koneksi.php';

if (isset($_POST['addacc'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $sql_check = mysqli_query($conn, "SELECT * FROM tb_account WHERE email='$email'");
    $r_check = mysqli_num_rows($sql_check);
    if ($r_check > 0) {
        header('location: ../pages/superadmin/account?pesan=akun_ganda');
    } else {
        $regis = "INSERT INTO tb_account (id_acc, email, password) VALUES (NULL, '$email','$password')";
        if ($conn->query($regis) === TRUE) {
            $sql = mysqli_query($conn, "SELECT * FROM tb_account WHERE email = '$email'");
            while ($d = mysqli_fetch_array($sql)) {
                $idacc = $d['id_acc'];
                $lv = "INSERT INTO tb_level (id_acc, id_level_name) VALUES ('$idacc','$level');";
                if ($conn->query($lv) === TRUE) {
                    header('location: ../pages/superadmin/account?pesan=berhasil');
                } else {
                    header('location: ../pages/superadmin/account?pesan=gagal');
                    // echo 'errro1' . $conn->connect_error;
                }
            }
        } else {
            // echo 'errro2' . $conn->connect_error;
            header('location: ../pages/superadmin/account?pesan=gagal');
        }
    }
}