<?php
$koneksi = new mysqli("localhost", "root", "", "perpus");
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM ebook WHERE id = $id")->fetch_assoc();

if (isset($_POST['submit'])) {
  $judul = $_POST['judul'];
  $pdf_name = $data['file_pdf'];
  $cover_name = $data['cover'];

  // Jika file PDF baru diunggah
  if ($_FILES['file_pdf']['name']) {
    $pdf_name = time() . '-' . $_FILES['file_pdf']['name'];
    move_uploaded_file($_FILES['file_pdf']['tmp_name'], 'upload/' . $pdf_name);
  }

  // Jika file cover baru diunggah
  if ($_FILES['cover']['name']) {
    $cover_name = time() . '-' . $_FILES['cover']['name'];
    move_uploaded_file($_FILES['cover']['tmp_name'], 'upload/cover/' . $cover_name);
  }

  $koneksi->query("UPDATE ebook SET judul='$judul', file_pdf='$pdf_name', cover='$cover_name' WHERE id = $id");
  header("Location: ebook.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit eBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold text-blue-700 mb-4">Edit eBook</h1>
    <form method="POST" enctype="multipart/form-data">
      <label class="block mb-2 font-semibold">Judul:</label>
      <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" class="w-full border p-2 mb-4 rounded" required>

      <label class="block mb-2 font-semibold">File PDF (kosongkan jika tidak diubah):</label>
      <input type="file" name="file_pdf" accept="application/pdf" class="w-full border p-2 mb-4 rounded">

      <label class="block mb-2 font-semibold">Cover (kosongkan jika tidak diubah):</label>
      <input type="file" name="cover" accept="image/*" class="w-full border p-2 mb-4 rounded">

      <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
