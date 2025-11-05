<?php
include 'koneksi.php';

// Proses tambah atau update data
if (isset($_POST['simpan'])) {
    $halaman = $_POST['halaman'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // Cek apakah gambar sudah ada untuk halaman tersebut
    $result = mysqli_query($koneksi, "SELECT * FROM background WHERE halaman='$halaman'");
    if (mysqli_num_rows($result) > 0) {
        // Jika sudah ada, update gambar
        $row = mysqli_fetch_assoc($result);
        if ($gambar) {
            // Hapus gambar lama
            if (file_exists("uploads/" . $row['gambar'])) {
                unlink("uploads/" . $row['gambar']);
            }
            move_uploaded_file($tmp, "uploads/" . $gambar);
            $query = "UPDATE background SET gambar='$gambar' WHERE halaman='$halaman'";
            mysqli_query($koneksi, $query);
        }
    } else {
        // Jika belum ada, insert gambar baru
        if ($gambar) {
            move_uploaded_file($tmp, "uploads/" . $gambar);
            $query = "INSERT INTO background (halaman, gambar) VALUES ('$halaman', '$gambar')";
            mysqli_query($koneksi, $query);
        }
    }
    header("Location: background.php");
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $result = mysqli_query($koneksi, "SELECT gambar FROM background WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    if ($row && file_exists("uploads/" . $row['gambar'])) {
        unlink("uploads/" . $row['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM background WHERE id=$id");
    header("Location: background.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Background</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
        }

        /* Geser area konten dari sidebar */
        .content-wrapper {
            margin-left: 250px; /* lebar sidebar */
            padding: 20px;
            width: calc(100% - 250px);
        }
    </style>
</head>
<body class="bg-light">

    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
        <h2 class="mb-4">Kelola Background Halaman</h2>

        <!-- Form Upload -->
        <div class="card mb-4 w-100">
            <div class="card-header bg-primary text-white">Tambah Background</div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Halaman</label>
                        <select name="halaman" class="form-select" required>
                            <option value="">Pilih Halaman</option>
                            <option value="beranda">Beranda</option>
                            <option value="tentang">Tentang</option>
                            <option value="ebook">Ebook</option>
                            <option value="login">Login</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card w-100">
            <div class="card-header bg-secondary text-white">Daftar Background</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Halaman</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM background ORDER BY id DESC");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['halaman']}</td>
                                <td><img src='uploads/{$row['gambar']}' width='150'></td>
                                <td>
                                    <a href='?hapus={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
