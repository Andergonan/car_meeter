# Dev documentation
- <a href="signup">Registrace uživatele</a>
    - <a href="signup_password">Ověření hesla</a>
    - <a href="signup_auth">Ověření uživatele</a>
        - <a href="signup_smtp">SMTP a jeho nastavení</a>

## "Framework"
### Routing
### Template system


## Registrace uživatele
<a name="signup"></a>

- *template.php* přesměrovává na fragment *signup.html*
- `<form/>` volá *app/scripts/php/auth/signup.php*

### Ověření hesla
<a name="signup_password"></a>

### Ověření uživatele
<a name="signup_password"></a>

#### SMTP a jeho nastavení
<a name="smtp"></a>

- je nutné upravit soubor php.ini a sendmail.ini

1. jděte na *xampp\sendmail* a otevřete soubor *sendmail.ini*
    - **změňte** smtp_server=mail.mydomain.com **na** smtp_server=smtp.gamil.com
    - **změňte** smtp_port **na** smtp_port=465
    - **změňte** ;error_logfile=error.log **na** error_logfile=error.log
    - **změňte** ;debug_logfile=debug.log **na** debug_logfile=debug.log
    - **změňte** auth_username= **na** auth_username=istesovaniovereni@gamil.com
    - **přepište** auth_password= **na** auth_password=****

2. jděte na *xampp\php* a otevřete soubor *php.ini*
    - **změňte** sendmail_from= **na** ;sendmail_from=
    - **změňte** ;sendmail_path= **na** sendmail_path="\"C:\xampp\sendmail\sendmail.exe\" -t"