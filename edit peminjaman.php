<?php
session_start();
include 'koneksi.php';
include 'sidebar.php';
// Cek apakah parameter id ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
    

    // Ambil data peminjaman berdasarkan ID
    $query = "SELECT * FROM peminjaman WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Proses update data
        $id_buku = $_POST['id_buku'];
        $id_siswa = $_POST['id_siswa'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $tanggal_kembali = $_POST['tanggal_kembali'];

        $update_query = "UPDATE peminjaman SET id_buku = '$id_buku', id_siswa = '$id_siswa', 
                         tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali' WHERE id = $id";
        mysqli_query($koneksi, $update_query);

        header('Location: daftar_peminjaman.php');
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Peminjaman</title>
</head>
<body>
<form method="POST">
    <label>Buku:</label>
    <input type="text" name="id_buku" value="<?php echo $data['id_buku']; ?>" required><br>
    <label>Siswa:</label>
    <input type="text" name="id_siswa" value="<?php echo $data['id_siswa']; ?>" required><br>
    <label>Tanggal Pinjam:</label>
    <input type="date" name="tanggal_pinjam" value="<?php echo $data['tanggal_pinjam']; ?>" required><br>
    <label>Tanggal Kembali:</label>
    <input type="date" name="tanggal_kembali" value="<?php echo $data['tanggal_kembali']; ?>" required><br>
    <button type="submit">Simpan</button>
</form>
<hr class="text-light">
<div class="text-center">
     <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
</div>
</body>
</html>
