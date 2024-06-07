<?php
include '../includes/session.php';
include '../includes/db.php';
requireLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO reviews (user_id, movie_id, review, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisi', $user_id, $movie_id, $review, $rating);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Review added successfully!";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Review</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="create.php" method="POST">
        <label for="movie_id">Movie ID:</label>
        <input type="number" name="movie_id" id="movie_id" required>
        <br>
        <label for="review">Review:</label>
        <textarea name="review" id="review" required></textarea>
        <br>
        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required>
        <br>
        <button type="submit">Add Review</button>
    </form>
</body>
</html>
