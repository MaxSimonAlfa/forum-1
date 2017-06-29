<?php
    error_reporting(0);
    session_start();
    include "includes/oop.php";

    $topics = New forum;
    $loggedin = $topics->isLoggedIn($_SESSION["isLoggedIn"]);
    $posts = $topics->showOnePost($_GET['id']);
    $reaction = $topics->showReactions($_GET['id']);
    if (isset($_POST['versturen'])) {
        $data = $topics->placeComment($_POST['content'], $_POST['name']);
        header("Refresh:0");
    }
    $loggedin = $topics->isLoggedIn($_SESSION["isLoggedIn"]);
    if (isset($_POST['logOut'])) {
        session_destroy();
        header("Refresh:0");
    }
    if (isset($_POST['send'])) {
        $data = $topics->login($_POST['username'], $_POST['password']);
        if ($data == true) {
            header('Location: checkdescription.php');
        } else {
            echo "De gegevens zijn fout";
        }
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
      }?><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container">
      <!-- Example row of columns -->
      <div>
          <div >
          <?php foreach ($posts as $posts):?>
              <h2>post: <?php echo $posts['name']; ?></h2>
              <p><?php echo $posts['content']; ?></p>
              <h6><?php echo $posts['date']; ?></h6>
              <hr>
          <?php endforeach ?>
          <h3>reacties:</h3>
          <hr>
          <?php foreach ($reaction as $reaction):?>
              <h3><?php echo $reaction['name']; ?></h3>
              <p><?php echo $reaction['content']; ?></p>
              <h6><?php echo $reaction['date']; ?></h6>
              <hr>
          <?php endforeach ?>
          <?php
          if ($_SESSION['isLoggedIn'] == true) {
              echo '<form class="" action="" method="post">
                  <input type="text" name="name" value="">
                  <br /><textarea name="content" rows="8" cols="80"></textarea>
                  <br /><input type="submit" name="versturen" value="versturen">
              </form>';
          }
          else {
              echo "";
          }
           ?>
      </div>


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
