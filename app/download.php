<?php
$file_url = '../files/Fifa_v2.rar';
if (file_exists($file_url) && is_readable($file_url)) {
    $size = filesize($file_url);
    header('Content-Type: application/x-rar-compressed, application/octet-stream');
    header('Content-Length: ' . $size);
    header('Content-Transfer-Encoding: binary');
    header("Content-disposition: attachment; filename=" . basename($file_url));
    readfile($file_url);
    exit;
} else {
    header('location: ../public/index.php?message=Bestand niet gevonden!');
}
?>