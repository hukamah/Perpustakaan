<?php
include 'koneksi.php';

$id_buku = $_POST['id_buku'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];

$sql = "INSERT INTO buku (id_buku, judul, pengarang, penerbit, tahun) VALUES ('$id_buku', '$judul', '$pengarang', '$penerbit', '$tahun')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);

