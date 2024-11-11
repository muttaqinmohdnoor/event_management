<?php
session_start(); // Start session to access session variables

include 'config.php';
global $connection;

// Store submitted data in the session to preserve it after redirect
$_SESSION['old_data'] = $_POST;

$arr_reg['name'] = $_POST['name'];
$arr_reg['email'] = $_POST['email'];
$arr_reg['password'] = md5($_POST['password']);
$arr_reg['c_password'] = md5($_POST['c_password']);
$arr_reg['phone'] = $_POST['phone'];
$arr_reg['address'] = $_POST['address'];
$arr_reg['city'] = $_POST['city'];
$arr_reg['state'] = $_POST['state'];
$arr_reg['zipcode'] = $_POST['zipcode'];
$arr_reg['country'] = $_POST['country'];

// Validate passwords
if ($arr_reg['password'] != $arr_reg['c_password']) {
    $_SESSION['error'] = 'Password and confirm password do not match';
    header('Location: register_form.php');
    exit();
}

// Validate length of password
if (strlen($_POST['password']) < 6) {
    $_SESSION['error'] = 'Password must be at least 6 characters long';
    header('Location: register_form.php');
    exit();
}

// Validate country
if ($arr_reg['country'] == '') {
    $_SESSION['error'] = 'Please select a country';
    header('Location: register_form.php');
    exit();
}

// Check for existing email
$sql_check = "SELECT * FROM users WHERE email = '" . $arr_reg['email'] . "'";
$result = $connection->query($sql_check);

if ($result->num_rows > 0) {
    $_SESSION['error'] = 'Email already exists';
    header('Location: register_form.php');
    exit();
}

// Insert into the database
$sql = "INSERT INTO users (name, email, password, phone, address, city, state, zipcode, country) VALUES ('" . $arr_reg['name'] . "', '" . $arr_reg['email'] . "', '" . $arr_reg['password'] . "', '" . $arr_reg['phone'] . "', '" . $arr_reg['address'] . "', '" . $arr_reg['city'] . "', '" . $arr_reg['state'] . "', '" . $arr_reg['zipcode'] . "', '" . $arr_reg['country'] . "')";

if ($connection->query($sql) === TRUE) {
    $_SESSION['user'] = $arr_reg; // Store user info in session
    $_SESSION['success'] = 'Registration successful';
    unset($_SESSION['old_data']); // Clear session data on success
    header('Location: home.php');
    exit();
} else {
    $_SESSION['error'] = 'Registration failed';
    header('Location: register_form.php');
    exit();
}
?>
