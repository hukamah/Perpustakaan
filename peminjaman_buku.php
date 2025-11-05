<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Peminjaman Buku</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" href="img/gambar.png" type="image/png">
  <style>
    body {
      margin: 0;
      background-color: #f8f9fa;
    }

    .main-content {
  margin-left: 250px;
  padding: 40px;
  width: calc(100% - 250px);
}

.form-container {
  background-color: #fff;
  padding: 30px 40px;
  width: 100%;
  max-width: unset !important;
}

    .form-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 25px;
      text-align: center;
    }

    .form-group label {
      font-weight: 500;
    }

    .form-control {
      font-size: 16px;
      padding: 10px 15px;
      border-radius: 5px;
    }

    .btn {
      padding: 10px 25px;
      font-size: 16px;
    }

    footer {
      text-align: center;
      color: #888;
      margin-top: 30px;
    }
  </style>
</head>
<body>

<div class="main-content">
  <div class="form-container">
    <div class="form-title">Form Peminjaman Buku</div>
    <form action="tambah_peminjaman.php" method="POST">
      
      <!-- Autocomplete Judul Buku -->
      <div class="form-group">
        <label for="judul_buku">Judul Buku</label>
        <input list="list_buku" name="judul_buku" id="judul_buku" class="form-control" placeholder="Ketik judul buku" required>
        <datalist id="list_buku">
          <?php
          $buku = mysqli_query($koneksi, "SELECT judul FROM buku");
          while ($row = mysqli_fetch_assoc($buku)) {
              echo "<option value='{$row['judul']}'>";
          }
          ?>
        </datalist>
      </div>

      <!-- Autocomplete Nama Siswa -->
      <div class="form-group">
        <label for="nama_siswa">Nama Siswa</label>
        <input list="list_siswa" name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Ketik nama siswa" required>
        <datalist id="list_siswa">
          <?php
          $siswa = mysqli_query($koneksi, "SELECT nama FROM siswa");
          while ($row = mysqli_fetch_assoc($siswa)) {
              echo "<option value='{$row['nama']}'>";
          }
          ?>
        </datalist>
      </div>

      <!-- Input lainnya -->
      <div class="form-group">
        <label for="jumlah">Jumlah Buku</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
      </div>
      <div class="form-group">
        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
      </div>
      <div class="form-group text-right mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-book"></i> Pinjam Buku
        </button>
      </div>
    </form>
    <footer>
      <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </footer>
  </div>
</div>

</body>
</html>