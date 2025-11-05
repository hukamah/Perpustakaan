<?php
include 'sidebar.php';
$koneksi = new mysqli("localhost", "root", "", "perpus");
$ebooks = $koneksi->query("SELECT * FROM ebook");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola eBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100"> <!-- FIXED: Hapus 'flex' -->

  <!-- Sidebar sudah dimasukkan lewat include -->

  <!-- Konten utama -->
  <div class="flex-1 p-6 ml-[250px]"> <!-- ml sesuai sidebar -->
    
    <!-- Judul -->
    <h1 class="text-2xl font-bold text-blue-700 text-center mb-4">Daftar eBook</h1>

    <!-- Tombol tambah -->
    <div class="mb-3">
      <a href="tambah_ebook.php" class="bg-blue-600 text-white text px-3 py-1 rounded hover:bg-blue-700 inline-block">
        + Tambah
      </a>
    </div>
    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="w-full bg-white shadow rounded text-sm">
        <thead class="bg-blue-100">
          <tr>
            <th class="px-3 py-2">No</th>
            <th class="px-3 py-2">Judul</th>
            <th class="px-3 py-2">PDF</th>
            <th class="px-3 py-2">Cover</th>
            <th class="px-3 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while($b = $ebooks->fetch_assoc()): ?>
          <tr class="border-b">
            <td class="px-3 py-2"><?= $no++ ?></td>
            <td class="px-3 py-2"><?= htmlspecialchars($b['judul']) ?></td>
            <td class="px-3 py-2">
              <a href="upload/<?= $b['file_pdf'] ?>" class="text-blue-600 underline" target="_blank">Lihat PDF</a>
            </td>
            <td class="px-3 py-2">
              <a href="upload/cover/<?= $b['cover'] ?>" target="_blank" class="text-blue-600 hover:underline">
                Lihat Cover
              </a>
            </td>
            <td class="px-3 py-2">
              <a href="edit_ebook.php?id=<?= $b['id'] ?>" class="text-yellow-600 hover:underline">Edit</a> |
              <a href="hapus_ebook.php?id=<?= $b['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Footer -->
    <p class="text-center text-gray-500 text-sm mt-10">&copy; 2025 SMK BINA BANGSA KERSANA</p>
  </div>

</body>
</html>
