<?php
session_start();
include '../includes/db.php';

// Fungsi untuk memeriksa login
requireLogin();

// Periksa apakah parameter 'id' telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil detail film berdasarkan ID
    $query = "SELECT * FROM movies WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $film = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Film</title>
</head>
<body>
    <h1>Detail Film</h1>
    <p><strong>Judul:</strong> <?php echo $film['film']; ?></p>
    <p><strong>Genre:</strong> <?php echo $film['genre']; ?></p>
    <p><strong>Actors:</strong> <?php echo $film['actors']; ?></p>
    <p><strong>Directors:</strong> <?php echo $film['directors']; ?></p>
    <img src="../assets/img/<?php echo $film['image']; ?>" width="200" alt="Film Image">
</body>
</html>
<?php
    } else {
        echo "Film tidak ditemukan.";
    }
} else {
    echo "ID film tidak diberikan.";
}
?>