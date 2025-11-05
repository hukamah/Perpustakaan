<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query ambil data pengguna
    $sql = "SELECT * FROM pengguna WHERE id_pengguna = '$id'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data pengguna tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kartu Pengguna</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f4f6f9;
      padding: 30px;
    }

    .kartu {
      width: 400px;
      height: 230px;
      background: #fff;
      border-radius: 15px;
      margin: auto;
      overflow: hidden;
      box-shadow: 0px 6px 15px rgba(0,0,0,0.2);
      position: relative;
    }

    .kartu-header {
      background: linear-gradient(90deg, #007bff, #00b4d8);
      color: white;
      text-align: center;
      padding: 12px;
      font-size: 18px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .kartu-body {
      display: flex;
      padding: 15px;
      align-items: center;
    }

    .avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: #007bff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      color: white;
      margin-right: 15px;
    }

    .data {
      font-size: 14px;
      line-height: 1.8;
      width: 100%;
    }

    .row {
      display: grid;
      grid-template-columns: 90px 10px auto; /* kolom label | titik dua | isi */
    }

    .label {
      font-weight: bold;
      color: #333;
    }

    .colon {
      text-align: center;
    }

    .value {
      color: #000;
    }

    .footer {
      background: #f1f1f1;
      text-align: center;
      font-size: 12px;
      padding: 6px;
      color: #555;
      position: absolute;
      bottom: 0;
      width: 100%;
    }

    .btn-print {
      display: block;
      margin: 25px auto;
      padding: 10px 22px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      transition: 0.3s;
    }

    .btn-print:hover {
      background: #218838;
      transform: scale(1.05);
    }

    @media print {
      .btn-print {
        display: none;
      }
      body {
        background: none;
        padding: 0;
      }
      .kartu {
        box-shadow: none;
      }
    }
  </style>
</head>
<body>

<div class="kartu">
  <div class="kartu-header">Kartu Anggota Perpustakaan</div>
  <div class="kartu-body">
    <div class="avatar">
      <i class="fas fa-user"></i>
    </div>
    <div class="data">
      <div class="row">
        <span class="label">ID</span>
        <span class="colon">:</span>
        <span class="value"><?= $row['id_pengguna']; ?></span>
      </div>
      <div class="row">
        <span class="label">Nama</span>
        <span class="colon">:</span>
        <span class="value"><?= $row['nama_pengguna']; ?></span>
      </div>
      <div class="row">
        <span class="label">Username</span>
        <span class="colon">:</span>
        <span class="value"><?= $row['username']; ?></span>
      </div>
      <div class="row">
        <span class="label">Password</span>
        <span class="colon">:</span>
        <span class="value"><?= $row['password']; ?></span>
      </div>
      <div class="row">
        <span class="label">Roles</span>
        <span class="colon">:</span>
        <span class="value"><?= $row['roles']; ?></span>
      </div>
    </div>
  </div>
  <div class="footer">
    © 2025 SMK Bina Bangsa Kersana
  </div>
</div>

<button class="btn-print" onclick="window.print()">🖨️ Cetak Kartu</button>

<!-- Font Awesome untuk ikon avatar -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</body>
</html>
