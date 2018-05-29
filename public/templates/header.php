<div id="header">
    <div class="container">
        <div>
            <h1>Fifa</h1>
        </div>
        <?php
        echo '<p class="headerinfo">';
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['isAdmin']) &&
            $_SESSION['isAdmin'] == true && isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'] == true) {
            echo 'Je bent ingelogd als ADMIN en TEAM CAPTAIN';
        } elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            echo 'Je bent ingelogd als ADMIN';
        } elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'] == true) {
            echo 'Je bent ingelogd als TEAM CAPTAIN';
        } elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            echo 'Je bent ingelogd als SPELER';
        }
        else{
            echo 'Je bent niet ingelogd. <a href="../public/login_register.php">KLIK HIER</a> om in te loggen.';
        }
        echo '</p>';
        ?>
        <nav>
            <a href="../public/index.php"><i class="fas fa-trophy"></i>Wedstrijden</a>
            <a href="../public/resultaten.php"><i class="fas fa-star"></i>Resultaten</a>
            <?php
            if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                ?>
                <a href="../public/login_register.php"><i class="fas fa-sign-in-alt"></i>Login</a>
            <?php } ?>
            <?php if((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true)
                || (isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'] == true)){ ?>

                <a href="../public/create_team.php"><i class="fas fa-users"></i>Team aanmaken</a>

            <?php } ?>
            <?php if((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true)
                || (isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'] == true)){ ?>

                <a href="../public/invoer_resultaten.php"><i class="fas fa-sort-numeric-up"></i>Standen invoeren</a>

            <?php }
            if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                ?>

                <a href="../app/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

            <?php } ?>
        </nav>
    </div>
</div>
