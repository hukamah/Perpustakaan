<link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="icon" href="img/group.png" type="image/png">

<style>
/* CSS Sidebar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Sidebar Styling */
.sidebar {
    width: 250px;
    background-color: #222d32;
    height: 100vh;
    position: fixed;
    left: -250px; /* Tersembunyi secara default */
    top: 0;
    transition: left 0.3s ease;
    z-index: 1001;
}

.sidebar .profile {
    text-align: center;
    padding: 20px;
}

.sidebar .profile img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: block;
    margin: 0 auto;
}

.sidebar .role {
    background-color: orange;
    color: #fff;
    padding: 10px;
    margin-top: 10px;
    width: 100%; /* Lebar penuh sidebar */
    text-align: center;
    border-radius: 5px;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: #fff;
    display: block;
    width: 100%; /* Lebar penuh sidebar */
    text-align: left; /* Rata kiri */
    padding: 10px 10px 10px 20px; /* Spasi untuk ikon */
    font-weight: bold;
    background-color: #222d32;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar nav ul li a.active {
    color: #fff;
    font-weight: bold;
}

.sidebar nav ul li a:hover {
    background-color: #1a2226;
    color: grey;
}

/* Sidebar Toggle */
#sidebar-toggle:checked ~ .sidebar {
    left: 0;
}

/* Toggle Button */
.toggle-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    cursor: pointer;
    z-index: 1002;
}

.menu,
.close {
    display: inline-block;
    font-size: 20px;
    color: #222d32;
}

.close {
    display: none;
}

/* Show Close Icon When Sidebar Active */
#sidebar-toggle:checked + .toggle-btn .menu {
    display: none;
}

#sidebar-toggle:checked + .toggle-btn .close {
    display: inline-block;
}

/* Main Content */
.main-content {
    margin-left: 0;
    padding: 20px;
    transition: margin-left 0.3s ease;
    background-color: #f4f4f4;
    flex-grow: 1;
}

#sidebar-toggle:checked ~ .main-content {
    margin-left: 250px; /* Sama dengan lebar sidebar */
}

.container {
    margin-top: 80px;
    width: calc(100% - 250px);
}
</style>

<!-- Checkbox untuk Toggle -->
<input type="checkbox" id="sidebar-toggle" hidden>

<!-- Tombol Toggle -->
<label for="sidebar-toggle" class="toggle-btn">
    <span class="menu"><i class="fas fa-bars"></i></span>
    <span class="close"><i class="fas fa-times"></i></span>
</label>

<!-- Sidebar -->
<div class="sidebar">
    <div class="profile">
        <img src="img/profile.png" alt="Profile">
        <b><div class="role">Administrator</div></b>
    </div>
    <nav>
        <ul>
            <li><a href="db_admin.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="data_buku.php"><i class="fas fa-book"></i> Tambah Data Buku</a></li>
            <li><a href="data_siswa.php"><i class="fas fa-user-graduate"></i> Tambah Data Siswa</a></li>
            <li><a href="peminjaman_buku.php"><i class="fas fa-book-reader"></i> Form Peminjaman</a></li>
            <li><a href="pengembalian.php"><i class="fas fa-undo-alt"></i> Data Pengembalian</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>
</div>
