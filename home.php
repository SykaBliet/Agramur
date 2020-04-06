<?php
include 'header.php';
?>
<?php
if (isset($_SESSION['userId'])) {
?>
    <p>You are logged in!</p>
    <div id="show-feed">
    <?php
    require 'includes/dbh.inc.php';
    $user = $_SESSION['userId'];
    $sql = "SELECT * FROM userphotos WHERE photoid order by dates DESC";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();
    foreach ($row as $key => $value) {
    ?>  
        <div class="container-gallery">
            <img class="img-login" src="<?php echo $value['photo']; ?>" alt="">
            <?php
            $valuephoto = $value['photo'];
            $likesql = "SELECT * FROM userphotos WHERE photo = '$valuephoto' ";
            $stmt = $pdo->query($likesql);
            $row = $stmt->fetch();
            ?>
            <form action="like.php" method="post">
            <input type="hidden" name="photo" value="<?php echo $valuephoto; ?>">
            <input type="hidden" name="idUsers" value="<?php echo $user; ?>">
            <input type="hidden" name="uidUsers" value="<?php echo $_SESSION["uidUsers"]; ?>">
            <button class="yes fas fa-heart" name="like"></button><span class="like-number"><?= $row['liked'];?></span>
            </form>
            <?php
            $commentsql = "SELECT * FROM comments WHERE photo = '$valuephoto' order by dates ASC";
            $stmt = $pdo->query($commentsql);
            $row = $stmt->fetchAll();
            echo '<h2 class="comment-title"> Comment Section</h2>';
            foreach ($row as $key => $value) {
            ?>
            <div class="comment">
                <h4>By <?php echo $value['uidUsers'] ?></h4>
                <p>Comment: <?php echo $value['comment']; ?> </p>
            </div>
            <?php
            }
            ?>
            <form action="comments.php" method="post">
                <input type="hidden" name="photo" value="<?php echo $valuephoto; ?>">
                <input type="hidden" name="idUsers" value="<?php echo $user; ?>">
                <input type="hidden" name="uidUsers" value="<?php echo $_SESSION['uidUsers']; ?>">
                <input type="text" name="comment" placeholder="Comment Here...">
                <button class="gallery-button">Submit</button>
            </form>
        </div>
        <?php
    }
    ?>
    </div>
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
    