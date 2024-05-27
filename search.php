<?php
include 'includes/session.php';
include 'includes/db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM movies WHERE film LIKE '%$query%' OR genre LIKE '%$query%' OR actors LIKE '%$query%' OR directors LIKE '%$query%'";
    $result = mysqli_query($conn, $query);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pencarian</title>
</head>
<body>
  <h1>Hasil Pencarian</h1>
  <?php if ($result && mysqli_num_rows($result) > 0) {
      while ($film = mysqli_fetch_assoc($result)) { ?>
          <div class="box">
              <div class="box-img">
                  <a href="detail.php?id=<?php echo $film['id']; ?>">Detail</a>
                  <img src="assets/img/<?php echo htmlspecialchars($film['image']); ?>" alt="Movie Image"> 
              </div>
            <h2><?php echo htmlspecialchars($film['film']); ?></h2>
            <h3><?php echo htmlspecialchars($film['directors']); ?></h3>
            <span><?php echo htmlspecialchars($film['id']); ?></span>
            <a href="admin/update.php?id=<?php echo $film['id']; ?>">Edit</a>
            <a href="admin/delete.php?id=<?php echo $film['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus film ini?')">Delete</a>
          </div>
  <?php endwhile; ?> 
  <?php else: ?>
      <p>Tidak ada hasil pencarian yang ditemukan.</p>
  <?php endif; ?>   
  
</body>
</html>