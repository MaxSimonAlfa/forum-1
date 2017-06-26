<?php
    session_start();
    include "includes/oop.php";
    $makeprofile = New forum;
    if (isset($_POST['send'])) {
        $data = $makeprofile->makeprofile($_POST['description'], $_POST['geslacht'], $_POST['geboorteDatum']);

    }
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
        <br>
    </nav>
    <div class="jumbotron">
      <div class="container">
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
    </div>
</div>
    <div class="container">
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
