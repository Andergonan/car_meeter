<?php
    
    session_start();

    require('../db_conn.php');

    if (!isset($_SESSION['loggedin'])) {

        $_SESSION['error_message'] = 'Pro zúčastnění akce, se nejpreve přihlašte!';
        header("Location: http://localhost/car_meeter");
        exit;
    }

    if (isset($_POST['meet_id'])) {
        $meet_id = $_POST['meet_id'];
        $user_id = $_SESSION['id'];
    
        $check_mysql = "SELECT party FROM meets WHERE meet_id = {$meet_id} AND FIND_IN_SET('{$user_id}', party) > 0";
        $check_result = $conn->query($check_mysql);
        if ($check_result->num_rows > 0) {

            $_SESSION['error_message'] = 'Tohoto srazu se již účastníte!';
            header("Location: http://localhost/car_meeter/home");
            exit;
        } else {

            $mysql = "UPDATE meets SET party = CONCAT(party, ',{$user_id}') WHERE meet_id = {$meet_id}";
            if ($conn->query($mysql) === TRUE) {
                $_SESSION['info_message'] = 'Úspěšně jste se zapsali na sraz!';
                header("Location: http://localhost/car_meeter/home");
                exit;
            } else {
                $_SESSION['error_message'] = 'Na sraz se vás bohužel nepovedlo zapsat. :/';
                header("Location: http://localhost/car_meeter/home");
                exit;
            }
        }
    }
    $conn->close();
?>