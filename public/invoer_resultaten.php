<?php
session_start();
if((isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) && (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
|| (isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'])) {

if((!isset($_SESSION['player-score-a']) && !isset($_SESSION['player-score-b'])) || (empty($_SESSION['player-score-a']) && empty($_SESSION['player-score-b']))) {
    $_SESSION['player-score-a'] = 0;
    $_SESSION['player-score-b'] = 0;
} elseif(!isset($_SESSION['player-score-a']) || empty($_SESSION['player-score-a'])){
    $_SESSION['player-score-a'] = 0;
} elseif(!isset($_SESSION['player-score-b']) || empty($_SESSION['player-score-b'])){
    $_SESSION['player-score-b'] = 0;
}
require ('../app/connect.php');

global $selected_team_a;
global $selected_team_b;
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

$sql = $server->prepare("SELECT tm.id AS id, t1.name AS team_a,t2.name AS team_b,tm.score_team_a, tm.score_team_b FROM tbl_matches tm
INNER JOIN tbl_teams t1 ON tm.team_id_a = t1.id
INNER JOIN tbl_teams t2 ON tm.team_id_b = t2.id");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

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
                    <?php
                    if(isset($_GET['message'])){
                        echo '<h3>' . $_GET['message'] . '</h3>';
                    }
                    ?>
                    <form action="../app/input-result.php" method="POST">
                        <div class="invoer-team-selecteren">
                            <div class="invoer-team-left">
                                <select name="team_list_a" id="team_list_a">
                                    <option value="0"> -- Selecteer teams -- </option>
                                    <?php
                                        foreach ($result as $team){
                                            if(isset($_GET['teams']) && !empty($_GET['teams'])) {
                                                if($_GET['teams'] == $team['id']) {
                                                    echo '<option value="' . $team['id'] . '"  selected="selected">' . $team['team_a'] . ' - ' . $team['team_b'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $team['id'] . '">' . $team['team_a'] . ' - ' . $team['team_b'] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="' . $team['id'] . '">' . $team['team_a'] . ' - ' . $team['team_b'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="resultaten-block">
                            <div class="resultaten-block-left">
                                <?php
                                    echo '<h2>' . $_SESSION['player-score-a'] . '</h2>';
                                ?>
                            </div>

                            <div class="resultaten-block-right">
                                <?php
                                    echo '<h2>' . $_SESSION['player-score-b'] . '</h2>';
                                ?>
                            </div>
                        </div>

                        <div class="invoer-scoorer">
                            <div class="invoer-scoorer-left">
                                <select name="player_list_a" id="player_list_a">
                                    <option value="0"> -- Selecteer speler -- </option>
                                    <?php
                                        foreach ($players as $player){
                                            if (isset($_GET['player_a']) && $_GET['player_a'] == $player['id'] ) {
                                                echo '<option value="' . $player['id'] . '" selected>' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $player['id'] . '">' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>

                                <div class="add-player-count-btn">
                                    <input class="btn" type="submit" id="player-sum_a" name="player-sum_a" value="toevoegen">
                                </div>
                            </div>

                            <div class="invoer-scoorer-right">
                                <select name="player_list_b" id="player_list_b">
                                    <option value="0"> -- Selecteer speler -- </option>
                                    <?php
                                        foreach ($players as $player){
                                            if (isset($_GET['player_b']) && $_GET['player_b'] == $player['id'] ) {
                                                echo '<option value="' . $player['id'] . '" selected>' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $player['id'] . '">' . $player['first_name'] . ' ' . $player['last_name'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>

                                <div class="add-player-count-btn">
                                    <input class="btn" type="submit" id="player-sum_b" name="player-sum_b" value="toevoegen">
                                </div>
                            </div>
                        </div>

                        <div class="reset-player-count-btn">
                            <input class ="btn" type="submit" id="player-sum_reset" name="player-sum_reset" value="reset">
                        </div>

                        <div class="invoer-submit">
                            <input class="btn" type="submit" id="submit-score" name="submit-score" value="versturen">
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
    <?php
} else {
    header('location: index.php');
    exit;
}
    ?>