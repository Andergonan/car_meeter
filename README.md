# Car Meeter
- *version 0.0.8*
- *last update 26.01.2023*

## Rozcestník
- *[konvence](docs/konvence.md)*
- *[dev documentation](dosc/dev.md)*

## Version log

### Co je nového ve verzi 0.2.2
- přejmenování "register" na "signup"
- upravení dokumentace
    - přidání konvencí
    - oddělení dokumentace pro vývojáře
- úprava registračního sryptu
    - ověřování e-mail adres ?
- propojení s SMTP ?
    - vytvořen na localhostu
    - plně funkční

### Co je nového ve verzi 0.0.8
- kontrola zadávaného hesla
    - počet znaků (min. 8)
    - kontrola velkých a malých písmen (min. 1 velké a jedno malé)
- přidání e-mailové adresy do ověření (nesmí být již v databázi)
- kontrola e-mailové adresy, zda odpovídá formátu (text@text.domena)
- chybové zprávy a přesměrování z register.php na template.php a následně register