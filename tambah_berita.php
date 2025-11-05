<?php
include 'cek_auth.php';
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $gambar = $_FILES['gambar']['name'];
    $target = "img/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $sql = "INSERT INTO berita (judul, gambar, isi, tanggal) VALUES ('$judul', '$gambar', '$isi', CURDATE())";
    mysqli_query($koneksi, $sql);

    header("Location: berita.php");
    exit();
}
?>

<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Berita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/gambar.png" type="image/png">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
      background-color: #f4f4f4;
    }

    .main-content {
      flex: 1;
      margin-left: 250px; /* Sesuaikan dengan sidebar */
      padding: 40px;
    }

    .form-box {
      background-color: white;
      padding: 40px;
      max-width: 1100px;
      margin: 0 auto;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    textarea {
      height: 150px;
      resize: none;
    }

    .btn-submit {
      width: 20%;
      background: rgb(35, 144, 247);
      color: white;
      padding: 15px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      font-size: 18px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-submit:hover {
      background: rgb(6, 111, 231);
    }

    footer {
      text-align: center;
      color: #888;
      padding: 20px 0;
      border-top: 1px solid #ddd;
      margin-left: 250px;
      background-color: transparent;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .main-content, footer {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="main-content">
    <div class="form-box">
      <h2>Tambah Berita</h2>
      <form method="POST" enctype="multipart/form-data">
        <label for="judul">Judul Berita:</label>
        <input type="text" name="judul" id="judul" required>

        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar" id="gambar" required>

        <label for="isi">Isi Berita:</label>
        <textarea name="isi" id="isi" required></textarea>

        <input type="submit" name="submit" value="Simpan" class="btn-submit">
      </form>
    </div>
  </div>

  <footer>
    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
  </footer>
</body>
</html>
