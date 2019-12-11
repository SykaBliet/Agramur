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
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $statment = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($statment, $sql)) {
            header("Location : ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($statment);
            $result = mysqli_stmt_get_result($statment);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']); //return 0 ou 1 //voir si le meme password pour login.
                if ($pwdCheck == false) {
                    header("Location : ../index.php?error=WrongPassword");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    session_start();    
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    
                    header("Location : ../index.php?login=success");
                    exit();
                }
            }
            else {
                header("Location : ../index.php?error=noUser");
                exit();
            }
        }

    }
}
else {
    header("Location: ../index.php");
    exit();
}