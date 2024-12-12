<?php
session_start();
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit; }
include 'koneksi.php'; 
include 'sidebar.php';
include 'cek_auth.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="img/gambar.png" type="image/png">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<style> 
.table thead{
    background-color: green;
    color: white;
}
</style>
    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-center">Data Siswa</h2>
            <a href="data_siswa.php" class="btn btn-primary mb-3">+ Tambah Data</a>
            <table id="dataSiswa" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id siswa</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    include 'koneksi.php';

                    // Query untuk mengambil data dari tabel siswa
                    $query = "SELECT * FROM siswa";
                    $result = mysqli_query($koneksi, $query);

                    // Periksa apakah query berhasil
                    if (!$result) {
                        die("Query gagal: " . mysqli_error($koneksi));
                    }

                    // Tampilkan data siswa
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['id_siswa']}</td>
                                <td>{$row['Nama']}</td>
                                <td>{$row['Kelas']}</td>
                                <td>{$row['jurusan']}</td>
                                <td>{$row['No_hp']}</td>
                                <td>{$row['Alamat']}</td>
                                <td>
                                <a href='edit_siswa.php?id_siswa={$row['id_siswa']}' class='btn btn-success'>
                                    <i class='fas fa-edit'></i> Edit
                                </a>
                                <a href='hapus_siswa.php?id={$row['id_siswa']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus siswa ini?\")'>
                                    <i class='fas fa-trash'></i> Hapus
                                </a>
                            </td>
                            </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#dataSiswa').DataTable();
    });
    </script>
    <hr class="text-light">
    <div class="text-center">
    <p class="mb-0">&copy; 2025 SMK BINA BANGSA KERSANA</p>
    </div>
</body>
</html>
