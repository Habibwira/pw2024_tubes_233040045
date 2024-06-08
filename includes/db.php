<?php
// Define database connection variables
$servername = "localhost";
$username = "u751466727_hwf"; // Sesuaikan dengan username MySQL Anda
$password = "Habibwf9"; // Sesuaikan dengan password MySQL Anda
$dbname = "u751466727_cineverse"; // Ganti dengan nama database Anda

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>