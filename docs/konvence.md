# Konvence

- [Psaní kódu](#jak-psát-kód)
- [Git commit](#git-commit)
    - [Issues](#issues)
    - [Branches](#braches)
    - [How (git tutorial)](#how-git-tutorial)
- [Verzování](#verzování)

## Jak psát kód

- přehledně
- nedělej to, co je hotové
    - pokud narazíš na část kódu, která se zbytečně opakuje, zkus ji zobjektnit
- komentuj krátce a stručně a pouze tehdy, pokud je to potřeba

## Git commit

- nikdy nový kód nepushuj do main
- vytvoř novou brach a následně pullrequest

### Issues

- vždy issue pojmenuj tak, aby bylo jasné o co se jedná
- do popisu uveď detaily
- tvoř ve tvaru `štítek: co se řeší`

### Braches

- vždy uváděj ve tvaru `štíket_version_issue`
    - `update_0.2.3_dej-harrymu-nove-koste`
- štítky a verzování
    - `update`
        - posouvá *version* v druhém řádu (0.ZDE.0)
        - pokud se dostane na hodnotu 0.9.0, posouvá první řád o +1
        - kolik nových funkcí řešíš o tolik přičti číselnou hodnotu ke stávající v řádu `update`
    - `bug`
        - posouvá *version* ve třetím řádu (0.0.ZDE)
        - pokud se `bug` dostane na hodnotu 0.0.9, posouvá nahoru o +1 řád pro `update`
        - kolik bugů řešíš o tolik přičti číselnou hodnotu ke stávající v řádu `bug`
        - jakékoliv úpravy dokumentace se počítají pouze do řádu `bug`
- vždy řádně uprav soubor *README.md*

### How (git tutorial)

- naklonování main `git clone "URL"`
- přepnutí na hlavní brach `git checkout main`
- vytvoří novou brach `git branch <nazev_nove_branch>`
- přepne do nové brach `git checkout <nazev_nove_branch>`
- ověří aktuální větev `git branch`
- přidá nové soubory do brach `git add .`
- provede commit `git commit -m "zprava k commitu"`
- přidá změny do branch na gitu `git push origin <nazev_branch>`

# Verzování

- máme 3 řády `1.2.3`
    - `1.` řád `main`
    - `2.` řád `update`
    - `3.` řád `bug`
- všechny řády jsou vždy aktualizován způsobem **+1 funkciolita/problém**
- řád `bug`
    - vždy +1 bug
    - vždy +1 úpravy dokumentace
    - vždy +1 podfunkce hlavní nové funkce, nebo úprava podfunkce
- řád `update`
    - vždy +1 zcela nová funkce

*příklad*

>- přidána možnost registrace **+1 update**
>- úprava generování tabulek **+1 bug**
>    - přidáno ... **+0**