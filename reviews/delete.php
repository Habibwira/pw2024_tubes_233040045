<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';
require_once '../includes/session.php';

requireLogin();
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: read.php");
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    header("Location: read.php");
    exit();
}
?>
