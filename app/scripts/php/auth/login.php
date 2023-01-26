<?php
    session_start();

    if (!isset($_POST['username'], $_POST['password'])) {
  
        echo 'Vyplňte prosím obě pole!';
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
            //echo 'Vítejte ' . $_SESSION['name'] . '!';
            header('Location: home.php');
        } else {
            echo 'Zadané přihlašovací údaje jsou nesprávné!';
        }
    } else {
        echo 'Zadané přihlašovací údaje jsou nesprávné!';
    }
    
    $mysql->close();
?>