<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pw2024_tubes_233040045"; 

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); 

// check connection
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>