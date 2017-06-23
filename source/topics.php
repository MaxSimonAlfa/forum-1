<?php
    session_start();
    error_reporting(0);
    include "includes/oop.php";

    $topics = New forum;
    $loggedin = $topics->isLoggedIn($_SESSION["isLoggedIn"]);
    $topic = $topics->showTopic();
    $admin = $topics->adminCheck();
    if (isset($_POST['logOut'])) {
        session_destroy();
        header ('Location: index.php');
    }
    if (isset($_POST['send'])) {
        $data = $topics->login($_POST['username'], $_POST['password']);
        if ($data == true) {
            header('Location: checkdescription.php');
        } else {
            echo "De gegevens zijn fout";
        }
    }
    if (isset($_POST['versturen'])) {
        $data = $topics->placeTopic($_POST['content'], $_POST['name']);
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
      }?>
      </div>
    </nav>

    <div class="container">
      <!-- Example row of columns -->
      <div>
        <?php foreach($topic as $topic):?>
        <div >
          <h2><?php echo $topic['name']; ?></h2>
          <p><?php echo $topic['description']; ?> </p>
          <p><a class="btn btn-default" href="topic.php?id=<?php echo $topic['id']; ?>" role="button">Naar de topic &raquo;</a></p>
        </div>
        <hr>
        <?php endforeach; ?>
        <?php
            if ($admin == 1) {
                echo '<form class="" action="" method="post">
                    <input type="text" name="name" value="s">
                    <br /><textarea name="content" rows="8" cols="80"></textarea>
                    <br /><input type="submit" name="versturen" value="versturen">
                </form>';
            } else  {
                echo "je bent geen admin dus je kunt geen topics aanmaken";
            }
         ?>
         <hr>
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
