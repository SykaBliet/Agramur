
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
    <main>
    <?php
        if (isset($_SESSION['userId'])) {
            echo require 'header.php';
            echo '<form action="includes/logout.inc.php" method="post">
                <button href="index.php" type="submit" name="logout-submit">Logout</button>
                <a href="login.php" type="submit" name="logout-submit">Logout</a>
            </form>';
        }
        else {
            echo '
            <div class="container-login-form">
                <form class="form-login" action="includes/login.inc.php" method="post"> 
                    <h1 class="login-title">Camagru</h1>
                    <input type="text" name="mailuid" placeholder="Username/E-mail...">
                    <input type="password" name="pwd" placeholder="Password">
                    <button class="login-button" type="submit" name="login-submit">Login</button>
                    <a class="forgot-pass" href="forgotPassword.php">Forgot Password ?</a>
                    <br>
                    <div class="signup-block">
                        <p class="signup-p">Not signed in yet?</p>
                        <a class="signup-button" href="signup.php">Sign Up</a>
                    </div>
                </form>
            </div>';
        }
    ?> 
    <?php
        if (isset($_SESSION['userId'])) {
            echo '<p>You are logged in!</p>';
        }
        else {
            echo '<p>You are logged out!</p>';
        }
    ?>
    </main>

    <?php
        require "footer.php";
    ?>