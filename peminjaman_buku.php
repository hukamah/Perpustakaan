<?php
include 'koneksi.php';

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
    <link rel="icon" href="img/daftar buku.png" type="image/png">
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
        <h2 class="text-center">Form Peminjaman Buku</h2>
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
            <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        </form>
    </div>
</body>
</html>
