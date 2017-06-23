<?php
    if (isset($_POST["cookies"])) {
        setcookie("accepted", "Je moeeder", time() + (86400 * 365), "/");
        header("Location: index.php");
    }


?>

<img src="img/CookieMonster.jpg" />
<h1>Ey swa beter ga je akkoord met die cookies of ik klap door de vlakte en je komt niet op de website ah mattie</h1>

<form method="post">
    <input type="submit" name="cookies" value="accepteer koekje" />
</form>
