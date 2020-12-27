# E-Commerce

## Install

First install dependecies with docker:

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

Then generate key:

`sail php artisan key:generate`

Create tables and add data:

```php
sail php artisan migrate:refresh
sail php artisan db:seed --class=UserSeeder
```
