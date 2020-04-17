<!-- database handler -->
<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db";
//connection de database
$pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);