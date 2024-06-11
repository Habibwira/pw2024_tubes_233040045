<?php
session_start();
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movie_id = $_POST['movie_id'];
        $rating = $_POST['rating'];
        $duration = $_POST['duration'];

        $stmt = $conn->prepare("UPDATE reviews SET movie_id = ?, rating = ?, duration = ? WHERE id = ?");
        $stmt->bind_param('issi', $movie_id, $rating, $duration, $id);

        if ($stmt->execute()) {
            header("Location: read.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $review = $result->fetch_assoc();

        $movies = mysqli_query($conn, "SELECT id, film FROM movies");
    }
} else {
    header("Location: read.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
</head>
<body>
    <h1>Edit Review</h1>
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <div>
            <label for="movie_id">Film:</label>
            <select name="movie_id" id="movie_id" required>
                <?php while ($movie = mysqli_fetch_assoc($movies)) { ?>
                <option value="<?php echo $movie['id']; ?>" <?php if ($movie['id'] == $review['movie_id']) echo 'selected'; ?>><?php echo $movie['film']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating" value="<?php echo $review['rating']; ?>" required>
        </div>
        <div>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" value="<?php echo $review['duration']; ?>" required>
        </div>
        <button type="submit">Update Review</button>
    </form>
    <a href="read.php">Kembali ke Daftar Reviews</a>
</body>
</html>
