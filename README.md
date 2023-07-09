# WTVIS
Second Year App Dev Project

Site URL once put onto a VM’s /var/www/html:  http://127.0.0.1/WTVIS/index.php
It is a web application, so no client will be downloaded.

URL of the source of the original data: https://data.world/notgibs/pokemon-wonder-trade-results 
Fields used: Pokemon,	Trainer Region,	Pokemon Region, Level, Level Met, Gender, Type1, Type2, Nature, Pokeball, Held Item, Perfect IVs.
Data fields that were not included in the database: Date, Time, Trainer Subregion.
Database name: wtrades
Table name: TRADES

The week 8 BooksAPI_PHP was used as a base framework for the visualisation. RestService.php, .httaccess, and the scripts that boot up jQuery were not changed. The rest were altered to fit the new visualisation, with webservicedemo.js and PokemonRestService.php having major alterations and extensions to the code.
Pokemon.php used books.php as a point of reference for how to make it as a class.

User inputs text into boxes and presses the box’s specific ‘GO!’ button, and data for that specific field is shown. The 1 input type – 1 button limitation was a result of wanting to keep my API human comprehendible, as I was already having it specify between integers and text.
