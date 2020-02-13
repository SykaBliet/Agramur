<?php
include 'header.php';
?>
<?php
        if (isset($_SESSION['userId'])) {
            ?>
            <p>You are logged in!</p>
            <?php
        }
        else {
            ?>
            <p>You are logged out!</p>
            <?php
            header ("Location: login.php");
        }
        ?>
    <?php
    include 'footer.php'
    ?>