<?php
include '../includes/session.php';
include '../includes/db.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitasi input ID

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../admin_dashboard.php");
        exit();
    } else {
        echo "Kesalahan dalam menghapus film: " . $stmt->error;
    }

    $stmt->close();
}
?>