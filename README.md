# Car Meeter
- *version 1.6.9*
- *last update 06.03.2023*

Sociální síť pro plánování tuning srazů

## Rozcestník
- *[konvence](docs/konvence.md)*
- *[dev documentation](docs/dev.md)*

## Version log

## Co je nového ve verzi 1.6.9
- úprava ikony zančící, zda je sraz organizovaný, nebo volný
    - přidání popisu
- nalezen a opraven bug v DB
    - "není možno, se zapsat na sraz"
    - chybějící definice NOT NULL u party
- nový způsobu načtení komponets
    - nový script *load_data.php*
    - úprava scriptu *load_meet.php*
- nová funkce - načtení vlastních srazů
    - sript *load_my_meet.php*
- nová funkce - možnost úpravy vlastních srazů
    - script *update_meet.php*
- zabezpečení vstupů formuláře pro zakládání nových srazů
- zabezpečení meets
    - přidáno hash_meet (každý sraz má svůj hash)
    - při úpravě se ověřuje meet_id, meet_hash a organizer_id
- úprava stylování
- nalezen a opraven bug - REGISTRACE UŽIVATELŮ
    - při registraci nemohl uživatel zadat jméno s diakritikou
    - vyřešeno úpravou regulárního výrazu
    - úprava v *signup.php*
- aktualizace loga
- nalezen a opraven bug - ÚPRAVA SRAZŮ
    - uživatel nemohl uložit upravená data, dokud nezměnil název srazu
    - upraven script *update_meet.php*
- přidán kalendář akcí
- úprava dokumentace (stále nekompletní)

## Co je nového ve verzi 1.2.9
- úprava fragmentu *dashboard.hmtl*
    - dashboard navigace (ikony)
    - texty
- úprava *style.css* hromadného class "flex-content"
    - přidání atributu "color: #fff"
- přidána nová funkce zápisu na sraz
- přidána nová funkce odhlšení ze srazu

## Co je nového ve verzi 1.0.7
- úprava stylování
    - fragment *dashboard.html*
        - úprava formuláře pro nové srazy
    - Pozadí meet-form
- úprava fragmentu *dashboard.html*
- nalezen a následně opraven bug při zobrazení 'error_message'
- úprava zabezpečení posílaných dat formulářem
    - script *new_meet.php* & script *signup.php*
        - přidání kontroly maximálního počtu znaků
- GDPR
    - úprava zabezpečení
    - nový fragment *personaldata.html*
    - upravení stylů
    - úprava registračního formuláře
    - úprava auth scriptů
    - úprava DB
- úprava dokumentace
- úprava DB
    - přejmenování v DB Meets sloupce "username" na "organizer"
- úprava scriptu *load_meet.php*
    - přidání funkce `nl2br()`, pro zamlamování vypisovaných dat z DB
- úprava js scryptu *dashboard.js*
    - automatické vyplnění aktuálního času
    - zprovnění tlačítka na dasboardu
- přidána funkce, pro změnu osobních údajů
    - možnost změny emailu, jména, příjmení, uživatelského jména a hesla
    - pro změnu e-mailu, je nutno zadat ověřovací kód z nové adresy
- úprava responsivity

## Co je nového ve verzi 0.8.9
- vyřešeno Plánování srazů #19
- úprava dokumentace
- úprava databáze
    - přidání nové tabulky "meets" do schématu
- úprava fragmentu *dashboard.html*
    - stylování
- úprava fragmentu *home.html*

### Co je nového ve verzi 0.7.5
- oprava navigace pro přihlášené
- oprava odhlašování
    - úprava scryptů *template.php*, *logout.php*, *auth_functions.php*
- úprava fragmentu *logout.html*
- úprava stylování
- úprava dokumentace
- úprava fragmentu *dashboard.html*
- přidána funkce pro kontrolu hesla
    - only server-side
    - pokud se hesla neshodují, tak se registrační formulář neodešle
- úprava animace na fragmentu 404
    - nyní je animce responzibilní

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
    - pro testovací účely je využívána schránka a SMTP gmail.com

### Co je nového ve verzi 0.0.8
- kontrola zadávaného hesla
    - počet znaků (min. 8)
    - kontrola velkých a malých písmen (min. 1 velké a jedno malé)
- přidání e-mailové adresy do ověření (nesmí být již v databázi)
- kontrola e-mailové adresy, zda odpovídá formátu (text@text.domena)
- chybové zprávy a přesměrování z register.php na template.php a následně register
