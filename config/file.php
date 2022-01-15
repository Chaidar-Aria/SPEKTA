<?php

require_once 'koneksi.php';

if (isset($_POST['addfile'])) {
    $nofile = $_POST['nofile'];
    $namefile = $_POST['namefile'];
    $datefile = $_POST['datefile'];

    $limit = 100 * 1024 * 1024;
    $ukuran    = $_FILES['file']['size'];
    $files = $_FILES['file']['name'];
    $eks_dibolehkan = ['pdf', 'docx', 'doc', 'xlsx', 'xls']; // ekstensi yang diperbolehkan
    $x = explode('.', $files); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['file']['tmp_name'];
    if ($ukuran > $limit) {
        header('location:../pages/superadmin/berkas_pengumuman?mes=gagal_fileukuran');
    } else {
        if (!in_array($ekstensi, $eks_dibolehkan)) {
            // echo $ekstensi;
            header('location:../pages/superadmin/berkas_pengumuman?mes=gagal_fileekstensi');
        } else {
            move_uploaded_file($file_tmp, '../assets/file/pengumuman/' . $files);
            $sql = "INSERT INTO tb_files (no_file, name_file, date_file, file_berkas, created_at) VALUES ('$nofile','$namefile','$datefile','$files',CURRENT_TIMESTAMP)";
            if ($conn->query($sql) === TRUE) {
                header('location:../pages/superadmin/berkas_pengumuman?mes=fileadd_success');
                // echo $conn->connect_error . 'success';
            } else {
                // echo $conn->connect_error;
                header('location:../pages/superadmin/berkas_pengumuman?mes=error');
            }
        }
    }
} else if (isset($_POST['editfile'])) {
    $idfiles = $_POST['idfile'];
    $nofile = $_POST['nofile'];
    $namefile = $_POST['namefile'];
    $datefile = $_POST['datefile'];


    $limit = 100 * 1024 * 1024;
    $ukuran    = $_FILES['file']['size'];
    $files = $_FILES['file']['name'];
    $eks_dibolehkan = ['pdf', 'docx', 'doc', 'xlsx', 'xls']; // ekstensi yang diperbolehkan
    $x = explode('.', $files); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['file']['tmp_name'];
    if ($ukuran > $limit) {
        header('location:../pages/superadmin/berkas_pengumuman?mes=gagal_fileukuran');
    } else {
        if (!in_array($ekstensi, $eks_dibolehkan)) {
            // echo $ekstensi;
            header('location:../pages/superadmin/berkas_pengumuman?mes=gagal_fileekstensi');
        } else {
            // pilih data yang akan dihapus berdasarkan id
            $sql1 = "SELECT * FROM tb_files WHERE id_files='$idfiles'";
            $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
            $data = mysqli_fetch_array($query1);

            // lakukan eksekusi hapus data dengan menggunakan query sql DELETE
            $sql2 = "DELETE FROM tb_files WHERE id_files='$idfiles'";
            $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

            // tentukan direktori penyimpanan file yang akan dihapus
            $path = "../assets/file/pengumuman/" . $data["file_berkas"];

            // cek jika ada file
            if (file_exists($path)) {
                if (unlink($path) == TRUE) {
                    move_uploaded_file($file_tmp, '../assets/file/pengumuman/' . $files);
                    $sql = "INSERT INTO tb_files (no_file, name_file, date_file, file_berkas, created_at) VALUES ('$nofile','$namefile','$datefile','$files',CURRENT_TIMESTAMP)";
                    if ($conn->query($sql) === TRUE) {
                        header('location:../pages/superadmin/berkas_pengumuman?mes=fileedit_success');
                        // echo $conn->connect_error . 'success';
                    } else {
                        // echo $conn->connect_error;
                        header('location:../pages/superadmin/berkas_pengumuman?mes=error');
                    }
                } else {
                    // echo $conn->connect_error;
                    header('location:../pages/superadmin/berkas_pengumuman?mes=error');
                }
            }
        }
    }
}