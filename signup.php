<?php

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title>Signup</title>
</head>
    <main>
        <div class="wrapper-main">
            <section class="container-login-form2">
                <form class="form-login" action="includes/signup.inc.php" method="post">
                    <h1 class="login-title">Sign Up</h1>
                    <input type="text" name="uid" placeholder="Username">
                    <input type="text" name="mail" placeholder="E-mail">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat password">
                    <button class="login-button" type="submit" name="signup-submit">Sign Up</button>
                </form>
            </section>
        </div>
    </main>

    <?php
        require "footer.php";
    ?>