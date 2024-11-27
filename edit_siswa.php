<?php
include 'koneksi.php';

// Cek jika parameter 'nis' ada di URL
if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];

    // Query untuk mengambil data siswa berdasarkan NIS
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "id_siswa tidak ditemukan!";
    exit;
}

// Cek jika form edit disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // Query untuk memperbarui data siswa
    $update_query = "UPDATE siswa SET Nama = '$nama', Kelas = '$kelas', Jurusan = '$jurusan', No_hp = '$no_hp', Alamat = '$alamat' WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $update_query)) {
        header('Location: index_2.php'); // Arahkan kembali ke halaman daftar siswa
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/group.png" type="image/png">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Siswa</h2>
        <form method="POST">
            <div class="form-group">
                <label for="id_siswa">Id_siswa</label>
                <input type="text" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $row['id_siswa']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['Nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $row['Kelas']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jurusan">jurusan</label>
                <input type="text" class="form-control" id="kelas" name="jurusan" value="<?php echo $row['jurusan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['No_hp']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat"><?php echo $row['Alamat']; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </di>
</body>
</html>
