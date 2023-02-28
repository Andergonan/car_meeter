<?php

    session_start();
    
    require('../db_conn.php');
    require('auth_functions.php');
    
    if (password_verify($_POST['verification_code'], $_SESSION['verifi_code'])) {
        
        $mysql = $conn->prepare('UPDATE users SET email = ? where id = ?');
        $mysql->bind_param('si', $_SESSION['new_email'], $_SESSION['id']);
        $mysql->execute();
        $mysql->close();
        $conn->close();

        $_SESSION['info_message'] = 'Registrace proběhla úspěšně, nyní se můžete přihlásit!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else {

        loadNewMailSession();
    }
?>