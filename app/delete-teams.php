<?php
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
    require('connect.php');

    if(isset($_GET['id'])) {
        $team_id = $_GET['id'];
    } else {
        header('location: ../public/create_team.php?message=Er is iets fout gegaan! Probeer het opnieuw!');
        exit;
    }

    try {
        $delete = $server->prepare("DELETE FROM `tbl_teams` WHERE `id` = :id");
        $delete->bindParam(":id", $team_id);
        $delete->execute();
    } catch (PDOException $e){
        header('location: ../public/create_team.php?message=Er is iets fout gegaan! Probeer het opnieuw!');
        exit;
    }

    if($delete->rowCount() > 0) {
        header('location: ../public/create_team.php?message=Team verwijderd!');
        exit;
    }
    else {
        header('location: ../public/create_team.php?message=Er is iets fout gegaan! Probeer het opnieuw!');
        exit;
    }
} else {
    header('location: ../public/index.php');
    exit;
}
?>