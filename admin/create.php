<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $film = $_POST['film'];
    $genre = $_POST['genre'];
    $actors = $_POST['actors'];
    $directors = $_POST['directors'];
    $image = $_FILES['image']['name'];
    $target = "../assets/img/". basename($image);

    $sql = "INSERT INTO movies (film, genre, actors, directors, image) VALUES ('$film', '$genre', '$actors', '$directors', '$image')";

    if (mysql_query($conn, $sql)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "film berhasil ditambahkan dan gambar diunggah. ";
        } else {
            echo "Film berhasil ditambahkan tetapi gagal mengunggah gambar . ";
        }
        header("Location: ../index.php");
    } else {
        echo "kesalahan: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Film</title>
</head>
<body>
    <h2>Update Film</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $film['id']; ?>">
        <label for="film">Film:</label><br>
        <input type="text" id="film" name="film"><br>
        
        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre"><br>

        <label for="actors">Actors:</label><br>
        <input type="text" id="actors" name="actors"><br>

        <label for="directors">Directors:</label><br>
        <input type="text" id="directors" name="directors"><br>

        <label for="image">Image:</label><br>
        <input type="text" id="image" name="image"><br>

        <input type="submit" value="Update film">
    </form>

</body>
</html>
