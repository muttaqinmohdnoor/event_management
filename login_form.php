<?php
session_start(); // Start the session at the top

// Debugging: Check the session data
// var_dump($_SESSION);

?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Login </title>
  <link rel="stylesheet" href="css/login_form.css">
</head>

<body>
  <div class="wrapper">
    <h2>LOG IN</h2>
    <?php
    // Check if there's an error message and display it
    if (isset($_SESSION['error'])) {
      echo '<div style="color: red; font-size: 14px; margin: 12px 0 10px 0; padding: 14px; border: 1px solid red; background-color: #fdd; border-radius: 5px;">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']); // Clear the error after displaying it
    }
    ?>
    <form action="login.php" method="POST">
      <div class="input-box">
        <input name="email" type="email" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input name="password" type="password" placeholder="Create password" required>
      </div>
      <div class="policy">
        <input type="checkbox">
        <h3>Remember me</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Login">
      </div>
      <div class="text">
        <h3>Don't have an account? <a href="register_form.php">Register here</a></h3>
      </div>
    </form>
  </div>
</body>

</html>