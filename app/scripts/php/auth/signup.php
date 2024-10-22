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
    } else if (!preg_match("/^[a-zA-ZáčďéěíňóřšťúůýžČĎŇŘŠŤŽ]+$/u", $_POST['firstname']) || !preg_match("/^[a-zA-ZáčďéěíňóřšťúůýžČĎŇŘŠŤŽ]+$/u", $_POST['lastname'])) {

        $_SESSION['error_message'] = 'Neplatný formát jména, nebo příjmení!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if ($_POST['password'] != $_POST['password-check']) {
        
        $_SESSION['error_message'] = 'Hesla se neshodují!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (empty($_POST['personal_data_agreement'] || $_POST['email_agreement'])) {

        $_SESSION['error_message'] = 'Bez Vašeho souhlasu s výše uvedenými body, nemůže služba CarMeeter správně fungovat.';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if ($_POST['personal_data_agreement'] != 'personal_data_agreement' || $_POST['email_agreement'] != 'email_agreement') {

        $_SESSION['error_message'] = 'Bez Vašeho souhlasu s výše uvedenými body, nemůže služba CarMeeter správně fungovat.';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['firstname']) > 50) {

        $_SESSION['error_message'] = 'Vaše jméno může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['lastname']) > 50) {

        $_SESSION['error_message'] = 'Vaše příjmení může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['username']) > 50) {

        $_SESSION['error_message'] = 'Vaše přezdívka může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['email']) > 255) {

        $_SESSION['error_message'] = 'Délka e-mailu může být maximálně 255 znaků!';
        header('Location: http://localhost/car_meeter/signup');
        exit;
    } else if (strlen($_POST['password']) > 255) {

        $_SESSION['error_message'] = 'Maximální délka hesla je 255 znaků!';
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