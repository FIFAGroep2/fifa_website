<?php
session_start();
$_SESSION = null;
session_destroy();
header('location: ../public/login_register.php');
?>