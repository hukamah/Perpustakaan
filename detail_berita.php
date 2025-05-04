<?php
include 'koneksi.php';

// Cek apakah parameter `id` ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID berita tidak ditemukan.");
}

// Ambil ID dan pastikan itu angka (hindari SQL Injection)
$id = intval($_GET['id']);

$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");

// Cek apakah ada hasil
if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($query) == 0) {
    die("Berita tidak ditemukan.");
}

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['judul']); ?></title>
</head>
<body>
    <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
    <img src="img/<?php echo htmlspecialchars($row['gambar']); ?>" width="500">
    <p><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
    <a href="index.php">Kembali</a>
</body>
</html>
