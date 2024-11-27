<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perpus";

// Membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 


?>