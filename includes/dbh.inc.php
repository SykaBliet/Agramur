<!-- database handler -->

<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "loginsystem";
//connection de database
$connection = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
//si connection fail renvoi le msg d'erreur avec l'erreur rendu par la dB
    if (!$connection)
    {
        die("Connection failed: ".mysqli_connect_error());
    }