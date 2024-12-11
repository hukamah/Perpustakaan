<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
include 'koneksi.php'; 
include 'sidebar.php'; 

$query = "SELECT p.id, b.judul, s.nama, p.tanggal_pinjam, p.tanggal_kembali, p.status
          FROM peminjaman p
          JOIN buku b ON p.id_buku = b.id_buku
          JOIN siswa s ON p.id_siswa = s.id_siswa";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<style> 
.table thead {
    background-color: green;
    color: white;
}
</style> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
</head>
<body>
<div class="container mt-5" style="margin-left: 250px;">
    <h2 class="text-center">Daftar Peminjaman Buku</h2>
    <table class="table table-striped table-bordered">
    
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Jika status peminjaman adalah "dipinjam", tampilkan tombol kembalikan dan edit
            if ($row['status'] == 'dipinjam') {
                $aksi = "<a href='pengembalian.php?id={$row['id']}' class='btn btn-primary'><i class='fas fa-undo-alt'></i> Kembalikan</a> 
                         <a href='edit_peminjaman.php?id={$row['id']}' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a> 
                         <a href='hapus_peminjaman.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
            } else {
                // Jika sudah dikembalikan, tampilkan status dan tombol edit
                $aksi = "<span class='text-success'><i class='fas fa-check-circle'></i> Sudah Dikembalikan</span>
                         <a href='edit_peminjaman.php?id={$row['id']}' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>";
            }
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['tanggal_pinjam']}</td>
                    <td>{$row['tanggal_kembali']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        {$aksi}
                    </td>
                </tr>";
            $no++;
        }
        ?>
        </div>
        </tbody>
    </table>
</div>
<footer class="text-center mt-5">
    <p>&copy; 2025 SMK Bina Bangsa</p>
</footer>
</body>
</html>
