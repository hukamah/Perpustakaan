<?php
include 'cek_auth.php';
include 'koneksi.php'; 
include 'sidebar.php'; // Memanggil sidebar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}
.dashboard-page {
    display: flex;
}
.container {
    margin-left: 260px; /* Lebar sidebar */
    padding: 20px;
    width: calc(100% - 260px); /* Sisa ruang setelah sidebar */
    max-width: 100%; /* Pastikan tidak ada batas maksimal */
    min-width: 300px; /* Tentukan batas minimal jika diperlukan */
}




 header {
     background-color: #4CAF50;
     padding: 30px;
     color: #fff;
     text-align: center;
     font-size: 24px;
     border-radius: 5px;
     width: 100%; /* Lebar penuh */
     position: relative;
   
 }
 .cards {
     display: flex;
     gap: 15px;
     margin-top: 30px;
     flex-wrap: wrap;
 }
 .card {
     flex: 1 1 22%; /* Memberikan lebar tetap pada setiap card */
     padding: 30px;
     color: #fff;
     border-radius: 8px;
     text-align: center;
     display: flex;
     flex-direction: column;
     justify-content: space-between; 
     align-items: center; 
     min-height: 200px; 
 }
 .card img.card-icon {
     width: 70px;
     height: auto;
     margin-bottom: 10px;   
 }
 .card h2 {
     font-size: 36px;
     margin-bottom: 10px;
 }
 .card a {
     color: #fff;
     text-decoration: none;
     font-weight: bold;
     display: inline-block;
     margin-top: 10px;
 }
 .blue { background-color: #2196F3; }
 .orange { background-color: #FFA726; }
 .green { background-color: #4CAF50; }
 .red { background-color: #F44336; }
 .dashboard-page .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
 }  
</style>
    <!-- Konten Utama -->
    <div class="main-content">
        <header>
            <h1>Perpustakaan Smk Bina Bangsa</h1>
        </header>
        <div class="cards">
            <div class="card blue">
                <img src="img/daftar buku.png" alt="buku" class="card-icon">
                <b><p>Data Buku</p></b>
                <a href="buku.php" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="card orange">
                <img src="img/group.png" alt="Data" class="card-icon">
                <b><p>Data Siswa</p></b>
                <a href="siswa.php" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="card green">
                <img src="img/pengembalian.png" alt="Pengembalian" class="card-icon">
                <b><p>Data Pengembalian</p></b>
                <a href="pengembalian.php" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="card red">
                <img src="img/peminjaman.png" alt="peminjaman" class="card-icon">
                <b><p>Data Peminjaman</p></b>
                <a href="daftar_peminjaman.php" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <hr class="text-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
            </div>
</body>
</html>
