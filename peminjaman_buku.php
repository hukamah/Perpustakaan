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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: right;
            align-items: right;
        }

        .card {
            width: 100%;
            max-width: 1112px;
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: bold;
            text-align: center;
            color: black; /*text*/
            background-color: white; 
        }
    </style>
</head>
<body>
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
                    <label for="id_siswa">Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">Pilih Siswa</option>
                        <?php 
                        while ($row_siswa = mysqli_fetch_assoc($result_siswa)) {
                            echo '<option value="' . $row_siswa['id_siswa'] . '">' . $row_siswa['Nama'] . '</option>';
                        }
                        ?>
                    </select>
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
        </div>
    </div>
</body>
</html>
