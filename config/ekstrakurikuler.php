<?php

require_once 'koneksi.php';

if (isset($_POST['addpembina'])) {
    $name = $_POST['name'];
    $nip = $_POST['nip'];
    $acc = $_POST['acc'];
    $cek = "SELECT * FROM tb_pembina WHERE id_acc = '$acc' OR name='$name' OR nip = '$nip'";
    $r = mysqli_query($conn, $cek);
    if (mysqli_num_rows($r) > 0) {
        header('location: ../pages/superadmin/pembina?mes=dataganda');
    } else {
        $sql = "INSERT INTO tb_pembina (id_acc, nip, name) VALUES ('$acc','$nip','$name')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/pembina?mes=berhasil_addpembina');
        } else {
            header('location: ../pages/superadmin/pembina?mes=error');
        }
    }
} else if (isset($_POST['editpembina'])) {
    $idpembina = $_GET['idpembina'];
    $name = $_POST['name'];
    $nip = $_POST['nip'];
    $acc = $_POST['acc'];
    $cek = "SELECT * FROM tb_pembina WHERE id_acc = '$acc' OR name='$name' OR nip = '$nip'";
    $r = mysqli_query($conn, $cek);
    if (mysqli_num_rows($r) > 0) {
        header('location: ../pages/superadmin/pembina?mes=dataganda');
    } else {
        $sql = "UPDATE tb_pembina SET name='$name', nip='$nip', id_acc='$acc' WHERE id_pembina = '$idpembina'";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/pembina?mes=berhasil_editpembina');
        } else {
            header('location: ../pages/superadmin/pembina?mes=error');
        }
    }
} else if (isset($_POST['addadmin'])) {
    $name = $_POST['name'];
    $acc = $_POST['acc'];
    $ekstra = $_POST['ekstra'];
    $cek = "SELECT * FROM tb_admin WHERE id_acc = '$acc' OR name='$name'";
    $r = mysqli_query($conn, $cek);
    if (mysqli_num_rows($r) > 0) {
        header('location: ../pages/superadmin/admin_ekstra?mes=dataganda');
    } else {
        $sql = "INSERT INTO tb_admin (id_acc, id_ekstra ,name) VALUES ('$acc','$ekstra','$name')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/admin_ekstra?mes=berhasil_addadmin');
        } else {
            header('location: ../pages/superadmin/admin_ekstra?mes=error');
        }
    }
} else if (isset($_POST['editadmin'])) {
    $idadmin = $_GET['idadmin'];
    $name = $_POST['name'];
    $ekstra = $_POST['ekstra'];
    $acc = $_POST['acc'];
    $cek = "SELECT * FROM tb_admin WHERE id_acc = '$acc' OR name='$name'";
    $r = mysqli_query($conn, $cek);
    if (mysqli_num_rows($r) > 0) {
        header('location: ../pages/superadmin/admin_ekstra?mes=dataganda');
    } else {
        $sql = "UPDATE tb_admin SET name='$name', id_ekstra='$ekstra', id_acc='$acc' WHERE id_admin = '$idadmin'";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/admin_ekstra?mes=berhasil_editadmin');
        } else {
            header('location: ../pages/superadmin/admin_ekstra?mes=error');
        }
    }
} else if (isset($_POST['addbinaekstra'])) {
    $idpembina = $_POST['acc'];
    $ekstra = $_POST['ekstra'];
    if (empty($ekstra)) {
        header('location: ../pages/superadmin/bina_ekstra?id=' . $idpembina . '&mes=kosong');
    } else {
        $sql = "INSERT INTO tb_bina_ekstra (id_pembina, id_ekstra) VALUES ('$idpembina','$ekstra')";
        if ($conn->query($sql) == TRUE) {
            header('location: ../pages/superadmin/pembina?mes=berhasil_addbina');
        } else {
            header('location: ../pages/superadmin/pembina?mes=error');
        }
    }
} else if (isset($_POST['editbinaekstra'])) {
    $idpembina = $_GET['acc'];
    $ekstra = $_POST['ekstra'];
    if (empty($ekstra)) {
        header('location: ../pages/superadmin/bina_ekstra?id=' . $idpembina . '&mes=kosong');
    } else {
        $sql = "UPDATE tb_bina_ekstra SET id_ekstra = '$ekstra' WHERE id_pembina = '$idpembina'";
        if ($conn->query($sql) == TRUE) {
            header('location: ../pages/superadmin/pembina?mes=berhasil_editbina');
        } else {
            header('location: ../pages/superadmin/pembina?mes=error');
        }
    }
} else if (isset($_POST['editekstra'])) {
    $id_ekstra = $_POST['idekskul'];
    $ekstrakurikuler = $_POST['ekstrakurikuler'];
    $query = "UPDATE tb_ekstrakurikuler SET ekstrakurikuler = '$ekstrakurikuler' WHERE id_ekstra = '$id_ekstra'";

    if ($conn->query($query) === TRUE) {
        // echo $conn->connect_error;
        header('location: ../pages/superadmin/ekstrakurikuler?mes=berhasil_edekstra');
    } else {
        // echo $conn->connect_error;
        header('location: ../pages/superadmin/ekstrakurikuler?mes=error');
    }
} else if (isset($_POST['addekstra'])) {
    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler ORDER BY id_ekskul DESC LIMIT 1");
    while ($d = mysqli_fetch_array($sql)) {
        $idekskul = $d['id_ekskul'] + 1;
        $ekstrakurikuler = $_POST['ekstrakurikuler'];

        $sql = "INSERT INTO tb_ekstrakurikuler (id_ekskul, ekstrakurikuler) VALUES ('$idekskul','$ekstrakurikuler')";
        if ($conn->query($sql) === TRUE) {
            header('location: ../pages/superadmin/ekstrakurikuler?mes=berhasil_addekstra');
        } else {
            header('location: ../pages/superadmin/ekstrakurikuler?mes=error');
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
}