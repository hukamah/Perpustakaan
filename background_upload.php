<?php
include 'koneksi.php';

if (isset($_POST['upload'])) {
  $id = $_POST['id'];
  $gambarBaru = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $folder = "upload/background/";

  // Cek apakah folder ada, kalau belum buat
  if (!is_dir($folder)) {
    mkdir($folder, 0755, true);
  }

  // Ganti nama file supaya unik
  $namaFile = time() . '_' . basename($gambarBaru);

  if (move_uploaded_file($tmp, $folder . $namaFile)) {
    $update = $koneksi->query("UPDATE background SET gambar='$namaFile' WHERE id=$id");

    if ($update) {
      header("Location: background.php");
      exit;
    } else {
      echo "Gagal update database.";
    }
  } else {
    echo "Gagal upload gambar.";
  }
}
?>
