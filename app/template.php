<?php

    session_start();

    require('app/scripts/php/db_conn.php');

    if (isset($_SESSION['loggedin'])) {
        $pages = [
            "home" => "Meets",
            "dashboard" => "Dashboard",
            "logout" => "Odhlásit se",
            "personaldata" => "personaldata",
            "404" => "404"
        ];
    } else {
        $pages = [
            "home" => "Meets",
            "signup" => "Registrace",
            "login" => "Přihlášení",
            "personaldata" => "personaldata",
            "404" => "404"
        ];
    }

    // routing setings
    $url = "//localhost";
    $urlDir = "/car_meeter/";
    $uri = str_replace($urlDir, "", $_SERVER["REQUEST_URI"]);
    $uriParam = explode("/", $uri);
    $page = $uriParam[0] ?? "";
    
    if (empty($page)) {
        $page = 'home';
    }

    if (!isset($pages[$page])) {
        $page = '404';
    }

    // title
    $title = ($page == "home" ? "" : $pages[$page] . " | ") . "CarMeeter";

    // navigation
    $navigation="";
    foreach ($pages as $key => $val) {
        if ($key == "404" || $key == "personaldata") {
            continue;
        } else if ($key == "home" || $key == "login_home") {
            $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button>' . $val . ' <i class="fa-solid fa-gas-pump"></i></button></a>';
        } else if ($key == "signup") {
            $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button>' . $val . ' <i class="fa-solid fa-flag-checkered"></i></button></a>';
        } else if ($key == "login" || $key == "logout") {
            $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button>' . $val . ' <i class="fa-solid fa-right-to-bracket"></i></button></a>';
        } else if ($key == "dashboard") {
            $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button>' . $val . ' <i class="fa-solid fa-warehouse"></i></button></a>';
        }
        else {
            $navigation .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '"><button>' . $val . '</i></button></a>';
        }
    }

    // mobile navigation
    $mobilenav="";
    foreach ($pages as $key => $val) {
        if ($key == "404" || $key == "personaldata") {
            continue;
        } else if ($key == "home" || $key == "login_home") {
            $mobilenav .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . ' <i class="fa-solid fa-gas-pump"></i></a>';
        } else if ($key == "signup") {
            $mobilenav .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . ' <i class="fa-solid fa-flag-checkered"></i></a>';
        } else if ($key == "login" || $key == "logout") {
            $mobilenav .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . ' <i class="fa-solid fa-right-to-bracket"></i></a>';
        } else if ($key == "dashboard") {
            $mobilenav .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . ' <i class="fa-solid fa-warehouse"></i></a>';
        }
        else {
            $mobilenav .= '<a ' . ($pages == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . '</i><</a>';
        }
    }

    // system forms
    $systemForm="";
    if (isset($_SESSION['verifi_form'])) {
        $systemForm = $_SESSION['verifi_form'];
        unset($_SESSION['verifi_form']);
    }

    // system messages
    $systemMess="";
    if (isset($_SESSION['error_message'])) {
        $systemMess = '<span class="system-mess" id="error-mess">'.$_SESSION['error_message'].'</span>';
        unset($_SESSION['error_message']);
    }

    if (isset($_SESSION['info_message'])) {
        $systemMess = '<span class="system-mess" id="info-mess">'.$_SESSION['info_message'].'</span>';
        unset($_SESSION['info_message']);
    }

    // user session info
    $nick="";
    $firstName="";
    $lastName="";
    $mail="";
    if (isset($_SESSION['loggedin'])) {
        $nick = $_SESSION['username'];
        $firstName = $_SESSION['firstname'];
        $lastName = $_SESSION['lastname'];
        $mail = $_SESSION['email'];
    }

    // load data
    include_once('app/scripts/php/load_data.php');

    // save contet to variables
    $content = file_get_contents("app/fragments/$page.html");
    $pageTemplate = file_get_contents("app/fragments/page.html");
    $header = file_get_contents("app/fragments/_header.html");

    $pageTemplate = str_replace("{base}", $url . $urlDir, $pageTemplate);
    $pageTemplate = str_replace("{title}", $title, $pageTemplate);
    $pageTemplate = str_replace("{header}", $header, $pageTemplate);
    $pageTemplate = str_replace("{navigation}", $navigation, $pageTemplate);
    $pageTemplate = str_replace("{mobilenav}", $mobilenav, $pageTemplate);
    $pageTemplate = str_replace("{content}", $content, $pageTemplate);
    $pageTemplate = str_replace("{systemForm}", $systemForm, $pageTemplate);
    $pageTemplate = str_replace("{systemMess}", $systemMess, $pageTemplate);
    $pageTemplate = str_replace("{nick}", $nick, $pageTemplate);
    $pageTemplate = str_replace("{firstName}", $firstName, $pageTemplate);
    $pageTemplate = str_replace("{lastName}", $lastName, $pageTemplate);
    $pageTemplate = str_replace("{mail}", $mail, $pageTemplate);
    $pageTemplate = str_replace("{meets}", $meets, $pageTemplate);
    $pageTemplate = str_replace("{myMeets}", $myMeets, $pageTemplate);
    $pageTemplate = str_replace("{actionCalendar}", $actionCalendar, $pageTemplate);

    // display content
    echo $pageTemplate;
?>