# Fanshop

Met dit project kunnen leden van de fanclub met hun geboortedatum en lidnummer eenmalig een cadeau aanvragen.
Ook is het mogelijk om een csv file in te lezen in de database.

## Installation

1. **Clone repository**
   '''bash
   git clone https://github.com/Maarten12334/Taak-Yappa
   '''
2. **Configure .env file**
   Add database settings and app key

3. **Dependencies:**
   '''bash
   composer install
   '''

4. **Create Database:**
   '''bash
   php bin/console doctrine:database:create
   '''

5. **Migrations:**
   '''bash
   php bin/console doctrine:migrations:migrate
   '''
6. **Import CSV file:**
   '''bash
   php bin/console app:import-csv "yourcsv.csv"
   '''
