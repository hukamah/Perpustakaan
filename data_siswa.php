<?php
session_start();
include 'koneksi.php'; 
include 'sidebar.php'; 
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
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2 class="text-center">Tambah Data Siswa</h2>
            <form method="POST" action="simpan_siswa.php">
                <div class="form-group">
                    <label for="id_siswa">Id Siswa</label>
                    <input type="text" name="id_siswa" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <hr class="text-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
            </div>
        </div>
    </div>
</body>
</html>
