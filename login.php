<?php
session_start();


require 'koneksi.php';

if (isset($_SESSION['username'])) {
    header("location: db_admin.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing password

        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE username = ? AND password = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: db_admin.php");
    } else {
        $error = "Username atau password salah.";
    }
    $stmt->close();
}

?>

<!doctype html>
<html lang="id">
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
<body class="login-page">
    <div class="container">
        <div class="card login-form"> 
            <div class="body text-center">
                <img src="img/gambar.png" alt="Logo SMK Bina Bangsa" style="width: 100px; height: auto;">
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
