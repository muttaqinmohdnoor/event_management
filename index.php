<?php

session_start();

//check session
if (isset($_SESSION['user'])) {
    header('Location: home.php');
    exit();
}

header('Location: login_form.php');
exit();