<?php

    function generateForm() {
        
        $_SESSION['verifi_form'] = '<form class="auth-form" action="app/scripts/php/auth/verifi.php" method="post">
            <label for="verification_code">Pro dokončení registrace, zadejte ověřovací kód, který vám byl zaslán na vámi uvedený e-mail.</label>
            <input type="text" name="verification_code" placeholder="Zadejte ověřovací kód">
            <input type="submit" value="Ověřit">
        </form>';
    }

    function generateNewMailForm() {
        $_SESSION['verifi_form'] = '<form class="auth-form" action="app/scripts/php/auth/verifi_new_mail.php" method="post">
            <label for="verification_code">Pro změnu e-mailu, zadejte ověřovací kód, který vám byl zaslán na novou adresu.</label>
            <input type="text" name="verification_code" placeholder="Zadejte ověřovací kód">
            <input type="submit" value="Ověřit">
        </form>';
    }

    function verifiMe() {
            
        $code = rand(1000, 9999);

        $_SESSION['verifi_code'] = password_hash($code, PASSWORD_DEFAULT);

        $to = $_POST['email'];
        $subject = "CarMeeter verification code";
        $message = "Your verification code is: " . $code;
        $headers = "From: istesovaniovereni@gmail.com";
        mail($to, $subject, $message, $headers);
    }

    function savePostsToSessions() {
        
        $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['personal_data_agreement'] = $_POST['personal_data_agreement'];
        $_SESSION['email_agreement'] = $_POST['email_agreement'];

        verifiMe();
        generateForm();
        header("Location: http://localhost/car_meeter/signup");
    }

    function loadSessions() {
        
        $_SESSION['password'];
        $_SESSION['username'];
        $_SESSION['firstname'];
        $_SESSION['lastname'];
        $_SESSION['email'];
        $_SESSION['personal_data_agreement'];
        $_SESSION['email_agreement'];
        $_SESSION['verifi_code'];
        $_SESSION['error_message'] = 'Zadejte správný ověřovací kód!';
        generateForm();
        header("Location: http://localhost/car_meeter/signup");
    }

    function saveNewMailToSession() {

        $_SESSION['new_email'] = $_POST['email'];

        verifiMe();
        generateNewMailForm();
        header("Location: http://localhost/car_meeter/dashboard");
    }

    function loadNewMailSession () {
        $_SESSION['new_email'];
        $_SESSION['error_message'] = 'Zadejte správný ověřovací kód!';
        generateNewMailForm();
        header("Location: http://localhost/car_meeter/dashboard");
    }

    function logoutMe() {
        
        session_start();
        session_destroy();
        session_start();
        $_SESSION['info_message'] = 'Byli jste úspěšně odhlášeni!';
        header("Location: http://localhost/car_meeter/login");
        exit;
    }
?>