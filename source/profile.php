<?php

    session_start();
    include "includes/oop.php";
    $login = New forum;
    $loggedin = $login->isLoggedIn($_SESSION["isLoggedIn"]);

    $topics = $login->showIndexTopic();
    $loggedin = $login->isLoggedIn($_SESSION["isLoggedIn"]);
    if (isset($_POST['logOut'])) {
        session_destroy();
        header ('Location: index.php');
    }
    $profile = $login->showProfile();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Een forum voor het vak php">
    <meta name="author" content="Thomas Steur">
    <link rel="icon" href="favicon.ico">
    <title>Jumbotron Template for Bootstrap</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Computer Forum</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" method="post" style="color:white;">
                        <input type="submit" name="logOut" value="log uit" class="btn btn-success">
                    </form>
               </div>
          </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
          <?php foreach ($profile as $profile):?>
        <h1>Welkom op je profiel <?php echo $profile['username']; ?></h1>
        <h2>Je beschrijving:</h2>
        <h3><?php echo $profile['description']; ?></h3><br>
        <h2>je registratiedatum:</h2><h3><?php echo $profile['registerdate']; ?></h3><br>
        <h2>je geslacht:</h2><h3><?php echo $profile['geslacht']; ?></h3><br>
        <?php endforeach; ?>

      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">

      </div>
      <p><a class="btn btn-primary btn-lg" href="topics.php" role="button">naar alle topics &raquo;</a></p>
      <hr>

      <footer>
        <p>&copy; 2017 Thomas Steur.</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
