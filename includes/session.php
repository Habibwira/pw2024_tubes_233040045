<?php
include 'db.php';

// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk memeriksa apakah pengguna sudah login
function requireLogin() {
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }
}

// Fungsi untuk memeriksa apakah pengguna adalah admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


?>