<?php
require 'header.php';
if (isset($_SESSION['userId'])) {
?>
    <form action="reset-username.php" method="post">
        <input type="text" name="old-username" placeholder="Enter Old Username">
        <input type="text" name="new-username" placeholder="Enter New Username">
        <input type="text" name="username-repeat" placeholder="Enter New Username Again">
        <button type="submit" name="reset-username-submit">Confirm</button>
    </form>
<?php 
} 
else {
Header ('Location: login.php');
}
require 'footer.php';
?>