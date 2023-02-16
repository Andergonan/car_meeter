<?php
    
    session_start();

    require('../db_conn.php');

    if (!isset($_POST['username'], $_POST['password'])) {

        $_SESSION['error_message'] = 'Vyplňte prosím obě pole!';
        header("Location: http://localhost/car_meeter/login");
        exit;
    }

    if ($mysql = $conn->prepare('SELECT id, password FROM users WHERE username = ?')) {

        $mysql->bind_param('s', $_POST['username']);
        $mysql->execute();

        $mysql->store_result();
    }
    
    if ($mysql->num_rows > 0) {
        $mysql->bind_result($id, $password);
        $mysql->fetch();

        if (password_verify($_POST['password'], $password)) {

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: http://localhost/car_meeter/login_home');
        } else {

            $_SESSION['error_message'] = 'Zadané přihlašovací údaje jsou nesprávné!';
            header("Location: http://localhost/car_meeter/login");
            exit;
        }
    } else {
        
        $_SESSION['error_message'] = 'Zadané přihlašovací údaje jsou nesprávné!';
        header('Location: http://localhost/car_meeter/login');
        exit;
    }
    
    $mysql->close();
?>