<?php
include 'koneksi.php';
include 'sidebar.php';

// Proses tambah pengumuman
if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];
    
    $stmt = $koneksi->prepare("INSERT INTO pengumuman (tanggal, judul, isi, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $tanggal, $judul, $isi, $status);
    
    if ($stmt->execute()) {
        $success = "Pengumuman berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan pengumuman!";
    }
}

// Proses hapus pengumuman
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $koneksi->prepare("DELETE FROM pengumuman WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $success = "Pengumuman berhasil dihapus!";
}

// Ambil semua pengumuman
$pengumuman = $koneksi->query("SELECT * FROM pengumuman ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pengumuman - SMK Bina Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            display: flex;
        }
        .content {
            margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
            width: calc(100% - 250px); /* Menghindari tumpang tindih dengan sidebar */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="content">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-blue-800 mb-6">
                <i class="fas fa-bullhorn mr-2"></i>Kelola Pengumuman
            </h1>

            <!-- Alert Messages -->
            <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= $success ?>
            </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $error ?>
            </div>
            <?php endif; ?>

            <!-- Form Tambah Pengumuman -->
            <form method="POST" class="mb-8">
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal</label>
                        <input type="date" name="tanggal" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                        <select name="status" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Pengumuman</label>
                    <input type="text" name="judul" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                           placeholder="Masukkan judul pengumuman">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Isi Pengumuman</label>
                    <textarea name="isi" rows="4" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                              placeholder="Masukkan isi pengumuman"></textarea>
                </div>
                
                <button type="submit" name="tambah" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Tambah Pengumuman
                </button>
            </form>
        </div>

        <!-- Daftar Pengumuman -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Pengumuman</h2>
            
            <?php if ($pengumuman->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Judul</th>
                            <th class="px-4 py-2 text-left">Isi</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($p = $pengumuman->fetch_assoc()): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= date('d/m/Y', strtotime($p['tanggal'])) ?></td>
                            <td class="px-4 py-2 font-semibold"><?= htmlspecialchars($p['judul']) ?></td>
                            <td class="px-4 py-2">
                                <?= substr(htmlspecialchars($p['isi']), 0, 100) ?>...
                            </td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded-full <?= $p['status'] == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="?hapus=<?= $p['id'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus pengumuman ini?')"
                                   class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-gray-500 text-center py-4">Belum ada pengumuman.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
