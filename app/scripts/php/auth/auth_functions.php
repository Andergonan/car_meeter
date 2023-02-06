<?php

    function generateForm() {
        
        $_SESSION['verifi_form'] = '<form action="app/scripts/php/auth/verifi.php" method="post">
            <label for="verification_code">Pro dokončení registrace, zadejte ověřovací kód, který vám byl zaslán na vámi uvedený e-mail.</label>
            <input type="text" name="verification_code" placeholder="Enter verification code">
            <input type="submit" value="Verify">
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
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        verifiMe();
        generateForm();
        header("Location: http://localhost/car_meeter/signup");
    }

    function loadSessions() {
        $_SESSION['password'];
        $_SESSION['username'];
        $_SESSION['email'];
        $_SESSION['verifi_code'];
        $_SESSION['error_message'] = 'Zadejte správný ověřovací kód!';
        generateForm();
        header("Location: http://localhost/car_meeter/signup");
    }
?>