<?php
session_start();
include '../includes/db.php';

$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Kesalahan dalam query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Films</title>
</head>
<body>
    <h2>Daftar Film</h2>
    <a href="create.php">Add film</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Film</th>
            <th>Genre</th>
            <th>Actors</th>
            <th>Directors</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>            

        <?php if (mysqli_num_rows($result) > 0) {
            while ($film = mysqli_fetch_assoc($result)) { ?>
                <tr>
                        <td><?php echo $film['id']; ?></td>
                        <td><?php echo $film['film']; ?></td>         
                        <td><?php echo $film['genre']; ?></td>         
                        <td><?php echo $film['actors']; ?></td>         
                        <td><?php echo $film['directors']; ?></td>         
                        <td><img src="<?php echo$film['image']; ?>" alt="Movie Image" width="100"></td>
                        <td>
                            <a href="update.php?id=<?php echo $film["id"]; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $film["id"]; ?>"onclick="return confirm('Apakah anda yakin ingin menghapus film ini ?')">Delete</a>         
                        </td>
                </tr>
        <?php }    
        } else {
            echo "<tr><td colspan='7'>Tidak ada film yang tersedia saat ini.</td></tr>";
        } ?>
    </table>        
</body>
</html>



