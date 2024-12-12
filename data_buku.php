<?php
session_start();
include 'koneksi.php'; 
include 'sidebar.php';
include 'cek_auth.php';
?>
<?php
    if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
    ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-center">Tambah Data Buku</h2>
            <form action="simpan_buku.php" method="POST">
                <div class="form-group">
                    <label>Id Buku</label>
                    <input type="text" name="id_buku" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <hr class="text-light">
    <div class="text-center">
    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </div>
</body>
</html>
