<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $film = mysqli_fetch_assoc($result);

    if (!$film) {
        die("Film tidak dapat ditemukan dengan ID: $id ");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $film = mysqlii_real_escape_string($conn, $_POST['film']);
    $genre = mysqlii_real_escape_string($conn, $_POST['genre']);
    $actors = mysqlii_real_escape_string($conn, $_POST['actors']);
    $directors = mysqlii_real_escape_string($conn, $_POST['directors']);
    $image = mysqlii_real_escape_string($conn, $_POST['image']);

    $sql = "UPDATE movies SET film='$film', genre='$genre', actors='$actors', directors='$directors', image='$image' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data film berhasil diupdate";
        header("Location: ../index.php");
        exit();
    } else {
        echo "Gagal mengupdate data film: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $film['id']; ?>">

        <label for="film">Judul Film:</label><br>
        <input type="text" id="film" name="film" value="<?php echo $film['film']; ?>"><br>
        
        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre" value="<?php echo $film['genre']; ?>"><br>

        <label for="actors">Aktor/Aktris:</label><br>
        <input type="text" id="actors" name="actors" value="<?php echo $film['actors']; ?>"><br>

        <label for="directors">Director:</label><br>
        <input type="text" id="directors" name="directors" value="<?php echo $film['directors']; ?>"><br>

        <label for="image">URL Gambar:</label><br>
        <input type="text" id="image" name="image" value="<?php echo $film['image']; ?>"><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
