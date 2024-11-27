<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan ID peminjaman dari URL
$id_peminjaman = $_GET['id'];

// Update status peminjaman menjadi 'dikembalikan'
$query = "UPDATE peminjaman SET status = 'dikembalikan', tanggal_kembali = NOW() WHERE id = '$id_peminjaman'";
if (mysqli_query($koneksi, $query)) {
    echo "Buku berhasil dikembalikan.";
    // Redirect ke halaman daftar peminjaman setelah berhasil
    header("Location: daftar_peminjaman.php");
    exit();
} else {
    echo "Gagal mengembalikan buku: " . mysqli_error($koneksi);
}
?>
