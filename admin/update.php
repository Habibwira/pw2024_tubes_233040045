<?php
include '../includes/session.php';
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $film = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $film = mysqli_real_escape_string($conn, $_POST['film']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $directors = mysqli_real_escape_string($conn, $_POST['directors']);
    $actors = mysqli_real_escape_string($conn, $_POST['actors']);

    // Check if a new image file is uploaded
    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        $target = "../assets/img/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $query = "UPDATE movies SET film='$film', genre='$genre', directors='$directors', actors='$actors', image='$image' WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                header('Location: ../admin_dashboard.php');
            } else {
                echo "Kesalahan dalam mengubah film: " . mysqli_error($conn);
            }
        } else {
            echo "Gagal mengupload gambar.";
        }
    } else {
        // No new image uploaded, only update other fields
        $query = "UPDATE movies SET film='$film', genre='$genre', directors='$directors', actors='$actors' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            header('Location: ../admin_dashboard.php');
        } else {
            echo "Kesalahan dalam mengubah film: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Film</title>
</head>
<body>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $film['id']; ?>">

        <label for="film">Judul Film:</label><br>
        <input type="text" id="film" name="film" value="<?php echo $film['film']; ?>"><br>
        
        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre" value="<?php echo $film['genre']; ?>"><br>

        <label for="actors">Aktor/Aktris:</label><br>
        <input type="text" id="actors" name="actors" value="<?php echo $film['actors']; ?>"><br>

        <label for="directors">Director:</label><br>
        <input type="text" id="directors" name="directors" value="<?php echo $film['directors']; ?>"><br>

        <label for="image">Gambar Film:</label><br>
        <input type="file" id="image" name="image"><br>
        <img src="../assets/img/<?php echo $film['image']; ?>" width="100"><br>

        <button type="submit">Edit Film</button>
    </form>
</body>
</html>