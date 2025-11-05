<?php
include 'cek_auth.php';
include 'koneksi.php';
include 'sidebar.php';

$query_pengembalian = "SELECT p.id, b.judul, s.nama, p.tanggal_pinjam, p.tanggal_kembali, p.status
                     FROM peminjaman p
                     JOIN buku b ON p.id_buku = b.id_buku
                     JOIN siswa s ON p.id_siswa = s.id_siswa
                     WHERE p.status = 'dikembalikan'";

$result_pengembalian = mysqli_query($koneksi, $query_pengembalian);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengembalian</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" href="img/gambar.png" type="image/png">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f8f9fa;
    }

    .container {
      flex: 1;
      margin-left: 250px;
    }

    .table thead {
      background-color: green;
      color: white;
    }

    footer {
      text-align: center;
      color: #888;
      padding: 20px 0;
      border-top: 1px solid #ddd;
      font-size: 14px;
    }

    .btn-warning, .btn-danger {
      margin-right: 5px;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center">Daftar Pengembalian Buku</h2>
  <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <input type="text" id="searchPengembalian" class="form-control w-25" placeholder="Cari di Pengembalian...">
  </div>
  <table class="table table-striped table-bordered" id="tablePengembalian">
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
    if (mysqli_num_rows($result_pengembalian) > 0) {
      while ($row = mysqli_fetch_assoc($result_pengembalian)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['judul']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['tanggal_pinjam']}</td>
                <td>{$row['tanggal_kembali']}</td>
                <td>{$row['status']}</td>
                <td>
                  <a href='edit_peminjaman.php?id={$row['id']}' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>
                  <a href='hapus_peminjaman.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>
                </td>
              </tr>";
        $no++;
      }
    } else {
      echo "<tr><td colspan='7' class='text-center'>Tidak ada data pengembalian</td></tr>";
    }
    ?>
    </tbody>
  </table>
</div>
<footer class="text-center mt-5">
  <p>&copy; 2025 SMK Bina Bangsa</p>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
  document.getElementById('searchPengembalian').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tablePengembalian tbody tr');

    rows.forEach(row => {
      const cells = Array.from(row.cells).map(cell => cell.textContent.toLowerCase());
      const matches = cells.some(cell => cell.includes(filter));
      row.style.display = matches ? '' : 'none';
    });
  });
</script>
</body>
</html>
