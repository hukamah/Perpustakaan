<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['roles'] != 'siswa') {
    header("Location: login.php");
    exit();
}
