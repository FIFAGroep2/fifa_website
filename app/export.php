<?php
session_start();
require ('../app/connect.php');

$sql = $server->prepare('SELECT team_id_a, team_id_b, score_team_a, score_team_b FROM tbl_matches');
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

$filename = 'Matches.csv';

$file = fopen($filename, 'w');
fputcsv($file, array('team_a', 'team_b', 'score_team_a', 'score_team_b'));

foreach ($result as $fields) {
    fputcsv($file, $fields);
}



fclose($file);

header("Content-disposition: attachment;filename=$filename");
readfile($filename);
?>
