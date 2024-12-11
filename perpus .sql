-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2024 pada 17.33
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
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(10) DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`) VALUES
(8, '202501', 'fisika', 'jonatan etes', 'jauhari', 1997),
(12, '202502', 'penjas', 'jaya', 'akbar', 1990),
(16, '202503', 'bahasa inggris', 'syahisl', 'babas', 2010),
(123, '202504', 'bahasa jawa', 'jauhari', 'alam', 1998),
(125, '202505', 'Kimia', 'Sutarmo', 'Erlangga', 1998),
(126, '202506', 'Pemograman dasar', 'bahari', 'erlangga', 1990),
(127, '202507', 'bahasa indonesia', 'ahmad', 'dahlan', 1995),
(128, '202508', 'Kisah Nabi', 'Naful Muzaki', 'akbar', 1992),
(129, '202509', 'bahasa pemograman', 'nur ichsan', 'erlangga', 1998);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_backup`
--

CREATE TABLE `buku_backup` (
  `id` int(11) NOT NULL DEFAULT 0,
  `id_buku` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku_backup`
--

INSERT INTO `buku_backup` (`id`, `id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`) VALUES
(8, '164567', 'fisika', 'jonatan etes', 'jauhari', 1998),
(12, '123', 'penjas', 'jaya', 'akbar', 2022),
(16, '1213e', 'inggris', 'syahisl', 'babas', 2010),
(18, '1111', 'fisika', 'johan', 'ali', 1990);

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
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `id_siswa`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(15, '202509', 20250004, '2024-11-20', '2024-12-09', 'dikembalikan'),
(16, '202502', 20250005, '2024-11-20', '2024-12-09', 'dipinjam'),
(17, '202503', 20250002, '2024-11-25', '2024-11-25', 'dipinjam'),
(18, '202505', 20250004, '2024-11-27', '2024-12-09', 'dikembalikan'),
(19, '202508', 20250004, '2024-12-09', '2024-12-09', 'dikembalikan'),
(20, '202502', 20250001, '2024-12-09', '2024-12-09', 'dikembalikan');

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
(11, 'siswa', 'siswa', '202cb962ac59075b964b07152d234b70', 'siswa'),
(16, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `No_hp` varchar(15) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `Nama`, `Kelas`, `jurusan`, `No_hp`, `Alamat`) VALUES
(20250001, 'Akbar Jaya', '10', 'Multimedia', '08587643289', 'Banjarharjo'),
(20250002, 'Della ikmatul', '10', 'Multimedia', '08657302723', 'Banjarharjo'),
(20250003, 'Ahmad jaelani', '10', 'Multimedia', '0877655808', 'cigedog'),
(20250004, 'Amalia nur hiba', '10', 'Multimedia', '08563893220', 'karangmalang'),
(20250005, 'Rian Ardiansyah', '10', 'Multimedia', '085674910', 'cigedog'),
(20250006, 'M.zamzami', '10', 'Multimedia', '0852358193', 'Songgom'),
(20250007, 'Ahmad Zaky', '10', 'Multimedia', '08363562890', 'Losari'),
(20250008, 'Nabila Masyaallah', '10', 'Multimedia', '086438296328', 'Cirebon'),
(20250009, 'M.Baehaqi', '10', 'Multimedia', '085273003732', 'Siwwuluh'),
(20250010, 'naful muzaki', '10', 'Multimedia', '08343565776', 'Keboledan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_backup`
--

CREATE TABLE `siswa_backup` (
  `id_siswa` int(11) NOT NULL DEFAULT 0,
  `NIS` varchar(20) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `Jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `No_hp` varchar(15) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa_backup`
--

INSERT INTO `siswa_backup` (`id_siswa`, `NIS`, `Nama`, `Kelas`, `Jenis_kelamin`, `No_hp`, `Alamat`) VALUES
(108788, '67934', 'aji ali', '11', 'Laki-laki', '0878478474', 'cigedog'),
(108790, '848439', 'kau', '11', 'Laki-laki', '0696840373', 'banjar');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_buku` (`id_buku`);

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
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20250011;

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
