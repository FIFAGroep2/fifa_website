<?php
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) ||
    (isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'])) {
    require('connect.php');

    header('Content-Type: text/html; charset=ISO-8859-1');

    $team_name_input = $_POST['input-team-name'];
    $maxPlayers = $_SESSION['maxPlayers'];

    if (isset($_POST['submit-input-team'])) {
        if (empty(trim($team_name_input))) {
            header('location: ../public/create_team.php?message=Voer het team naam in!');
        }

        if (!empty(trim($team_name_input))) {
            $insert_team = $server->prepare("INSERT INTO `tbl_teams` (`name`) VALUES ('$team_name_input')");
            $insert_team->execute();
        }
        for ($i = 1; $i <= $maxPlayers; $i++) {
            if (!empty($_POST['player_select' . $i]) && $_POST['player_select' . $i] != NULL && $_POST['player_select' . $i] != 0) {
                $playerSelect = $_POST['player_select' . $i];
                $player_option = $playerSelect;
                echo $player_option;
                if (isset($player_option)) {
                    try {
                        $select_team_id = $server->prepare("SELECT `id` FROM `tbl_teams` WHERE `name` = '$team_name_input'");
                        $select_team_id->execute();
                        $team_id = $select_team_id->fetch(PDO::FETCH_ASSOC);
                        $team_id = $team_id['id'];

                        $update_player_team = $server->prepare("UPDATE `tbl_players` SET `team_id`='$team_id' WHERE `id` = '$player_option'");
                        $update_player_team->execute();
                    } catch (PDOException $ex) {
                        header('Location: ../public/create_team.php?message=Er is iets fout gegaan!');
                        exit;
                    }
                }
            }
        }
        header('Location: ../public/create_team.php?message=Succesvol geregistreerd!');
        exit;
    }
} else {
    header('location: ../public/index.php');
    exit;
}