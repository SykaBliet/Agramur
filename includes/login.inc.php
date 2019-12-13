<?php
if (isset($_POST['login-submit'])) {
    
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location : ../index.php?error=emptyfields");
        exit();
    }
    else {//recherche si l'uidUsers ou email est dans la DB
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
        $statment = mysqli_stmt_init($connection); //
        if (!mysqli_stmt_prepare($statment, $sql)) { // run sql string dans DB et check si c'est les memes infos.
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statment, "ss", $mailuid, $mailuid); //pass les param du user qui a essayer de ce connecter dans la DB et voir s'il y a un resultat du $sql
            mysqli_stmt_execute($statment); //execute les param de la DB
            $result = mysqli_stmt_get_result($statment); //voir les resultat du statment
            if ($row = mysqli_fetch_assoc($result)){ //check si on a eu qq chose de la db
                $pwdCheck = password_verify($password, $row['pwdUsers']); //return 0 ou 1 //voir si le
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();    
                    $_SESSION['userId'] = $row['idUsers']; //$_SESSION global d'env.
                    $_SESSION['userUid'] = $row['uidUsers']; // $_SESSION global d'env.
                    
                    header("Location: ../index.php?login=success");
                    exit();
                }
                else { //aucun match
                header("Location: ../index.php?error=wrongpwd");
                exit();
                }
            }
            else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}