<?php
require_once 'koneksi.php';

if (isset($_POST['addkegiatan'])) {
    $idekstra = $_POST['idekstra'];
    $name = $_POST['name'];
    $penyelenggara = $_POST['penyelenggara'];
    $tglmulai = $_POST['datekegmulai'];
    $tglend = $_POST['datekegselesai'];
    $peserta = $_POST['pesertakeg'];
    $limit = 10 * 1024 * 1024;
    $ukuran    = $_FILES['file']['size'];
    $files = $_FILES['file']['name'];
    $eks_dibolehkan = ['pdf']; // ekstensi yang diperbolehkan
    $x = explode('.', $files); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['file']['tmp_name'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler WHERE id_ekstra = '$idekstra'");
    while ($d = mysqli_fetch_array($sql)) {
        $sql2 = mysqli_query($conn, "SELECT * FROM tb_kegiatan_ekstra");
        $jumlahkeg = mysqli_num_rows($sql2);

        $kode_kegiatan = $d['id_ekskul'] . "-" . date("dmy") . "-keg-" . ($jumlahkeg + 1);
        if ($ukuran > $limit) {
            header('location:../pages/admin/kegiatan?mes=gagal_kegukuran');
        } else {
            if (!in_array($ekstensi, $eks_dibolehkan)) {
                // echo $ekstensi;
                header('location:../pages/admin/kegiatan?mes=gagal_kegekstensi');
            } else {
                move_uploaded_file($file_tmp, '../assets/file/kegiatan/' . $files);
                $sql = "INSERT INTO tb_kegiatan_ekstra (id_ekstra, kode_kegiatan, nama_kegiatan, tanggal_mulai_kegiatan, tanggal_selesai_kegiatan,penyelenggara_kegiatan, peserta_kegiatan, bukti_kegiatan) 
                VALUES ('$idekstra','$kode_kegiatan','$name','$tglmulai','$tglend','$penyelenggara','$peserta','$files')";
                if ($conn->query($sql) === TRUE) {
                    header('location:../pages/admin/kegiatan?mes=kegadd_success');
                    // echo $conn->connect_error . 'success';
                } else {
                    // echo $conn->connect_error;
                    header('location:../pages/admin/kegiatan?mes=error');
                }
            }
        }
    }
} else if (isset($_POST['editkegiatan'])) {
    $idkegiatan = $_GET['id'];
    $idekstra = $_POST['idekstra'];
    $name = $_POST['name'];
    $penyelenggara = $_POST['penyelenggara'];
    $tglmulai = $_POST['datekegmulai'];
    $tglend = $_POST['datekegselesai'];
    $peserta = $_POST['pesertakeg'];
    $limit = 10 * 1024 * 1024;
    $ukuran    = $_FILES['file']['size'];
    $files = $_FILES['file']['name'];
    $eks_dibolehkan = ['pdf']; // ekstensi yang diperbolehkan
    $x = explode('.', $files); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['file']['tmp_name'];

    if ($ukuran > $limit) {
        header('location:../pages/admin/kegiatan?mes=gagal_kegeukuran');
        // echo $conn->connect_error;
    } else {
        if (!in_array($ekstensi, $eks_dibolehkan)) {
            // echo $conn->connect_error;
            // echo $ekstensi;
            header('location:../pages/admin/kegiatan?mes=gagal_kegekstensi');
        } else {
            $sql3 = "SELECT * FROM tb_kegiatan_ekstra WHERE id_ekstra='$idekstra'";
            $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
            $data3 = mysqli_fetch_array($query3);

            // tentukan direktori penyimpanan file yang akan dihapus
            $path = "../assets/file/kegiatan/" . $data3["bukti_kegiatan"];
            move_uploaded_file($file_tmp, '../assets/file/kegiatan/' . $files);

            $sql = "UPDATE tb_kegiatan_ekstra 
                    SET
                    nama_kegiatan = '$name',
                    tanggal_mulai_kegiatan ='$tglmulai',
                    tanggal_selesai_kegiatan = '$tglend',
                    penyelenggara_kegiatan = '$penyelenggara',
                    peserta_kegiatan = '$peserta',
                    bukti_kegiatan = '$files'
                    WHERE id_kegiatan = '$idkegiatan'

                        ";
            if ($conn->query($sql) === TRUE) {
                if (file_exists($path)) {
                    if (unlink($path) == TRUE) {
                        header('location:../pages/admin/kegiatan?mes=keged_success');
                        // echo $conn->connect_error . 'success';
                    } else {
                        // echo $conn->connect_error;
                        header('location:../pages/admin/kegiatan?mes=error');
                    }
                } else {
                    // echo $conn->connect_error;
                    header('location:../pages/admin/kegiatan?mes=error');
                }
            } else {
                // echo $conn->connect_error;
                header('location:../pages/admin/kegiatan?mes=error');
            }
        }
    }
} else if (isset($_POST['tolakkegiatan'])) {
    $id = $_GET['id'];
    $alasan = $_POST['alasantolak'];
    $sql = "UPDATE tb_kegiatan_ekstra 
    SET alasan_tolak = '$alasan', setuju_pembina = '0' WHERE id_kegiatan = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/teacher/kegiatan?mes=keg_tolak');
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->connect_error;
        header('location:../pages/teacher/kegiatan?mes=error');
    }
} else if (isset($_POST['setujukegiatan'])) {
    $id = $_GET['id'];
    $sql = "UPDATE tb_kegiatan_ekstra 
    SET alasan_tolak = NULL , setuju_pembina = '1', status_kegiatan ='0' WHERE id_kegiatan = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/teacher/kegiatan?mes=keg_setuju');
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->connect_error;
        header('location:../pages/teacher/kegiatan?mes=error');
    }
} else if (isset($_POST['upsurat'])) {
    $id = $_GET['id'];
    $limit = 10 * 1024 * 1024;
    $ukuran    = $_FILES['surattugas']['size'];
    $files = $_FILES['surattugas']['name'];
    $eks_dibolehkan = ['pdf']; // ekstensi yang diperbolehkan
    $x = explode('.', $files); // memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['surattugas']['tmp_name'];
    if ($ukuran > $limit) {
        header('location:../pages/admin/kegiatan?mes=gagal_surukuran');
    } else {
        if (!in_array($ekstensi, $eks_dibolehkan)) {
            // echo $ekstensi;
            header('location:../pages/admin/kegiatan?mes=gagal_surekstensi');
        } else {
            move_uploaded_file($file_tmp, '../assets/file/surat_tugas/' . $files);
            $sql = "UPDATE tb_kegiatan_ekstra SET surat_tugas = '$files' WHERE id_kegiatan = '$id'";
            if ($conn->query($sql) === TRUE) {
                header('location:../pages/teacher/kegiatan?mes=surat_upload');
                // echo $conn->connect_error . 'success';
            } else {
                // echo $conn->connect_error;
                header('location:../pages/teacher/kegiatan?mes=error');
            }
        }
    }
} else if ($_GET['status'] == "selesai") {
    $idkeg = $_GET['id'];
    $sql = "UPDATE tb_kegiatan_ekstra SET status_kegiatan = '1' WHERE id_kegiatan = '$idkeg'";
    if ($conn->query($sql) === TRUE) {
        header('location:../pages/admin/kegiatan?mes=keg_end');
        // echo $conn->connect_error . 'success';
    } else {
        // echo $conn->connect_error;
        header('location:../pages/admin/kegiatan?mes=error');
    }
}