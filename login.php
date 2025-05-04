<?php
session_start();

// Koneksi ke database
include 'koneksi.php';

// Jika sudah login, langsung alihkan ke halaman admin
if (isset($_SESSION['username'])) {
    header("Location: db_admin.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password input dengan md5()

    // Query untuk memeriksa username dan password
    $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data_session = $result->fetch_assoc();

        // Set session untuk user yang berhasil login
        $_SESSION['username'] = $data_session['username'];
        $_SESSION['roles'] = $data_session['roles'];

        // Redirect ke halaman admin
        header("Location: db_admin.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
    $stmt->close();
}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet"> 
    <link rel="icon" href="img/gambar.png" type="image/png">
    <title>Login - Sistem Informasi Perpustakaan</title>
</head>
<style>
    
/* css login */
/* Mengatur background halaman login */
body.login-page {
    background-image: url('img/smkbb.jpg'); 
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Mengatur container form agar berada di tengah halaman */
.container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    max-width: 400px;
    width: 100%;
    margin: auto;
}

/* Mengatur tampilan card form */
.card.login-form {
    background-color: rgba(255, 255, 255, 0.9); 
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(27, 27, 27, 0.26); 
    width: 100%;
    text-align: center;
}

/* Mengatur gambar logo di atas form */
.card.login-form img {
    margin-bottom: 15px;
}

/* Judul form login */
.card-title {
    font-size: 24px;
    margin: 10px 0;
    color: #000;
}

/* Mengatur tampilan label agar berwarna hitam dan rata kiri */
.card.login-form label {
    color: #000; /* Warna hitam untuk label */
    display: block;
    margin-bottom: 5px;
    text-align: left;
    
}

/* Mengatur tampilan input teks agar berwarna hitam dan rata kiri */
.form-control {
    color: #000; /* Warna hitam untuk teks input */
    background-color: #fff;
    text-align: left; /* Meratakan teks ke kiri */
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #cccccc;
    width: 100%;
    box-sizing: border-box;
}

/* Tombol login utama */
.btn-primary {
    width: 100%;
    padding: 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: rgb(219, 9, 9);
}

/* Checkbox dan teks di sebelahnya */
.form-check {
    display: flex;
    align-items: center;
    justify-content: left;
    margin-bottom: 10px;
}

.form-check input[type="checkbox"] {
    margin-right: 5px;
}

.form-check label {
    color: red; 
}

</style>
<body class="login-page">
    <div class="container">
        <div class="card login-form"> 
            <div class="body text-center">
                <img src="img/Gambar.png" alt="Logo SMK Bina Bangsa" style="width: 100px; height: auto;">
                <h1 class="card-title">SMK BINA BANGSA</h1>
            </div>
            <div class="card-text">
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <?php
                if ($error) {
                    echo $error;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
