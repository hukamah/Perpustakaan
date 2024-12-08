<?php 
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include 'koneksi.php';
include 'sidebar.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
</head>
<style> 
.table thead{
    background-color: green;
    color: white;
   
}
</style>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-center">Data Buku</h2>
            <a href="data_buku.php" class="btn btn-primary mb-3">+ Tambah Data</a>
            <table id="dataBuku" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM buku") or die(mysqli_error($koneksi));
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['id_buku']}</td>
                            <td>{$row['judul']}</td>
                            <td>{$row['pengarang']}</td>
                            <td>{$row['penerbit']}</td>
                            <td>{$row['tahun']}</td>
                            <td>
                                <a href='edit_buku.php?id={$row['id']}' class='btn btn-success'>
                                    <i class='fas fa-edit'></i> Edit
                                </a>
                                <a href='hapus_buku.php?id={$row['id_buku']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataBuku').DataTable();
        });
    </script>
</body>

