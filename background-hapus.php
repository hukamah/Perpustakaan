<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Ambil nama file lama
    $result = $koneksi->query("SELECT gambar FROM background WHERE id = $id");
    $row = $result->fetch_assoc();

    if ($row) {
        $gambar = $row['gambar'];
        $filePath = "upload/background/" . $gambar;

        // Hapus file jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data dari database
        $hapus = $koneksi->query("DELETE FROM background WHERE id = $id");

        if ($hapus) {
            header("Location: background.php");
            exit;
        } else {
            echo "Gagal menghapus dari database.";
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
