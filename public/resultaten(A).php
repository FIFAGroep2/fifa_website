<?php
session_start();
require ('../app/connect.php');

$select_teams= $server->prepare('SELECT * FROM `tbl_teams`');
$select_teams->execute();
$results = $select_teams->fetchAll();

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
    <title>Resultaten</title>
</head>
<body>
<?php require('templates/header.php'); ?>
<div class="main">
    <div class="header">
        <h2>FIFA Dev Edition</h2>
        <h3>Resultaten</h3>
    </div>

    <div class="team-time">
        <div class="team-roster">
            <div class="left-row">
                <?php
                foreach ($results as $team){
                    echo '<h4>' . $team['name'] . '</h4>';
                }
                ?>
            </div>

            <div class="middle-row">
                <?php foreach ($results as $team){
                    echo '<h4>' . $team['score'] . '-' . $team['score'] .  '</h4>';
                }
                ?>
            </div>

            <div class="right-row">
                <?php foreach ($results as $team){
                    echo '<h4>' . $team['name'] . '</h4>';
                }
                ?>
            </div>
        </div>

        <div class="time-scheme">
            <h3>Tijd Regeling</h3>

            <div class="scheme">
                <div class="left-row-time">
                    <h3>Team</h3>
                    <?php foreach ($results as $team){
                        echo '<p>' . $team['name'] . '</p>';
                    }
                    ?>
                </div>

                <div class="middle-row-time">
                    <h3>Team</h3>
                    <?php foreach ($results as $team){
                        echo '<p>' . $team['name'] . '</p>';
                    }
                    ?>
                </div>

                <div class="right-row-time">
                    <h3>Tijd</h3>
                    <p>10:00</p>
                    <p>10:15</p>
                    <p>10:30</p>
                    <p>10:45</p>
                    <p>11:00</p>
                </div>

                <form action="../app/edit-time.php" method="POST">
                    <input type="submit" id="submit-change-time" name="submit-change-time" class="change-time" value="Bewerk Tijd">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('templates/footer.php'); ?>
</body>
</html>