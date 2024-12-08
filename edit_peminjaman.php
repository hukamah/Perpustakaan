<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data peminjaman berdasarkan ID
$query = "SELECT p.id, p.id_buku, p.id_siswa, p.tanggal_pinjam, p.tanggal_kembali, p.status 
          FROM peminjaman p
          WHERE p.id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Query untuk mendapatkan daftar buku
$queryBuku = "SELECT id_buku, judul FROM buku";
$resultBuku = mysqli_query($koneksi, $queryBuku);

// Query untuk mendapatkan daftar siswa
$querySiswa = "SELECT id_siswa, nama FROM siswa";
$resultSiswa = mysqli_query($koneksi, $querySiswa);

// Update data peminjaman jika form disubmit
if (isset($_POST['update'])) {
    $id_buku = $_POST['id_buku'];
    $id_siswa = $_POST['id_siswa'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE peminjaman SET 
                    id_buku = '$id_buku', 
                    id_siswa = '$id_siswa', 
                    tanggal_pinjam = '$tanggal_pinjam', 
                    tanggal_kembali = '$tanggal_kembali', 
                    status = '$status' 
                    WHERE id = $id";

    if (mysqli_query($koneksi, $updateQuery)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='daftar_peminjaman.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Peminjaman</h2>
    <form method="POST">
        <!-- Dropdown untuk Judul Buku -->
        <div class="form-group">
            <label for="id_buku">Judul Buku</label>
            <select class="form-control" id="id_buku" name="id_buku" required>
                <?php
                while ($buku = mysqli_fetch_assoc($resultBuku)) {
                    $selected = $data['id_buku'] == $buku['id_buku'] ? 'selected' : '';
                    echo "<option value='{$buku['id_buku']}' $selected>{$buku['judul']}</option>";
                }
                ?>
            </select>
        </div>
        
        <!-- Dropdown untuk Nama Siswa -->
        <div class="form-group">
            <label for="id_siswa">Nama Siswa</label>
            <select class="form-control" id="id_siswa" name="id_siswa" required>
                <?php
                while ($siswa = mysqli_fetch_assoc($resultSiswa)) {
                    $selected = $data['id_siswa'] == $siswa['id_siswa'] ? 'selected' : '';
                    echo "<option value='{$siswa['id_siswa']}' $selected>{$siswa['nama']}</option>";
                }
                ?>
            </select>
        </div>
        
        <!-- Input untuk Tanggal Pinjam -->
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam']; ?>" required>
        </div>

        <!-- Input untuk Tanggal Kembali -->
        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?= $data['tanggal_kembali']; ?>" required>
        </div>
        
        <!-- Dropdown untuk Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="dipinjam" <?= $data['status'] == 'dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
                <option value="dikembalikan" <?= $data['status'] == 'dikembalikan' ? 'selected' : ''; ?>>Dikembalikan</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="daftar_peminjaman.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
