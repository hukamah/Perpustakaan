<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
// Cek apakah ada ID yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data peminjaman berdasarkan ID
    $query = "DELETE FROM peminjaman WHERE id = '$id'";

    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman daftar peminjaman setelah penghapusan
        header('Location: peminjaman_buku.php');
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
