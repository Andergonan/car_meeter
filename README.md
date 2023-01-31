# Car Meeter
- *version 0.2.2*
- *last update 31.01.2023*

## Rozcestník
- *[konvence](docs/konvence.md)*
- *[dev documentation](docs/dev.md)*

## Version log

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