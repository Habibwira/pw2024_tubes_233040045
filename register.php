<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password sebelum disimpan

    // Query untuk memeriksa apakah username sudah digunakan
    $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    // Jika username sudah digunakan, tampilkan pesan error
    if ($stmt_check->num_rows > 0) {
        echo "Username sudah digunakan. Silakan coba dengan username lain.";
        exit();
    }

    // Query untuk menyimpan data pengguna baru ke database
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman login setelah pendaftaran berhasil
        header("Location: login.php");
        exit();
    } else {
        echo "Pendaftaran gagal. Silakan coba lagi.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
