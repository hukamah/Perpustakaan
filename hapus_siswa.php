<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
// Cek jika parameter 'nis' ada di URL
if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];

    // Query untuk menghapus data siswa berdasarkan NIS
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    // Menjalankan query
    if (mysqli_query($koneksi, $query)) {
        header('Location: index_2.php'); // Arahkan kembali ke halaman daftar siswa
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo " id tidak ditemukan!";
}
?>
