<?php
    session_start();

    require('../db_conn.php');

    if ($mysql = $conn->prepare('SELECT meet_id FROM meets WHERE title = ?')) {
        
        $mysql->bind_param('s', $_POST['title']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            $_SESSION['error_message'] = 'Sraz se stejným názvem již existuje!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        
        } else if ($mysql = $conn->prepare('INSERT INTO meets (username, title, organizing, car_specs, datetime, town, address, place, gps_location, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            
            $mysql->bind_param('ssssssssss', $_SESSION['username'], $_POST['title'], $_POST['organizing'], $_POST['car_specs'], $_POST['datetime'], $_POST['town'], $_POST['address'], $_POST['place'], $_POST['gps_location'], $_POST['description']);
            $mysql->execute();
            
            $_SESSION['info_message'] = 'Sraz úspěšně vytvořen!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        }
        $mysql->close();
    }
?>