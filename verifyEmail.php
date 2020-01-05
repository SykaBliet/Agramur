<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<?php
if ($_GET['error'] == 'invalid') {
?>
    <p>WRONG LINK</p>
<?php
}
else {
?>
    <p>CHECK YOUR EMAIL TO VERIFY ACCOUNT</p>
    <a style="color:black;" href="login.php">Email verified click here to login to your profile!</a>'
    <a style="color:black;" href="">Didnt recieve verification email</a>'

</body>
<?php
}
?>
