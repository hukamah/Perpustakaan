<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perpustakaan SMK Bina Bangsa</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="icon" href="img/Gambar.png" type="image/png" />
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

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #2c3e50, #34495e);
      height: 100vh;
      color: #ecf0f1;
      position: fixed;
      left: 0;
      top: 0;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
      overflow-y: auto;
    }

    .sidebar .profile {
      text-align: center;
      padding: 30px 20px 15px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar .profile img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto;
      display: block;
    }

    .sidebar .role {
      background-color: #e74c3c;
      color: #fff;
      margin-top: 20px;
      padding: 8px;
      font-weight: 600;
    }

    .sidebar nav ul {
      list-style: none;
      padding: 0;
      margin-top: 20px;
    }

    .sidebar nav ul li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #ecf0f1;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease, color 0.3s ease;
      border-left: 4px solid transparent;
      cursor: pointer;
    }

    .sidebar nav ul li a i {
      margin-right: 15px;
      font-size: 18px;
    }

    .sidebar nav ul li a:hover {
      background-color: #3b4c5a;
      color: #ffffff;
      border-left: 4px solid #e67e22;
    }

    /* Dropdown */
    .dropdown-container {
      display: none;
      flex-direction: column;
      padding-left: 40px;
      background-color: #2f3e4e;
    }

    .dropdown-btn.active + .dropdown-container {
      display: flex;
    }

    .dropdown-btn::after {
      content: "\f107";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      margin-left: auto;
      transition: transform 0.3s;
    }

    .dropdown-btn.active::after {
      transform: rotate(180deg);
    }

    .dropdown-container a {
      font-size: 14px;
      padding: 8px 0;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile">
      <img src="img/Gambar.png" alt="Foto Profil" />
      <div class="role">Admin</div>
    </div>
    <nav>
      <ul>
        <li><a href="db_admin.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="data_buku.php"><i class="fas fa-book"></i> Tambah Data Buku</a></li>
        <li><a href="data_siswa.php"><i class="fas fa-user-graduate"></i> Tambah Data Siswa</a></li>
        <li><a href="peminjaman_buku.php"><i class="fas fa-book-reader"></i> Peminjaman</a></li>
        <li><a href="data_pengguna.php"><i class="fas fa-users-cog"></i> Pengguna Sistem</a></li>

        <!-- Dropdown Setting -->
        <li>
          <a class="dropdown-btn"><i class="fas fa-cogs"></i> Setting</a>
          <div class="dropdown-container">
            <a href="tambah_ebook.php"><i class="fas fa-file-pdf"></i> Kelola eBook</a>
            <a href="tambah_berita.php"><i class="fas fa-newspaper"></i> Kelola Berita</a>
            <a href="background.php"><i class="fas fa-images"></i> Kelola Background</a>
            <a href="edit_visimisi.php"><i class="fas fa-book"></i> Kelola Visi & Misi</a>
             <a href="pengumuman.php"><i class="fas fa-bullhorn"></i> Kelola Pengumuman</a>
          </div>
        </li>

        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </nav>
  </div>

  <!-- Script -->
  <script>
    const dropdowns = document.querySelectorAll(".dropdown-btn");
    dropdowns.forEach(btn => {
      btn.addEventListener("click", () => {
        btn.classList.toggle("active");
      });
    });
  </script>

</body>
</html>
