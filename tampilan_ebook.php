<?php
include 'koneksi.php';

// Ambil gambar background khusus halaman eBook
$query = $koneksi->query("SELECT gambar FROM background WHERE halaman = 'ebook' ORDER BY id DESC LIMIT 1");
$data = $query->fetch_assoc();
$gambarBackground = $data['gambar'] ?? 'default.jpg'; // Gambar default jika tidak ada

// Query eBook
$keyword = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'judul';
$query = "SELECT * FROM ebook WHERE 1";
$params = []; 
$types = "";

if ($keyword) {
    $query .= " AND judul LIKE ?";
    $params[] = "%$keyword%"; 
    $types .= "s";
}

$order = ['newest' => 'id DESC', 'oldest' => 'id ASC', 'az' => 'judul ASC', 'za' => 'judul DESC'];
$query .= " ORDER BY " . ($order[$sort] ?? 'judul ASC');

if ($params) {
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $ebooks = $stmt->get_result();
} else {
    $ebooks = $koneksi->query($query);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <title>Perpustakaan SMK Bina Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-bg {
            background-image: url('uploads/<?= $gambarBackground ?>'); /* Pastikan path sesuai */
            background-size: cover;
            background-position: center;
            min-height: 60vh;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header -->
    <header class="bg-blue-900 shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="img/Gambar.png" alt="Logo" class="w-12 h-12">
                <h1 class="text-xl sm:text-2xl font-bold text-white">Perpustakaan SMK Bina Bangsa</h1>
            </div>
            <nav class="space-x-4">
                <a href="index.php" class="text-white hover:text-blue-300 font-medium">Beranda</a>
                <a href="home.php" class="text-white hover:text-blue-300 font-medium">Tentang</a>
                <a href="tampilan_ebook.php" class="text-white hover:text-blue-300 font-medium">E-book</a>
                <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition font-semibold inline-flex items-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg text-white flex items-center justify-center text-center relative">
        <div class="z-10 px-4">
            <h2 class="hero-title text-4xl md:text-5xl font-bold mb-4">📚 Koleksi eBook</h2>
            <p class="hero-subtitle text-xl md:text-2xl font-semibold">Temukan dan baca eBook favoritmu secara gratis</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">
        <!-- Search & Filter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 mt-6">
            <form method="GET" class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" name="search" value="<?= htmlspecialchars($keyword) ?>" 
                               placeholder="Cari judul eBook..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <select name="sort" onchange="this.form.submit()" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
                        <option value="az" <?= $sort=='az'?'selected':'' ?>>🔤 A-Z</option>
                        <option value="za" <?= $sort=='za'?'selected':'' ?>>🔤 Z-A</option>
                        <option value="newest" <?= $sort=='newest'?'selected':'' ?>>🆕 Terbaru</option>
                        <option value="oldest" <?= $sort=='oldest'?'selected':'' ?>>📅 Terlama</option>
                    </select>
                </div>
            </form>

            <div class="flex justify-between items-center mt-4 pt-4 border-t">
                <p class="text-gray-600">Ditemukan <span class="font-semibold text-blue-600"><?= $ebooks->num_rows ?></span> eBook</p>
                <?php if ($keyword): ?>
                    <a href="ebook.php" class="text-gray-500 hover:text-gray-700 text-sm">
                        <i class="fas fa-times mr-1"></i>Reset
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- eBook Grid -->
        <?php if ($ebooks->num_rows > 0): ?>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 pb-12">
                <?php while ($b = $ebooks->fetch_assoc()): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="upload/cover/<?= $b['cover'] ?>" alt="<?= $b['judul'] ?>" 
                                 onerror="this.src='img/fallback.png'"
                                 class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="upload/<?= $b['file_pdf'] ?>" target="_blank" 
                                   class="bg-white text-gray-800 px-4 py-2 rounded-full font-medium hover:bg-gray-100 transition">
                                    <i class="fas fa-eye mr-2"></i>Baca
                                </a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 text-sm mb-2 line-clamp-2" title="<?= $b['judul'] ?>">
                                <?= htmlspecialchars($b['judul']) ?>
                            </h3>
                            <a href="upload/<?= $b['file_pdf'] ?>" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-download mr-1"></i>Download PDF
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16 bg-white rounded-xl shadow-lg">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada eBook Ditemukan</h3>
                <p class="text-gray-500 mb-4">Coba gunakan kata kunci yang berbeda</p>
                <a href="ebook.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Lihat Semua eBook
                </a>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 to-indigo-900 text-white pt-12 pb-6 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Kolom 1 -->
            <div>
                <h4 class="text-xl font-bold mb-4">Tentang Sekolah</h4>
                <p class="text-sm text-gray-300 leading-relaxed">
                    SMK Bina Bangsa Kersana merupakan sekolah kejuruan yang berkomitmen mencetak generasi unggul, terampil, dan siap kerja
                    dengan pendekatan teknologi serta karakter mulia.
                </p>
                <div class="flex gap-4 mt-4 text-xl">
                    <a href="https://www.facebook.com/osissmkbisaa" class="hover:text-blue-400"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/binabangsakersana" class="hover:text-pink-400"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@binabangsaofficial" class="hover:text-red-500"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h4 class="text-xl font-bold mb-4">Informasi Kontak</h4>
                <ul class="text-sm text-gray-300 space-y-3">
                    <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Tanjung - Banjarharjo KM. 10, Kersana, Brebes</li>
                    <li><i class="fas fa-phone-alt mr-2"></i>0283 4582621</li>
                    <li><i class="fas fa-envelope mr-2"></i>smkbisakersana@gmail.com</li>
                    <li><i class="fas fa-clock mr-2"></i>Senin - Jumat, 07:00 - 16:00 WIB</li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div>
                <h4 class="text-xl font-bold mb-4">Lokasi Sekolah</h4>
                <div class="rounded overflow-hidden shadow-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.661551407208!2d108.89388057427457!3d-7.824016592172582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fbfe75c6c4de1%3A0x49f313e5a4e3a3f7!2sSMK%20Bina%20Bangsa%20Kersana!5e0!3m2!1sid!2sid!4v1692179647164!5m2!1sid!2sid"
                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="text-xs text-gray-300 mt-2">Klik peta untuk melihat lokasi lengkap di Google Maps.</p>
            </div>
        </div>

        <!-- Footer Bawah -->
        <div class="border-t border-white mt-10 pt-4 text-sm text-center text-gray-300">
            <p>&copy; <?= date('Y') ?> SMK Bina Bangsa Kersana. Seluruh hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
</body>
</html>
