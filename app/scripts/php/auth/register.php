<?php
    require("../db_conn.php");

    if (!isset($_POST['username'], $_POST['email'], $_POST['password']))  {
        
        session_start();
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header("Location: http://localhost/car_meeter/register");
        exit;
    
    } else if ((empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))) {
        
        session_start();
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header("Location: http://localhost/car_meeter/register");
        exit;
    } else if (strlen($_POST['password']) < 8) {
        
        session_start();
        $_SESSION['error_message'] = 'Heslo musí obsahovat minimálně 8 znaků!';
        header("Location: http://localhost/car_meeter/register");
        exit;
    } else if (!preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[a-z]/', $_POST['password'])) {
        
        session_start();
        $_SESSION['error_message'] = "Heslo musí obsahovat alespoň jedno velké a jedno malé písmeno!";
        header("Location: http://localhost/car_meeter/register");
        exit;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        
        session_start();
        $_SESSION['error_message'] = "Neplatný formát e-mailu!";
        header("Location: http://localhost/car_meeter/register");
        exit;
    }

    if ($mysql = $conn->prepare('SELECT id, password FROM users WHERE username = ? OR email = ?')) {
        
        $mysql->bind_param('ss', $_POST['username'], $_POST['email']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            session_start();
            $_SESSION['error_message'] = 'Uživatelské jméno nebo e-mail již existuje!';
            header("Location: http://localhost/car_meeter/register");
            exit;
        
        } else if ($mysql = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)')) {
            
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $mysql->bind_param('sss', $_POST['username'], $_POST['email'], $password);
            $mysql->execute();

            session_start();
            $_SESSION['error_message'] = 'Registrace probělhla úspěšně! Nyní se můžete <a href="index.html">přihlásit<a/>!';
            header("Location: http://localhost/car_meeter/register");
            exit;
        }
        $mysql->close();
    } else {
        
        echo 'Něco se pokazilo :/.';
    }
    
    $conn->close();
?>