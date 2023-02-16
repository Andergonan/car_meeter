<?php
    
    session_start();
    
    require('../db_conn.php');
    require('auth_functions.php');
    
    if (password_verify($_POST['verification_code'], $_SESSION['verifi_code'])) {
        
        $mysql = $conn->prepare('INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)');
        $mysql->bind_param('sssss', $_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['username'], $_SESSION['email'], $_SESSION['password']);
        $mysql->execute();
        $mysql->close();
        $conn->close();

        $_SESSION['info_message'] = 'Registrace proběhla úspěšně, nyní se můžete přihlásit!';
        header('Location: http://localhost/car_meeter/login');
        exit;
    } else {

        loadSessions();
    }
?>