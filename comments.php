<?php 
    ini_set('display_errors', 1);
    $localhost = 'http://localhost';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'includes/dbh.inc.php';
    $id= $_POST['idUsers'];
    $username= $_POST['uidUsers'];
    $photo= $_POST['photo'];
    $comment= $_POST['comment'];

    if(!(empty($comment))) {//meilleure verif cas mettre un espace 
    $sql = "INSERT INTO comments (idUsers, uidUsers, photo, comment) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->bindValue(2, $username);
    $stmt->bindValue(3, $photo);
    $stmt->bindValue(4, $comment);
    $stmt->execute();

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->SMTPDebug  = 1;                      // Enable verbose debug output
    $mail->isSMTP();       
    $mail->Mailer     = "smtp";                                     // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'camagru.projet@gmail.com';                     // SMTP username
    $mail->Password   = 'aurele123';                               // SMTP password
    $mail->SMTPSecure = "tls";        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('camagru.projet@gmail.com', 'Camagru Team');
    $mail->addAddress($email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Comment Notification';
    $mail->Body    = '';

    $mail->send();

    header("Location: ../verifyEmail.php");
    exit();
    }

    

    header("Location: home.php");
    //envoi mail de notification

?>