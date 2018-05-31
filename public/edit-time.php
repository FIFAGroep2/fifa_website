<?php
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
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
        <h2>FIFA Dev Edition</h2>
        <h3>Resultaten</h3>
    </div>

    <div class="team-time">
        <div class="time-scheme">
            <form action="../app/update-time.php" method="POST">
            <h3>Tijd Regeling</h3>

            <div class="scheme">
                <div class="left-row-time">
                    <h3>Team</h3>
                    <?php
                    $count = 1;
                    foreach ($results as $team){
                        $teamid = $team['team_id_a'];
                        $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                        $teamname->execute();
                        $name = $teamname->fetch(PDO::FETCH_ASSOC);
                        $name = $name['name'];
                        echo "<input type='text' class='team-input' id='teama$count' name='teama$count' value='$name' readonly>";
                        $count++;
                    }
                    ?>
                </div>

                <div class="middle-row-time">
                    <h3>Team</h3>
                    <?php
                    $count = 1;
                    foreach ($results as $team){
                        $teamid = $team['team_id_b'];
                        $teamname = $server->prepare("SELECT `name` FROM `tbl_teams` WHERE `id` = '$teamid'");
                        $teamname->execute();
                        $name = $teamname->fetch(PDO::FETCH_ASSOC);
                        $name = $name['name'];
                        echo "<input type='text' class='team-input' id='teama$count' name='teamb$count' value='$name' readonly>";
                        $count++;
                    }
                    ?>
                </div>

                <div class="right-row-time">
                    <h3 class="time">Tijd</h3>

                    <?php
                    $count = 1;
                    foreach ($results as $time){
                        $time = $time['start_time'];
                        echo "<div>";
                        echo "<input type='text' class='input-time' name='input-time$count' id='input-time$count' value='$time'>";
                        echo "</div>";
                        $count++;
                    }
                    ?>
                    <input type='submit' id='submit-input-time submit$count' name='submit-input-time submit$count' class='input-button' value='Update Tijd'>
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
