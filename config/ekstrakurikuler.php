<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../app/vendor/autoload.php';

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
        header('location: ../pages/users/exam?mes=ekstraganda');
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
            $sql = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_1 
                                            WHERE tb_users.id_ekstra_1= '$ekstra1'");
            while ($data1 = mysqli_fetch_array($sql)) {
                $ekskul1 = $data1['ekstrakurikuler'];
            }
            $sql2 = mysqli_query($conn, "SELECT * FROM tb_ekstrakurikuler 
                                            INNER JOIN tb_users ON tb_ekstrakurikuler.id_ekstra = tb_users.id_ekstra_2
                                            WHERE tb_users.id_ekstra_2 = '$ekstra2'");
            while ($data2 = mysqli_fetch_array($sql2)) {
                $ekskul2 = $data2['ekstrakurikuler'];
            }
            $sql = mysqli_query($conn, "SELECT * FROM tb_users INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc WHERE tb_users.id_users = '$id_users'");
            while ($data3 = mysqli_fetch_array($sql)) {
                $nameuser = $data3['name'];
                $email = $data3['email'];
            }
            $mail = new PHPMailer(true);
            $email_template = 'welcome_ekstra.html';
            try {
                //server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->SMTPDebug    = false;
                $mail->isSMTP();
                $mail->Host         = 'smtp.mailtrap.io';
                $mail->SMTPAuth     = true;
                $mail->Username     = '2aa79927c9f834';
                $mail->Password     = 'ea69ba662e15ba';
                $mail->SMTPSecure   = "TLS";
                $mail->Port = 2525;

                //Recipients
                $mail->setFrom('noreply.spektasmansa@sman1mejayan.sch.id', 'SPEKTA SMANSA');
                $mail->addAddress($email);
                $mail->addReplyTo('noreply.spektasmansa@sman1mejayan.sch.id', 'SPEKTA SMANSA');

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'SELAMAT DATANG DI EKSTRAKURIKULER SMA NEGERI 1 MEJAYAN';
                $message = file_get_contents($email_template);
                $message = str_replace('%namauser%', $nameuser, $message);
                $message = str_replace('%ekstra1%', $ekskul1, $message);
                $message = str_replace('%ekstra2%', $ekskul2, $message);

                $mail->msgHTML($message);
                $mail->send();
                echo 'message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
            header('location: ../pages/users/exam?mes=ekstraberhasil');
        } else {
            // echo $conn->connect_error;
            header('location: ../pages/users/exam?mes=gagal');
        }
    }
}