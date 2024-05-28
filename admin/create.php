<?php
include '../includes/session.php';
include '../includes/db.php';

// Hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Anda tidak memiliki akses ke halaman ini.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $film = mysqli_real_escape_string($conn, $_POST['film']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $directors = mysqli_real_escape_string($conn, $_POST['directors']);
    $actors = mysqli_real_escape_string($conn, $_POST['actors']);
    $image = $_FILES['image']['name'];

    $target = "../assets/img/" . basename($image);

    // Validasi form
    if (empty($film) || empty($genre) || empty($directors) || empty($actors) || empty($image)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Cek apakah film sudah ada dalam tabel
        $checkQuery = "SELECT * FROM movies WHERE film='$film'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            echo "Film sudah ada dalam database.";
        } else {
            // Jika tidak ada film dengan nama yang sama, lakukan penyisipan data
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $query = "INSERT INTO movies (film, genre, directors, actors, image) VALUES ('$film', '$genre', '$directors', '$actors', '$image')";
                if (mysqli_query($conn, $query)) {
                    echo "Film berhasil ditambahkan.";
                    header('Location: ../admin_dashboard.php');
                    exit;
                } else {
                    echo "Kesalahan dalam menambah film: " . mysqli_error($conn);
                }
            } else {
                echo "Gagal mengupload gambar.";
            }
        }
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <form method="POST" action="create.php" enctype="multipart/form-data">
        <label for="film">Film:</label><br>
        <input type="text" id="film" name="film" required><br>
        
        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre" required><br>

        <label for="actors">Actors:</label><br>
        <input type="text" id="actors" name="actors" required><br>

        <label for="directors">Directors:</label><br>
        <input type="text" id="directors" name="directors" required><br>

        <label for="image">Image:</label><br>
        <input type="file" name="image" id="image" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>