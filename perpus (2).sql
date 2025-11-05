-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2025 pada 08.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `background`
--

CREATE TABLE `background` (
  `id` int(11) NOT NULL,
  `halaman` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `background`
--

INSERT INTO `background` (`id`, `halaman`, `gambar`) VALUES
(12, 'beranda', '689c7be2a13d7.jpg'),
(13, 'beranda', '689c7bfe11b60.jpg'),
(14, 'beranda', '689c7c1107fc3.jpg'),
(17, 'login', '1754028976_background.jpg'),
(21, 'ebook', '1754028976_background.jpg'),
(22, 'tentang', '1754028887_depan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `gambar`, `isi`, `tanggal`) VALUES
(4, 'PPDB 2025', 'ppdb.jpg', 'Buruan yang belum daftar ulang sebelum kuotanya habis...```\r\n\r\nWAKTU PENDAFTARAN\r\n\r\nGEL 1: 13 Jan-21 Mart 2025\r\n\r\nGEL 2: 8 April - 10 Jun 2025\r\n\r\nSenin-Kamis (08:00-13:00)\r\n\r\nKhusus Jumat (08:00-11:00)\r\n\r\nSabtu-Minggu (Tutup)\r\n\r\nKRITERIA\r\n\r\n1. LAKI-LAKI & PEREMPUAN\r\n2. USIA TIDAK LEBIH 18 TH (pada bulan Juli)\r\n3. LAKI-LAKI TIDAK BERTATO & BERTINDIK\r\n4. SEHAT JASMANI & ROHANI\r\n\r\nDOKUMEN PENDAFTARAN\r\n\r\n1. FC RAPOT KELAS 9\r\n2. FC KARTU KELUARGA\r\n3. FC AKTA LAHIR\r\n4. FC PIAGAM PENGHARGAAN/SERTIFIKAT\r\nLOMBA (jika ada)\r\n\r\nPROGRAM KEAHLIAN\r\n\r\n1. ΤΕΚΝΙΚ OTOMOTIF\r\n2. DESAIN KOMUNIKASI VISUAL\r\n3. AKUNTANSI KEUANGAN & LEMBAGA\r\n\r\nPENGEMBANGAN KARAKTER SISWA\r\n\r\n1. SHOLAT DUHA BERSAMA\r\n2. SHOLAT DZUHUR BERJAMAAH\r\n3. SHOLAT ASHAR BERJAMAAH\r\n4. SHOLAT JUM\'AT BERJAMAAH', '2025-03-20'),
(6, 'Juara 1 sepak bola putra', 'WhatsApp-Image-2023-10-11-at-07.39.58-scaled.webp', 'sepak bolaa putra kini mendapatkan tropi juara 1 yang diselenggaran di kabupaten tegal', '2025-03-20'),
(10, 'juara 2 basket', 'basket.jpg', 'juara 2 basket yang diselenggarakan oleh bupati brebes dalam acara hari jadi brebes', '2025-03-20'),
(19, 'tes', 'akintasi.jpg', 'tesssss', '2025-08-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(10) DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`, `jumlah`) VALUES
(8, '202501', 'fisika', 'jonatan etes', 'jauhari', 1994, 12),
(12, '202502', 'penjas', 'jaya', 'akbar', 1989, 23),
(16, '202503', 'bahasa inggris', 'syahisl', 'babas', 2010, 44),
(123, '202504', 'bahasa jawa', 'jauhari', 'alam', 1998, 35),
(125, '202505', 'Kimia', 'Sutarmo', 'Erlangga', 1998, 65),
(126, '202506', 'Pemograman dasar', 'bahari', 'erlangga', 1990, 34),
(127, '202507', 'bahasa indonesia', 'ahmad', 'dahlan', 1995, 45),
(129, '202509', 'bahasa pemograman', 'nur ichsan', 'erlangga', 1998, 56),
(135, '2025010', 'Desain Grafis', 'Jalaludin', 'Erlangga', 1990, 23),
(136, '2025011', 'Penggembangan Jaringan', 'Blackceqel', 'alexander', 1985, 67),
(140, '2025013', 'Novel Kancil', 'Marcel', 'Erlangga', 1947, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ebook`
--

CREATE TABLE `ebook` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ebook`
--

INSERT INTO `ebook` (`id`, `judul`, `file_pdf`, `cover`) VALUES
(8, 'buku desain multimedia', '1751208810-buku-desain-multimedia-1.pdf', '1751212796-MM.jpg'),
(9, 'Dasar dasar TKR', '1751212377-tkr.pdf', '1751212377-tkr.webp'),
(10, 'akuntasi', '1751212638-Dasar-Akuntansi-dan-Lembaga-Keuangan-BS-KLS-X.pdf', '1751212638-akintasi.jpg'),
(11, 'PPKN', '1751212740-Kelas X PPKn BS press.pdf', '1751212740-PPKN.jpg'),
(12, 'buku', '1752914555-kti.pdf', '1752914555-fto.jpg'),
(13, 'n', '1752914719-Bagi SUTARTO new.pdf', '1752914719-images.png'),
(14, 'b', '1752915865-Kelas X PPKn BS press.pdf', '1752915865-aktivity.jpg'),
(15, 'tes', '1754054063-tkr.pdf', '1754054063-perpus.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(10) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam',
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `id_siswa`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `jumlah`) VALUES
(16, '202502', 20250005, '2024-11-20', '2024-12-31', 'dikembalikan', 0),
(19, '202508', 20250004, '2024-12-09', '2024-12-09', 'dikembalikan', 0),
(37, '202506', 20250007, '2025-03-25', '2025-03-27', 'dikembalikan', 30),
(38, '2025013', 20250003, '2025-04-15', '2025-04-24', 'dikembalikan', 11),
(39, '202509', 20250011, '2025-07-12', '2025-07-12', 'dikembalikan', 11),
(40, '202509', 20250007, '2025-07-12', '2025-07-12', 'dikembalikan', 11),
(42, '202501', 20250001, '2025-06-29', '2025-06-30', 'dikembalikan', 40),
(45, '202507', 20250001, '2025-07-19', '2025-07-30', 'dipinjam', 1),
(46, '202506', 20250008, '2025-07-21', '2025-07-29', 'dipinjam', 1),
(47, '202506', 20250002, '2025-07-22', '2025-07-29', 'dipinjam', 1),
(48, '202501', 20250002, '2025-07-21', '2025-07-22', '', 1),
(49, '202507', 20250001, '2025-07-21', '2025-07-22', '', 1),
(50, '202504', 20250005, '2025-07-21', '2025-07-22', 'dipinjam', 1),
(51, '202501', 20250006, '2025-08-02', '2025-08-03', 'dipinjam', 11),
(52, '202501', 20250010, '2025-08-07', '2025-08-05', 'dipinjam', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `roles`) VALUES
(22, 'angga baskara', 'angga', '123', 'siswa'),
(23, 'admin', 'admin', '123', 'admin'),
(24, 'ahmad dhani', 'ahmad', '123', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `tanggal`, `judul`, `isi`, `status`, `created_at`) VALUES
(2, '2025-12-11', 'Lomba membuat novel', 'ayo daftarkan diri anda diperlombaan membuat novel daftar langsung ke staff perpustakaan', 'aktif', '2025-08-13 14:43:14'),
(3, '2025-08-03', 'Ikutilah workshop digital library', 'segera hadir workshop digital library yang diadakan oleh osis di ruang audit jam 13:00 setelah sholat dzuhur', 'aktif', '2025-08-13 14:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id` int(11) NOT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `visi`, `misi`) VALUES
(1, '\"Menjadi pusat informasi dan sumber belajar yang mendukung terwujudnya Siswa Siswi SMK Bina Bangsa Kersana yang cerdas, terampil, dan berakhlak mulia.\"', '1. Menyediakan koleksi bahan pustaka yang relevan dan mutakhir sesuai kebutuhan kurikulum dan perkembangan ilmu pengetahuan. \r\n2. Memberikan layanan informasi yang cepat, tepat, dan akurat bagi seluruh warga sekolah.\r\n3. Meningkatkan minat baca dan budaya literasi di kalangan siswa, guru, dan staf.\r\n4. Menyelenggarakan kegiatan literasi dan pelatihan penggunaan perpustakaan secara berkala.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `no_whatsapp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `kelas`, `jurusan`, `no_whatsapp`, `alamat`) VALUES
(20250001, 'Akbar Jaya', '10', 'Multimedia', '08637329101', 'Banjarharjo'),
(20250002, 'Della ikmatul', '10', 'Multimedia', '08657302723', 'Banjarharjo'),
(20250003, 'Ahmad jaelani', '10', 'Multimedia', '08645278192', 'cigedog'),
(20250004, 'Amalia nur hiba', '10', 'Multimedia', '08563893220', 'karangmalang'),
(20250005, 'Rian Ardiansyah', '10', 'Multimedia', '085674910', 'cigedog'),
(20250006, 'M.zamzami', '10', 'Multimedia', '0852358193', 'Songgom'),
(20250007, 'Ahmad Zaky', '10', 'Multimedia', '08363562890', 'Losari'),
(20250008, 'Nabila Masyaallah', '10', 'Multimedia', '086438296328', 'Cirebon'),
(20250009, 'M.Baehaqi', '10', 'Multimedia', '085273003732', 'Siwwuluh'),
(20250010, 'naful muzaki', '10', 'Multimedia', '08343565776', 'Keboledan'),
(20250011, 'Dinda Selvia', '11', 'Multimedia', '08965262821', 'Cikandang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `fk_id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `background`
--
ALTER TABLE `background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20250012;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_id_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
