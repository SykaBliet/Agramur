<?php
    session_start();
?>
        <?php
        if (isset($_SESSION['userId'])) {
            header("Location: home.php");
        }
        else {
            header("Location: login.php");
        }
        ?>
<?php
    require "footer.php";
?>