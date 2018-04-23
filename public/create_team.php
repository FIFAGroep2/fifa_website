<?php
require ('../app/connect.php');
session_start();

$teams = $server->prepare("SELECT * FROM `tbl_teams`");
$teams->execute();
$teams = $teams->fetchAll();

$players = $server->prepare("SELECT * FROM `tbl_players`");
$players->execute();
$rows = $players->rowCount();
$players = $players->fetchAll();

$maxPlayers = 8;


header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Team aanmaken</title>
</head>
<body>
    <?php require('templates/header.php'); ?>
    <div class="main">
        <div class="header">
            <div class="header-border">
                <h2>FIFA DEV EDITION</h2>
                <h3>Invoer Teams en Spelers</h3>
            </div>
        </div>

        <div class="content">
            <div class="input-border">
                <h3 class="input-border-txt">Invoer Teams + Spelers</h3>
                <form action="../app/submit-teams.php" method="POST">
                    <div class="input-box">

                        <div class="input-item">
                            <div class="input-team-name">
                                <label for="input-team-name">Team naam:</label>
                                <input type="text" class="input-team-name" name="input-team-name" id="input-team-name">
                            </div>

                            <div class="team-view">
                                <h3>Teams bekijken:</h3>
                                <?php
                                    foreach ($teams as $team){
                                        echo '<p class="team-name">'. $team['name'];
                                        echo '<a href="../app/delete-teams.php?id=' . $team['id'] . '"><i class="fas fa-times"></i></a>';
                                        echo '</p>';
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="input-player">
                            <?php for ($i = 0; $i <= $maxPlayers; $i++):?>
                                <div class="input-player-block">
                                    <label for="<?php echo 'pl' . $rows;?>">Selecteer speler:</label>
                                    <select class="player-option" id="<?php echo 'pl' . $rows;?>" onchange="check()">
                                        <option disabled selected value> -- Selecteer speler -- </option>
                                        <?php
                                            foreach ($players as $player) {
                                                echo '<option value="' . $player['id'] . '">' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            <?php endfor;?>
                        </div>

                        <div class="input-item">
                            <input type="submit" id="submit-input-team" name="submit-input-team" class="input-button" value="Invoer Teams en spelers">
                            <div class="get-message">
                                <?php
                                    if (isset($_GET['message'])){
                                        echo '<h2>';
                                        echo $_GET['message'];
                                        echo '</h2>';
                                    }else{
                                        echo '<p></p>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function check() {
            var d=document;
            var myArray = [];
            for (var h=0; h < <?php echo $rows; ?>; h++) {
                myArray[h] = d.getElementById('pl'+(h+1)).value;
            }
            for (var a=0; a < <?php echo $rows; ?>; a++) {
                for (var b=1; b < 5 ;b++) {
                    d.getElementById('pl'+(a+1)).options[b].style.display = "block";
                    for (var c=0; c < <?php echo $rows; ?>; c++) {
                        if(d.getElementById('pl'+(a+1)).options[b].value === myArray[c]) {
                            d.getElementById('pl'+(a+1)).options[b].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
