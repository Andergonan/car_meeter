# Dev documentation
- *[Template systém](#template-systém)*
    - *[Routing](#routing)*
- *[Přihlášení uživatele](#přihlášení-uživatele)*
- *[Registrace uživatele](#registrace-uživatele)*
    - *[Ověření hesla](#ověření-hesla)*
    - *[Ověření uživatele](#ověření-uživatele)*
        - *[Ověření e-mailu](#ověření-e-mailu)*
- *[SMTP a jeho nastavení](#smtp-a-jeho-nastavení)*

## Template systém
### Routing


## Přihlášení uživatele
1) *template.php* přesměrovává na fragment *login.html*
2) `<form/>` volá scripty authorization
3) po úspěšném přihlášení je uživateli spuštěna session pro přihlášené

- uživatel je přihlášen pouze tehdy, zadá-li správné přihlašovací údaje

*login.php*
```
    <?php 
        if ($mysql->num_rows > 0) {
        $mysql->bind_result($id, $password);
        $mysql->fetch();

            if (password_verify($_POST['password'], $password)) {

                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                header('Location: http://localhost/car_meeter/login_home');
            } else {

                $_SESSION['error_message'] = 'Zadané přihlašovací údaje jsou nesprávné!';
                header("Location: http://localhost/car_meeter/login");
                exit;
            }
        } else {
            
            $_SESSION['error_message'] = 'Zadané přihlašovací údaje jsou nesprávné!';
            header('Location: http://localhost/car_meeter/login');
            exit;
        }
    ?>
```

## Registrace uživatele

1) *template.php* přesměrovává na fragment *signup.html*
2) `<form/>` volá scripty authorization
3) po úspěšné registraci je uživatel uložen do DB (jméno a příjmení prochází triggerem)

### Ověření hesla

- heslo je schváleno pouze tehdy... 
    1) obsahuje-li minimálně 8 znaků
    2) obsahuje alespoň jedno velké a jedno malé písmeno
- heslo je kontrolováno regulárními výrazy na straně serveru
- pro šifrování hesel je využívána funkce [`password_hash()`](https://www.php.net/manual/en/function.password-hash.php)

### Ověření uživatele

- uživatelské jméno je schváleno pouze tehdy...
    1) uživatelské jméno ještě neexistuje
- jméno a příjmení je schváleno pouze tehdy...
    1) neobashuje-li mezeru, číslici či jiný znak než písmeno

#### Ověření e-mailu

- e-mailová adresa je schválena pouze tehdy...
    1) e-mailová adresa není v databázi již uložena
    2) splňuje parametry e-mailové adresy (jmeno@domena.cz)
- Před úspěšnou registrací, je novému uživateli na jeho uvedenou e-mailovou adresu zaslán 4-místný ověřovací kód. Stejný kód je uložen i do `$_SESSION['verifi_code']` jako hash.

*app/scripts/php/auth/auth_functions.php*
```
<?php 
    function verifiMe() {
            
        $code = rand(1000, 9999); // generuje 4-místný kód

        $_SESSION['verifi_code'] = password_hash($code, PASSWORD_DEFAULT); // ukládá jako hash do session

        /* posílá na uvedený e-mail */
        $to = $_POST['email'];
        $subject = "CarMeeter verification code";
        $message = "Your verification code is: " . $code; // $code = nezašifrovaný kód
        $headers = "From: istesovaniovereni@gmail.com";
        mail($to, $subject, $message, $headers);
    }
?>
```
> Funkce `verifiMe()` je volána ve funkci `savePostsToSessions()`
> `savePostsToSessions()` je volána v *signup.php*

- Pokud uživatel zadá správný kód, tak se jeho data uloží do databáze a registrace je vyhodnocena jako úspěšná.

*verifi.php*
```
<?php
    
    session_start();
    
    require("../db_conn.php"); // připojení k DB
    require("auth_functions.php"); // funkce
    
    /* pokud je odeslané heslo shodné s hash v session tak... */
    if (password_verify($_POST['verification_code'], $_SESSION['verifi_code'])) {
        
        $mysql = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $mysql->bind_param('sss', $_SESSION['username'], $_SESSION['email'], $_SESSION['password']);
        $mysql->execute();
        $mysql->close();
        $conn->close();

        $_SESSION['error_message'] = "Registrace proběhla úspěšně, nyní se můžete přihlásit!";
        header("Location: http://localhost/car_meeter/login"); // přesměrování na login page
        exit;
    } else {

        loadSessions(); // znovu načte data + zobrazí error_message
    }
?>
```
> `loadSessions()` načítá uložená data z `savePostsToSessions()`

## SMTP a jeho nastavení

- je nutné upravit soubor php.ini a sendmail.ini

1. jděte na *xampp\sendmail* a otevřete soubor *sendmail.ini*
    - **změňte** smtp_server=mail.mydomain.com **na** smtp_server=smtp.gmail.com
    - **změňte** smtp_port **na** smtp_port=465
    - **změňte** ;error_logfile=error.log **na** error_logfile=error.log
    - **změňte** ;debug_logfile=debug.log **na** debug_logfile=debug.log
    - **změňte** auth_username= **na** auth_username=FUNKČNÍ@EMAIL.SMILE
    - **přepište** auth_password= **na** auth_password=****

2. jděte na *xampp\php* a otevřete soubor *php.ini*
    - **změňte** sendmail_from= **na** ;sendmail_from=
    - **změňte** ;sendmail_path= **na** sendmail_path="\"C:\xampp\sendmail\sendmail.exe\" -t"
