<?php 
include 'cek_auth.php';    
include 'koneksi.php'; 
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Buku</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="icon" href="img/Gambar.png" type="image/png">
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
      min-height: 100vh;
      overflow-x: auto;
    }

    .table thead {
      background-color: green;
      color: white;
    }

    /* Warna khusus saat print */
    @media print {
      body {
        background: white;
      }
      .table thead {
        background-color: green !important;
        -webkit-print-color-adjust: exact; 
        color-adjust: exact;
        color: white !important;
      }
      .btn, .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate {
        display: none !important; /* sembunyikan tombol dan kontrol saat print */
      }
    }
  </style>
</head>
<body>

  <!-- Konten Utama -->
  <div class="main-content">
    <div class="container">
      <h2 class="text-center">Data Buku</h2>
      <a href="data_buku.php" class="btn btn-primary mb-3">+ Tambah Data</a>
      <button onclick="window.print()" class="btn btn-success mb-3">🖨 Print</button>
      <table id="dataBuku" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Jumlah Buku</th>
            <th>Kelola</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = mysqli_query($koneksi, "SELECT * FROM buku") or die(mysqli_error($koneksi));
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                  <td>{$no}</td>
                  <td>{$row['id_buku']}</td>
                  <td>{$row['judul']}</td>
                  <td>{$row['pengarang']}</td>
                  <td>{$row['penerbit']}</td>
                  <td>{$row['jumlah']}</td>
                  <td>
                      <a href='edit_buku.php?id={$row['id']}' class='btn btn-success btn-sm'>
                          <i class='fas fa-edit'></i> Edit
                      </a>
                      <a href='hapus_buku.php?id={$row['id_buku']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>
                          <i class='fas fa-trash'></i> Hapus
                      </a>
                      <a href='peminjaman_buku.php?id_buku={$row['id_buku']}' class='btn btn-primary btn-sm'>
                          <i class='fas fa-book'></i> Pinjam
                      </a>
                  </td>
              </tr>";
              $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
    <hr class="text-light">
    <div class="text-center">
      <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </div>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataBuku').DataTable();
    });
  </script>
</body>
</html>
