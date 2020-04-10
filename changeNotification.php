<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
?>
<?php
    if (isset($_SESSION['userId'])){
?>
    <div class="container-login-form">
    <?php 
        $sql = "SELECT getMail FROM users WHERE uidUsers='".$_SESSION['uidUsers']."' ";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        $getMail = $row['getMail'];
    ?>
        <h4 class="title-pass-recovery">
            Would you like to turn <?php if($getMail == 0){echo 'ON';} else{echo 'OFF';} ?> your notification?
        </h4>
        <div id="profil-username">
            <button id="button-changepwd">Yes</button>
            <script>
            var btn = document.getElementById('button-changepwd');
            btn.addEventListener('click', function() {
            document.location.href = 'changeNotification.inc.php';
            });
            </script>
        </div>
    </div>

<?php 
} else {
    Header ('Location: profil.php');
} 
?>

<?php
    require 'footer.php';
?>