<?php
include '../includes/session.php';
include '../includes/db.php';
requireLogin();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM reviews WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Reviews</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Your Reviews</h1>
    <a href="create.php">Add New Review</a>
    <table>
        <thead>
            <tr>
                <th>Movie ID</th>
                <th>Review</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['movie_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['review']); ?></td>
                    <td><?php echo htmlspecialchars($row['rating']); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
