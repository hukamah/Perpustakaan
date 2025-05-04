<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
$id = intval($_GET['id']); // Pastikan id hanya angka

$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");
$row = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);

    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $target = "img/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

        $sql = "UPDATE berita SET judul='$judul', gambar='$gambar', isi='$isi' WHERE id=$id";
    } else {
        $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id=$id";
    }

    mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi)); // Tambahkan error debugging
    header("Location: berita.php");
}
?>

<h2>Edit Berita</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Judul Berita:</label><br>
    <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']); ?>" required><br><br>

    <label>Gambar:</label><br>
    <input type="file" name="gambar"><br><br>
    <img src="img/<?= htmlspecialchars($row['gambar']); ?>" width="100"><br><br>

    <label>Isi Berita:</label><br>
    <textarea name="isi" rows="20" required><?= htmlspecialchars($row['isi']); ?></textarea><br><br>

    <input type="submit" name="submit" value="Simpan Perubahan">
</form>
