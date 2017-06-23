<?php
    session_start();
    include "includes/oop.php";
    $makeprofile = New forum;
    if (isset($_POST['send'])) {
        $data = $makeprofile->makeprofile($_POST['description'], $_POST['geslacht'], $_POST['geboorteDatum']);

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form class="MakeProfile" method="post">
            description: <textarea  name="description"></textarea>
            <br>
            geslacht: <select class="geslacht" name="geslacht">
                <option value="niks"></option>
                <option value="man">man</option>
                <option value="vrouw">vrouw</option>
                <option value="ietsAnders">iets anders</option>
            </select>
            <br>
            geboortedatum: <input type="date" name="geboorteDatum">
            <br>
            <input type="submit" name="send" value="send">
        </form>
    </body>
</html>
