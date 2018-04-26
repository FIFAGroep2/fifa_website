<?php
require ('../app/connect.php');
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <title>Finales</title>
</head>
<body>
    <?php require('templates/header.php'); ?>
    <div class="main">
        <div class="header">
            <div class="header-border">
                <h2>FIFA DEV EDITION</h2>
                <h3>Finales</h3>
            </div>
        </div>

        <div class="main-content">
        <div class="deel1-main-content">   
     <ul>
        <li>&nbsp;</li>

        <li class="game game-top winner">Lousville <span>79</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">NC A&amp;T <span>48</span></li>

        <li>&nbsp;</li>

        <!-- REDACTED SOME GAMES -->

        <li class="game game-top winner">Duke <span>73</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">Albany <span>61</span></li>

        <li>&nbsp;</li>
    </ul>
    <ul>
        <!-- redacted, same structure as round 1 -->
    </ul>
    <ul>
        <!-- redacted -->    
    </ul>
    <ul>
        <li>&nbsp;</li>

        <li class="game game-top winner">Lousville <span>85</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">Duke <span>63</span></li>

        <li>&nbsp;</li>

    </ul>
    </div> 

            <div class="deel2-main-content">   
     <ul>
        <li>&nbsp;</li>

        <li class="game game-top winner">Lousville <span>79</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">NC A&amp;T <span>48</span></li>

        <li>&nbsp;</li>

        <!-- REDACTED SOME GAMES -->

        <li class="game game-top winner">Duke <span>73</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">Albany <span>61</span></li>

        <li>&nbsp;</li>
    </ul>
    <ul>
        <!-- redacted, same structure as round 1 -->
    </ul>
    <ul>
        <!-- redacted -->    
    </ul>
    <ul>
        <li>&nbsp;</li>

        <li class="game game-top winner">Lousville <span>85</span></li>
        <li>&nbsp;</li>
        <li class="game game-bottom ">Duke <span>63</span></li>

        <li>&nbsp;</li>

    </ul>
    </div>  
        </div>
</body>
</html>
