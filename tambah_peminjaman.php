<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form (input manual)
    $judul_buku = $_POST['judul_buku'];
    $nama_siswa = $_POST['nama_siswa'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Cari ID buku berdasarkan judul
    $query_buku = "SELECT id_buku FROM buku WHERE judul = '$judul_buku' LIMIT 1";
    $result_buku = mysqli_query($koneksi, $query_buku);
    $data_buku = mysqli_fetch_assoc($result_buku);
    $id_buku = $data_buku['id_buku'] ?? null;

    // Cari ID siswa berdasarkan nama
    $query_siswa = "SELECT id_siswa FROM siswa WHERE Nama = '$nama_siswa' LIMIT 1";
    $result_siswa = mysqli_query($koneksi, $query_siswa);
    $data_siswa = mysqli_fetch_assoc($result_siswa);
    $id_siswa = $data_siswa['id_siswa'] ?? null;

    if ($id_buku && $id_siswa) {
        // Simpan data ke tabel peminjaman
        $query = "INSERT INTO peminjaman (id_buku, id_siswa, jumlah, tanggal_pinjam, tanggal_kembali, status) 
                  VALUES ('$id_buku', '$id_siswa', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')";
        mysqli_query($koneksi, $query);

        header("Location: daftar_peminjaman.php");
        exit();
    } else {
        echo "<script>alert('Judul buku atau nama siswa tidak ditemukan!'); history.back();</script>";
    }
}
?>
