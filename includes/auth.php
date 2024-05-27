<?php
session_start();

function requireLogin() {
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        header("Location: ../login.php");
        exit();
    }
}

include 'db.php';

// Function to check if user is logged in
function isLoggedIn(){
    return isset($_SESSION['user_id']);
}

// Function to redirect user to login page if not logged in
function redirectToLogin(){
    if(!isLoggedIn()){
        header('Location: login.php');
        exit();
    }
}

// Function to redirect user to index page if logged in
function redirectToIndex(){
    if(isLoggedIn()){
        header('Location: index.php');
        exit();
    }
}

// Function to handle user login
function login($username, $password){
    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    }else{
        return false;
    }
}

// Function to handle user logout
function logout(){
    session_unset();
    session_destroy();
    header('Location: logout.php');
    exit();
}

// Function to handle user registration
function register($username, $email, $password){
    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Additional validation can be added here

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if(mysqli_query($conn, $sql)){
        return true;
    }else{
        return false;
    }
}

requireLogin();
?>

