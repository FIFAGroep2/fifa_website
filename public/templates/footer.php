<div id="footer">
    <div class="container">
        <h2>Poulestanden</h2>
        <h4>Poule 1</h4>
        <table>
            <tr>
                <th>Nr</th>
                <th>Team</th>
                <th>Score</th>
            </tr>
            <?php
            //header('Content-Type: text/html; charset=ISO-8859-1');
            $teams = $server->prepare("SELECT * FROM `tbl_teams` ORDER BY `score` DESC");
            $teams->execute();
            $teams = $teams->fetchAll();

            $rank = 1;
            foreach ($teams as $team){
                $poule = $team['poule_id'];
                if ($poule == 1) {
                    echo '<tr>';
                    echo '<td>' . $rank . '</td>';
                    echo '<td class="teamname name">' . $team['name'] . '</td>';
                    echo '<td>' . $team['score'] . '</td>';
                    echo '</tr>';
                    $rank++;
                }
            }
            ?>
        </table>

        <h4>Poule 2</h4>
        <table>
            <tr>
                <th>Nr</th>
                <th>Team</th>
                <th>Score</th>
            </tr>
            <?php
            $rank = 1;
            foreach ($teams as $team){
                $poule = $team['poule_id'];
                if ($poule == 2) {
                    echo '<tr>';
                    echo '<td>' . $rank . '</td>';
                    echo '<td class="teamname name">' . $team['name'] . '</td>';
                    echo '<td>' . $team['score'] . '</td>';
                    echo '</tr>';
                    $rank++;
                }
            }
            ?>
        </table>

        <h4 class="header-userrank">User Ranking</h4>
        <table>
            <tr>
                <th>Nr</th>
                <th>Naam</th>
                <th>Team</th>
                <th>Score</th>
            </tr>
            <tr>
                <?php
                $players = $server->prepare("SELECT * FROM `tbl_players` ORDER BY `score` DESC LIMIT 10");
                $players->execute();
                $players = $players->fetchAll();

                $rank = 1;
                foreach ($players as $player) {
                    $teamid = $player['team_id'];
                    $team = $server->prepare("SELECT * FROM `tbl_teams` WHERE `id` = '$teamid'");
                    $team->execute();
                    $team = $team->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>' . $rank . '</td>';
                    echo '<td class="playername name">' . $player['first_name'] . ' ' . $player['last_name'] . '</td>';
                    echo '<td>' . $team['name'] . '</td>';
                    echo '<td>' . $player['score'] . '</td>';
                    echo '</tr>';
                    $rank++;
                }
                ?>
            </tr>
        </table>
    </div>
</div>