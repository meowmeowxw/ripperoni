# Ripperoni

## Team

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

`Ripperoni` è un sito e-commerce di birre scritto in laravel 8, bootstrap 4, html 5 e jquery.

### Struttura

Il progetto è stato pensato con i principi del design mobile-first, abbiamo usato bootstrap
per raggiungere lo scopo. Inizialmente abbiamo fatto dei [mockups](./mockups).

Ci sono vari tipi di utenti, che possono effettuare le seguenti azioni:

#### Guest

* Navigare i prodotti ed eseguire ricerche

#### Customer

* Cambiare i propri dati personali e la password
* Può aggiungere al carrello i prodotti
* Effettuare ordini e visualizzarli, verificandone lo stato (waiting, confirmed, shipped, delivered)

#### Seller

* Aggiungere prodotti
* Modificare e cancellare i propri prodotti
* Visualizzare e modificare lo stato degli ordini
* Cambiare i propri dati personali e la password

### Development

Per la fase di development abbiamo usato [sail](https://laravel.com/docs/8.x/sail), che ci
permette di avere un ambiente dockerizzato semplice da usare (Su windows è consigliato
avere WSL2). Una volta lanciato il comando `./vendor/bin/sail up` possiamo 
accedere all'interfaccia web su `http://localhost` e al mail server su `http://localhost:8025`.

In production [(heroku)](https://www.heroku.com) usiamo:

* [Mail trap](https://mailtrap.io/) per mandare le mail
* [AWS S3](https://aws.amazon.com/s3/) per salvare le immagini dei nuovi prodotti inseriti

### Sicurezza

Il sito è protetto contro attacchi di tipo:

* [SQL Injection](https://portswigger.net/web-security/sql-injection)
* [XSS](https://portswigger.net/web-security/cross-site-scripting)
* [CSRF](https://portswigger.net/web-security/csrf)

Inoltre applichiamo degli hash **sicuri** alle password prima di salvarle nel DB.

### Notifiche

Le notifiche sono di due tipi:

#### Email

* Creazione utente
* Ordine (sia per il customer che per i seller)
* Cambio stato dell'ordine (per il customer)
* Cambio password (per ogni tipo di utente)

#### Javascript

* Creazione ordine (sia per il customer che per i seller)
* Cambiamento dello stato dell'ordine (per il customer)

### Ajax

Abbiamo usato ajax nella ricerca prodotto e nell'aggiornamento delle quantità del carrello.
