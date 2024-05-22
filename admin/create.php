<?php
include '../db.php/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $film = $_POST['film'];
    $genre = $_POST['genre'];
    $actors = $_POST['actors'];
    $directors = $_POST['directors'];

    $sql = "INSERT INTO film (film, genre, actors, directors) VALUES ('$film', '$genre', '$actors', '$directors')";
    if ($conn->query($sql) === TRUE) {
        echo "New film record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
    <h2>Create New Film</h2>
    <form method="POST" action="create.php">
        <label for="film">Film:</label><br>
        <input type="text" id="film" name="film"><br>
        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre"><br>
        <label for="actors">Actors:</label><br>
        <input type="text" id="actors" name="actors"><br>
        <label for="directors">Directors:</label><br>
        <input type="text" id="directors" name="directors"><br>
        <input type="submit" value="Submit">
    </form>
    <a href="../read.php/read.php">View Films</a>    
</body>
</html>
