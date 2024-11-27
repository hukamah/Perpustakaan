<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];
    $id_siswa = $_POST['id_siswa'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Validasi apakah id_buku ada di tabel buku
    $cek_buku = mysqli_prepare($koneksi, "SELECT id FROM buku WHERE id_buku = ?");
    mysqli_stmt_bind_param($cek_buku, 's', $id_buku); // 's' untuk string
    mysqli_stmt_execute($cek_buku);
    mysqli_stmt_store_result($cek_buku);
    if (mysqli_stmt_num_rows($cek_buku) == 0) {
        die("Error: Buku dengan ID $id_buku tidak ditemukan di tabel buku.");
    }
    mysqli_stmt_close($cek_buku);

    // Validasi apakah id_siswa ada di tabel siswa
    $cek_siswa = mysqli_prepare($koneksi, "SELECT id_siswa FROM siswa WHERE id_siswa = ?");
    mysqli_stmt_bind_param($cek_siswa, 's', $id_siswa); // 's' untuk string
    mysqli_stmt_execute($cek_siswa);
    mysqli_stmt_store_result($cek_siswa);
    if (mysqli_stmt_num_rows($cek_siswa) == 0) {
        die("Error: Siswa dengan ID $id_siswa tidak ditemukan.");
    }
    mysqli_stmt_close($cek_siswa);

    // Jika validasi lolos, simpan data peminjaman
    $query = mysqli_prepare($koneksi, "INSERT INTO peminjaman (id_buku, id_siswa, tanggal_pinjam, tanggal_kembali) 
              VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'ssss', $id_buku, $id_siswa, $tanggal_pinjam, $tanggal_kembali);

    if (mysqli_stmt_execute($query)) {
        echo "Peminjaman berhasil ditambahkan.";
        header("Location: daftar_peminjaman.php"); // Arahkan ke halaman daftar peminjaman
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
