<?php
require ('../app/connect.php');

session_start();
?>
<!doctype html>
<html lang="en" class="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Fifa</title>
</head>
<body>
    <?php require('templates/header.php'); ?>
    <div class="main">
        <div class="header">
            <h2>FIFA Dev Edition</h2>
            <h3>FINALES</h3>
        </div>
        <div class="content">

        </div>
    </div>
    <?php require('templates/footer.php'); ?>
</body>
</html>