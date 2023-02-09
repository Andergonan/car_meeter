# Car Meeter
- *version 0.6.7*
- *last update 09.02.2023*

## Rozcestník
- *[konvence](docs/konvence.md)*
- *[dev documentation](docs/dev.md)*

## Version log

### Co je nového ve verzi 0.6.7
- úprava registrace + DB
    - přidána pole - jméno (firstname) a příjmení (lastname)
        - *verifi.php*
        - *auth_functions.php*
        - *db.sql*
        - přídání trigger do DB pro tabulku users (úprava jména a příjmení)
    - validace jména a příjmení
        - nesmí obsahovat jiné znaky než-li písmena
- zprovozněno přihlašování uživatelů
    - úprava *login.php*
- přidání balíčku ikon
- přidáno stylování
    - navigace
    - formuláře
    - 404 (animace)
    - atd.
- zprovozněna navigace pro mobilní zařízení
- **NEFUNKČNÍ ODHLAŠOVÁNÍ**

### Co je nového ve verzi 0.2.5
- úprava a zabezpečení registrace
    - úprava *signup.php*
    - přidání scriptu *verifi.php*
    - zabezpečený způsob posílání verifikace
    - registrace plně funkční
- opraven rozcestník dokumentace
- úprava dokumentace

### Co je nového ve verzi 0.2.2
- přejmenování "register" na "signup"
- upravení dokumentace
    - přidání konvencí
    - oddělení dokumentace pro vývojáře
- úprava registračního sryptu
    - ověřování e-mail adres
    - **OVĚŘENÍ NEFUGUJE, PŘEDMĚT DALŠÍHO UPDATU!!!**
- odesílání ověřovacího e-mailu novému uživateli
    - pro testovací účely je využívána schránka a [SMTP seznam.cz](https://napoveda.seznam.cz/cz/imap-pop3-smtp/)

### Co je nového ve verzi 0.0.8
- kontrola zadávaného hesla
    - počet znaků (min. 8)
    - kontrola velkých a malých písmen (min. 1 velké a jedno malé)
- přidání e-mailové adresy do ověření (nesmí být již v databázi)
- kontrola e-mailové adresy, zda odpovídá formátu (text@text.domena)
- chybové zprávy a přesměrování z register.php na template.php a následně register