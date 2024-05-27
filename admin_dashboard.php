<?php
session_start();
include 'includes/session.php'; // Memasukkan file session.php yang berisi definisi requireLogin()
include 'includes/db.php';

// Query untuk menampilkan semua data film
$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);

// Fungsi pencarian
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM movies WHERE film LIKE '%$search%' OR genre LIKE '%$search%' OR actors LIKE '%$search%' OR directors LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Film List</title>
    <link rel="stylesheet" href="assets/style.css">
     <style>
        /* CSS untuk memberikan warna pada tabel */
        table {
            width: 100%;
            
        }

        /* CSS untuk memberikan warna pada header kolom */
        th {
            background-color: #1e1c2a;
        }
    </style>
</head>
<body>
    <h1>Daftar Film</h1>
    <form action="admin_dashboard.php" method="GET">
        <input type="text" name="search" placeholder="Cari Film">
        <button type="submit">Cari</button>
    </form>
    <a href="admin/create.php">Tambah Film</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Genre</th>
            <th>Actors</th>
            <th>Directors</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($film = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $film['id']; ?></td>
            <td><?php echo $film['film']; ?></td>
            <td><?php echo $film['genre']; ?></td>
            <td><?php echo $film['actors']; ?></td>
            <td><?php echo $film['directors']; ?></td>
            <td><img src="assets/img/<?php echo $film['image']; ?>" width="100"></td>
            <td>
                <a href="admin/update.php?id=<?php echo $film['id']; ?>">Edit</a>
                <a href="admin/delete.php?id=<?php echo $film['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus film ini?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>