<?php

session_start();

include_once 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$login = "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        WHERE email = '$email' AND password = '$password'";
$result = $conn->query($login);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['level_name'] == "SUPERADMIN") {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = "SUPERADMIN";
            header("location: ../pages/superadmin/");
        } else if ($row['level_name'] == "ADMIN") {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = "ADMIN";
            header("location: ../pages/admin/");
        } else if ($row['level_name'] == "TEACHER") {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = 'TEACHER';
            header("location: ../pages/teacher/");
        } else if ($row['level_name'] == "USER") {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = 'USER';
            header("location: ../pages/users/");
        } else {
            header("location: ../pages/auth/login?pesan=gagal_login");
        }
    }
} else {
    header("location: ../pages/auth/login?pesan=gagal_login");
}