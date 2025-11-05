<?php
include 'koneksi.php';

// Proses tambah atau update gambar background
if (isset($_POST['simpan'])) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // Cek apakah gambar sudah ada untuk halaman "tentang"
    $result = mysqli_query($koneksi, "SELECT * FROM background WHERE halaman='tentang'");
    if (mysqli_num_rows($result) > 0) {
        // Jika sudah ada, update gambar
        $row = mysqli_fetch_assoc($result);
        if ($gambar) {
            // Hapus gambar lama
            if (file_exists("uploads/" . $row['gambar'])) {
                unlink("uploads/" . $row['gambar']);
            }
            move_uploaded_file($tmp, "uploads/" . $gambar);
            $query = "UPDATE background SET gambar='$gambar' WHERE halaman='tentang'";
            mysqli_query($koneksi, $query);
        }
    } else {
        // Jika belum ada, insert gambar baru
        if ($gambar) {
            move_uploaded_file($tmp, "uploads/" . $gambar);
            $query = "INSERT INTO background (halaman, gambar) VALUES ('tentang', '$gambar')";
            mysqli_query($koneksi, $query);
        }
    }
}

// Ambil gambar background untuk halaman tentang
$query = $koneksi->query("SELECT gambar FROM background WHERE halaman = 'tentang' ORDER BY id DESC LIMIT 1");
$data = $query->fetch_assoc();
$gambarBackground = $data['gambar'] ?? 'default.jpg'; // Gambar default jika tidak ada

// Ambil data profil sekolah
$queryProfil = $koneksi->query("SELECT * FROM profil_sekolah ORDER BY id DESC LIMIT 1");
$dataProfil = $queryProfil->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <title>Perpustakaan SMK Bina Bangsa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header / Navbar -->
    <header class="bg-blue-900 shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="img/Gambar.png" alt="Logo SMK Bina Bangsa" class="w-12 h-12">
                <h1 class="text-xl sm:text-2xl font-bold text-white">Perpustakaan SMK Bina Bangsa</h1>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="index.php" class="text-white hover:text-blue-300 font-medium">Beranda</a>
                <a href="home.php" class="text-white hover:text-blue-300 font-medium">Tentang</a>
                <a href="tampilan_ebook.php" class="text-white hover:text-blue-300 font-medium">E-book</a>
                <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold flex items-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative h-[400px] overflow-hidden">
        <img src="uploads/<?= $gambarBackground ?>" alt="Background Tentang" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-3">Perpustakaan SMK Bina Bangsa</h1>
            <p class="mb-6 text-lg">Silakan login terlebih dahulu untuk menggunakan layanan perpustakaan.</p>
        </div>
    </section>

    <!-- Info Sekolah -->
    <div class="bg-blue-900 text-white text-center py-3 font-semibold text-sm">
        Jl. Tanjung - Banjarharjo KM. 10, Kubangpari Satu, Kersana, Brebes
    </div>

    <!-- Deskripsi -->
    <section class="bg-gray-100 text-center py-12 px-4">
        <h2 class="text-3xl font-bold mb-4 text-blue-900">Website Perpustakaan SMK Bina Bangsa</h2>
        <p class="max-w-3xl mx-auto text-gray-700 text-justify text-lg leading-relaxed">
            Website Perpustakaan SMK Bina Bangsa adalah platform digital yang dirancang untuk membantu siswa, guru, dan staf sekolah dalam mengakses informasi terkait layanan perpustakaan secara lebih mudah dan efisien. Dengan adanya website ini, pengguna dapat melihat informasi terbaru mengenai layanan perpustakaan serta mengelola data buku, peminjaman, dan pengembalian secara digital.
        </p>
    </section>

    <section class="bg-gradient-to-br from-blue-50 to-white py-16 px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-blue-900 mb-10">Visi & Misi Perpustakaan</h2>
            <div class="grid md:grid-cols-2 gap-10 items-stretch">
                <!-- Visi -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold text-blue-800 mb-4 text-center">Visi</h3>
                    <p class="text-gray-700 text-lg leading-relaxed text-justify">
                        <?= nl2br(htmlspecialchars($dataProfil['visi'])) ?>
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold text-blue-800 mb-4 text-center">Misi</h3>
                    <p class="text-gray-700 text-lg leading-relaxed text-justify">
                        <?= nl2br(htmlspecialchars($dataProfil['misi'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita -->
    <?php
    $sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 6";
    $result = mysqli_query($koneksi, $sql);
    ?>
    <section id="berita" class="py-12 px-4 text-center bg-white">
        <h2 class="text-3xl font-bold text-blue-900 mb-8">SMK BINA BANGSA NEWS</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="bg-white w-72 shadow-md rounded-lg overflow-hidden">
                    <img src="img/<?php echo $row['gambar']; ?>" class="w-full h-40 object-cover" alt="<?php echo $row['judul']; ?>">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2"><?php echo $row['judul']; ?></h3>
                        <p class="text-gray-600 text-sm mb-3"><?php echo substr($row['isi'], 0, 100); ?>...</p>
                        <a href="detail_berita.php?id=<?php echo $row['id']; ?>" class="text-blue-700 font-semibold hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

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
                    <a href="https://www.instagram.com/binabangsakersana?igsh=MWJld3MxYnUxY3Zhdw==" class="hover:text-pink-400"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@binabangsaofficial?si=S0KXLx2XMWErqUkj" class="hover:text-red-500"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h4 class="text-xl font-bold mb-4">Informasi Kontak</h4>
                <ul class="text-sm text-gray-300 space-y-3">
                    <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Tanjung - Banjarharjo KM. 10, Kersana, Brebes</li>
                    <li><i class="fas fa-phone-alt mr-2"></i> 0283 4582621</li>
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
