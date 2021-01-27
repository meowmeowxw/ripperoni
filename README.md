# Ripperoni

Project made by:
* Giovanni Di Santi (giovanni.disanti@studio.unibo.it)
* Massimiliano Conti (massimiliano.conti8@studio.unibo.it)

## Install

If `php` and `composer` are installed then you can install dependencies with:

`composer install`

otherwise use docker:

```sh
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
```

## Run

Alias sail:

`alias sail="./vendor/bin/sail"`

Copy .env:

`cp .env.develop .env`

Start the server:

`sail up`

Then generate key:

`sail php artisan key:generate`

Create tables and add data:

```php
sail php artisan migrate:fresh
sail php artisan db:seed
```

Install js/css dependencies and compile sass:

```sh
npm install
npm run prod
# Alternative to create a debuggable non-minified js/css
# npm run dev
```

## Relazione (ITA)

`Ripperoni` è scritto in laravel 8, bootstrap 4, html 5 e jquery.

Per la fase di development abbiamo usato [sail](https://laravel.com/docs/8.x/sail), che ci
permette di avere un ambiente dockerizzato semplice da usare (Su windows è consigliato
avere WSL2). Una volta lanciato il comando `./vendor/bin/sail up` possiamo 
accedere all'interfaccia web su `http://localhost` e al mail server su `http://localhost:8025`.

### Struttura

Il progetto è stato pensato con i principi del design mobile-first, abbiamo usato bootstrap
per raggiungere lo scopo. Inizialmente abbiamo fatto dei [mockups](./mockups)

### Sicurezza

Il sito è protetto contro attacchi di tipo:

* [SQL Injection](https://portswigger.net/web-security/sql-injection)
* [XSS](https://portswigger.net/web-security/cross-site-scripting)
* [CSRF](https://portswigger.net/web-security/csrf)

Inoltre applichiamo degli hash **sicuri** alle password prima di salvarle nel DB.

### Notifiche

Le notifiche sono di due tipi email:

* Creazione utente
* Ordine (sia per il customer che per i seller)
* Cambio stato dell'ordine (per il customer)
* Cambio password (per ogni tipo di utente)

E javascript:

* Creazione ordine (sia per il customer che per i seller)
* Cambiamento dello stato dell'ordine (per il customer)

### Ajax

Abbiamo usato ajax nella ricerca prodotto e nell'aggiornamento delle quantità del carrello.
