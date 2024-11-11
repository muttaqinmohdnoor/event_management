<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login_form.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
    }

    .bgimg {
        background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
        height: 100%;
        background-position: center;
        background-size: cover;
        position: relative;
        color: white;
        font-family: "Courier New", Courier, monospace;
        font-size: 25px;
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

<body>

    <div class="bgimg">

        <div class="topleft">
            <p>Logo</p>
        </div>
        <div class="topright">
            <!-- <p>Some text</p> -->
            <form action="logout.php" method="POST">
                <button>Logout</button>
            </form>
        </div>
        <div class="middle">
            <h1>Main Page</h1>
            <hr>
            <p>
                <?php
                echo 'Welcome, ' . $_SESSION['user']['name'];
                ?>
            </p>
        </div>
        <!-- <div class="bottomleft">
            <p>Some text</p>
        </div> -->
    </div>

</body>

</html>