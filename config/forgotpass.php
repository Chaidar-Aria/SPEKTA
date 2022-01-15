<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../app/vendor/autoload.php';

require_once 'koneksi.php';

if (isset($_POST['send_link'])) {
    $email = $_POST['email'];
    $sql_check = mysqli_query($conn, "SELECT * FROM tb_account WHERE email = '$email'");
    $r_check = mysqli_num_rows($sql_check);
    if ($r_check == 0) {
        header('location: ../pages/auth/forgot?pesan=email_null');
    } else {
        $str = rand();
        $kode = hash("sha256", $str);
        $sql = "UPDATE tb_account SET code='$kode' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            $mail = new PHPMailer(true);
            $email_template = 'password_template.html';

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
                $mail->Subject = 'RESET PASSWORD AKUN SPEKTA SMANSA';
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
            header('location: ../pages/auth/forgot?pesan=berhasil');
        } else {
            header('location: ../pages/auth/forgot?pesan=gagal');
        }
    }
} elseif (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $code = $_POST['code'];

    $sql = "UPDATE tb_account 
    SET password='$password', 
    code=NULL 
    WHERE email='$email'";
    if ($conn->query($sql) == TRUE) {
        header('location: ../pages/auth/login?pesan=password');
    } else {
        header('location: ../pages/auth/reset_password?pesan=gagal?email=' . $email . '&code=' . $code);
    }
}