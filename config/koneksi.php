<?php
date_default_timezone_set('Asia/Jakarta');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$user = "root";
$pass = "";
$dbname1 = "db_spekta";
$dbname2 = "db_cbt_spekta";

$conn = new mysqli($servername, $user, $pass, $dbname1);
$conn2 = new mysqli($servername, $user, $pass, $dbname2);


if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
} else if ($conn2->connect_error) {
    die("Koneksi ke database gagal: " . $conn2->connect_error);
}