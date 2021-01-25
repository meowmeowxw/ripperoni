# Ripperoni

## Install

If `php` is installed you can install dependencies with:

`php composer install`

or use docker:

```sh
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
```

Alias sail:

`alias sail="./vendor/bin/sail"`

Start the server:

`sail up`

Copy .env:

`cp .env.example .env`

Then generate key:

`sail php artisan key:generate`

Create tables and add data:

```php
sail php artisan migrate:fresh
sail php artisan db:seed
```

Install js/css components:

```sh
npm install
npm run prod
# Alternative to create a debuggable non-minified js/css
# npm run dev
```

## Relazione (ITA)

`Ripperoni` è scritto in laravel 8, bootstrap 4, html 5 e jquery.

Per la fase di development abbiamo usato [sail](https://laravel.com/docs/8.x/sail), che ci
permette di avere un ambiente dockerizzato semplice da usare. Una volta fatto partire con
`./vendor/bin/sail up` il programma possiamo accedere all'interfaccia web su `http://localhost`
e al mail server su `http://localhost:8025`.

### Struttura

Il progetto è stato pensato con i principi del design mobile-first, abbiamo usato bootstrap
per raggiungere lo scopo. Inizialmente abbiamo fatto dei [mockups](./mockups)

### Sicurezza

Il sito è protetto contro attacchi di tipo:

* [SQL Injection](https://portswigger.net/web-security/sql-injection)
* [XSS](https://portswigger.net/web-security/cross-site-scripting)
* [CSRF](https://portswigger.net/web-security/csrf)

### Notifiche

Le notifiche sono via email e vengono inviate in questi casi:

* Creazione utente
* Ordine (sia per il customer che per il seller)
* Cambio stato dell'ordine (per il customer)
* Cambio password (per ogni tipo di utente)

### Ajax

Abbiamo usato ajax nella ricerca prodotto e nell'aggiornamento delle quantità del carrello.
