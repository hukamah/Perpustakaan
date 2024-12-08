<?php
include 'koneksi.php';

// Cek apakah id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Ambil data buku berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
} else {
    // Jika id tidak ada, arahkan ke halaman data buku
    header("Location: data_buku.php");
    exit;
}

// Cek jika form telah disubmit untuk melakukan update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    // Query untuk memperbarui data buku
    $query = "UPDATE buku SET id_buku='$id_buku', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun='$tahun' WHERE id='$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, arahkan kembali ke halaman data buku
        header("Location: index.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="icon" href="img/daftar buku.png" type="image/png">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Buku</h2>
        <form action="edit_buku.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label>Id Buku</label>
                <input type="text" name="id_buku" class="form-control" value="<?php echo $row['id_buku']; ?>" required>
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?php echo $row['judul']; ?>" required>
            </div>
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?php echo $row['pengarang']; ?>" required>
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="<?php echo $row['penerbit']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" value="<?php echo $row['tahun']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
