<?php
$servername = "localhost";
$username = "minx6158";
$password = "3mWu4aqNzEFQ81";
$dbname = "perpus";

// Membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 


?>