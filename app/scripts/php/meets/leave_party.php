<?php
    session_start();

    require('../db_conn.php');

    if (!isset($_SESSION['loggedin'])) {

        $_SESSION['error_message'] = 'Nejprve se přihlašte!';
        header("Location: http://localhost/car_meeter");
        exit;
    }

    if (isset($_POST['meet_id'])) {
        $meet_id = $_POST['meet_id'];
        $user_id = $_SESSION['id'];
    
        $check_mysql = "SELECT party FROM meets WHERE meet_id = {$meet_id} AND FIND_IN_SET('{$user_id}', party) > 0";
        $check_result = $conn->query($check_mysql);
        if ($check_result->num_rows > 0) {
    
            $delete_mysql = "UPDATE meets SET party = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', party, ','), ',{$user_id},', ',')) WHERE meet_id = {$meet_id}";
            if ($conn->query($delete_mysql) === TRUE) {
                
                $_SESSION['info_message'] = 'Úspěšně jste se odhlásili ze srazu!';
                header("Location: http://localhost/car_meeter/home");
                exit;
            } else {
                
                $_SESSION['error_message'] = 'Ze srazu se vás bohužel nepovedlo odhlásit. :/';
                header("Location: http://localhost/car_meeter/home");
                exit;
            }
        } else {
            
            $_SESSION['error_message'] = 'Srazu se neúčastníte!';
            header("Location: http://localhost/car_meeter/home");
            exit;
        }
    }
    $conn->close();
?>