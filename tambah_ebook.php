<?php
ob_start(); 
include 'sidebar.php';
include 'koneksi.php';

// Buat folder upload jika belum ada
if (!is_dir('upload')) mkdir('upload', 0777, true);
if (!is_dir('upload/cover')) mkdir('upload/cover', 0777, true);

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];

    // Upload PDF
    $pdf_name = time() . '-' . $_FILES['file_pdf']['name'];
    $pdf_tmp = $_FILES['file_pdf']['tmp_name'];
    $pdf_target = 'upload/' . $pdf_name;

    // Upload Cover
    $cover_name = time() . '-' . $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    $cover_target = 'upload/cover/' . $cover_name;

    $upload_pdf = move_uploaded_file($pdf_tmp, $pdf_target);
    $upload_cover = move_uploaded_file($cover_tmp, $cover_target);

    if ($upload_pdf && $upload_cover) {
        $koneksi->query("INSERT INTO ebook (judul, file_pdf, cover) VALUES ('$judul', '$pdf_name', '$cover_name')");
        header("Location: ebook.php");
        exit;
    } else {
        echo "<p class='text-danger text-center mt-3'>Gagal upload file!</p>";
    }
}
?>


  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
   <link rel="icon" href="img/Gambar.png" type="image/png">
    <title>Perpustakaan SMK Bina Bangsa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <style>
      body {
        background-color: #f5f5f5;
        margin: 0;
        padding: 30px;
      }
    .main-content {
  margin-left: 230px;
  padding: 30px;
  width: calc(100% - 230px);
}

.card-form {
  width: 100%;
  max-width: unset !important;
  background-color: #ffffff;
  padding: 50px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  margin: auto;
}
      .form-label {
        font-weight: bold;
      }
      .footer-text {
        text-align: center;
        color: #888;
        font-size: 14px;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>

  <div class="main-content">
    <div class="card-form">
      <h3 class="text-center mb-4 text-primary">Tambah eBook</h3>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="judul" class="form-label">Judul eBook</label>
          <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="file_pdf" class="form-label">File PDF</label>
          <input type="file" name="file_pdf" id="file_pdf" class="form-control" accept="application/pdf" required>
        </div>

        <div class="mb-4">
          <label for="cover" class="form-label">Cover eBook</label>
          <input type="file" name="cover" id="cover" class="form-control" accept="image/*" required>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

      <p class="footer-text mt-5">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </div>
  </div>

  </body>
  </html>
