<?php
    require("../db_conn.php");

    if (!isset($_POST['username'], $_POST['email'], $_POST['password']))  {
        
        session_start();
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header("Location: http://localhost/car_meeter/signup");
        exit;
    
    } else if ((empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))) {
        
        session_start();
        $_SESSION['error_message'] = 'Vyplňte prosím všechny pole!';
        header("Location: http://localhost/car_meeter/signup");
        exit;
    } else if (strlen($_POST['password']) < 8) {
        
        session_start();
        $_SESSION['error_message'] = 'Heslo musí obsahovat minimálně 8 znaků!';
        header("Location: http://localhost/car_meeter/signup");
        exit;
    } else if (!preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[a-z]/', $_POST['password'])) {
        
        session_start();
        $_SESSION['error_message'] = "Heslo musí obsahovat alespoň jedno velké a jedno malé písmeno!";
        header("Location: http://localhost/car_meeter/signup");
        exit;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        
        session_start();
        $_SESSION['error_message'] = "Neplatný formát e-mailu!";
        header("Location: http://localhost/car_meeter/signup");
        exit;
    }

    if ($mysql = $conn->prepare('SELECT id, password FROM users WHERE username = ? OR email = ?')) {
        
        $mysql->bind_param('ss', $_POST['username'], $_POST['email']);
        $mysql->execute();
        $mysql->store_result();
        
        if ($mysql->num_rows > 0) {
            
            session_start();
            $_SESSION['error_message'] = 'Uživatelské jméno nebo e-mail již existuje!';
            header("Location: http://localhost/car_meeter/signup");
            exit;
        
        } else if ($mysql = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)')) {

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $mysql->bind_param('sss', $_POST['username'], $_POST['email'], $password);

                
            $verification_code = rand(1000, 9999); // generate random (4-digit) verify code

            // send verifi code to user e-mail (PHPMailer)
            $to = $_POST['email'];
            $subject = "CarMeeter verification code";
            $message = "Your verification code is: " . $verification_code;
            $headers = "From: isveryficationtest@seznam.cz";
            mail($to, $subject, $message, $headers);

            // generate form for verifi code
            echo 
            '<form action="" method="post">
                <input type="text" name="verification_code" placeholder="Enter verification code">
                <input type="submit" value="Verify">
            </form>';

            if (mail($to, $subject, $message, $headers)) {
                echo 'Na váš e-mail byl odeslán ověřovací kód.';
            } else {
                echo 'Na váš e-mail se nepodařilo poslat ověřovací kód, zkuste to prosím znovi. :/';
            }

            if (isset($_POST['verification_code']) && $_POST['verification_code'] ==  $_SESSION["verification_code"]) {
                $mysql->execute();

                session_start();
                $_SESSION['error_message'] = 'Registrace proběhla úspěšně! Nyní se můžete přihlásit!';
                header("Location: http://localhost/car_meeter/login");
                exit;
            }
        }
        $mysql->close();
    } else {
        
        session_start();
        $_SESSION['error_message'] = "Něco se pokazilo :/.";
        header("Location: http://localhost/car_meeter/signup");
        exit;
    }
    
    $conn->close();
?>