<?php

//protection contre l'acces direct au signup

if (isset($_POST['signup-submit'])) {
    
    //run connection au database

    require 'dbh.inc.php';

    //fetch info quand user s'inscrit

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // error handlers

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^$[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduidmail=");
        exit();
    }
    //fonction si email valide
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    //un bon username
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    // check si password match passwordRepeat
    elseif ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheckfail&uid=".$username."&mail".$email);
        exit();
    }
    //check si username exist deja et protection avec "prepare statement avec placeholders -> '?'
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $statment = mysqli_stmt_init($connection); //
        if (!mysqli_stmt_prepare($statment, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statment, "s", $username);
            mysqli_stmt_execute($statment);
            mysqli_stmt_store_result($statment);
            $resultCheck = mysqli_stmt_num_rows($statment);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else { //Insertion des infos tapper dans mysql
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $statment = mysqli_stmt_init($connection); //
                if (!mysqli_stmt_prepare($statment, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    //cryptage du pwd en "hashing" avec Becrypt
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    
                    mysqli_stmt_bind_param($statment, "sss", $username, $email, $hashedPwd); //prendre info du user 
                    mysqli_stmt_execute($statment);
                    // mysqli_stmt_store_result($statment);

                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($statment);
    mysqli_close($connection);
}
else {
    header("Location: ../signup.php");
    exit();
}