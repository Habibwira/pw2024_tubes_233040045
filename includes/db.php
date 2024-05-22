<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pw2024_tubes_233040045"; 

// create connection
$conn = new mysqli($servername, $username, $password, $dbname); 

// check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>