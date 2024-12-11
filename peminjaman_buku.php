<?php
include 'koneksi.php';
include 'sidebar.php';

// Ambil data buku dan siswa untuk ditampilkan dalam dropdown
$query_buku = "SELECT * FROM buku";
$result_buku = mysqli_query($koneksi, $query_buku);

$query_siswa = "SELECT * FROM siswa";
$result_siswa = mysqli_query($koneksi, $query_siswa);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: white;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 1500px; /* Maksimal lebar card */
            margin: 0 auto; /* Center card secara horizontal */
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: bold;
            text-align: center;
            color: black; /*text*/
            background-color: white;
        }

        .form-group {
            margin-bottom: 1rem; /* Memberikan jarak antar elemen form */
        }

        .form-control {
            padding: 0.75rem 1rem; /* Memberikan padding yang lebih nyaman pada input */
            font-size: 1rem;
            width: 100%;
        }

        input[type="date"] {
            width: 100%; /* Memastikan lebar input tanggal sesuai dengan form */
        }

        .btn-primary {
            background-color: #007bff; /* Warna biru standar */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }

        hr.text-light {
            margin: 100px 0;
        }
    </style>
</head>
<body>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="card shadow-lg border-0">
            <div class="card-header">
                <h4>Form Peminjaman Buku</h4>
            </div>
            <div class="card-body">
                <form action="tambah_peminjaman.php" method="POST">
                    <div class="form-group">
                        <label for="id_buku">Buku</label>
                        <select name="id_buku" class="form-control" required>
                            <option value="">Pilih Buku</option>
                            <?php while ($row_buku = mysqli_fetch_assoc($result_buku)) { ?>
                                <option value="<?php echo $row_buku['id_buku']; ?>"><?php echo $row_buku['judul']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_siswa">Nama Siswa</label>
                        <input type="text" id="siswa_input" name="id_siswa" class="form-control" placeholder="Ketik Nama Siswa" required>
                    </div>
                    <script>
                        $(document).ready(function() {
                            var siswaData = [
                                <?php 
                                    // Ambil data siswa dan jadikan array untuk autocomplete
                                    $siswa_autocomplete = [];
                                    while ($row_siswa = mysqli_fetch_assoc($result_siswa)) {
                                        $siswa_autocomplete[] = '"' . addslashes($row_siswa['Nama']) . '"';
                                    }
                                    echo implode(',', $siswa_autocomplete);
                                ?>
                            ];

                            $('#siswa_input').autocomplete({
                                source: siswaData
                            });
                        });
                    </script>
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
                <hr class="text-light">
                <div class="text-center">
                    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
