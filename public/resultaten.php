<?php
session_start();
require ('../app/connect.php');

$select_teams= $server->prepare('SELECT * FROM `tbl_matches`');
$select_teams->execute();
$results = $select_teams->fetchAll();

?>
<!doctype html>
<html lang="en" class="dashboard">
<head>
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Resultaten</title>
</head>
<body>
<?php require('templates/header.php'); ?>
<div class="main">
    <div class="header">
        <div class="header-border-result">
            <h2>FIFA Dev Edition</h2>
            <h3>Resultaten</h3>
        </div>
    </div>

    <div class="team-time">
        <div class="team-roster">
            <div class="left-row">
                <?php
                foreach ($results as $team1){
                    $teamid = $team1['team_id_a'];
                    $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                    $teamname->execute();
                    $name = $teamname->fetch();
                    echo '<h4>' . $name['name'] . '</h4>';
                }
                ?>
            </div>

            <div class="middle-row">
                <?php foreach ($results as $team){
                    echo '<h4>' . $team['score_team_a'] . '-' . $team['score_team_b'] .  '</h4>';
                }
                ?>
            </div>

            <div class="right-row">
                <?php foreach ($results as $team2){
                    $teamid = $team2['team_id_b'];
                    $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                    $teamname->execute();
                    $name = $teamname->fetch(PDO::FETCH_ASSOC);
                    echo '<h4>' . $name['name'] . '</h4>';
                }
                ?>
            </div>
        </div>

        <div class="time-scheme">
            <h3>Tijd schema</h3>

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
        </div>
    </div>
</div>
<?php require('templates/footer.php'); ?>
</body>
</html>