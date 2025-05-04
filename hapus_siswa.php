<?php
session_start();
include 'koneksi.php'; 
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
// Periksa apakah parameter 'id' dikirimkan
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Amankan ID buku
    $id_siswa = mysqli_real_escape_string($koneksi, $id_siswa);

    // Query untuk menghapus data berdasarkan ID buku
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $query)) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus data
        header("Location: siswa.php");
        exit(); // Pastikan skrip berhenti setelah redirect
    } else {
        echo "Error menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID buku tidak valid.";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
