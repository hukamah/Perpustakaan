<?php
session_start();
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

// Cek jika pengguna memiliki hak akses admin
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
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
        header("Location: buku.php");
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
    <title>Edit Data Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="img/daftar_buku.png" type="image/png">
    <style>
        body {
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .footer-text {
            font-size: 0.8rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Edit Data Buku</h2>
                        <form action="edit_buku.php?id=<?php echo $id; ?>" method="POST">
                            <div class="mb-3">
                                <label for="id_buku" class="form-label">ID Buku</label>
                                <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $row['id_buku']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $row['judul']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control" value="<?php echo $row['pengarang']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" class="form-control" value="<?php echo $row['penerbit']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" name="tahun" id="tahun" class="form-control" value="<?php echo $row['tahun']; ?>" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3 footer-text">
                    &copy; 2025 SMK Bina Bangsa Kersana
                </div>
            </div>
        </div>
    </div>
</body>
</html>
