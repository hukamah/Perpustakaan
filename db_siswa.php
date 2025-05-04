<?php
include 'cek_siswa.php';
include 'koneksi.php';
include 'sidebar_siswa.php'; // Sidebar khusus siswa
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .dashboard-page {
            margin-left: 260px;
            padding: 20px;
        }
        header {
            background-color: #007BFF;
            padding: 20px;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card i {
            font-size: 40px;
        }
    </style>
</head>
<body>
    <div class="dashboard-page">
        <header>
            <h1>Dashboard Siswa</h1>
        </header>

        <div class="alert alert-success text-center">
            Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong>! Silakan pilih menu di bawah.
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-book text-primary"></i>
                        <h5 class="card-title mt-3">Data Peminjaman Buku</h5>
                        <p class="card-text">Cek status peminjaman buku Anda.</p>
                        <a href="daftar_peminjaman_siswa.php" class="btn btn-primary">Lihat Peminjaman</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-arrow-return-left text-success"></i>
                        <h5 class="card-title mt-3">Data Pengembalian Buku</h5>
                        <p class="card-text">Cek status pengembalian buku Anda.</p>
                        <a href="daftar_pengembalian_siswa.php" class="btn btn-primary">Lihat Pengembalian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
