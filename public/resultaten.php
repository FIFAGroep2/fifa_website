<?php
session_start();
?>
<!doctype html>
<html lang="en" class="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style-resultaten.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Fifa</title>
</head>
<body>
<?php require('templates/header.php'); ?>
<div class="main">
    <div class="header">
        <h2>FIFA Dev Edition</h2>
        <h3>Resultaten</h3>
    </div>

    <div class="part">
        <div class="part1">
            <div class="deel1">

                <h4>Team 1</h4>
                <h4>Team 2</h4>
                <h4>Team 3</h4>
                <h4>Team 4</h4>
                <h4>Team 5</h4>
                <h4>Team 6</h4>
                <h4>Team 7</h4>
                <h4>Team 8</h4>

            </div>

            <div class="deel2">

                <h4>2-1</h4>
                <h4>2-0</h4>
                <h4>3-1</h4>
                <h4>1-2</h4>
                <h4>0-0</h4>
                <h4>2-0</h4>
                <h4>1-1</h4>
                <h4>1-3</h4>

            </div>

            <div class="deel3">

                <h4>Team 5</h4>
                <h4>Team 4</h4>
                <h4>Team 2</h4>
                <h4>Team 3</h4>
                <h4>Team 1</h4>
                <h4>Team 7</h4>
                <h4>Team 8</h4>
                <h4>Team 6</h4>

            </div>
        </div>

        <div class="part2">

            <h3>Tijdsschema</h3>

            <div class="schema">

                <div class="deel1-part2">
                    <h4 id="merk">Team</h4>
                    <h4>Team 3</h4>
                    <h4>Team 1</h4>
                    <h4>Team 7</h4>
                    <h4>Team 8</h4>
                    <h4>Team 6</h4>
                </div>

                <div class="deel2-part2">
                    <h4 id="merk">Team</h4>
                    <h4>Team 2</h4>
                    <h4>Team 3</h4>
                    <h4>Team 5</h4>
                    <h4>Team 9</h4>
                    <h4>Team 2</h4>
                </div>

                <div class="deel3-part2">
                    <h4 id="merk">Tijd</h4>
                    <h4>10:00</h4>
                    <h4>10:15</h4>
                    <h4>10:30</h4>
                    <h4>10:45</h4>
                    <h4>11:00</h4>
                </div>
            </div>
        </div>
    </div>


    <div class="content">

    </div>
    <div class="footer">

    </div>
</div>
<?php require('templates/footer.php'); ?>
</body>
</html>