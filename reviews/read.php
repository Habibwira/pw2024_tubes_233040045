<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';
require_once '../includes/session.php';

requireLogin();
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

// Query untuk menampilkan semua data ulasan
$sql = "SELECT r.id, r.rating, r.duration, m.film FROM reviews r JOIN movies m ON r.movie_id = m.id";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Reviews</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Daftar Reviews</h1>
    <a href="../admin_dashboard.php">Kembali ke Dashboard</a>
    <a href="create.php">Tambah Review</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Film</th>
            <th>Rating</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
        <?php while ($review = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $review['id']; ?></td>
            <td><?php echo $review['film']; ?></td>
            <td><?php echo $review['rating']; ?></td>
            <td><?php echo $review['duration']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $review['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $review['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus review ini?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
