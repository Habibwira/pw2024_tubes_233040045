<?php
$password = 'password'; // Password yang ingin Anda hash
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
?>
