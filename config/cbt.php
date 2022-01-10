<?php
require_once 'koneksi.php';

if (isset($_POST['addcbt'])) {
    $id_users = $_GET['id_users'];
    $test_id = $_POST['test_id'];
    $cbtdate = $_POST['cbtdate'];

    // USERNAME
    $char = "0123456789";
    $username = substr(str_shuffle($char), 0, 16);
    //PASSWORD
    $char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = substr(str_shuffle($char), 0, 8);



    $sql = "UPDATE tb_users_cbt 
    INNER JOIN tb_users_status ON tb_users_cbt.id_users = tb_users_status.id_users
    SET 
    test_id = '$test_id',
    users_cbt_date = '$cbtdate',
    pilih_jadwal_cbt = '1',
    username = '$username',
    password = '$password'
    WHERE tb_users_cbt.id_users = '$id_users'
    ";

    if ($conn->query($sql) === TRUE) {
        $sql2 = mysqli_query($conn, "SELECT * FROM tb_users_cbt 
                                    INNER JOIN tb_users ON tb_users.id_users = tb_users_cbt.id_users
                                    INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
                                    WHERE tb_users_cbt.id_users = '$id_users'");
        while ($d = mysqli_fetch_array($sql2)) {
            $iduserscbt = $d['id_users_cbt'];
            $id_acc = $d['id_acc'];
            $sql3 = "UPDATE tb_level SET id_users_cbt = '$iduserscbt' WHERE id_acc = '$id_acc'";
            if ($conn->query($sql3) === TRUE) {
                header('location: ../pages/users/exam?pesan=berhasil');
            }
        }
    } else {
        header('location: ../pages/users/exam?pesan=gagal');
    }
}