<?php
include 'koneksi.php';

// Ambil gambar latar dari database
$result = mysqli_query($koneksi, "SELECT gambar FROM background WHERE halaman='beranda' ORDER BY id DESC");
$sliderImages = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['gambar']) && file_exists("uploads/" . $row['gambar'])) {
        $sliderImages[] = $row['gambar'];
    }
}

// Kalau kosong, pakai gambar default
if (empty($sliderImages)) {
    $sliderImages[] = "default.jpg"; // Pastikan default.jpg ada di folder uploads
}

// Cek pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';
if ($keyword) {
    $stmt = $koneksi->prepare("SELECT * FROM ebook WHERE judul LIKE ?");
    $like = "%$keyword%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $ebooks = $stmt->get_result();
} else {
    $ebooks = $koneksi->query("SELECT * FROM ebook");
}

$pengumumanQuery = $koneksi->query("SELECT * FROM pengumuman WHERE status = 'aktif' ORDER BY tanggal DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <title>Perpustakaan SMK Bina Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        .slide { display: none; }
        .slide.active { display: block; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
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
    <!-- Slider Beranda -->
<section class="relative h-[500px]">
    <?php foreach ($sliderImages as $i => $img): ?>
        <div class="slide absolute inset-0 bg-center bg-cover <?= $i === 0 ? 'active' : '' ?>" style="background-image: url('uploads/<?= $img ?>');">
            <div class="w-full h-full bg-black bg-opacity-40 flex flex-col items-center justify-center text-center px-4">
                <h2 class="text-4xl font-bold mb-4 text-white">Selamat Datang di Perpustakaan Digital</h2>
                <p class="text-lg text-gray-200 mb-6">Temukan eBook favoritmu dan tingkatkan literasi digitalmu dari mana saja, kapan saja.</p>
                <form method="GET" class="w-full max-w-lg">
                    <div class="flex bg-white rounded-lg overflow-hidden shadow-lg">
                        <input type="text" name="search" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari eBook..." class="flex-grow px-4 py-3 text-gray-700 focus:outline-none" />
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Tombol Navigasi -->
    <button class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white text-gray-800 rounded-full p-2 shadow" onclick="showPrevSlide()">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white text-gray-800 rounded-full p-2 shadow" onclick="showNextSlide()">
        <i class="fas fa-chevron-right"></i>
    </button>
</section>

    
    <!-- Script Slider -->
    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');

        function showNextSlide() {
            slides[slideIndex].classList.remove('active');
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].classList.add('active');
        }

        function showPrevSlide() {
            slides[slideIndex].classList.remove('active');
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            slides[slideIndex].classList.add('active');
        }

        // Interval otomatis
        setInterval(showNextSlide, 5000);
    </script>

    <!-- TAMBAHAN: Info Perpustakaan - Style Simple -->
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Sambutan Simple -->
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-blue-800 mb-6">Tentang Perpustakaan SMK Bina Bangsa</h3>
                <p class="text-gray-700 max-w-4xl mx-auto text-lg leading-relaxed">
                    Perpustakaan SMK Bina Bangsa adalah pusat informasi dan pembelajaran yang menyediakan berbagai koleksi buku, e-book, dan layanan digital untuk mendukung kegiatan belajar mengajar. Kami berkomitmen memberikan akses informasi yang mudah dan berkualitas bagi seluruh civitas akademika.
                </p>
            </div>
            <!-- Layanan - Simple List -->
            <div class="mb-12">
                <h4 class="text-2xl font-bold text-center text-blue-800 mb-8">Fasilitas Perpustakaan</h4>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-book text-blue-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">Peminjaman Buku</div>
                            <div class="text-sm text-gray-600">Sistem peminjaman online dan offline</div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-tablet-alt text-green-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">E-Book Digital</div>
                            <div class="text-sm text-gray-600">Akses buku digital 24/7</div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-wifi text-purple-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">Internet Gratis</div>
                            <div class="text-sm text-gray-600">WiFi untuk penelitian dan belajar</div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-chair text-orange-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">Ruang Baca</div>
                            <div class="text-sm text-gray-600">Area baca yang nyaman dan tenang</div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-question-circle text-red-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">Bantuan Referensi</div>
                            <div class="text-sm text-gray-600">Konsultasi tugas dan penelitian</div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition">
                        <i class="fas fa-users text-indigo-500 text-xl mr-4"></i>
                        <div>
                            <div class="font-semibold text-gray-800">Ruang Diskusi</div>
                            <div class="text-sm text-gray-600">Area diskusi kelompok</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
        <h4 class="text-xl font-bold text-blue-800 mb-4">
            <i class="fas fa-bullhorn mr-2"></i>Pengumuman Terbaru
        </h4>
        <?php if ($pengumumanQuery->num_rows > 0): ?>
            <div class="space-y-3">
                <?php 
                $colors = ['blue', 'green', 'purple']; // Warna border
                $i = 0;
                while ($pengumuman = $pengumumanQuery->fetch_assoc()): 
                    $color = $colors[$i % 3];
                ?>
                    <div class="border-l-4 border-<?= $color ?>-500 pl-4">
                        <div class="text-sm text-<?= $color ?>-600 font-semibold">
                            <?= date('d M Y', strtotime($pengumuman['tanggal'])) ?>
                        </div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($pengumuman['judul']) ?></div>
                        <div class="text-sm text-gray-600"><?= htmlspecialchars($pengumuman['isi']) ?></div>
                    </div>
                <?php 
                    $i++;
                endwhile; 
                ?>
            </div>
        <?php else: ?>
            <div class="text-center py-4">
                <i class="fas fa-info-circle text-blue-400 text-2xl mb-2"></i>
                <p class="text-blue-600">Belum ada pengumuman terbaru.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- eBook Section -->
    <main class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-3xl font-bold text-center text-blue-800 mb-10">Koleksi eBook Terbaru</h3>
        <p class="text-center text-black mb-10">Yuk, baca buku tanpa ribet! Di sini kamu bisa baca atau download eBook langsung dari HP atau laptop kamu. Belajar jadi makin mudah dan seru!</p>
       
        <?php if ($ebooks->num_rows > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php while ($b = $ebooks->fetch_assoc()): ?>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                        <a href="upload/<?= $b['file_pdf'] ?>" target="_blank">
                            <img src="upload/cover/<?= $b['cover'] ?>" alt="<?= htmlspecialchars($b['judul']) ?>" onerror="this.src='img/fallback.png'" class="w-full h-60 object-cover">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold truncate" title="<?= $b['judul'] ?>"><?= $b['judul'] ?></h4>
                                <p class="text-sm text-gray-500 mt-1">Klik untuk membaca atau unduh</p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600 italic mt-6">Tidak ada eBook ditemukan dengan kata kunci: <strong><?= htmlspecialchars($keyword) ?></strong></p>
        <?php endif; ?>
    </main>
    
    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 to-indigo-900 text-white pt-12 pb-6 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
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
            <div>
                <h4 class="text-xl font-bold mb-4">Informasi Kontak</h4>
                <ul class="text-sm text-gray-300 space-y-3">
                    <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Tanjung - Banjarharjo KM. 10, Kersana, Brebes</li>
                    <li><i class="fas fa-phone-alt mr-2"></i>+62 283 123 4567</li>
                    <li><i class="fas fa-envelope mr-2"></i>info@smkbinabangsa.sch.id</li>
                    <li><i class="fas fa-clock mr-2"></i>Senin - Jumat, 07:00 - 16:00 WIB</li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Lokasi Sekolah</h4>
                <div class="rounded overflow-hidden shadow-md">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.661551407208!2d108.89388057427457!3d-7.824016592172582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fbfe75c6c4de1%3A0x49f313e5a4e3a3f7!2sSMK%20Bina%20Bangsa%20Kersana!5e0!3m2!1sid!2sid!4v1692179647164!5m2!1sid!2sid"
                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="text-xs text-gray-300 mt-2">Klik peta untuk melihat lokasi lengkap di Google Maps.</p>
            </div>
        </div>
        <div class="border-t border-white mt-10 pt-4 text-sm text-center text-gray-300">
            <p>&copy; <?= date('Y') ?> SMK Bina Bangsa Kersana. Seluruh hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
</body>
</html>
