<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($film = mysqli_fetch_assoc($result)) {
        // Tampilkan detail film
    } else {
        echo "Film tidak ditemukan.";
    }
} else {
    echo "ID film tidak disediakan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Film</title>
</head>
<body>
    <?php if ($film): ?>
        <h1><?php echo htmlspecialchars($film['film']); ?></h1>
        <p>Genre: <?php echo htmlspecialchars($film['genre']); ?></p>
        <p>Actors: <?php echo htmlspecialchars($film['actors']); ?></p>
        <p>Directors: <?php echo htmlspecialchars($film['directors']); ?></p>
        <img src="assets/img/<?php echo htmlspecialchars($film['image']); ?>" alt="Movie Image">
    <?php endif; ?>

</body>
</html>