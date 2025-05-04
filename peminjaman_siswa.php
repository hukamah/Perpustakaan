<?php
include 'koneksi.php';
include 'sidebar_siswa.php';

// Ambil data buku dan siswa
$query_buku = "SELECT * FROM buku";
$result_buku = mysqli_query($koneksi, $query_buku);

$query_siswa = "SELECT * FROM siswa";
$result_siswa = mysqli_query($koneksi, $query_siswa);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman Buku</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <style>
        body {
            margin: 0;
            background-color: #f8f9fa;
        }

        .main-content {
            margin-left: 260px; /* agar tidak tertimpa sidebar */
            padding: 40px;
            width: calc(100% - 260px);
            box-sizing: border-box;
            min-height: 100vh;
        }

        .card {
            max-width: 1000px;
            margin: 0 auto;
        }

        .card-header {
            background-color: white;
            text-align: center;
            font-weight: bold;
            border-bottom: none;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="card shadow-lg border-0">
            <div class="card-header">
                <h4>Form Peminjaman Buku</h4>
            </div>
            <div class="card-body">
                <form action="tambah_peminjaman_siswa.php" method="POST">
                    <div class="form-group">
                        <label for="id_buku">Buku</label>
                        <select name="id_buku" class="form-control" required>
                            <option value="">Pilih Buku</option>
                            <?php while ($row_buku = mysqli_fetch_assoc($result_buku)) { ?>
                                <option value="<?= $row_buku['id_buku']; ?>"><?= $row_buku['judul']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_siswa">Siswa</label>
                        <select name="id_siswa" class="form-control" required>
                            <option value="">Pilih Siswa</option>
                            <?php while ($row_siswa = mysqli_fetch_assoc($result_siswa)) { ?>
                                <option value="<?= $row_siswa['id_siswa']; ?>"><?= $row_siswa['Nama']; ?> (<?= $row_siswa['id_siswa']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah Buku</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Pinjam Buku</button>
                </form>
                <div class="footer-text mt-4">
                    &copy; 2025 SMK BINA BANGSA KERSANA
                </div>
            </div>
        </div>
    </div>
</body>
</html>
