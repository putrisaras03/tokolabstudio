<?php
date_default_timezone_set('Asia/Jakarta');

$hostname = 'localhost';
$username = 'root'; // sesuaikan dengan username MySQL
$password = '';     // isi jika pakai password
$dbname   = 'tokolabs'; // nama database kamu

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>