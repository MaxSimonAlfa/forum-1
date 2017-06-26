<?php
    error_reporting(0);
    session_start();
    include "includes/oop.php";
    $login = New forum;
    $loggedin = $login->isLoggedIn($_SESSION["isLoggedIn"]);

    $topics = $login->showIndexTopic();
    if (isset($_POST['send'])) {
        $data = $login->login($_POST['username'], $_POST['password']);
        if ($data == true) {
            header('Location: checkdescription.php');
        } else {
            echo "De gegevens zijn fout";
        }
    }
    $loggedin = $login->isLoggedIn($_SESSION["isLoggedIn"]);
    if (isset($_POST['logOut'])) {
        session_destroy();
        header ('Location: index.php');
    }
    $adminCheck = $login->adminCheck();


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
          <a class="navbar-brand" href="#">Computer Forum</a>
        </div>
        <?php if ($loggedin == true) {
            echo '<div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" method="post" style="color:white;">
                        <input type="submit" name="logOut" value="log uit" class="btn btn-success">
                    </form>
               </div>
          </div>';
      } elseif ($loggedin == false) {
          echo '<div id="navbar" class="navbar-collapse collapse">
                  <form class="navbar-form navbar-right" method="post" style="color:white;">
                      gebruikersnaam <input type="text" name="username" class="form-control">
                     wachtwoord <input type="password" name="password" class="form-control">
                      <input type="submit" name="send" value="send" class="btn btn-success">
                  </form>
             </div>
        </div>';
      }?>

    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Welkom</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <?php if ($loggedin == false) {
            echo '<p><a class="btn btn-primary btn-lg" href="register.php" role="button">registreer jezelf &raquo;</a></p>';
        } if ($loggedin == true) {
            echo '<p><a class="btn btn-primary btn-lg" href="profile.php" role="button">naar je profile &raquo;</a></p>';
            if ($adminCheck['admin'] == 1) {
                echo '<p><a class="btn btn-primary btn-lg" href="adminpannel.php" role="button">naar het adminpannel &raquo;</a></p>';
            }
        } ?>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?php foreach($topics as $topic):?>
        <div class="col-md-4">
          <h2><?php echo $topic['name']; ?></h2>
          <p><?php echo $topic['description']; ?> </p>
          <p><a class="btn btn-default" href="topic.php?id=" role="button">Naar de topic &raquo;</a></p>
        </div>
        <?php endforeach; ?>

      </div>
      <p><a class="btn btn-primary btn-lg" href="topics.php" role="button">alle topics &raquo;</a></p>
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
