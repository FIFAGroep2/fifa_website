<div id="header">
    <div class="container">
        <div>
            <h1>Fifa</h1>
        </div>
        <?php
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            echo '<p>Je bent ingelogd als ADMIN</p>';
        } elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['isCaptain']) && $_SESSION['isCaptain'] == true) {
            echo '<p>Je bent ingelogd als TEAM CAPTAIN</p>';
        } elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            echo '<p>Je bent ingelogd als SPELER</p>';
        }
        else{
            echo '<p>Je bent niet ingelogd</p>';
        }
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
