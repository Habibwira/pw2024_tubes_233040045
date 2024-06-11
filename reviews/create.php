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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO reviews (movie_id, rating, duration) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $movie_id, $rating, $duration);

    if ($stmt->execute()) {
        header("Location: read.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$sql = "SELECT id, film FROM movies";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Review</title>
</head>
<body>
    <h1>Tambah Review</h1>
    <form action="create.php" method="POST">
        <div>
            <label for="movie_id">Film:</label>
            <select name="movie_id" id="movie_id" required>
                <?php while ($movie = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $movie['id']; ?>"><?php echo $movie['film']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating" required>
        </div>
        <div>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" required>
        </div>
        <button type="submit">Tambah Review</button>
    </form>
    <a href="read.php">Kembali ke Daftar Reviews</a>
</body>
</html>
