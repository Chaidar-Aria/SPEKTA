<?php
require_once 'koneksi.php';
require_once '../app/helper/base_url.php';

if (isset($_POST['setujuverval'])) {
    $id_users = $_GET['id_users'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $class = $_POST['class'];
    $religion = $_POST['religion'];
    $street = $_POST['street'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $village = $_POST['village'];
    $district = $_POST['district'];
    $regency = $_POST['regency'];
    $province = $_POST['province'];


    $sql = "UPDATE tb_users 
            INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            name = '$name', 
            nisn = '$nisn', 
            nis = '$nis',
            gender = '$gender',
            birth_place = '$birth_place',
            birth_date = '$birth_date',
            id_class = '$class',
            id_religion='$religion',  
            street = '$street',
            rt='$rt',
            rw='$rw',
            village='$village',
            district='$district',
            regency='$regency',
            province='$province',
            is_verval = '1',
            is_tolak = '0',
            alasan_tolak = '',
            verval_at = current_timestamp()
            WHERE tb_users.id_users = '$id_users'";

    if ($conn->query($sql) === TRUE) {

        header('location:../pages/superadmin/verval?mes=verval');
    } else {
        header('location:../pages/superadmin/verval?mes=error');
    }
} else if (isset($_POST['tolakverval'])) {
    $id_users = $_GET['id_users'];
    $alasantolak = $_POST['alasantolak'];

    $sql = "UPDATE tb_users 
            INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            is_tolak = '1',
            is_verval = '0',
            isi_foto = '0',
            alasan_tolak = '$alasantolak'
            WHERE tb_users.id_users = '$id_users'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/superadmin/verval?mes=tolak');
    } else {
        // echo $conn->connect_error;
        header('location:../pages/superadmin/verval?mes=error');
    }
} else if (isset($_POST['setujuvervaladmin'])) {
    $id_users = $_GET['id_users'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $class = $_POST['class'];
    $religion = $_POST['religion'];
    $street = $_POST['street'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $village = $_POST['village'];
    $district = $_POST['district'];
    $regency = $_POST['regency'];
    $province = $_POST['province'];


    $sql = "UPDATE tb_users 
            INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            name = '$name', 
            nisn = '$nisn', 
            nis = '$nis',
            gender = '$gender',
            birth_place = '$birth_place',
            birth_date = '$birth_date',
            id_class = '$class',
            id_religion='$religion',  
            street = '$street',
            rt='$rt',
            rw='$rw',
            village='$village',
            district='$district',
            regency='$regency',
            province='$province',
            is_verval = '1',
            is_tolak = '0',
            alasan_tolak = '',
            verval_at = current_timestamp()
            WHERE tb_users.id_users = '$id_users'";

    if ($conn->query($sql) === TRUE) {

        header('location:../pages/admin/verval?mes=verval');
    } else {
        header('location:../pages/admin/verval?mes=error');
    }
} else if (isset($_POST['tolakvervaladmin'])) {
    $id_users = $_GET['id_users'];
    $alasantolak = $_POST['alasantolak'];

    $sql = "UPDATE tb_users 
            INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            is_tolak = '1',
            is_verval = '0',
            isi_foto = '0',
            alasan_tolak = '$alasantolak'
            WHERE tb_users.id_users = '$id_users'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/admin/verval?mes=tolak');
    } else {
        // echo $conn->connect_error;
        header('location:../pages/admin/verval?mes=error');
    }
} else if (isset($_POST['addbiodata'])) {
    $id_users = $_GET['id_users'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $class = $_POST['class'];
    $religion = $_POST['religion'];
    $street = $_POST['street'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $village = $_POST['village'];
    $district = $_POST['district'];
    $regency = $_POST['regency'];
    $province = $_POST['province'];
    $poscode = $_POST['poscode'];

    $sql = "UPDATE tb_users 
            INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            name = '$name', 
            nisn = '$nisn', 
            nis = '$nis',
            gender = '$gender',
            birth_place = '$birth_place',
            birth_date = '$birth_date',
            id_class = '$class',
            id_religion='$religion',  
            street = '$street',
            rt='$rt',
            rw='$rw',
            village='$village',
            district='$district',
            regency='$regency',
            province='$province',
            poscode = '$poscode',
            is_permanent = '1',
            is_tolak = '0',
            alasan_tolak = '',
            isi_verval = '1',
            permanent_at = current_timestamp()
            WHERE tb_users.id_users = '$id_users'";

    if ($conn->query($sql) === TRUE) {
        header('location:../pages/users/?mes=success');
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->error;
        header('location:../pages/users/?mes=error');
    }
} else if (isset($_POST['uploadFoto'])) {
    $id_users = $_GET['id_users'];
    $limit = 2 * 1024 * 1024;
    $ukuran    = $_FILES['fotousers']['size'];
    $gambar = $_FILES['fotousers']['name'];
    $eks_dibolehkan = ['jpeg', 'jpg']; // ekstensi yang diperbolehkan
    $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['fotousers']['tmp_name'];
    if ($ukuran > $limit) {
        header('location:../pages/users/upload_foto?mes=gagal_ukuran');
    } else {
        if (!in_array($ekstensi, $eks_dibolehkan)) {
            // echo $ekstensi;
            header('location:../pages/users/upload_foto?mes=gagal_ekstensi');
        } else {
            $namefoto = date('d-m-Y') . '-' . $gambar;
            move_uploaded_file($file_tmp, '../assets/img/user/' . date('d-m-Y') . '-' . $gambar);
            $sql = "UPDATE tb_users 
            INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
            INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
            SET 
            foto_users = '$namefoto',
            isi_foto = '1'
            WHERE tb_users.id_users = '$id_users'";
            if ($conn->query($sql) === TRUE) {
                header('location:../pages/users/?mes=success');
                // echo $conn->connect_error . 'success';
            } else {
                // echo $conn->connect_error;
                header('location:../pages/users/upload_foto?mes=error');
            }
        }
    }
}