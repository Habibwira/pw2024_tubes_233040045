<?php
include 'db.php';

// Contoh penanganan login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function requireLogin() {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
}

function isAdmin() {
    return isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true;
}


?>