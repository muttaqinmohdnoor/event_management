<?php

$database_name = "login_db";
$database_user = "root";
$database_password = "password";

$connection = new mysqli("localhost", $database_user, $database_password, $database_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

return $connection;
?>