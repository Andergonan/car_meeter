<?php
    session_start();

    require('../db_conn.php');

    if (!isset($_POST['firstname'], $_POST['lastname']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ((empty($_POST['firstname']) || empty($_POST['lastname']))) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (preg_match("/[\s\d\W]+/", $_POST['firstname']) || preg_match("/[\s\d\W]+/", $_POST['lastname'])) {

        $_SESSION['error_message'] = 'Neplatný formát jména, nebo příjmení!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['firstname']) > 50) {

        $_SESSION['error_message'] = 'Vaše jméno může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['lastname']) > 50) {

        $_SESSION['error_message'] = 'Vaše příjmení může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }

    $mysql = $conn->prepare('UPDATE users SET firstname = ?, lastname = ? WHERE ID = ? AND (firstname != ? OR lastname != ?)');
    $mysql->bind_param('ssiss', $_POST['firstname'], $_POST['lastname'], $_SESSION['id'], $_POST['firstname'], $_POST['lastname']);
    $mysql->execute();
    $affected_rows = $mysql->affected_rows;
    $mysql->close();
    $conn->close();
    
    if ($affected_rows > 0) {
        $_SESSION['info_message'] = 'Vaše jméno bylo úspěšně změněno!';
    } else {
        $_SESSION['error_message'] = 'Vaše jméno nebylo změněno!';
    }

    header('Location: http://localhost/car_meeter/dashboard');
    exit;
?>