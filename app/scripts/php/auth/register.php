<?php
    require("../db_conn.php");

    if (!isset($_POST['username'], $_POST['password']))  {
        
        //$page == 'register';
        echo 'vyplňte všechna pole';
    
    } else if ((empty($_POST['username']) || empty($_POST['password']))) {
        
        //  $page == 'register';
        echo 'vyplňte všechna pole';
    }

    if ($mysql = $conn->prepare('SELECT id, password FROM users WHERE username = ?')) {
        
        $mysql->bind_param('s', $_POST['username']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            session_start();
            $_SESSION['error_message'] = 'Uživatelské jméno již existuje!';
            header("Location: http://localhost/car_meeter/register");
            exit;
        
        } else if ($mysql = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)')) {
            
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $mysql->bind_param('ss', $_POST['username'], $password);
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