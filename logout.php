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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <div class="logout-container">
        <h2>Logout</h2>
        <p>You have been logged out.</p>
        <a href="index.php">Return to Home</a>
    </div>

</body>
</html>
