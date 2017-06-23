<?php
//verbinden met de databse:
$dbHost = "localhost";
$database = "alfa";
$user = "thomas2";
$wachtwoord = "jan";
try {
    $con = new PDO("mysql:host=$dbHost;dbname=$database", $user, $wachtwoord);
    $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $message = $e ->getMessage();
    echo $message;
}
 ?>
