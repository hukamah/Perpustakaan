<?php
include 'cek_auth.php';
include 'koneksi.php'; 
include 'sidebar.php';

// Ambil data pengguna
$sql = "SELECT * FROM pengguna";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="img/gambar.png" type="image/png">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f8f9fa;
    }

    .main-content {
      flex: 1;
      padding: 30px;
      margin-left: 250px; /* Sesuaikan dengan sidebar */
    }

    footer {
      text-align: center;
      color: #888;
      padding: 20px 0;
      font-size: 14px;
      border-top: 1px solid #ddd;
      background-color: #f8f9fa;
    }

    .btn-tambah {
      background-color: #007bff;
      border-color: #007bff;
      color: white;
    }

    .btn-tambah:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="main-content">
  <div class="container">
    <h2 class="mb-4">Data Pengguna</h2>

    <div class="d-flex justify-content-between mb-3">
      <a href="tambah_pengguna.php" class="btn btn-tambah">+ Tambah Pengguna</a>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="bg-primary text-white text-center">
        <tr>
          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Username</th>
          <th>Password</th>
          <th>Roles</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $no = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td class='text-center'>{$no}</td>
                    <td>{$row['nama_pengguna']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['roles']}</td>
                    <td class='text-center'>
                      <a href='edit_pengguna.php?username={$row['username']}' class='btn btn-warning btn-sm'>
                        <i class='fas fa-edit'></i> Edit
                      </a>
                      <a href='hapus_pengguna.php?username={$row['username']}' 
                         class='btn btn-danger btn-sm' 
                         onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>
                        <i class='fas fa-trash'></i> Hapus
                      </a>
                      <a href='cetak_kartu.php?id={$row['id_pengguna']}' 
                         target='_blank' 
                         class='btn btn-success btn-sm'>
                        <i class='fas fa-print'></i> Cetak
                      </a>
                    </td>
                  </tr>";
            $no++;
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>Data tidak ditemukan</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<footer>
  <div class="text-center">
    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
  </div>
</footer>

</body>
</html>

<?php
$koneksi->close();
?>
