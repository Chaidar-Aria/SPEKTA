<?php
session_start();
include_once 'koneksi.php';
require_once 'googleapi.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require '../app/vendor/autoload.php';

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google\Service\Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }
    }
}

// kode verifikasi
$str = rand();
$kode = hash("sha256", $str);

$email = $_SESSION['email'];

$regis = "INSERT INTO tb_account (email, code, google_acc) VALUES ('$email', '$kode', '1')";
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
    header('location: ../pages/auth/regis?pesan=gagal');
}