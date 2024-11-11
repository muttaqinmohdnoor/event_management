<?php
session_start(); // Start session to access session variables

include 'config.php';

global $connection;

$email = $_POST['email'];
$password = $_POST['password'];
$hash = md5($password); // Password hash for comparison

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hash'";

$result = $connection->query($sql);

// If user found, log them in
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user; // Store user info in session
    $_SESSION['success'] = 'Login successful';
    header('Location: home.php'); // Redirect to the home page
    exit(); // Ensure no further code execution
} else {
    // Login failed, set error message in session
    $_SESSION['error'] = 'Invalid email or password';
    header('Location: login_form.php'); // Redirect back to login page
    exit(); // Ensure no further code execution
}
