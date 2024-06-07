<?php
include '../includes/session.php';
include '../includes/db.php';
requireLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $sql = "UPDATE reviews SET review = ?, rating = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $review, $rating, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Review updated successfully!";
        header("Location: read.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
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
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($review['id']); ?>">
        <label for="review">Review:</label>
        <textarea name="review" id="review" required><?php echo htmlspecialchars($review['review']); ?></textarea>
        <br>
        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" min="1" max="5" value="<?php echo htmlspecialchars($review['rating']); ?>" required>
        <br>
        <button type="submit">Update Review</button>
    </form>
</body>
</html>
