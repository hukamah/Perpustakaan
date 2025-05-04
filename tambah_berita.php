<?php
include 'koneksi.php';
include 'sidebar.php';
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target = "img/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $sql = "INSERT INTO berita (judul, gambar, isi, tanggal) VALUES ('$judul', '$gambar', '$isi', CURDATE())";
    mysqli_query($koneksi, $sql);

    header("Location: berita.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: cover;
            justify-content: center;
            height: 700px;
        }

        .container {
            background: white;
            padding: 30px;
            width: 100vh;
            max-width: 900px;
            border-radius: 0px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 150px;
            resize: none;
        }

        .btn-submit {
            width: 100%;
            background: rgb(35, 144, 247);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            font-size: 18px;
        }

        .btn-submit:hover {
            background: rgb(6, 111, 231);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Berita</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul Berita:</label>
        <input type="text" name="judul" required>

        <label>Gambar:</label>
        <input type="file" name="gambar" required>

        <label>Isi Berita:</label>
        <textarea name="isi" required></textarea>

        <input type="submit" name="submit" value="Simpan" class="btn-submit">
    </form>
</div>

</body>
</html>
