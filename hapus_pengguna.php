<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
    include 'koneksi.php';
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Query untuk menghapus data pengguna
    $sql = "DELETE FROM pengguna WHERE username='$username'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data pengguna berhasil dihapus!'); window.location='data_pengguna.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>
