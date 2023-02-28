<?php
    session_start();

    require('../db_conn.php');
    require('auth_functions.php');

    if (!isset($_POST['email']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ((empty($_POST['email']))) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        
        $_SESSION['error_message'] = "Neplatný formát e-mailu!";
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['email']) > 255) {

        $_SESSION['error_message'] = 'Délka e-mailu může být maximálně 255 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['lastname']) > 50) {

        $_SESSION['error_message'] = 'Vaše příjmení může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }

    if ($mysql = $conn->prepare('SELECT id FROM users WHERE email = ?')) {

        $mysql->bind_param('s', $_POST['email']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            $_SESSION['error_message'] = 'E-mail je již užíván!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        }

        $mysql->close();
    }

    saveNewMailToSession();
?>