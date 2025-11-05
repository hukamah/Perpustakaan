<?php
include 'cek_auth.php';     
include 'koneksi.php'; 
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .main-content {
            flex: 1;
            padding: 5px;
            margin-left: 250px; /* supaya tidak ketutup sidebar */
        }

        footer {
            text-align: center;
            color: #888;
            padding: 20px 0;
            background-color: transparent;
            font-size: 14px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-center">Tambah Data Buku</h2>

            <!-- Tampilkan pesan error/success -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>

            <!-- Form tambah buku -->
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
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Buku</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        <footer>
            <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
        </footer>
    </div>
</body>
</html>
