<?php
session_start();
$_SESSION = array();
session_destroy();
header('location: ../public/login_register.php');