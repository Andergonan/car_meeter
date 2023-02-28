<?php
    session_start();

    require('../db_conn.php');

    if (!isset($_POST['username']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (empty($_POST['username'])) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['username']) > 50) {

        $_SESSION['error_message'] = 'Vaše přezdívka může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }
    
    if ($mysql = $conn->prepare('SELECT id FROM users WHERE username = ?')) {

        $mysql->bind_param('s', $_POST['username']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            $_SESSION['error_message'] = 'Uživatelské jméno je již obsazené!';
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        } else if ($mysql = $conn->prepare('UPDATE users SET username = ? WHERE ID = ?')) {
        
            $mysql->bind_param('si', $_POST['username'], $_SESSION['id']);
            $mysql->execute();
            $mysql->close();
            $conn->close();
    
            $_SESSION['info_message'] = 'Vaše jméno bylo úspěšně změněno!';
            $_SESSION['username'] = $_POST['username'];
            session_write_close();
            header('Location: http://localhost/car_meeter/dashboard');
            exit;
        }

        $mysql->close();
    } 
?>