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
if (isset($_GET['error']) == 'invalid') {
?>
    <div class="verified-text">
        <p>WRONG LINK</p>
        <a style="color:black;" href="">Something wrong happenend try to signup again and verify your mail for a verification link</a>'
    </div>
<?php
}
else {
    ?>
    <div class="verified-text">
        <p>Please verify your email</p>
        <button class="verified-button" onclick="window.location.href = 'login.php';">Login</button>
    </div>

</body>
<?php
}
?>
