<?php
// Koneksi ke database (isi dengan detail koneksi Anda)
include 'koneksi.php';

// Fungsi untuk membersihkan input dari karakter berbahaya (mencegah injection)
function bersihkan_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari form dan bersihkan
  $id_siswa = bersihkan_input($_POST['id_siswa']);
  $nama = bersihkan_input($_POST['nama']);
  $kelas = bersihkan_input($_POST['kelas']);
  $jurusan = bersihkan_input($_POST['jurusan']);
  $no_whatsapp = bersihkan_input($_POST['no_whatsapp']);
  $alamat = bersihkan_input($_POST['alamat']);

  // Persiapkan query dengan placeholder untuk mencegah injection
  $query = "INSERT INTO siswa (id_siswa, nama, kelas, jurusan, no_whatsapp, alamat) VALUES (?, ?, ?, ?, ?, ?)";

  // Siapkan statement
  $stmt = mysqli_prepare($koneksi, $query);

  // Bind parameter
  mysqli_stmt_bind_param($stmt, "ssssss", $id_siswa, $nama, $kelas, $jurusan, $no_whatsapp, $alamat);

  // Eksekusi query
  if (mysqli_stmt_execute($stmt)) {

    // Redirect ke halaman data siswa jika berhasil
    header("Location: siswa.php");
    exit();
  } else {
    // Tampilkan pesan kesalahan jika gagal
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
  }

  // Tutup statement
  mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($koneksi);
?>