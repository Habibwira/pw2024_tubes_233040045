<?php
include '../includes/session.php';
include '../includes/db.php';
requireLogin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Review deleted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
}

header("Location: read.php");
exit();
?>
