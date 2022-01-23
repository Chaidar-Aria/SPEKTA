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
            $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_acc = '" . $row['id_acc'] . "'");
            while ($row2 = mysqli_fetch_assoc($sql)) {
                $_SESSION['email'] = $email;
                $_SESSION['ekstra'] = $row2['id_ekstra'];
                $_SESSION['level'] = "ADMIN";
                header("location: ../pages/admin/");
            }
        } else if ($row['level_name'] == "TEACHER") {
            $sql = mysqli_query($conn, "SELECT * FROM tb_pembina WHERE id_acc = '" . $row['id_acc'] . "'");
            while ($row3 = mysqli_fetch_assoc($sql)) {
                $_SESSION['email'] = $email;
                $_SESSION['pembina'] = $row3['id_pembina'];
                $_SESSION['level'] = 'TEACHER';
                header("location: ../pages/teacher/");
            }
        } else if ($row['level_name'] == "USER") {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = 'USER';
            header("location: ../pages/users/");
        } else {
            // echo "error 1 $conn->error";
            header("location: ../pages/auth/login?pesan=gagal_login");
        }
    }
} else {
    // echo "error 2 $conn->error";
    header("location: ../pages/auth/login?pesan=gagal_login");
}