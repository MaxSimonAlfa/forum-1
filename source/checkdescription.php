<?php
    session_start();
    include "includes/oop.php";
    $checkDescription = New forum;
    $checkDescription->checkDescription();
    $loggedin = $profile->isLoggedIn($_SESSION["isLoggedIn"]);
?>
