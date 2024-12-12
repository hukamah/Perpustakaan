<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
include 'sidebar.php';
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roles = $_POST['roles'];

    // Menggunakan MD5 untuk enkripsi password
    $password_hash = md5($password);

    // Menyimpan data ke dalam tabel pengguna
    $sql = "INSERT INTO pengguna (nama_pengguna, username, password, roles) VALUES ('$nama_pengguna', '$username', '$password_hash', '$roles')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Pengguna berhasil ditambahkan!'); window.location='data_pengguna.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/gambar.png" type="image/png">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Pengguna</h2>
        <form method="POST" action="tambah_pengguna.php">
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Level</label>
                <select class="form-select" id="roles" name="roles" required>
                    <option value="admin">admin</option>
                    <option value="siswa">siswa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </form>
    </div>
</body>
</html>
