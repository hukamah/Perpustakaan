<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM berita WHERE id=$id");

header("Location: berita.php");
?>
