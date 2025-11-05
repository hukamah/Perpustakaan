<?php
include 'cek_auth.php';
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin</title>
  <link rel="icon" href="img/gambar.png" type="image/png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      display: flex;
      min-height: 100vh;
      background-color: #f0f2f5;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    header {
      background-color: #4CAF50;
      padding: 50px 30px;
      color: #fff;
      text-align: center;
      font-size: 30px;
      border-radius: 5px;
      width: 100%;
      margin-bottom: 15px; 
    }
    header h1 {
      margin: 0;
      font-size: 35px;
    }
    .cards {
      display: flex;
      gap: 15px;
      margin-top: 0; 
      flex-wrap: wrap;
    }
    .card {
      flex: 1 1 22%;
      padding: 70px;
      color: #fff;
      border-radius: 8px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 160px;
      transition: transform 0.5s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .card img.card-icon {
      width: 80px;
      margin-bottom: 10px;
    }
    .card p {
      font-weight: bold;
      margin: 5px 0;
    }
    .card a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      margin-top: 5px;
    }
    .blue { background-color: #2196F3; }
    .orange { background-color: #FFA726; }
    .green { background-color: #4CAF50; }
    .red { background-color: #F44336; }
    footer {
      text-align: center;
      color: #888;
      margin-top: 30px;
      padding: 20px 0;
    }
  </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <header>
      <h1>Perpustakaan SMK Bina Bangsa</h1>
    </header>
    <div class="cards">
      <div class="card blue">
        <img src="img/daftar buku.png" alt="buku" class="card-icon">
        <p>Data Buku</p>
        <a href="buku.php">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="card orange">
        <img src="img/group.png" alt="Data" class="card-icon">
        <p>Data Siswa</p>
        <a href="siswa.php">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="card green">
        <img src="img/pengembalian.png" alt="Pengembalian" class="card-icon">
        <p>Data Pengembalian</p>
        <a href="daftar_pengembalian.php">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="card red">
        <img src="img/peminjaman.png" alt="peminjaman" class="card-icon">
        <p>Data Peminjaman</p>
        <a href="daftar_peminjaman.php">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <footer>
      &copy; 2025 SMK BINA BANGSA KERSANA
    </footer>
  </div>
</body>
</html>