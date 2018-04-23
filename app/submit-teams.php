<?php
require ('connect.php');
session_start();

header('Content-Type: text/html; charset=ISO-8859-1');

$team_name_input = $_POST['input-team-name'];
$player_option = $_POST['player-option'];

if (isset($_POST['submit-input-team'])){
    if (empty(trim($team_name_input))){
        header('location: ../public/create_team.php?message=Voer het team naam in!');
    }

    if(!empty(trim($team_name_input))){
        if (empty($player_option)){
            header('location: ../public/create_team.php?message=Selecteer a.u.b. minimaal 6 spelers!');
        }

        if (!empty($player_option)){
            header('location: ../public/create_team.php?message=Succesvol gerigistreerd!');
        }
    }

//    if (!isset($_POST['player-option'])){
//        header('location: ../public/create_team.php?message=Team succesvol toegevoegd!');
//    }
}