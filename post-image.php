<?php
    require 'header.php';
?>

<?php
    if (isset($_SESSION['userId'])){
        $filter_array = Array (
            'cigarette',
            'hat',
            'cap'
        );
        if (isset($_GET['filter']) && in_array($_GET['filter'], $filter_array)) {
            $filter = $_GET['filter'];
        }
?>

<script src="camera.js">
</script>
<div>
<a id="download" class="select"><img src="https://img.icons8.com/bubbles/50/000000/download.png"></a>
<a id="redo" class="select"><img src="https://img.icons8.com/bubbles/50/000000/recurring-appointment.png"></a>
</div>
<div class="camera">
    <video id="video">Video stream not available.</video>
    <?php
        if(isset($_GET['filter'])) {
            $disableTakePhoto = "button-photo";
        } else {
                $disableTakePhoto = "button-photo-off";
            }
    ?>
    <button class="<?= $disableTakePhoto ?>" id="startbutton">Take photo</button>
    <?php
        if(isset($filter)){
    ?>
            <img class="filterOnImage" src="filter/<?=$filter?>.png" alt="">
    <?php
        }
    ?>
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img class="resultPhoto" id="photo" alt="The screen capture will appear in this box.">
  </div>
  <div class="filters">
    <a href="post-image.php?filter=cigarette"><img class="filter" id="cigarette" src="filter/cigarette.png" alt="cig filter"></a>
    <a href="post-image.php?filter=hat"><img class="filter" id="hat" src="filter/hat.png" alt="hat filter"></a>
    <a href="post-image.php?filter=cap"><img class="filter" id="cap" src="filter/cap.png" alt="cap filter"></a>
</div>

<div id="show-feed1">
    <h2>Last Images Updated</h2>
    <?php
    require 'includes/dbh.inc.php';
    $user = $_SESSION['userId'];
    $sql = "SELECT * FROM userphotos WHERE idUsers= $user order by dates DESC";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();
    foreach ($row as $key => $value) {
      ?> <div>
            <img src="<?php echo $value['photo']; ?>" alt="">
        </div>
    <?php
    }
    ?>
</div>
<?php 
} else {
    header ('Location: login.php');
}
    ?>
<?php
    require 'footer.php';
?>