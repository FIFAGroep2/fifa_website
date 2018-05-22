<?php
require ('connect.php');
session_start();

$team_id = $_GET['id'];

$delete = $server->prepare("DELETE FROM `tbl_teams` WHERE `id` = '$team_id'");
$delete->execute();

header('location: ../public/create_team.php?message=Team deleted!');