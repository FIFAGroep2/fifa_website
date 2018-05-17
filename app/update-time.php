<?php

session_start();
require ('../app/connect.php');

if(!isset($_POST['input-time']) || empty($_POST['input-time'])){
    header('Location: ../public/edit-time.php?message=Er is geen tijd ingevoerd!');
    exit;
}

$time = $_POST['input-time'];
$teama = $_POST['teama'];
$teamb = $_POST['teamb'];

$teamida = $server->prepare("SELECT `id` FROM `tbl_teams` WHERE `name` = '$teama'");
$teamida->execute();
$teamida = $teamida->fetch(PDO::FETCH_ASSOC);
$teama = $teamida['id'];

$teamidb = $server->prepare("SELECT `id` FROM `tbl_teams` WHERE `name` = '$teamb'");
$teamidb->execute();
$teamidb = $teamidb->fetch(PDO::FETCH_ASSOC);
$teamb = $teamidb['id'];

$time = $server->prepare("UPDATE `tbl_matches` SET `start_time` = '$time' WHERE `team_id_a` = '$teama', `team_id_b` = '$teamb'");
$time->execute();
$time = $time->fetchAll();