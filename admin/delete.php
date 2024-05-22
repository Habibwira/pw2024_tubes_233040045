<?php
include 'db.php'


if(isset($_GET["id"])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM films WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted succcesfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
    header("Location: read.php");
} else {
    echo "Invalid ID";
}
?>