<?php
require 'connect.php';
session_start();

if (isset($_POST['submit-score'])) {
    $match_id = $_POST['match_id'];
    $player_score_a = $_SESSION['player-score-a'];
    $player_score_b = $_SESSION['player-score-b'];
        $team_id = $_SESSION['team_id'];
        try{
            $sql_update = "UPDATE `tbl_matches` SET `score_team_a` = :player_score_a, `score_team_b` = :player_score_b WHERE `id` = :team_id";
            $stmt = $server->prepare($sql_update);
            $stmt->bindParam(':team_id', $team_id);
            $stmt->bindParam(':player_score_a', $player_score_a);
            $stmt->bindParam(':player_score_b', $player_score_b);
            $stmt->execute();
            $count = $stmt->rowCount();
            header("location: ../public/invoer_resultaten.php?message=Scores succesvol ingevoerd!");
        }catch (PDOException $exception){
            header("location: ../public/invoer_resultaten.php?message=Er is iets fout gegaan! Probeer opnieuw.");
    }
}

if (isset($_POST['teams'])) {
    header("location: ../public/invoer_resultaten.php?team_a=$team_a&team_b=$team_b");
}

if (isset($_POST['player-sum_a'])) {
    $selected_player_a = $_POST['player_list_a'];
    $_SESSION['player-score-a'] ++;
    header("location: ../public/invoer_resultaten.php?player_a=" . $selected_player_a);
}

if (isset($_POST['player-sum_b'])) {
    $selected_player_b = $_POST['player_list_b'];
    $_SESSION['player-score-b'] ++;
    header("location: ../public/invoer_resultaten.php?player_b=" . $selected_player_b);
}

if (isset($_POST['player-sum_reset'])) {
    $_SESSION['player-score-a'] = 0;
    $_SESSION['player-score-b'] = 0;
    header("location: ../public/invoer_resultaten.php");
}
