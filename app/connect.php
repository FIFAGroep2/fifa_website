<?php
require('../config/server.php');

$server = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>