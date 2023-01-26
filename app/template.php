<?php

    session_start();

    require("app/scripts/php/db_conn.php");

    if (!isset($_SESSION['loggedin'])) {
        $pages = [
            "home" => "Domů",
            "register" => "Registrace",
            "login" => "Přihlášení",
            "404" => "404"
        ];
    } else {
        $pages = [
            "login_home" => "Domů",
            "dashboard" => "Profil",
            "404" => "404"
        ];
    }

    $url = "//localhost";
    $urlDir = "/car_meeter/";
    $uri = str_replace($urlDir, "", $_SERVER["REQUEST_URI"]);
    $uriParam = explode("/", $uri);
    $page = $uriParam[0] ?? "";
    
    if (empty($page)) {
        $page = 'home';
    } else if (isset($_SESSION['loggedin'])) {
        $page = 'login_home';
    }

    if (!isset($pages[$page])) {
        $page = '404';
    }

    if(isset($_SESSION['error_message'])) {
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']);
    }

    $title = ($page == "home" ? "" : $pages[$page] . " | ") . "CarMeeter";

    $navigation = "";
    foreach ($pages as $key => $val) {
        if ($key == "404") {
            continue;
        }
        $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button  style="min-width:20%">' . $val . '</button></a>';
    }

    /*$mobilenav = "";
    foreach ($pages as $key => $val) {
        if ($key == "404") {
            continue;
        }
        $mobilenav .= '<a ' . ($page == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . '</a>';
    }*/

    // content
    $content = file_get_contents("app/fragments/$page.html");
    $pageTemplate = file_get_contents("app/fragments/page.html");
    $header = file_get_contents("app/fragments/_header.html");
    $footer = file_get_contents("app/fragments/_footer.html");

    $pageTemplate = str_replace("{base}", $url . $urlDir, $pageTemplate);
    $pageTemplate = str_replace("{title}", $title, $pageTemplate);
    $pageTemplate = str_replace("{header}", $header, $pageTemplate);
    $pageTemplate = str_replace("{navigation}", $navigation, $pageTemplate);
    //$pageTemplate = str_replace("{mobilenav}", $mobilenav, $pageTemplate);
    $pageTemplate = str_replace("{content}", $content, $pageTemplate);
    $pageTemplate = str_replace("{footer}", $footer, $pageTemplate);
    echo $pageTemplate;
?>