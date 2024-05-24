<?php
session_start();
include '../includes/db.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM movies WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
    } else {
        echo "Kesalahan: " . mysqli_error($conn);
    }
}
?>