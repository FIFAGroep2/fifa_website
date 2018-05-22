<?php
require ('../app/connect.php');
header('Content-Type: text/html; charset=ISO-8859-1');

$select_teams= $server->prepare('SELECT * FROM `tbl_matches`');
$select_teams->execute();
$results = $select_teams->fetchAll();

session_start();
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
    <title>Fifa</title>
</head>
<body>
    <?php require('templates/header.php'); ?>
    <div class="main">
        <div class="header-border">
            <h2>FIFA Dev Edition</h2>
            <h3>FINALES</h3>
        </div>

        <div class="border-finales">
            <div class="main-content">
                <div class="tournament-brackets">
                    <div class="left-bracket">
                        <div class="bracket-box">
                            <?php
                            foreach ($results as $team1){
                                $teamid = $team1['team_id_a'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch();
                                echo '<p class="left-teams-name">' . $name['name'] . '</p>';
                            }
                            ?>
                            <div class="border-line-top">
                                <div class="border-line-right"></div>
                                    <?php
                                    foreach ($results as $team1){
                                        $teamid = $team1['team_id_a'];
                                        $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                        $teamname->execute();
                                        $name = $teamname->fetch();
                                        echo '<p class="left-teams-name-2nd">' . $name['name'] . '</p>';
                                    }
                                    ?>
                            </div>

                            <div class="border-line-bottom">
                                <div class="border-line-right"></div>
                            </div>
                            <?php foreach ($results as $team2){
                                $teamid = $team2['team_id_b'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                echo '<p class="right-teams-name">' . $name['name'] . '</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="middle-bracket">
                        <div class="border-line-middle"></div>
                        <div class="border-line-middle-left"></div>
                        <div class="border-line-middle-right"></div>
                        <div class="bracket-box">
                            <?php
                            foreach ($results as $team1){
                                $teamid = $team1['team_id_a'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch();
                            }
                                echo '<p class="middle-teams-name-left">' . $name['name'] . '</p>';
                            ?>
                            <?php foreach ($results as $team){
                                $teamid = $team['team_id_b'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                            }
                            echo '<p class="middle-teams-name-right">' . $name['name'] . '</p>';
                            ?>
                        </div>
                        <div class="winner-block">

                        </div>
                    </div>

                    <div class="right-bracket">
                        <div class="bracket-box">
                            <?php foreach ($results as $team){
                                $teamid = $team['team_id_a'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                echo '<p class="left-teams-name">' . $name['name'] . '</p>';
                            }
                            ?>
                            <div class="border-line-top">
                                <div class="border-line-left"></div>
                                <?php foreach ($results as $team){
                                    $teamid = $team['team_id_a'];
                                    $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                    $teamname->execute();
                                    $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                    echo '<p class="right-teams-name-2nd">' . $name['name'] . '</p>';
                                }
                                ?>
                            </div>

                            <div class="border-line-bottom">
                                <div class="border-line-left"></div>
                            </div>
                            <?php foreach ($results as $team){
                                $teamid = $team['team_id_b'];
                                $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                                $teamname->execute();
                                $name = $teamname->fetch(PDO::FETCH_ASSOC);
                                echo '<p class="right-teams-name">' . $name['name'] . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>


                <div class="pouleresult-main">
                    <h3 class="word-pouleresult">Pouleresultaten</h3>

                    <div class="poule-names">
                        <h3 class="teams-score">Poule A</h3>
                        <h3 class="teams-score">Poule B</h3>
                    </div>

                    <div class="pouleresults">
                        <div class="teams-left">
                            <h4 class="teams-score">TEAMS</h4>
                            <?php
                            $teams = $server->prepare("SELECT * FROM `tbl_teams` ORDER BY `score` DESC");
                            $teams->execute();
                            $teams = $teams->fetchAll();

                            foreach ($teams as $team){
                                $poule = $team['poule_id'];
                                if ($poule == 1) {
                                    echo '<p class="teamname name">' . $team['name'] . '</p>';
                                }
                            }
                            ?>
                        </div>

                        <div class="score">
                            <h4 class="teams-score">SCORE</h4>
                            <?php
                            $teams = $server->prepare("SELECT * FROM `tbl_teams` ORDER BY `score` DESC");
                            $teams->execute();
                            $teams = $teams->fetchAll();

                            foreach ($teams as $team){
                                $poule = $team['poule_id'];
                                if ($poule == 1) {
                                    echo '<p>' . $team['score'] . '</p>';
                                }
                            }
                            ?>
                        </div>

                        <div class="teams-right">
                            <h4 class="teams-score">TEAMS</h4>
                            <?php
                            $teams = $server->prepare("SELECT * FROM `tbl_teams` ORDER BY `score` DESC");
                            $teams->execute();
                            $teams = $teams->fetchAll();

                            foreach ($teams as $team){
                                $poule = $team['poule_id'];
                                if ($poule == 2) {
                                    echo '<p class="teamname name">' . $team['name'] . '</p>';
                                }
                            }
                            ?>
                        </div>

                        <div class="score">
                            <h4 class="teams-score" >SCORE</h4>
                            <?php
                            $teams = $server->prepare("SELECT * FROM `tbl_teams` ORDER BY `score` DESC");
                            $teams->execute();
                            $teams = $teams->fetchAll();

                            foreach ($teams as $team){
                                $poule = $team['poule_id'];
                                if ($poule == 2) {
                                    echo '<p>' . $team['score'] . '</p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>