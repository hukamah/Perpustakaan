<!-- tampilan data Buku -->
<?php 
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/daftar buku.png" type="image/png">
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
    z-index: 2;
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
    z-index: 3;
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
#sidebar-toggle:checked + .toggle-btn .menu {
    display: none;
}

#sidebar-toggle:checked + .toggle-btn .close {
    display: inline-block;
}

/* Main Content Styling */
.main-content {
    margin-left: 0;
    padding: 20px;
    transition: margin-left 0.3s ease; /* Transisi halus */
}

/* Menggeser konten utama saat sidebar aktif */
#sidebar-toggle:checked ~ .main-content {
    margin-left: 250px; /* Geser sesuai lebar sidebar */
}
</style>

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
        <h2 class="text-center">Data Buku</h2>
        <button class="btn btn-primary mb-3" onclick="window.location.href='data_buku.php'">+ Tambah Data</button>
        <table id="dataBuku" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM buku");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['id_buku']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['pengarang']}</td>
                        <td>{$row['penerbit']}</td>
                        <td>{$row['tahun']}</td>
                        <td>
                            <a href='edit_buku.php?id={$row['id']}' class='btn btn-success'>Edit</a>
                          <a href='hapus_buku.php?id=" . $row['id_buku'] . "' class='btn btn-danger'>Hapus</a>

                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataBuku').DataTable();
        });
    </script>
</body>
</html>





