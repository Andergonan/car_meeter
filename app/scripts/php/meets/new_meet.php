<?php
    session_start();

    require('../db_conn.php');

    if (!isset($_SESSION['username'], $_SESSION['id'], $_POST['title'], $_POST['organizing'], $_POST['car_specs'], $_POST['datetime'], $_POST['town'], $_POST['address'], $_POST['place']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (empty($_SESSION['username'] || $_SESSION['id'] || $_POST['title'] || $_POST['organizing'] || $_POST['car_specs'] || $_POST['datetime'] || $_POST['town'] || $_POST['address'] || $_POST['place'])) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['title']) > 50) {
        
        $_SESSION['error_message'] = 'Název může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['description']) > 500) {

        $_SESSION['error_message'] = 'Popis může obsahovat maximálně 500 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['town']) > 50) {

        $_SESSION['error_message'] = 'Název města může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['address']) > 50) {

        $_SESSION['error_message'] = 'Název ulice může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['gps_location']) > 200) {

        $_SESSION['error_message'] = 'GPS souřadnice může obsahovat maximálně 200 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ($_POST['organizing'] != '<i title="Organizovaný" class="fa-solid fa-road-barrier"></i>' && $_POST['organizing'] != '<i title="Volný" class="fa-solid fa-road-circle-exclamation"></i>') {
            
        $_SESSION['error_message'] = 'Něco se pokazilo.';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ($_POST['car_specs'] != 'Všechny vozy' && $_POST['car_specs'] != 'Pouze upravené' && $_POST['car_specs'] != 'Pouze sportovní' && $_POST['car_specs'] != 'Pouze kombi' && $_POST['car_specs'] != 'Pouze JDM') {

        $_SESSION['error_message'] = 'Něco se pokazilo.';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ($_POST['place'] != 'fa-solid fa-gas-pump' && $_POST['place'] != 'fa-solid fa-cart-shopping' && $_POST['place'] != 'fa-solid fa-square-parking' && $_POST['place'] != 'fa-solid fa-plane-departure' && $_POST['place'] != 'fa-solid fa-road') {

        $_SESSION['error_message'] = 'Něco se pokazilo.';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } /*else if (isset($_POST['datetime']) && DateTime::createFromFormat('D-m-y H:i', $_POST['datetime']) === false) {

        $_SESSION['error_message'] = 'Něco se pokazilo.';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }*/


    if ($mysql = $conn->prepare('SELECT meet_id FROM meets WHERE title = ?')) {
        
        $mysql->bind_param('s', $_POST['title']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            $_SESSION['error_message'] = 'Sraz se stejným názvem již existuje!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        
        } else if ($mysql = $conn->prepare('INSERT INTO meets (organizer, organizer_id, meet_hash, title, organizing, car_specs, datetime, town, address, place, gps_location, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            $hash = rand(100000, 99999);
            $meet_hash = password_hash($hash, PASSWORD_DEFAULT);
            $mysql->bind_param('sissssssssss', $_SESSION['username'], $_SESSION['id'], $meet_hash, $_POST['title'], $_POST['organizing'], $_POST['car_specs'], $_POST['datetime'], $_POST['town'], $_POST['address'], $_POST['place'], $_POST['gps_location'], $_POST['description']);
            $mysql->execute();
            
            $_SESSION['info_message'] = 'Sraz úspěšně vytvořen!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        }
        $mysql->close();
    }
?>