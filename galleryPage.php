<?php
    require 'gallery.php';
?>
<div id="show-feed">
    <?php
    require 'includes/dbh.inc.php';
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
            <button class="heart fas fa-heart" name="like"></button><span class="like-number"><?= $row['liked'];?></span>
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
        </div>
        <?php
    }
    ?>
    </div>
<?php require 'footer.php'; ?>