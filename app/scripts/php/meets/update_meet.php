<?php
    session_start();

    require('../db_conn.php');

    if (!isset($_SESSION['username'], $_SESSION['id'], $_POST['title'], $_POST['datetime'], $_POST['town'], $_POST['address']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (empty($_SESSION['username'] || $_SESSION['id'] || $_POST['title'] || $_POST['datetime'] || $_POST['town'] || $_POST['address'])) {
        
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
    }

    if ($mysql = $conn->prepare('SELECT meet_id, meet_hash, organizer_id FROM meets WHERE title = ? AND meet_id != ? AND meet_hash != ?')) {
        $mysql->bind_param('sis', $_POST['title'], $_POST['meet_id'], $_POST['meet_hash']);
        $mysql->execute();
        $mysql->store_result();
            
        if ($mysql->num_rows > 0) {
            $_SESSION['error_message'] = 'Sraz se stejným názvem již existuje!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        }
    }
    
    if ($mysql = $conn->prepare('UPDATE meets SET organizer = ?, title = ?, datetime = ?, town =  ?, address = ?, gps_location = ?, description = ? WHERE meet_id = ? AND meet_hash = ? AND organizer_id = ?')) {
        $mysql->bind_param('sssssssiss', $_SESSION['username'], $_POST['title'], $_POST['datetime'], $_POST['town'], $_POST['address'], $_POST['gps_location'], $_POST['description'], $_POST['meet_id'], $_POST['meet_hash'], $_SESSION['id']);
        $mysql->execute();
        $affected_rows = $mysql->affected_rows;
    
        if ($affected_rows > 0) {
            $_SESSION['info_message'] = 'Váš sraz byl úspěšně upraven!';
        } else {
            $_SESSION['error_message'] = 'Váš sraz se nepodařilo upravit!';
        }
    
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }

    $mysql->close();
?>