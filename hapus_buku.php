<?php
// Sambungkan ke database
include 'koneksi.php'; 

// Periksa apakah parameter 'id' dikirimkan
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_buku = $_GET['id'];

    // Amankan ID buku
    $id_buku = mysqli_real_escape_string($koneksi, $id_buku);

    // Query untuk menghapus data berdasarkan ID buku
    $query = "DELETE FROM buku WHERE id_buku = '$id_buku'";

    if (mysqli_query($koneksi, $query)) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus data
        header("Location: index.php");
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
