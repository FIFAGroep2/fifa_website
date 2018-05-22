<?php
session_start();

require 'connect.php';

if (isset($_POST['btnregister'])) {
    try {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql_select = $server->prepare("SELECT `student_id` FROM `tbl_users` WHERE `student_id` = '$username'");
        $sql_select->execute();
        $result = $sql_select->rowCount();


        if($result > 0){
            header("location: ../public/login_register.php?message=Dit dnummer is al in gebruik.");
            exit;
        }

        if(strlen($password) <8){
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

        if (strlen($username) >13){
            header("location: ../public/login_register.php?message=Uw dnummer kan maximaal 13 karakters bevatten.");
            exit;
        }

        else {
            $sql_insert = "INSERT INTO `tbl_users`(`student_id`, `first_name`, `last_name`, `password`) VALUES (:username, :fname, :lname, :password)";

            $stmt = $server->prepare($sql_insert);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);

            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->execute();
            header("location: ../public/login_register.php?message=Registratie succesvol!");
            die();
        }
    }
    catch (PDOException $e){
        header("location: ../public/login_register.php?message=registratie error, controleer uw gegevens a.u.b!");
    }
}

if (isset($_POST['btnlogin'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $server->prepare('SELECT * FROM `tbl_users` WHERE `student_id` = :username');
        $sql->bindParam(':username', $username);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $sql->rowCount();

        if ($result > 0) {
            if($user['is_captain'] == 0 && $user['is_admin'] == 0){
                $hashedpass = $user['password'];

                if (password_verify($password, $hashedpass)) {
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['username'] = $username;
                    header('location: ../public/login_register.php?loginmessage=Je bent ingelogd!');
                    die();
                }
            }
            if ($user['is_captain'] == 1) {
                $hashedpass = $user['password'];

                if (password_verify($password, $hashedpass)) {
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['isCaptain'] = true;
                    header('location: ../public/login_register.php?loginmessage=Je bent ingelogd als Team Captain.');
                    die();
                }
            }
            if ($user['is_admin'] == 1) {
                $hashedpass = $user['password'];

                if (password_verify($password, $hashedpass)) {
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['isAdmin'] = true;
                    header('location: ../public/login_register.php?loginmessage=Je bent ingelogd als Admin.');
                    die();
                }
            }
        }
        else{
            header('location: ../public/login_register.php?loginmessage=De ingevulde gebruikersnaam of wachtwoord is fout!');
            die();
        }
    }catch (PDOException $e){
        header('location: ../public/login_register.php?loginmessage=er is een fout opgetreden tijdens het inloggen. Controleer uw gegevens a.u.b.');
        die();
    }
}