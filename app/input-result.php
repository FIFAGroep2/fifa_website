<?php
session_start();
if((isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) && (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
    || (isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'])) {
    require 'connect.php';

    if(isset($_POST['team_list_a'])){
        $team_id = $_POST['team_list_a'];
    }

    if (isset($_POST['submit-score'])) {
        $match_id = $_POST['match_id'];
        $player_score_a = $_SESSION['player-score-a'];
        $player_score_b = $_SESSION['player-score-b'];

            try{
                $sql_update = "UPDATE `tbl_matches` SET `score_team_a` = :player_score_a, `score_team_b` = :player_score_b WHERE `id` = :team_id";
                $stmt = $server->prepare($sql_update);
                $stmt->bindParam(':team_id', $team_id);
                $stmt->bindParam(':player_score_a', $player_score_a);
                $stmt->bindParam(':player_score_b', $player_score_b);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count > 0) {
                    header("location: ../public/invoer_resultaten.php?message=Scores succesvol ingevoerd!");
                } else {
                    header("location: ../public/invoer_resultaten.php?message=Er is iets fout gegaan bij het invoeren van de score! Probeer opnieuw.");
                }
                exit;
            }catch (PDOException $exception){
                header("location: ../public/invoer_resultaten.php?message=Er is iets fout gegaan! Probeer opnieuw.");
                exit;
        }
    }

    if (isset($_POST['teams'])) {
        header("location: ../public/invoer_resultaten.php?team_a=$team_a&team_b=$team_b");
    }

    if (isset($_POST['player-sum_a'])) {
        $selected_player_a = $_POST['player_list_a'];

        $sql_update = "SELECT `score` FROM `tbl_players` WHERE `id` = :playerid";
        $playerscore = $server->prepare($sql_update);
        $playerscore->bindParam(':playerid', $selected_player_a);
        $playerscore->execute();
        $currentscore = $playerscore->fetch(PDO::FETCH_ASSOC);

        $score = $currentscore['score'] + 1;

        $sql_update = "UPDATE `tbl_players` SET `score` = :score WHERE `id` = :playerid";
        $stmt = $server->prepare($sql_update);
        $stmt->bindParam(':playerid', $selected_player_a);
        $stmt->bindParam(':score', $score);
        $stmt->execute();

        $_SESSION['player-score-a']++;
        header("location: ../public/invoer_resultaten.php?player_a=" . $selected_player_a . "&teams=" . $team_id);
        exit;
    }

    if (isset($_POST['player-sum_b'])) {
        $selected_player_b = $_POST['player_list_b'];

        $sql_update = "SELECT `score` FROM `tbl_players` WHERE `id` = :playerid";
        $playerscore = $server->prepare($sql_update);
        $playerscore->bindParam(':playerid', $selected_player_b);
        $playerscore->execute();
        $currentscore = $playerscore->fetch(PDO::FETCH_ASSOC);

        $score = $currentscore['score'] + 1;

        $sql_update = "UPDATE `tbl_players` SET `score` = :score WHERE `id` = :playerid";
        $stmt = $server->prepare($sql_update);
        $stmt->bindParam(':playerid', $selected_player_b);
        $stmt->bindParam(':score', $score);
        $stmt->execute();

        $_SESSION['player-score-b'] ++;
        header("location: ../public/invoer_resultaten.php?player_b=" . $selected_player_b . "&teams=" . $team_id);
        exit;
    }

    if (isset($_POST['player-sum_reset'])) {
        $_SESSION['player-score-a'] = 0;
        $_SESSION['player-score-b'] = 0;
        header("location: ../public/invoer_resultaten.php");
        exit;
    }

} else {
    header('location: index.php');
    exit;
}
    ?>
