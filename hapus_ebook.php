<?php
$koneksi = new mysqli("localhost", "root", "", "perpus");
$id = $_GET['id'];

// Ambil data dulu
$data = $koneksi->query("SELECT * FROM ebook WHERE id = $id")->fetch_assoc();

// Hapus file PDF dan cover
if (file_exists("pepustakaan/upload/" . $data['file_pdf'])) {
  unlink("pepustakaan/upload/" . $data['file_pdf']);
}
if (file_exists("pepustakaan/upload/cover/" . $data['cover'])) {
  unlink("pepustakaan/upload/cover/" . $data['cover']);
}

// Hapus dari database
$koneksi->query("DELETE FROM ebook WHERE id = $id");
header("Location: ebook.php");
?>
