<?php
include 'db.php';

$sql = "SELECT id, film, genre, actors, directors FROM films";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Films</title>
</head>
<body>
    <h2>Film List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Films</th>
            <th>Genre</th>
            <th>Actors</th>
            <th>Directors</th>
            <th>Actions</th>
        </tr>            
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["films"]. "</td>         
                        <td>" . $row["genre"]. "</td>         
                        <td>" . $row["actors"]. "</td>         
                        <td>" . $row["directors"]. "</td>         
                        <td>
                            <a href='update.php?id=" . $row["id"]. "'>Update</a> |
                            <a href='delete.php?id=" . $row["id"]. "'>Delete</a>         
                        </td>
                      </tr>";

            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>
    <a href="create.php">Add New Films</a>    
    
</body>
</html>

<?php
$conn->close();
?>


