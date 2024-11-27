<?php
include 'koneksi.php';
$query = "SELECT p.id, b.judul, s.nama, p.tanggal_pinjam, p.tanggal_kembali, p.status
          FROM peminjaman p
          JOIN buku b ON p.id_buku = b.id_buku
          JOIN siswa s ON p.id_siswa = s.id_siswa";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/transaksi.png" type="image/png">
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
        <h2 class="text-center">Daftar Peminjaman Buku</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    // Jika status peminjaman adalah "dipinjam", tampilkan tombol kembalikan
    if ($row['status'] == 'dipinjam') {
        $aksi = "<a href='pengembalian.php?id={$row['id']}' class='btn btn-primary'>Kembalikan</a> 
                 <a href='hapus_peminjaman.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
    } else {
        $aksi = "<span class='text-success'>Sudah Dikembalikan</span>";
    }
    echo "<tr>
            <td>{$no}</td>
            <td>{$row['judul']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['tanggal_pinjam']}</td>
            <td>{$row['tanggal_kembali']}</td>
            <td>{$row['status']}</td>
            <td>
                {$aksi}
            </td>
        </tr>";
    $no++;
}
?>

 </tbody>
</table>
 </div>
</body>
</html>
