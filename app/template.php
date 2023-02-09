<?php

    session_start();

    require('app/scripts/php/db_conn.php');

    if (!isset($_SESSION['loggedin'])) {
        $pages = [
            "home" => "Meets",
            "signup" => "Registrace",
            "login" => "Přihlášení",
            "404" => "404"
        ];
    } else {
        $pages = [
            "login_home" => "Meets",
            "dashboard" => "Profil",
            "logout" => "Odhlásit se",
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

    $title = ($page == "home" ? "" : $pages[$page] . " | ") . "CarMeeter";

    $navigation = "";
    foreach ($pages as $key => $val) {
        if ($key == "404") {
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

    $mobilenav = "";
    foreach ($pages as $key => $val) {
        if ($key == "404") {
            continue;
        }
        $mobilenav .= '<a ' . ($page == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . '</a>';
    }

    // save contet to variables
    $content = file_get_contents("app/fragments/$page.html");
    $pageTemplate = file_get_contents("app/fragments/page.html");
    $header = file_get_contents("app/fragments/_header.html");
    $footer = file_get_contents("app/fragments/_footer.html");

    $pageTemplate = str_replace("{base}", $url . $urlDir, $pageTemplate);
    $pageTemplate = str_replace("{title}", $title, $pageTemplate);
    $pageTemplate = str_replace("{header}", $header, $pageTemplate);
    $pageTemplate = str_replace("{navigation}", $navigation, $pageTemplate);
    $pageTemplate = str_replace("{mobilenav}", $mobilenav, $pageTemplate);
    $pageTemplate = str_replace("{content}", $content, $pageTemplate);
    $pageTemplate = str_replace("{footer}", $footer, $pageTemplate);
    
    // dysplay content
    echo $pageTemplate;

    if(isset($_SESSION['verifi_form'])) {
        echo $_SESSION['verifi_form'];
        unset($_SESSION['verifi_form']);
    }

    if(isset($_SESSION['error_message'])) {
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']);
    }
?>