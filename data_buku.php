<?php
// Contoh kode awal di tambah_buku.php
include 'koneksi.php'; // Pastikan jalur ke koneksi.php benar

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/daftar buku.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

.dashboard-page {
    display: flex;
}

/* Sidebar Styling */
.sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    height: 100vh;
    padding: 20px;
    position: fixed;
    left: -250px; /* Hide sidebar by default */
    top: 0;
    bottom: 0;
    transition: left 0.3s ease; /* Smooth transition */
}

.sidebar nav ul li a {
    color: #fff; /* Warna teks default */
    text-decoration: none;
    transition: color 0.3s ease;
}

.sidebar nav ul li a:hover {
    color: #bfbfbf; /* Warna saat hover */
}

.sidebar nav ul li a.active {
    color: #ffa500; /* Warna teks saat halaman aktif */
    font-weight: bold; /* Opsional: Membuat teks lebih tebal */
}

.profile {
    text-align: center;
    margin-bottom: 20px;
}

.profile img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.role {
    background-color: #ffa500;
    color: #fff;
    border-radius: 4px;
    padding: 2px 5px;
    margin-top: 10px;
}

.sidebar nav ul {
    list-style-type: none;
}

.sidebar nav ul li {
    margin: 15px 0;
}

.sidebar nav ul li a {
    color: #fff;
    text-decoration: none;
}

/* Sidebar Toggle Active */
#sidebar-toggle:checked ~ .sidebar {
    left: 0;
}

/* Toggle Button Styling */
.toggle-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    cursor: pointer;
    z-index: 1;
}


.menu {
    width: 23px;
    height: 23px;
    display: inline-block;
}

.close {
    width: 30px;
    height: 30px;
    display: inline-block;
}
.close {
    display: none;
}

/* Menampilkan ikon close saat sidebar aktif */
#sidebar-toggle:checked + .toggle-btn .menu{
    display: none;
}

#sidebar-toggle:checked + .toggle-btn .close{
    display: inline-block;
}</style>
<body class="dashboard-page">

    <!-- Checkbox untuk toggle sidebar -->
    <input type="checkbox" id="sidebar-toggle" style="display: none;">
    <!-- Tombol toggle sidebar -->
    <label for="sidebar-toggle" class="toggle-btn">
        <img src="img/menu.png" alt="Menu" class="menu">
        <img src="img/close.png" alt="Close" class="close">
    </label>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile">
            <img src="img/profile.png" alt="Profile">
            <div class="role">Administrator</div>
        </div>
        <nav>
        <ul>
            <li><a href="db_admin.html"><i class="fas fa-home"></i>  Dashboard</a></li>
            <li><a href="data_buku.php"><i class="fas fa-book"></i>  Tambah Data Buku</a></li>
            <li><a href="Data_siswa.php"><i class="fas fa-user-graduate"></i>  Tambah Data Siswa</a></li>
            <li><a href="peminjaman_buku.php"><i class="fas fa-book-reader"></i>  Form Peminjaman</a></li>
            <li><a href="pengembalian.php"><i class="fas fa-undo-alt"></i>  Data Pengembalian</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>  Logout</a></li>
            </ul>          
      </nav>
    </div>  
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Data Buku</h2>
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
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
