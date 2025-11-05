<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
  $halaman = $_POST['halaman'];
  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $folder = 'upload/background/';

  if (!is_dir($folder)) {
    mkdir($folder, 0755, true);
  }

  $namaFile = time() . '_' . basename($gambar);
  if (move_uploaded_file($tmp, $folder . $namaFile)) {
    $koneksi->query("INSERT INTO background (halaman, gambar) VALUES ('$halaman', '$namaFile')");
    header("Location: background.php");
    exit;
  } else {
    echo "Gagal upload gambar.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Background</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="p-6 md:ml-64">
    <div class="bg-white rounded-xl shadow-lg p-6 max-w-xl mx-auto">
      <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Background Baru</h1>
      <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block font-semibold mb-1">Halaman</label>
          <input type="text" name="halaman" placeholder="contoh: beranda, tentang, ebook" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div>
          <label class="block font-semibold mb-1">Pilih Gambar</label>
          <input type="file" name="gambar" accept="image/*" class="w-full" required>
        </div>
        <div>
          <button type="submit" name="tambah" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
            Simpan Background
          </button>
          <a href="background.php" class="ml-4 text-sm text-gray-600 hover:underline">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
