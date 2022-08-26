<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../app/vendor/autoload.php';

session_start();

include_once '../app/helper/base_url.php';
include_once 'koneksi.php';


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        header("location: ../pages/auth/login?pesan=email_kosong");
    } else if (empty($password)) {
        header("location: ../pages/auth/login?pesan=pass_kosong");
    } else if (empty($email) && empty($password)) {
        header("location: ../pages/auth/login?pesan=form_kosong");
    } else {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'secret' => '6LdyPWQhAAAAAChqphmUY9uf4C7V5FEC_z7IIPM-',
                'response' => $_POST['g-token'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);
        $output = curl_exec($ch);
        curl_close($ch);
        // $url = 'https://www.google.com/recaptcha/api/siteverify';
        // $secret = '6LdyPWQhAAAAAChqphmUY9uf4C7V5FEC_z7IIPM-';
        // $response = $_POST['g-token'];
        // $remoteip = $_SERVER['REMOTE_ADDR'];

        $login = "SELECT * FROM tb_account
        INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
        INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
        WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($login);
        if ($result->num_rows > 0) {
            // $request = file_get_contents($url . '?secret=' . $secret . '&response=' . $response);
            // $res = json_decode($request);
            $json = json_decode($output);

            // print_r($res);
            if ($json->success == true) {
                while ($row = $result->fetch_assoc()) {
                    $query2 = "SELECT * FROM tb_security";
                    $result2 = $conn->query($query2);
                    while ($row2 = $result2->fetch_assoc()) {
                        if ($row2['is_on'] == '1' && $row2['is_otp'] == '1') {
                            $mail = new PHPMailer(true);
                            $otp_template = 'otp.html';
                            $otp = rand(100000, 999999);
                            try {
                                $query = "UPDATE tb_account SET code = '$otp' WHERE email = '$email'";
                                if ($conn->query($query) === TRUE) {

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
                                    $mail->Subject = 'SISTEM AUTENTIKASI SPEKTA SMANSA';
                                    $message = file_get_contents($otp_template);
                                    $message = str_replace('%otp%', $otp, $message);

                                    $mail->msgHTML($message);
                                    $mail->send();
                                    echo 'message has been sent';

                                    $email64 = base64_encode($email);
                                    $pass64 = base64_encode($password);

                                    header('location: ../pages/auth/otp?e=' . $email64 . '&p=' . $pass64 . '');
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                            }
                        } else if ($row2['is_on'] == '1' && $row2['is_maillogin'] == '1') {
                            $mail = new PHPMailer(true);
                            $otp_template = 'login_mail.html';
                            $code = rand(100000, 999999);
                            $logurl = $url_config . 'login.php?e=' . base64_encode($email) . '&p=' . base64_encode($password) . '&code=' . base64_encode($code) . '&m=email_log';
                            try {
                                $query = "UPDATE tb_account SET code = '$code' WHERE email = '$email'";
                                if ($conn->query($query) === TRUE) {

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
                                    $mail->Subject = 'SISTEM AUTENTIKASI SPEKTA SMANSA';
                                    $message = file_get_contents($otp_template);
                                    $message = str_replace('%logurl%', $logurl, $message);

                                    $mail->msgHTML($message);
                                    $mail->send();
                                    echo 'message has been sent';

                                    $email64 = base64_encode($email);
                                    $pass64 = base64_encode($password);

                                    header('location: ../pages/auth/login?pesan=email_log');
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                            }
                        } else if ($row2['is_on'] == '0') {
                            if ($row['level_name'] == "SUPERADMIN") {
                                $query = "UPDATE tb_account SET code = '' WHERE email = '$email'";
                                if ($conn->query($query) == TRUE) {
                                    $_SESSION['email'] = $email;
                                    $_SESSION['level'] = "SUPERADMIN";
                                    header("location: ../pages/superadmin/");
                                }
                            } else if ($row['level_name'] == "ADMIN") {
                                $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_acc = '" . $row['id_acc'] . "'");
                                while ($row2 = mysqli_fetch_assoc($sql)) {
                                    $query = "UPDATE tb_account SET code = '' WHERE email = '$email'";
                                    if ($conn->query($query) == TRUE) {
                                        $_SESSION['email'] = $email;
                                        $_SESSION['ekstra'] = $row2['id_ekstra'];
                                        $_SESSION['level'] = "ADMIN";
                                        header("location: ../pages/admin/");
                                    }
                                }
                            } else if ($row['level_name'] == "TEACHER") {
                                $sql = mysqli_query($conn, "SELECT * FROM tb_pembina WHERE id_acc = '" . $row['id_acc'] . "'");
                                while ($row3 = mysqli_fetch_assoc($sql)) {
                                    $query = "UPDATE tb_account SET code = '' WHERE email = '$email'";
                                    if ($conn->query($query) == TRUE) {
                                        $_SESSION['email'] = $email;
                                        $_SESSION['pembina'] = $row3['id_pembina'];
                                        $_SESSION['level'] = 'TEACHER';
                                        header("location: ../pages/teacher/");
                                    }
                                }
                            } else if ($row['level_name'] == "USER") {
                                $query = "UPDATE tb_account SET code = '' WHERE email = '$email'";
                                if ($conn->query($query) == TRUE) {
                                    $_SESSION['email'] = $email;
                                    $_SESSION['level'] = 'USER';
                                    header("location: ../pages/users/");
                                }
                            } else {
                                echo "error 6 $conn->error";
                                header("location: ../pages/auth/login?pesan=gagal_login");
                            }
                        } else {
                            header("location: ../pages/auth/login?pesan=gagal_login");
                        }
                    }
                }
            } else {
                // echo "error 2 $conn->error";
                header("location: ../pages/auth/login?pesan=gagal_login");
            }
        } else {
            // echo "error 3 $conn->error";
            header("location: ../pages/auth/login?pesan=gagal_login");
        }
    }
} else if (isset($_POST['otp_verif'])) {

    $email64 = $_POST['email'];
    $pass64 = $_POST['password'];

    $emailnon64 = base64_decode($email64);
    $passnon64 = base64_decode($pass64);
    $otp = $_POST['otp'];

    $login = "SELECT * FROM tb_account
    INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
    WHERE tb_account.email = '$emailnon64' AND tb_account.password = '$passnon64' AND tb_account.code = '$otp'";
    $result = $conn->query($login);
    if ($result->num_rows > 0) {


        while ($row = $result->fetch_assoc()) {
            if ($row['level_name'] == "SUPERADMIN") {
                $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                if ($conn->query($query) == TRUE) {
                    $_SESSION['email'] = $emailnon64;
                    $_SESSION['level'] = "SUPERADMIN";
                    header("location: ../pages/superadmin/");
                }
            } else if ($row['level_name'] == "ADMIN") {
                $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_acc = '" . $row['id_acc'] . "'");
                while ($row2 = mysqli_fetch_assoc($sql)) {
                    $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                    if ($conn->query($query) == TRUE) {
                        $_SESSION['email'] = $emailnon64;
                        $_SESSION['ekstra'] = $row2['id_ekstra'];
                        $_SESSION['level'] = "ADMIN";
                        header("location: ../pages/admin/");
                    }
                }
            } else if ($row['level_name'] == "TEACHER") {
                $sql = mysqli_query($conn, "SELECT * FROM tb_pembina WHERE id_acc = '" . $row['id_acc'] . "'");
                while ($row3 = mysqli_fetch_assoc($sql)) {
                    $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                    if ($conn->query($query) == TRUE) {
                        $_SESSION['email'] = $emailnon64;
                        $_SESSION['pembina'] = $row3['id_pembina'];
                        $_SESSION['level'] = 'TEACHER';
                        header("location: ../pages/teacher/");
                    }
                }
            } else if ($row['level_name'] == "USER") {
                $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                if ($conn->query($query) == TRUE) {
                    $_SESSION['email'] = $emailnon64;
                    $_SESSION['level'] = 'USER';
                    header("location: ../pages/users/");
                }
            } else {
                echo "error 6 $conn->error";
                header("location: ../pages/auth/login?pesan=gagal_login");
            }
        }
    } else {
        header("location: ../pages/auth/otp?e=" . $email64 . "&p=" . $pass64 . "&pesan=gagal");
    }
} else if ($_GET['m'] == 'email_log') {

    $email64 = $_GET['e'];
    $pass64 = $_GET['p'];
    $code64 = $_GET['code'];

    $emailnon64 = base64_decode($email64);
    $passnon64 = base64_decode($pass64);
    $codenon64 = base64_decode($code64);

    $login = "SELECT * FROM tb_account
    INNER JOIN tb_level ON tb_account.id_acc = tb_level.id_acc
    INNER JOIN tb_level_name ON tb_level.id_level_name = tb_level_name.id_level_name
    WHERE tb_account.email = '$emailnon64' AND tb_account.password = '$passnon64' AND tb_account.code = '$codenon64'";
    $result = $conn->query($login);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            if ($row['level_name'] == "SUPERADMIN") {
                $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                if ($conn->query($query) == TRUE) {
                    $_SESSION['email'] = $emailnon64;
                    $_SESSION['level'] = "SUPERADMIN";
                    header("location: ../pages/superadmin/");
                }
            } else if ($row['level_name'] == "ADMIN") {
                $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_acc = '" . $row['id_acc'] . "'");
                while ($row2 = mysqli_fetch_assoc($sql)) {
                    $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                    if ($conn->query($query) == TRUE) {
                        $_SESSION['email'] = $emailnon64;
                        $_SESSION['ekstra'] = $row2['id_ekstra'];
                        $_SESSION['level'] = "ADMIN";
                        header("location: ../pages/admin/");
                    }
                }
            } else if ($row['level_name'] == "TEACHER") {
                $sql = mysqli_query($conn, "SELECT * FROM tb_pembina WHERE id_acc = '" . $row['id_acc'] . "'");
                while ($row3 = mysqli_fetch_assoc($sql)) {
                    $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                    if ($conn->query($query) == TRUE) {
                        $_SESSION['email'] = $emailnon64;
                        $_SESSION['pembina'] = $row3['id_pembina'];
                        $_SESSION['level'] = 'TEACHER';
                        header("location: ../pages/teacher/");
                    }
                }
            } else if ($row['level_name'] == "USER") {
                $query = "UPDATE tb_account SET code = '' WHERE email = '$emailnon64'";
                if ($conn->query($query) == TRUE) {
                    $_SESSION['email'] = $emailnon64;
                    $_SESSION['level'] = 'USER';
                    header("location: ../pages/users/");
                }
            } else {
                echo "error 6 $conn->error";
                header("location: ../pages/auth/login?pesan=gagal_login");
            }
        }
    } else {
        header("location: ../pages/auth/login?pesan=not_found");
    }
}