<?php

include 'includes/db.php';

$search = $_GET['q'];
$sql = "SELECT * FROM movies WHERE film LIKE ? OR genre LIKE ? OR actors LIKE ? OR directors LIKE ?";
$search_param = '%' . $search . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $search_param, $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

$movies = array();
while ($row = $result->fetch_assoc()) {
    $movies[] = $row;
}

echo json_encode($movies);
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