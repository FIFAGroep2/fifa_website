<?php
session_start();
require ('../app/connect.php');
header('Content-Type: text/html; charset=ISO-8859-1');

$sql = $server->prepare("SELECT t1.name AS team_a,t2.name AS team_b,tm.score_team_a, tm.score_team_b FROM tbl_matches tm
INNER JOIN tbl_teams t1 ON tm.team_id_a = t1.id
INNER JOIN tbl_teams t2 ON tm.team_id_b = t2.id");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

$count = $sql->rowCount();

?>
<!doctype html>
<html lang="en" class="dashboard">
<head>
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js/dist/jquery.bracket.min.js"></script>

    <link type="text/css" href="../js/jquery-ui.min.css">
    <link type="text/css" href="../js/jquery-ui.structure.min.css">
    <link type="text/css" href="../js/jquery-ui.theme.min.css">
    <link type="text/css" href="../js/dist/jquery.bracket.min.css" rel="stylesheet">

    <title>Finales</title>
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
                <div id="autoComplete">
                    <div class="bracket-box">
                        <script>
                            var autoCompleteData = {
                                teams: [
                                    <?php
                                        foreach ($result as $team){
                                            echo ' ["'. $team['team_a'] .'", "'. $team['team_b'] .'"],';
                                        }
                                    ?>
                                ],

                                results: [
                                    <?php
                                        foreach ($result as $team){
                                            echo '['.$team['score_team_a']. ',' . $team['score_team_b'].'],';
                                        }
                                    ?>
                                ]
                            };

                            /* If you call doneCb([value], true), the next edit will be automatically
                               activated. This works only in the first round. */

                            function acEditFn(container, data, doneCb) {
                                var input = $('<input type="text" >');
                                input.val(data);
                                input.blur(function() { doneCb(input.val()) });
                                input.keyup(function(e) { if ((e.keyCode||e.which)===13) input.blur() });
                                container.html(input);
                                input.focus()
                            }

                            function acRenderFn(container, data, score, state) {
                                switch(state) {
                                    case 'empty-bye':
                                        container.append('BYE');
                                        return;
                                    case 'empty-tbd':
                                        container.append('TBD');
                                        return;

                                    case 'entry-no-score':
                                    case 'entry-default-win':
                                    case 'entry-complete':
                                        container.append(data);
                                        return;
                                }
                            }

                            $(function() {
                                $('div#autoComplete .bracket-box').bracket({
                                    init: autoCompleteData,
                                    save: function(){}, /* without save() labels are disabled */
                                    decorator: {
                                        edit: acEditFn,
                                        render: acRenderFn
                                    }})
                            });


                            $(function() {
                                $('div#connectorStyles .bracket-box').bracket({
                                    centerConnectors: true,
                                    disableHighlight: true,
                                    init: autoCompleteData
                                })
                            });

                            $('.bracket-box').bracket({
                                init: autoCompleteData
                            });
                        </script>
                    </div>
                </div>
                <a href="javascript:console.log($('div#autoComplete .bracket-box').bracket('data'));">Show log</a>

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