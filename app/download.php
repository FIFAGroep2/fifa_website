<?php
$file_url = '../files/README.txt';
header('Content-Type: text/plain');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=" . basename($file_url));
readfile($file_url);
exit;
?>