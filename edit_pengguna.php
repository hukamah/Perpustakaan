<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit;
}

include 'sidebar.php';
include 'koneksi.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Query untuk mendapatkan data pengguna
    $sql = "SELECT * FROM pengguna WHERE username='$username'";
    $result = $koneksi->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $roles = $_POST['roles'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Jika password baru diisi, update juga password
        $sql = "UPDATE pengguna 
                SET nama_pengguna='$nama_pengguna', roles='$roles', password='$password' 
                WHERE username='$username'";
    } else {
        // Jika password tidak diisi, jangan ubah password
        $sql = "UPDATE pengguna 
                SET nama_pengguna='$nama_pengguna', roles='$roles' 
                WHERE username='$username'";
    }

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data pengguna berhasil diubah!'); window.location='data_pengguna.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/gambar.png" type="image/png">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
    }
    .main-content {
      flex: 1;
      margin-left: 250px; /* Sesuaikan dengan sidebar */
      padding: 30px;
    }
    footer {
      text-align: center;
      color: #888;
      padding: 20px 0;
      font-size: 14px;
      background-color: transparent;
      border-top: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <div class="container">
      <h2>Edit Pengguna</h2>
      <form method="POST" action="edit_pengguna.php?username=<?php echo $user['username']; ?>">
        <div class="mb-3">
          <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
          <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?php echo $user['nama_pengguna']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" readonly required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password Baru</label>
          <input type="text" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
        </div>
        <div class="mb-3">
          <label for="roles" class="form-label">Level</label>
          <select class="form-select" id="roles" name="roles" required>
            <option value="admin" <?php echo ($user['roles'] == 'admin') ? 'selected' : ''; ?>>admin</option>
            <option value="siswa" <?php echo ($user['roles'] == 'siswa') ? 'selected' : ''; ?>>siswa</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <footer>
    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
  </footer>
</body>
</html>
