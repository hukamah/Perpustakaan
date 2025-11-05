<?php
include 'koneksi.php';

$id_buku   = $_POST['id_buku'];
$judul     = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit  = $_POST['penerbit'];
$tahun     = $_POST['tahun'];      // <--- ini belum ada sebelumnya
$jumlah    = $_POST['jumlah'];     // <--- ini sudah ada, tinggal masukkan ke query

$sql = "INSERT INTO buku (id_buku, judul, pengarang, penerbit, tahun, jumlah) 
        VALUES ('$id_buku', '$judul', '$pengarang', '$penerbit', '$tahun', '$jumlah')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: buku.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
