<?php
    session_start();

    require('../db_conn.php');
    
    if (!isset($_POST['password']))  {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ((empty($_POST['password']))) {
        
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['password']) > 255) {

        $_SESSION['error_message'] = 'Vaše heslo může obsahovat maximálně 50 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (strlen($_POST['password']) < 8) {
        
        $_SESSION['error_message'] = 'Heslo musí obsahovat minimálně 8 znaků!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if (!preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[a-z]/', $_POST['password'])) {
        
        $_SESSION['error_message'] = 'Heslo musí obsahovat alespoň jedno velké a jedno malé písmeno!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    } else if ($_POST['password'] != $_POST['password-check']) {
        
        $_SESSION['error_message'] = 'Hesla se neshodují!';
        header('Location: http://localhost/car_meeter/dashboard');
        exit;
    }

    $mysql = $conn->prepare('UPDATE users SET password = ? WHERE ID = ?');
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mysql->bind_param('si', $password, $_SESSION['id']);
    $mysql->execute();
    $mysql->close();
    $conn->close();
    
    $_SESSION['info_message'] = 'Vaše heslo bylo úspěšně změněno!';
    header('Location: http://localhost/car_meeter/dashboard');
    exit;
?>