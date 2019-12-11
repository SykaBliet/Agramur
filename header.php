<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
    <div class="container">
        <a href="#">
            <img src="img/logo.png" alt="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="form-login">
            <?php
                
            ?>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="mailuid" placeholder="Username/E-mail...">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>
            <form action="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>
        </div>
    </div>
</header