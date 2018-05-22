<?php
session_start();

require ('../app/connect.php');


$select_teams= $server->prepare('SELECT * FROM `tbl_matches`');
$select_teams->execute();
$results = $select_teams->fetchAll();

$teams = $server->prepare("SELECT * FROM `tbl_teams`");
$teams->execute();
$teams = $teams->fetchAll();

$players = $server->prepare("SELECT * FROM `tbl_players`");
$players->execute();
$rows = $players->rowCount();
$players = $players->fetchAll();

header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!doctype html>
<html lang="en" class="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Invoer Resultaten</title>
</head>
<body>
    <?php require('templates/header.php'); ?>
    <div class="main">
        <div class="header">
            <div class="header-border-invoer">
                <h2>FIFA Dev Edition</h2>
                <h3>Invoer Resultaten</h3>
            </div>
        </div>

        <div class="team-time">
            <div class="border-invoer">
                <div class="invoer-resultaten">
                    <form action="../app/input-result.php">
                        <div class="invoer-team-selecteren">

                            <select name="team_list" id="team_list">
                                <option disabled selected value="0"> -- Selecteer teams -- </option>
                                <?php
                                foreach ($teams as $team){
                                    echo '<option>'. $team['name'] . '</option>';
                                }
                                ?>
                            </select>

                            <select name="team_list" id="team_list">
                                <option disabled selected value="0"> -- Selecteer teams -- </option>
                                <?php
                                foreach ($teams as $team){
                                    echo '<option>'. $team['name'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>

                        <div class="resultaten-block">
                            <?php
                            $standard = 0;

                            echo '<h2>' . $standard . '</h2>' ;
                            echo '<h2>' . $standard . '</h2>' ;
                            ?>
                        </div>

                        <div class="invoer-scoorer">

                            <div class="invoer-scoorer-left">

                                <select name="player_list" id="player_list">
                                    <option disabled selected value="0"> -- Selecteer speler -- </option>
                                    <?php
                                    foreach ($players as $player){
                                        echo '<option value="' . $player['id'] . '">' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <div class="add-player-count-btn">
                                    <input class="btn" type="submit" id="player-sum" name="player-sum" value="toevoegen">
                                </div>

                            </div>

                            <div class="invoer-scoorer-left">

                                <select name="player_list" id="player_list">
                                    <option disabled selected value="0"> -- Selecteer speler -- </option>
                                    <?php
                                    foreach ($players as $player){
                                        if ($player['team_id'] == NULL){
                                            echo '<option value="' . $player['id'] . '">' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>

                                <div class="add-player-count-btn">
                                    <input class="btn" type="submit" id="player-sum" name="player-sum" value="toevoegen">
                                </div>

                            </div>

                        </div>

                        <div class="invoer-submit">
                            <input  class="btn" type="submit" id="submit-score" name="submit-score" value="versturen">
                        </div>

                    </form>
                </div>

                <div class="time-scheme-input">
                    <h3>Tijd Regeling</h3>

                    <div class="scheme">
                        <div class="left-row-time">
                            <h3>Team</h3>
                            <?php foreach ($results as $team){
                                $teamid = $team['team_id_a'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                echo '<p>' . $name['name'] . '</p>';
                            }
                            ?>
                        </div>

                        <div class="middle-row-time">
                            <h3>Team</h3>
                            <?php foreach ($results as $team){
                                $teamid = $team['team_id_b'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                echo '<p>' . $name['name'] . '</p>';
                            }
                            ?>
                        </div>

                        <div class="right-row-time">
                            <h3>Tijd</h3>
                            <?php foreach ($results as $time){
                                echo '<p>' . $time['start_time'] . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <form action="edit-time.php" method="POST">
                        <input type="submit" id="submit-change-time" name="submit-change-time" class="change-time" value="Bewerk Tijd">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php require('templates/footer.php'); ?>
</body>
</html>