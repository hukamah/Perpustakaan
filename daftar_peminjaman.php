<?php
include 'cek_auth.php';
include 'koneksi.php';
include 'sidebar.php';

// Ambil data peminjaman yang masih "dipinjam"
$query_peminjaman = "SELECT p.id, b.judul, s.nama, s.no_whatsapp, p.jumlah, p.tanggal_pinjam, p.tanggal_kembali, p.status
                    FROM peminjaman p
                    JOIN buku b ON p.id_buku = b.id_buku
                    JOIN siswa s ON p.id_siswa = s.id_siswa
                    WHERE p.status = 'dipinjam'";
$result_peminjaman = mysqli_query($koneksi, $query_peminjaman);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Peminjaman Buku</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    }
    .container {
      margin-left: 250px;
    }
    .table thead {
      background-color: green;
      color: white;
    }
    .btn-print {
      background-color: #28a745;
      color: white;
    }
    .btn-print:hover {
      background-color: #218838;
    }
    .form-control {
      width: 250px;
    }
    footer {
      text-align: center;
      color: #888;
      padding: 20px 0;
      border-top: 1px solid #ddd;
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center">Daftar Peminjaman Buku</h2>

  <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-print" onclick="window.print()">
      <i class="fa-solid fa-print"></i> Print
    </button>
    <input type="text" id="searchPeminjaman" class="form-control" placeholder="Cari di Peminjaman...">
  </div>

  <table class="table table-striped table-bordered" id="tablePeminjaman">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Nama Siswa</th>
        <th>Jumlah</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $hari_ini = date('Y-m-d');
      while ($row = mysqli_fetch_assoc($result_peminjaman)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['judul']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['jumlah']}</td>
                <td>{$row['tanggal_pinjam']}</td>
                <td>{$row['tanggal_kembali']}</td>
                <td>{$row['status']}</td>
                <td>
                  <a href='edit_peminjaman.php?id={$row['id']}' class='btn btn-warning mb-1'><i class='fa-solid fa-edit'></i> Edit</a> 
                  <a href='hapus_peminjaman.php?id={$row['id']}' class='btn btn-danger mb-1' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fa-solid fa-trash'></i> Hapus</a>";
        
        // Jika telat mengembalikan dan ada nomor WhatsApp
        if ($row['tanggal_kembali'] < $hari_ini && !empty($row['no_whatsapp'])) {
          $pesan = "Halo " . $row['nama'] . ", Anda terlambat mengembalikan buku \"" . $row['judul'] . "\" yang seharusnya dikembalikan pada " . $row['tanggal_kembali'] . ". Mohon segera dikembalikan ya 🙏";
          $pesan_encoded = urlencode($pesan);
          $nomorWA = preg_replace('/^0/', '62', $row['no_whatsapp']);

          echo "<br><a href='https://api.whatsapp.com/send?phone={$nomorWA}&text={$pesan_encoded}' target='_blank' class='btn btn-success btn-sm mt-2'>
                  <i class='fab fa-whatsapp'></i> WA
                </a>";
          echo "<br><span class='badge badge-danger mt-2'>Terlambat</span>";
        }

        echo "</td></tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<footer class="text-center mt-5">
  <p>&copy; 2025 SMK Bina Bangsa</p>
</footer>

<script>
  document.getElementById('searchPeminjaman').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tablePeminjaman tbody tr');

    rows.forEach(row => {
      const cells = Array.from(row.cells).map(cell => cell.textContent.toLowerCase());
      const matches = cells.some(cell => cell.includes(filter));
      row.style.display = matches ? '' : 'none';
    });
  });
</script>
</body>
</html>
