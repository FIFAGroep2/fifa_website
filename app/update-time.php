<?php

session_start();
require ('../app/connect.php');

$matches = $server->prepare("SELECT COUNT(*) FROM `tbl_matches`; ");
$matches->execute();
$count = $matches->fetchColumn();

for($i = 1; $i <= $count; $i++) {
    if (!isset($_POST['input-time' . $i]) || empty($_POST['input-time' . $i])) {

    } else {
        $settime = $_POST['input-time' . $i];
        $teama = $_POST['teama' . $i];
        $teamb = $_POST['teamb' . $i];

        try {
            $teamida = $server->prepare("SELECT `id` FROM `tbl_teams` WHERE `name` = '$teama'");
            $teamida->execute();
            $teamida = $teamida->fetch(PDO::FETCH_ASSOC);
            $teama = $teamida['id'];

            $teamidb = $server->prepare("SELECT `id` FROM `tbl_teams` WHERE `name` = '$teamb'");
            $teamidb->execute();
            $teamidb = $teamidb->fetch(PDO::FETCH_ASSOC);
            $teamb = $teamidb['id'];

            $sametime = $server->prepare("SELECT `start_time` FROM `tbl_matches` WHERE `team_id_a` = '$teama' AND `team_id_b` = '$teamb'");
            $sametime->execute();
            $sametime = $sametime->fetch(PDO::FETCH_ASSOC);
            $time = $sametime['start_time'];

            if ($time != $settime) {
                try {
                    $time = $server->prepare("UPDATE `tbl_matches` SET `start_time` = '$settime' WHERE `team_id_a` = '$teama' AND `team_id_b` = '$teamb'");
                    $time->execute();
                } catch (PDOException $ex) {
                    header('Location: ../public/edit-time.php?message=Er is iets fout gegaan!');
                }
            }
        } catch (PDOException $ex) {
            header('Location: ../public/edit-time.php?message=Er is iets fout gegaan!');
        }
    }
}

?>