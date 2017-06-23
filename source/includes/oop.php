<?php
    /**
     * de class die ik gebruikt heb op mijn hele forum
     */
    class forum
    {
        /**
         * de connectie naar de database gebruiken om in te loggen op de website
         */
        function login($username, $password) {
            include "includes/connection.php";

            $loginQuery = $con->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
            $loginQuery->execute(array($username, sha1($password)));
            $loginData = $loginQuery->fetchAll();

            if (!empty($loginData)) {
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = $username;
                return true;
            } else {
                return false;
            }

        }
        /**
         * een functie om je te regristreren op de website
         */
        function register($username, $password, $email) {
            include "includes/connection.php";
            $hash = md5( rand(0,1000) );
                $usernameCheck = $con->prepare("SELECT id FROM users WHERE username = ?");
                $usernameCheck->execute(array($username));
                $usernameCheckOutput = $usernameCheck->fetchAll();
                $emailCheck = $con->prepare("SELECT id FROM users WHERE email = ?");
                $emailCheck->execute(array($email));
                $emailCheckOutput = $emailCheck->fetchAll();

            if (!empty($usernameCheckOutput) && !empty($emailCheckOutput)) {
                $_SESSION['errorMessage'] = "je gebruikersnaam of wachtwoord is al in gebruik";
                return false;
            } if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errorMessage'] = "dat is geen email adres";
                return false;
            } else {
                $today = date("y:m:d H:i:s");
                $registerQuery = $con->prepare("INSERT INTO users (username, password, email, registerdate, hash) VALUES(?, ?, ?, ?, ?)");
                $registerQuery->execute(array($username, sha1($password), $email, $today, $hash));

                $to      = $email;
                $subject = 'Signup | Verification';
                $message = '

                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                ------------------------
                Username: '.$name.'
                ------------------------

                Please click this link to activate your account:
                http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

                '; // Our message above including the link

                $headers = 'From:noreply@computerforums.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email
                return true;
                }
        }
        /**
         * een functie om te checken of iemand ingelogd is
         */
        function isLoggedIn($loggedIn) {
            if ($loggedIn == true) {
                return true;
            } else {
                return false;
            }

        }
        /**
         * een fucntie die checkt of iemand al een description heeft aangemaakt als hij inlogd
         */
        function checkDescription() {
            include "includes/connection.php";
            $descriptionCheck = $con->prepare("SELECT description FROM users WHERE username = ?");
            $descriptionCheck->execute(array($_SESSION['username']));
            $descriptionCheckOutput = $descriptionCheck->fetchAll();
            if (!empty($descriptionCheckOutput)) {
                header('Location: index.php');
            }   else {
                header('Location: makeprofile.php');
            }
        }
        /**
         * als iemand geen description heeft maakt hij hem hier aan
         */
        function makeprofile($description, $geslacht, $geboortedatum) {
            include "includes/connection.php";
            $registerQuery = $con->prepare("UPDATE Users SET description = ?, geslacht = ?, geboortedatum = ? WHERE username = ?");
            $registerQuery->execute(array($description, $geslacht, $geboortedatum, $_SESSION['username']));
            header('Location: profile.php');
        }
        /**
         * de 3 topics die worden laten zien op de hoofdpagina
         */
        function showIndexTopic() {
            include "includes/connection.php";
            $indexTopics = $con->prepare("SELECT * FROM topics ORDER BY id DESC LIMIT 3");
            $indexTopics->execute();
            $indexTopicsOutput = $indexTopics->fetchAll();
            return $indexTopicsOutput;
        }
        /**
         * alle topics laten zien in topics.php
         */
        function showTopic() {
            include "includes/connection.php";
            $indexTopics = $con->prepare("SELECT * FROM topics ORDER BY id DESC");
            $indexTopics->execute();
            $indexTopicsOutput = $indexTopics->fetchAll();
            return $indexTopicsOutput;
        }
        /**
         * als je op een topic hebt geklickt krijg je via deze functie de topic te zien met daaronder de posts
         */
        function showOneTopic($id) {
            include "includes/connection.php";
            $topic = $con->prepare("SELECT * FROM topics WHERE id = ?");
            $topic->execute(array($id));
            $topicOutput = $topic->fetchAll();
            return $topicOutput;
        }
        /**
         * laat alle posts zien onder een topic
         */
        function showPosts($topicId) {
            include "includes/connection.php";
            $posts = $con->prepare("SELECT * FROM posts WHERE topic_id = ? ORDER BY id DESC ");
            $posts->execute(array($topicId));
            $postsOutput = $posts->fetchAll();
            return $postsOutput;
        }
        /**
         * laat een post zien in post.php met daaronder de reacties
         */
        function showOnePost($id) {
            include "includes/connection.php";
            $posts = $con->prepare("SELECT * FROM posts WHERE id = ? ");
            $posts->execute(array($id));
            $postsOutput = $posts->fetchAll();
            return $postsOutput;
        }
        /**
         * laat de reacties zien onder de post
         */
        function showReactions($postId) {
            include "includes/connection.php";
            $reaction = $con->prepare("SELECT * FROM replies WHERE post_id = ? ORDER BY id DESC ");
            $reaction->execute(array($postId));
            $reactionOutput = $reaction->fetchAll();
            return $reactionOutput;
        }
        /**
         * hiermee kun je een comment plaatsen onder een post
         */
        function placeComment($content, $name) {
            include "includes/connection.php";
            $date = date("y:m:d H:i:s");
            $placePost = $con->prepare("INSERT INTO replies (content, name, user_name, date, post_id) VALUES(?, ?, ?, ?, ?)");
            $placePost->execute(array($content, $name, $_SESSION['username'], $date, $_GET['id']));
        }
        /**
         * hiermee kun je een post plaatsen onder een topic
         */
        function placePost($content, $name) {
            include "includes/connection.php";
            $date = date("y:m:d H:i:s");
            $placePost = $con->prepare("INSERT INTO posts (content, name, user_name, date, topic_id) VALUES(?, ?, ?, ?, ?)");
            $placePost->execute(array($content, $name, $_SESSION['username'], $date, $_GET['id']));
        }
        /**
         * deze functie laat je profiel zien
         */
        function showProfile() {
            include "includes/connection.php";
            $profile = $con->prepare("SELECT * FROM users WHERE username = ?");
            $profile->execute(array($_SESSION['username']));
            $profileOutput = $profile->fetchAll();
            return $profileOutput;
        }
        /**
         * deze functie checkt of je admin bent
         */
        function adminCheck() {
            include "includes/connection.php";
            $admin = $con->prepare("SELECT admin FROM users WHERE username = ?");
            $admin->execute(array($_SESSION['username']));
            $adminOutput = $admin->fetch();
            return $adminOutput;
        }
        /**
         * deze punctie maakt een nieuw topic aan als je admin bent
         */
        function placeTopic($name, $description) {
            include "includes/connection.php";
            $placePost = $con->prepare("INSERT INTO topics (name, description, username) VALUES(?, ?, ?)");
            $placePost->execute(array($name, $description, $_SESSION['username']));
        }
    }
?>
