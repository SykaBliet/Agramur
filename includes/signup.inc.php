<?php

ini_set('display_errors', 1);
$localhost = 'http://localhost:8888';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, token) VALUES (?, ?, ?, ?)";
                $statment = mysqli_stmt_init($connection); //
                if (!mysqli_stmt_prepare($statment, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    //cryptage du pwd en "hashing" avec Becrypt
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $token = md5(uniqid(rand(), true));
                    
                    mysqli_stmt_bind_param($statment, "ssss", $username, $email, $hashedPwd, $token); //prendre info du user 
                    mysqli_stmt_execute($statment);
                    // mysqli_stmt_store_result($statment);

                                        
                    include_once 'PHPMailer/PHPMailer.php';
                    include_once 'PHPMailer/SMTP.php';
                    include_once 'PHPMailer/Exception.php';

                    $mail = new PHPMailer(true);
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'in-v3.mailjet.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = '8ae5af56a2cc2bcf242e12d516cd8a4d';                     // SMTP username
                    $mail->Password   = '7b6e978de69d0d474870b8c3acf41519';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('quentin.guitard@gmail.com', 'CACA');
                    $mail->addAddress('quentin.guitard@gmail.com');     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Verify Email';
                    $mail->Body    = '<a href='". $localhost ."/Agramur-master%202/confirm.php?token=". $token .",email=". $email"'>VERIFY MY EMAIL ADRESSE</a>';

                    $mail->send();

                    //sendVerification($email, $token, $mail);
                    header("Location: ../verifyEmail.php");
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


function sendVerification($email, $token, $mail)
{

}