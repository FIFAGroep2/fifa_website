<?php
session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <title>Login/Registratie</title>
    </head>
    <body>
        <?php require('templates/header.php'); ?>
        <?php if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) { ?>
        <div id="register">
            <form class="form" action="../app/account_handler.php" method="POST">
                <h1>Registreren</h1>

                <div class="labels">
                    <div class="dnummer">
                        <label for="dnummer">D-nummer:</label>
                        <input type="text" name="username" required>
                    </div>

                    <div class="voornaam">
                        <label for="voornaam">Voornaam:</label>
                        <input type="text" name="fname" required>
                    </div>

                    <div class="achternaam">
                        <label for="achternaam">Achternaam:</label>
                        <input type="text" name="lname" required>
                    </div>

                    <div class="wachtwoord">
                        <label for="wachtwoord">Wachtwoord:</label>
                        <input type="password" name="password" required>
                    </div>
                </div>

                <input class="button" type="submit" name="btnregister" value="Registreren">
            </form>
        </div>


        <div class="container">
            <?php
            if(isset($_GET['message'])){
                echo '<h3>' . $_GET['message'] . '</h3>';
            }
            ?>
            <div id="login">
                <form class="form" action="../app/account_handler.php" method="POST">
                    <h1>Login</h1>

                    <div class="dnummer">
                        <label for="dnummer">D-nummer:</label>
                        <input type="text" name="username" required>
                    </div>

                    <div class="wachtwoord">
                        <label for="wachtwoord">Wachtwoord:</label>
                        <input type="password" name="password" required>
                    </div>

                    <input class="button" type="submit" name="btnlogin" value="Inloggen">
                </form>
            </div>
            <?php
            if(isset($_GET['loginmessage'])){
                echo '<h3>' . $_GET['loginmessage'] . '</h3>';
            }
            ?>
        </div>
        <?php
        } else {
            header('location: index.php');
            exit;
        }
        ?>
    </body>
</html>