<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title></title>
</head>
<body>
    <?php
        if (isset($_SESSION['userId'])) {
    ?>
            <header>
                <nav class="nav-bar">
                    <ul class="ul-navbar">
                        <a class="logo" href="index.php"><img class="logo-img1" src="img/logo-img1.png" alt="logo"></a>
                        <li class="li-navbar"><a href="#">Profil</a></li>
                        <li class="li-navbar"><a href="#">Post Image</a></li>
                        <li class="li-navbar-logout">
                        <a href="includes/logout.inc.php" type="submit" name="logout-submit">Logout</a>
                        </li>
                    </ul>
                </nav>
            </header>
    <?php
       }
       else {
           require 'login.php';
           header ("Location: login.php");
       }
    ?>
            <!-- mettre post pour cacher l'info sur l'url -->  