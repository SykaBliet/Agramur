<?php
ini_set('display_errors', 1);
$localhost = 'http://localhost';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//protection contre l'acces direct au signup
if (isset($_POST['reset-submit'])) { 
    //run connection au database
    require 'includes/dbh.inc.php';
    //fetch info quand user s'inscrit
    $email = $_POST['mail'];
    // error handlers
    if (empty($email)) {
        header("Location: forgotPassword.php?error=emptyfield&mail=empty");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: forgotPassword.php?error=invalidmail");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE emailUsers='" . $email . "'";
        $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
        $row = $stmt->fetch();
        if ($row > 0) {
            header("Location: forgotPassword.php?error=emailtaken&email=".$email);
            exit();
        }   
        else {
            //Insertion des infos tapper dans mysql
            $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, token) VALUES (?, ?, ?, ?)"; 
            //cryptage du pwd en "hashing" avec Becrypt
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $token = md5(uniqid(rand(), true));
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $hashedPwd);
            $stmt->bindValue(4, $token);
            $stmt->execute();

            include_once 'PHPMailer/PHPMailer.php';
            include_once 'PHPMailer/SMTP.php';
            include_once 'PHPMailer/Exception.php';

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();            // Send using SMTP
            $mail->Host       = 'in-v3.mailjet.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;   // Enable SMTP authentication
            $mail->Username   = '8ae5af56a2cc2bcf242e12d516cd8a4d';     // SMTP username
            $mail->Password   = '7b6e978de69d0d474870b8c3acf41519';     // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('aurele.guitard@gmail.com', 'CACA');
            $mail->addAddress('aurele.guitard@gmail.com');     // Add a recipient
            // Content
            $mail->isHTML(true);                               // Set email format to HTML
            $mail->Subject = 'Verify Email';
            $mail->Body    = '<a href="'. $localhost .'/Agramur/confirm.php?token='. $token .'&email='. $email .'">VERIFY MY EMAIL ADRESSE</a>';
            $mail->send();
            //sendVerification($email, $token, $mail);
            header("Location: forgotPassword.php");
            exit();
        }
    }
}
else {
    header("Location: forgotPassword.php");
    exit();
}