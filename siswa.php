<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit;
}
include 'koneksi.php'; 
include 'sidebar.php';
include 'cek_auth.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Siswa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link rel="icon" href="img/gambar.png" type="image/png" />
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .main-content {
      margin-left: 250px; /* untuk memberi ruang sidebar */
      padding: 30px;
      min-height: 100vh;
      overflow-x: auto;
    }

    .table thead {
      background-color: green;
      color: white;
    }
  </style>
</head>
<body>

<!-- Konten utama -->
<div class="main-content">
  <div class="container">
    <h2 class="text-center mb-4">Data Siswa</h2>
    
    <!-- Tombol Tambah Data & Print -->
    <div class="d-flex mb-3">
      <a href="data_siswa.php" class="btn btn-primary mr-2">+ Tambah Data</a>
      <button onclick="window.print()" class="btn btn-success">Print</button>
    </div>

    <table id="dataSiswa" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Id Siswa</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jurusan</th>
          <th>No_whatsapp</th>
          <th>Alamat</th>
          <th>Kelola</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM siswa";
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Query gagal: " . mysqli_error($koneksi));
        }
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['id_siswa']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['kelas']}</td>
                    <td>{$row['jurusan']}</td>
                    <td>{$row['no_whatsapp']}</td>
                    <td>{$row['alamat']}</td>
                    <td>
                      <a href='edit_siswa.php?id_siswa={$row['id_siswa']}' class='btn btn-success btn-sm'>
                        <i class='fas fa-edit'></i> Edit
                      </a>
                      <a href='hapus_siswa.php?id={$row['id_siswa']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus siswa ini?\")'>
                        <i class='fas fa-trash'></i> Hapus
                      </a>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
      </tbody>
    </table>
    <hr />
    <div class="text-center">
      <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#dataSiswa').DataTable();
  });
</script>

</body>
</html>
