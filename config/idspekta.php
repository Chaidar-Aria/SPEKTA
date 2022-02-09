<?php
require_once "koneksi.php";

if (isset($_POST['buatidspekta'])) {
    $ekskul1 = $_GET['ekskul1'];
    $ekskul2 = $_GET['ekskul2'];
    $iduser = $_GET['id_user'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler
    INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 WHERE tb_users.id_ekstra_1= '$ekskul1'");
    while ($data1 = mysqli_fetch_array($sql)) {
        $ekstra1 = $data1['id_ekskul'];
    }
    $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
    INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2 WHERE tb_users.id_ekstra_2 = '$ekskul2'");
    while ($data2 = mysqli_fetch_array($sql2)) {
        $ekstra2 = $data2['id_ekskul'];
    }
    $sql3 = mysqli_query($conn, "SELECT * FROM tb_users_utility");
    $count = mysqli_num_rows($sql3);
    if ($count < 10) {
        $jumlah = "0" . $count;
    } else {
        $jumlah = $count;
    }

    $sql4 = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_users=$iduser");
    while ($data4 = mysqli_fetch_array($sql4)) {
        $ttl = $data4['birth_date'];
    }

    // ID SPEKTA
    $id_spekta = $ekstra1 . "-" . $ekstra2 . "-" . date("y", strtotime($ttl)) . "-" . $jumlah;

    $sql5 = "UPDATE tb_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            SET id_spekta = '$id_spekta' WHERE tb_users.id_users = '$iduser'";
    if ($conn->query($sql5) === TRUE) {
        header('location:../pages/superadmin/showmember?mes=successidspekta&id_users=' . $iduser);
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->error;
        header('location:../pages/superadmin/showmember?&mes=errorid_users=' . $iduser);
    }
} else if (isset($_POST['buatidspektaadmin'])) {
    $ekskul1 = $_GET['ekskul1'];
    $ekskul2 = $_GET['ekskul2'];
    $iduser = $_GET['id_user'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler
    INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 WHERE tb_users.id_ekstra_1= '$ekskul1'");
    while ($data1 = mysqli_fetch_array($sql)) {
        $ekstra1 = $data1['id_ekskul'];
    }
    $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
    INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2 WHERE tb_users.id_ekstra_2 = '$ekskul2'");
    while ($data2 = mysqli_fetch_array($sql2)) {
        $ekstra2 = $data2['id_ekskul'];
    }
    $sql3 = mysqli_query($conn, "SELECT * FROM tb_users_utility");
    $count = mysqli_num_rows($sql3);
    if ($count < 10) {
        $jumlah = "0" . $count;
    } else {
        $jumlah = $count;
    }

    $sql4 = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_users=$iduser");
    while ($data4 = mysqli_fetch_array($sql4)) {
        $ttl = $data4['birth_date'];
    }

    // ID SPEKTA
    $id_spekta = $ekstra1 . "-" . $ekstra2 . "-" . date("y", strtotime($ttl)) . "-" . $jumlah;

    $sql5 = "UPDATE tb_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            SET id_spekta = '$id_spekta' WHERE tb_users.id_users = '$iduser'";
    if ($conn->query($sql5) === TRUE) {
        header('location:../pages/admin/showmember?mes=successidspekta&id_users=' . $iduser);
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->error;
        header('location:../pages/admin/showmember?&mes=errorid_users=' . $iduser);
    }
}