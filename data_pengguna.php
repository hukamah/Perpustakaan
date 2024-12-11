<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
include 'sidebar.php'; 
include 'koneksi.php';
// Query untuk mengambil data pengguna
$sql = "SELECT * FROM pengguna";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* CSS untuk menggeser konten ketika sidebar aktif */
        .table-container {
            transition: margin-left 0.3s ease;
            margin-left: 0;
        }

        #sidebar-toggle:checked ~ .table-container {
            margin-left: 250px; /* Sama dengan lebar sidebar */
        }

        /* Tombol 'Tambah Pengguna' */
        .btn-tambah {
            background-color: #007bff; /* Warna biru */
            border-color: #007bff;
            color: white;
        }
        .btn-tambah:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Styling untuk tabel */
        .table th, .table td {
            vertical-align: middle; /* Menjaga elemen vertikal rata tengah */
        }

        /* Pencarian dan pagination */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .pagination {
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="container mt-5 table-container">
        <h2 class="mb-4">Data Pengguna</h2>
        
        <!-- Container untuk tombol dan pencarian -->
        <div class="search-container">
            <a href="tambah_pengguna.php" class="btn btn-tambah">+ Tambah Pengguna</a>
        </div>
        
        <!-- Tabel data pengguna -->
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_pengguna']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['roles']}</td>
                                <td>
                                    <a href='edit_pengguna.php?username={$row['username']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                    <a href='hapus_pengguna.php?username={$row['username']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Data tidak ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
<hr class="text-light">
                <div class="text-center">
                    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
                </div>
<?php
// Tutup koneksi
$koneksi->close();
?>
