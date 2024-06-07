<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
    <div class="logout-container">
        <h2>Logout</h2>
        <p>You have been logged out successfully.</p>
        <a href="login.php">Login Again</a>
    </div>
</body>
</html>