<?php
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
    require('../app/connect.php');

    if(isset($_GET['type']) && $_GET['type'] == 'matches') {
        $sql = $server->prepare('SELECT `team_id_a`, `team_id_b`, `score_team_a`, `score_team_b` FROM `tbl_matches`');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $filename = 'Matches.csv';

        $file = fopen($filename, 'w');
        fputcsv($file, array('team_a', 'team_b', 'score_team_a', 'score_team_b'));
    } else if (isset($_GET['type']) && $_GET['type'] == 'teams'){
        $sql = $server->prepare('SELECT `id`, `name` FROM `tbl_teams`');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $filename = 'Teams.csv';

        $file = fopen($filename, 'w');
        fputcsv($file, array('id', 'name'));
    }

    foreach ($result as $fields) {
        fputcsv($file, $fields);
    }
    fclose($file);

    header("Content-disposition: attachment;filename=$filename");
    readfile($filename);
    exit;
} else {
    header('location: ../public/index.php');
    exit;
}
?>
