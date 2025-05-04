<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];
    $id_siswa = $_POST['id_siswa'];
    $jumlah = $_POST['jumlah']; 
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Simpan data ke tabel peminjaman
    $query = "INSERT INTO peminjaman (id_buku, id_siswa, jumlah, tanggal_pinjam, tanggal_kembali, status) 
              VALUES ('$id_buku', '$id_siswa', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')";
    mysqli_query($koneksi, $query);

    // Redirect kembali ke halaman daftar peminjaman
    header("Location: daftar_peminjaman_siswa.php");
    exit();
}
?>
