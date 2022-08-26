<?php
session_start();
include_once 'koneksi.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../app/vendor/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
    header("location: ../pages/auth/regis?pesan=email_kosong");
} else if (empty($password)) {
    header("location: ../pages/auth/regis?pesan=pass_kosong");
} else if (empty($email) && empty($password)) {
    header("location: ../pages/auth/regis?pesan=form_kosong");
} else {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $secret = '6LdyPWQhAAAAAChqphmUY9uf4C7V5FEC_z7IIPM-';
    $response = $_POST['g-token'];
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $sql_check = mysqli_query($conn, "SELECT * FROM tb_account WHERE email = '$email'");
    $r_check = mysqli_num_rows($sql_check);
    if ($r_check > 0) {
        header('location: ../auth/regis?pesan=akun_ganda');
    } else {
        $request = file_get_contents($url . '?secret=' . $secret . '&response=' . $response);
        $res = json_decode($request);
        // print_r($res);
        if ($res->success == true) {
            // kode verifikasi
            $str = rand();
            $kode = hash("sha256", $str);

            $regis = "INSERT INTO tb_account (email, password, code) VALUES ('$email','$password', '$kode')";
            if ($conn->query($regis) == TRUE) {
                $mail = new PHPMailer(true);
                $email_template = 'email_template.html';
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
                    $mail->Subject = 'VERIFIKASI AKUN SPEKTA SMANSA';
                    $message = file_get_contents($email_template);
                    $message = str_replace('%email%', $email, $message);
                    $message = str_replace('%password%', $pass, $message);
                    $message = str_replace('%kode%', $kode, $message);

                    $mail->msgHTML($message);
                    $mail->send();
                    echo 'message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                }
                header('location: ../pages/auth/regis?pesan=berhasil');
            } else {
                echo "error 2 $conn->error";

                // header('location: ../pages/auth/regis?pesan=gagal');
            }
        } else {
            echo "error 3 $conn->error";

            // header('location: ../pages/auth/regis?pesan=gagal');
        }
    }
}