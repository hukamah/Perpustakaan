<?php
include 'koneksi.php';
include 'sidebar.php';
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
$sql = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | SMK Bina Bangsa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(244, 244, 244);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-tambah {
            display: inline-block;
            background: rgb(35, 144, 247);
            color: white;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-tambah:hover {
            background: rgb(6, 111, 231);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background: rgb(0, 200, 43);
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e1f5fe;
        }

        td img {
            border-radius: 5px;
            transition: 0.3s;
        }

        td img:hover {
            transform: scale(1.1);
        }

        .btn-aksi {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            font-weight: bold;
            margin: 3px;
            text-decoration: none;
        }

        .btn-edit {
            background: #ffc107;
        }

        .btn-hapus {
            background: #dc3545;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-hapus:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kelola Berita</h2>
    
    <!-- Tambah berita ada di kanan -->
    <div class="action-container">
        <a href="tambah_berita.php" class="btn-tambah">+ Tambah Berita</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['judul']; ?></td>
            <td><img src="img/<?= $row['gambar']; ?>" width="100"></td>
            <td>
                <a href="edit_berita.php?id=<?= $row['id']; ?>" class="btn-aksi btn-edit">✏ Edit</a>
                <a href="hapus_berita.php?id=<?= $row['id']; ?>" class="btn-aksi btn-hapus" onclick="return confirm('Yakin hapus?');">🗑 Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
