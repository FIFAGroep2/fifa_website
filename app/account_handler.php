<?php
session_start();

require 'connect.php';

if (isset($_POST['btnregister'])) {
    try {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $sql_select = $server->prepare("SELECT `student_id` FROM `tbl_users` WHERE `student_id` = '$username'");
        $sql_select->execute();
        $result = $sql_select->rowCount();


        if($result > 0){
            header("location: ../public/login_register.php?message=Dit D-nummer is al in gebruik.");
            exit;
        }

        if(strlen($password) < 8){
            header("location: ../public/login_register.php?message=Uw wachtwoord moet minimaal 8 tekens bevatten.");
            exit;
        }

        if(!preg_match("#[0-9]+#", $password)){
            header("location: ../public/login_register.php?message=Uw wachtwoord moet minimaal 1 getal bevatten.");
            exit;
        }

        if (!preg_match("#[A-Z]+#", $password)){
            header("location: ../public/login_register.php?message=Uw wachtwoord moet minimaal 1 hoofdletter bevatten.");
            exit;
        }

        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        if(preg_match($pattern, $username)){
            header("location: ../public/login_register.php?message=Alleen letters en cijfers toegestaan in het D-nummer!");
            exit;
        }

        if(preg_match($pattern . "#[0-9]+#", $fname)){
            header("location: ../public/login_register.php?message=Alleen letters toegestaan in voornaam!");
            exit;
        }

        if(preg_match($pattern . "#[0-9]+#", $lname)){
            header("location: ../public/login_register.php?message=Alleen letters toegestaan in achternaam!");
            exit;
        }

        if (strlen($username) > 13){
            header("location: ../public/login_register.php?message=Uw D-nummer kan maximaal 13 karakters bevatten.");
            exit;
        }

        else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO `tbl_users`(`student_id`, `first_name`, `last_name`, `password`) VALUES (:username, :fname, :lname, :password)";
            $stmt = $server->prepare($sql_insert);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->execute();

            if(isset($_POST['typeplayer'])) {
                $sql_insert = "INSERT INTO `tbl_players`(`student_id`, `first_name`, `last_name`) VALUES (:username, :fname, :lname)";
                $stmt = $server->prepare($sql_insert);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':fname', $fname);
                $stmt->bindParam(':lname', $lname);
                $stmt->execute();
            }

            header("location: ../public/login_register.php?message=Registratie succesvol!");
            exit;
        }
    } catch (PDOException $e) {
        header("location: ../public/login_register.php?message=Registratie error, controleer uw gegevens a.u.b!");
    }
} elseif (isset($_POST['btnlogin'])) {
    try {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $sql = $server->prepare('SELECT * FROM `tbl_users` WHERE `student_id` = :username');
        $sql->bindParam(':username', $username);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $sql->rowCount();

        if ($result > 0) {
            $hashedpass = $user['password'];

            if (password_verify($password, $hashedpass)) {
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = $username;
                if ($user['is_captain'] == 1 && $user['is_admin'] == 1) {
                    $_SESSION['isCaptain'] = true;
                    $_SESSION['isAdmin'] = true;
                    header('location: ../public/index.php');
                } elseif ($user['is_captain'] == 1) {
                    $_SESSION['isCaptain'] = true;
                    header('location: ../public/index.php');
                } elseif ($user['is_admin'] == 1) {
                    $_SESSION['isAdmin'] = true;
                    header('location: ../public/index.php');
                } else {
                    header('location: ../public/index.php');
                }
                exit;
            }
            else {
                header('location: ../public/login_register.php?loginmessage=De ingevulde gebruikersnaam of wachtwoord is fout!');
                exit;
            }
        } else {
            header('location: ../public/login_register.php?loginmessage=De ingevulde gebruikersnaam of wachtwoord is fout!');
            exit;
        }
    }catch (PDOException $e){
        header('location: ../public/login_register.php?loginmessage=Er is een fout opgetreden tijdens het inloggen. Controleer uw gegevens a.u.b.');
        exit;
    }
} else {
    header('location: ../public/login_register.php');
    exit;
}