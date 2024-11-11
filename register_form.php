<?php
session_start(); // Start the session at the top

// Debugging: Check the session data
// var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="css/register_form.css">
</head>

<body>
  <div class="wrapper">
    <h2>REGISTRATION</h2>
    <?php
    // Check if there's an error message and display it
    if (isset($_SESSION['error'])) {
      echo '<div style="color: red; font-size: 14px; margin: 12px 0 10px 0; padding: 14px; border: 1px solid red; background-color: #fdd; border-radius: 5px;">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']); // Clear the error after displaying it
    }
    ?>
    <form action="register.php" method="post">
      <div class="form-columns">
        <div class="column">
          <div class="input-box">
            <input name="name" type="text" placeholder="Enter your name" required value="<?= $_SESSION['old_data']['name'] ?? '' ?>">
          </div>
          <div class="input-box">
            <input name="email" type="email" placeholder="Enter your email" required value="<?= $_SESSION['old_data']['email'] ?? '' ?>">
          </div>
          <div class="input-box">
            <input name="password" type="password" placeholder="Create password" required>
          </div>
          <div class="input-box">
            <input name="c_password" type="password" placeholder="Confirm password" required>
          </div>
          <div class="input-box">
            <input name="phone" type="text" placeholder="Enter your phone number" required value="<?= $_SESSION['old_data']['phone'] ?? '' ?>">
          </div>
        </div>
        <div class="column">
          <div class="input-box">
            <input name="address" type="text" placeholder="Enter your address" required value="<?= $_SESSION['old_data']['address'] ?? '' ?>">
          </div>
          <div class="input-box">
            <input name="city" type="text" placeholder="Enter your city" required value="<?= $_SESSION['old_data']['city'] ?? '' ?>">
          </div>
          <div class="input-box">
            <input name="state" type="text" placeholder="Enter your state" required value="<?= $_SESSION['old_data']['state'] ?? '' ?>">
          </div>
          <div class="input-box">
            <input name="zipcode" type="text" placeholder="Enter your postal code" required value="<?= $_SESSION['old_data']['zipcode'] ?? '' ?>">
          </div>
          <div class="input-box">
            <select name="country" id="country" required>
              <option value="">Select your country</option>
              <option value="Malaysia" <?= ($_SESSION['old_data']['country'] ?? '') == 'Malaysia' ? 'selected' : '' ?>>Malaysia</option>
              <option value="Singapore" <?= ($_SESSION['old_data']['country'] ?? '') == 'Singapore' ? 'selected' : '' ?>>Singapore</option>
              <option value="Indonesia" <?= ($_SESSION['old_data']['country'] ?? '') == 'Indonesia' ? 'selected' : '' ?>>Indonesia</option>
            </select>
          </div>
        </div>
      </div>
      <div class="input-box button">
        <input type="submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login_form.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>

</html>

<?php unset($_SESSION['old_data']); // Clear old data after displaying it ?>