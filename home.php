
<?php
require 'header.php';
?>
<?php
        if (isset($_SESSION['userId'])) {
            echo '<p>You are logged in!</p>';
        }
        else {
            echo '<p>You are logged out!</p>';
            header ("Location: login.php");
        }
    ?>