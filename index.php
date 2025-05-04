<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK BINA BANGSA</title>
    <link rel="icon" href="img/Gambar.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            background-color: #0098C8;
            color: white;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            font-size: 25px;
            font-weight: bold;
            width: 100%;
        }

        .logo {
            width: 50px;
            margin-right: 15px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 40px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .hero h2 {
            font-size: 30px;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-login {
            display: inline-block;
            background-color: #ffcc00;
            color: black;
            padding: 10px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #e6b800;
        }

        /* Informasi Sekolah */
        .section-header {
            background-color: #0098C8;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Deskripsi */
        .description {
            background: rgb(236, 237, 238);
            color: black;
            text-align: center;
            padding: 30px 20px;
        }

        .description h2 {
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .description p {
            max-width: 900px;
            margin: 0 auto;
            text-align: justify;
            font-size: 18px;
            line-height: 1.6;
        }

        /* Berita */
        .news-section {
            text-align: center;
            padding: 30px 20px;
        }

        .news-section h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .news-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .news-item {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
        }

        .news-item img {
            width: 100%;
            border-radius: 5px;
        }

        .news-item h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .news-item p {
            font-size: 14px;
            color: #666;
        }

        .news-item a {
            display: inline-block;
            margin-top: 10px;
            color: #0098C8;
            text-decoration: none;
            font-weight: bold;
        }

        .news-item a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            width: 100%;
            background-color: #0098C8;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        .footer img {
            width: 60px;
            margin-bottom: 10px;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }
        .footer-copyright {
        width: 100%;
        background-color: #0078A8;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        font-size: 14px;
    }

    .copyright {
        flex: 1;
    }

    .social-media {
        display: flex;
        gap: 15px;
    }

    .social-media a {
        color: white;
        font-size: 18px;
        text-decoration: none;
        transition: 0.3s;
    }

    .social-media a:hover {
        color:rgb(20, 20, 20);
    }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="img/Gambar.png" alt="Logo SMK Bina Bangsa" class="logo">
        SMK BINA BANGSA
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <img src="img/smk.jpg" alt="Perpustakaan SMK Bina Bangsa">
        <div class="overlay">
            <h1>Selamat Datang di</h1>
            <h2>Perpustakaan SMK Bina Bangsa</h2>
            <a href="login.php" class="btn-login">LOGIN</a>
        </div>
    </div>

    <!-- Informasi Sekolah -->
    <div class="section-header">
        Jl. Tanjung - Banjarharjo No.KM. 10, Kubangpari Satu, Kubangpari, Kec. Kersana
    </div>

    <!-- Deskripsi -->
    <div class="description">
        <h2>WEBSITE PERPUSTAKAAN SMK BINA BANGSA</h2>
        <p>
            Website Perpustakaan SMK Bina Bangsa adalah platform digital yang dirancang untuk membantu siswa, guru, dan staf sekolah dalam mengakses informasi terkait layanan perpustakaan secara lebih mudah dan efisien.
            Dengan adanya website ini, pengguna dapat melihat informasi terbaru mengenai layanan perpustakaan. Selain itu, admin perpustakaan dapat mengelola data buku, peminjaman, serta pengembalian secara digital, sehingga proses administrasi menjadi lebih terstruktur dan cepat.
        </p>
    </div>

    <!-- Berita -->
    <?php
    include 'koneksi.php';
    $sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 6";
    $result = mysqli_query($koneksi, $sql);
    ?>
    <div class="news-section">
        <h2>SMK BINA BANGSA NEWS</h2>
        <div class="news-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="news-item">
                    <img src="img/<?php echo $row['gambar']; ?>" alt="<?php echo $row['judul']; ?>">
                    <h3><?php echo $row['judul']; ?></h3>
                    <p><?php echo substr($row['isi'], 0, 100); ?>...</p>
                    <a href="detail_berita.php?id=<?php echo $row['id']; ?>">Baca Selengkapnya</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <img src="img/Gambar.png" alt="Logo SMK Bina Bangsa">
        <p>SMK BINA BANGSA</p>
        <p>Jl. Tanjung - Banjarharjo No.KM. 10, Kubangpari Satu, Kubangpari, Kec. Kersana</p>
    </footer>
    <footer class="footer-copyright">
    <p>&copy; <?php echo date("Y"); ?> SMK BINA BANGSA. All Rights Reserved.</p>
    <div class="social-media">
        <a href="https://www.facebook.com/osissmkbisaa" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/binabangsakersana?igsh=MWJld3MxYnUxY3Zhdw==" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://youtube.com/@binabangsaofficial?si=S0KXLx2XMWErqUkj" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>
</footer>

</body>
</html>
