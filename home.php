<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login_form.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Keeps background fixed during scroll */
            background-size: cover;
            /* Ensures image covers entire viewport */
            min-height: 100vh;
            /* Full viewport height */
            margin: 0;
            padding: 0;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 25px;
            overflow-x: hidden;
            /* Prevents horizontal scrolling */
        }

        .topleft {
            position: absolute;
            top: 0;
            left: 16px;
        }

        .topright {
            position: absolute;
            top: 0;
            right: 16px;
        }

        .bottomleft {
            position: absolute;
            bottom: 0;
            left: 16px;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        hr {
            margin: auto;
            width: 40%;
        }

        button {
            margin-top: 10px;
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 10px;
            font-weight: bold;
            padding: 10px 35px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="home.php">Home</a>
            <a class="navbar-brand text-light" href="products.php">Products</a>
            <form action="logout.php" method="POST" class="ms-auto">
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div>
        <div class="middle">
            <h1>Main Page</h1>
            <hr>
            <p>
                <?php
                echo 'Welcome, ' . $_SESSION['user']['name'];
                ?>
            </p>
        </div>
    </div>

</body>

</html>