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

Start the server:

`./vendor/bin/sail up`

Then generate key:

`./vendor/bin/sail php artisan key:generate`
