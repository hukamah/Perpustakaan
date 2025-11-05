<?php
include 'cek_auth.php';     // Panggil pertama agar session dimulai sebelum ada output
include 'koneksi.php'; 
include 'sidebar_siswa.php';

// Query untuk mengambil data peminjaman
$query_peminjaman = "SELECT p.id, b.judul, s.nama, p.jumlah, p.tanggal_pinjam, p.tanggal_kembali, p.status
                    FROM peminjaman p
                    JOIN buku b ON p.id_buku = b.id_buku
                    JOIN siswa s ON p.id_siswa = s.id_siswa
                    WHERE p.status = 'dipinjam'";
$result_peminjaman = mysqli_query($koneksi, $query_peminjaman);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="img/gambar.png" type="image/png">
    <style> 
        body {
            background-color: #f8f9fa;
        }
        
        .container {
            margin-left: 250px;
        }

        .table thead {
            background-color: green;
            color: white;
        }

        .btn-print {
            background-color: #28a745;
            color: white;
        }

        .btn-print:hover {
            background-color: #218838;
        }

        .form-control {
            width: 250px;
        }
    </style> 
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Daftar Peminjaman Buku</h2>
    
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-print" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
        <input type="text" id="searchPeminjaman" class="form-control" placeholder="Cari di Peminjaman...">
    </div>

    <table class="table table-striped table-bordered" id="tablePeminjaman">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Nama Siswa</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result_peminjaman)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['tanggal_pinjam']}</td>
                    <td>{$row['tanggal_kembali']}</td>
                    <td>{$row['status']}</td>
                </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>

<footer class="text-center mt-5">
    <p>&copy; 2025 SMK Bina Bangsa</p>
</footer>

<script>
    document.getElementById('searchPeminjaman').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tablePeminjaman tbody tr');

        rows.forEach(row => {
            const cells = Array.from(row.cells).map(cell => cell.textContent.toLowerCase());
            const matches = cells.some(cell => cell.includes(filter));
            row.style.display = matches ? '' : 'none';
        });
    });
</script>
</body>
</html>
