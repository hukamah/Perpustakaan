<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Hanya mulai sesi jika belum ada sesi yang aktif
}
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
