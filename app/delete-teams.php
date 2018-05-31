<?php
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
    require('connect.php');

    $team_id = $_GET['id'];

    $delete = $server->prepare("DELETE FROM `tbl_teams` WHERE `id` = '$team_id'");
    $delete->execute();

    header('location: ../public/create_team.php?message=Team deleted!');
    exit;
} else {
    header('location: ../public/index.php');
    exit;
}
?>