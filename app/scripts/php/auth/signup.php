<?php

    session_start();

    require('../db_conn.php');
    require('auth_functions.php');

    if (!isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    
    } else if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['password']) < 8) {
        
        $_SESSION['error_message'] = 'Heslo musí obsahovat minimálně 8 znaků!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (!preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[a-z]/', $_POST['password'])) {
        
        $_SESSION['error_message'] = 'Heslo musí obsahovat alespoň jedno velké a jedno malé písmeno!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        
        $_SESSION['error_message'] = "Neplatný formát e-mailu!";
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (preg_match("/[\s\d\W]+/", $_POST['firstname']) || preg_match("/[\s\d\W]+/", $_POST['lastname'])) {

        $_SESSION['error_message'] = 'Neplatný formát jména, nebo příjmení!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    }

    if ($mysql = $conn->prepare('SELECT id, password FROM users WHERE username = ? OR email = ?')) {

        $mysql->bind_param('ss', $_POST['username'], $_POST['email']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            $_SESSION['error_message'] = 'Uživatelské jméno nebo e-mail již existuje!';
            header('Location: http://localhost/car_meeter/signup');
            exit;
        }

        $mysql->close();
    }

    savePostsToSessions();
?>