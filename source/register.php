<?php
    session_start();
    include "includes/oop.php";
    $register = New forum;

    if (isset($_POST['register'])) {
        $check = $register->passwordCheck($_POST['password']);
        if ($_POST['password'] == $_POST['password2'] && $_POST['email'] == $_POST['email2'] && $check == true) {
            $data = $register->register($_POST['username'], $_POST['password'], $_POST['email']);
            if ($data == true) {
                header('Location: index.php');
                echo "je bent geregistreerd";
            } elseif ($data == false) {
                print_r($_SESSION['errorMessage']);
            }
        } if ($check == false) {
            echo "je wachtwoord is te zwak";
        }
        else {
            echo "je wachtwoord of email is niet gelijk";
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
        <br>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <hr>
        <form method="post" class="">
          <br />je username <input type="text" name="username" class="form-control">
          <br />je wachtwoord (tussen de 8 en 20 tekens en minimaal een nummer, letter, caps en symbool) <input type="password" name="password" class="form-control">
          <br />voer je wachtwoord nog een keer in <input type="password" name="password2" class="form-control">
          <br />je email adres <input type="text" name="email" class="form-control">
          <br />voer je email adres nog een keer in <input type="text" name="email2" class="form-control">
          <br /><input type="submit" name="register" class="btn btn-success">
        </form>
        <hr>
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















<!-- <?php
    // session_start();
    // include "includes/oop.php";
    //
    //
    //
    // $register = New forum;
    //
    // if (isset($_POST['register'])) {
    //     $data = $register->register($_POST['username'], $_POST['password'], $_POST['email']);
    //     if ($data == true) {
    //         header('Location: index.php');
    //         echo "je bent geregistreerd";
    //     } elseif ($data == false) {
    //         print_r($_SESSION['errorMessage']);
    //     }
    //
    // }
 ?> -->

<!-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>registerForm</title>
    </head>
    <body>
        <form class="" method="post">
            <br />je username <input type="text" name="username">
            <br />je wachtwoord <input type="password" name="password">
            <br />je email adres <input type="text" name="email">
            <br /><input type="submit" name="register">
        </form>
    </body>
</html> -->
