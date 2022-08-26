<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'koneksi.php';

if (isset($_POST['addcbt'])) {
    $id_users = $_GET['id_users'];
    $test_id = $_POST['test_id'];
    $cbtdate = $_POST['cbtdate'];


    $sql = "SELECT * FROM tb_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_users.id_users = '$id_users'
        ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $jumlah = mysqli_num_rows($result);
    while ($d = mysqli_fetch_array($result)) {

        $ekskul1 = $d['id_ekstra_1'];
        $ekskul2 = $d['id_ekstra_2'];
        $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 
                                            WHERE tb_users.id_ekstra_1= '$ekskul1'");
        while ($data1 = mysqli_fetch_array($sql)) {
            $ekstra1 = $data1['id_ekskul'];
        }
        $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2
                                            WHERE tb_users.id_ekstra_2 = '$ekskul2'");
        while ($data2 = mysqli_fetch_array($sql2)) {
            $ekstra2 = $data2['id_ekskul'];
        }

        // USERNAME
        $date = date("y");
        $username = $jumlah . '-' . $date . '-' . $ekstra1 . '-' . $ekstra2;

        //PASSWORD
        $char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = substr(str_shuffle($char), 0, 8);

        $sql = "UPDATE tb_users_cbt 
        SET 
        test_id = '$test_id',
        username = '$username',
        password = '$password'
        WHERE tb_users_cbt.id_users = '$id_users'
        ";

        if ($conn2->query($sql) === TRUE) {
            $sql2 = mysqli_query($conn, "SELECT * FROM db_cbt_spekta.tb_users_cbt 
                                        INNER JOIN db_spekta_3.tb_users ON db_spekta_3.tb_users.id_users = db_cbt_spekta.tb_users_cbt.id_users
                                        INNER JOIN db_spekta_3.tb_account ON db_spekta_3.tb_users.id_acc = db_spekta_3.tb_account.id_acc
                                        WHERE db_cbt_spekta.tb_users_cbt.id_users = '$id_users'");
            while ($d = mysqli_fetch_array($sql2)) {
                $iduserscbt = $d['id_users_cbt'];
                $id_acc = $d['id_acc'];
                $sql4 = "INSERT INTO tb_users_cbt_date (id_users_cbt, test_id, users_cbt_date) VALUES ('$iduserscbt','$test_id','$cbtdate')";
                if ($conn2->query($sql4) === TRUE) {
                    $sql5 = "INSERT INTO tb_users_cbt_status (id_users_cbt, test_id, is_reg) VALUES ('$iduserscbt','$test_id','1')";
                    if ($conn2->query($sql5) === TRUE) {
                        $sql6 = "INSERT INTO tb_users_cbt_choice (id_users_cbt, test_id) VALUES ('$iduserscbt','$test_id')";
                        if ($conn2->query($sql6) == TRUE) {
                            $sql7 = "UPDATE tb_users_status SET pilih_jadwal_cbt ='1' WHERE tb_users_status.id_users='$id_users'";
                            if ($conn->query($sql7)) {
                                header('location: ../pages/users/exam?mes=berhasil_cbt');
                            } else {
                                header('location: ../pages/users/exam?mes=gagal');
                            }
                        } else {
                            header('location: ../pages/users/exam?mes=gagal');
                        }
                    } else {
                        header('location: ../pages/users/exam?mes=gagal');
                    }
                } else {
                    header('location: ../pages/users/exam?mes=gagal');
                }
            }
        } else {
            header('location: ../pages/users/exam?mes=gagal');
        }
    }
}