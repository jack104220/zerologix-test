FROM php:8.0.10-apache

RUN apt-get update && apt-get install -y wget git libssl-dev libzip-dev zip

RUN pecl install swoole \
    && docker-php-ext-enable swoole

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN pecl install zip

RUN docker-php-ext-install bcmath ctype pdo_mysql pcntl zip

RUN wget https://github.com/composer/composer/releases/download/2.1.6/composer.phar
RUN chmod u+x composer.phar

RUN mv composer.phar /usr/local/bin/composer

RUN mkdir /laravel
WORKDIR /laravel

# FROM php8:0.0.0
# CMD ["php", "artisan", "octane:start", "--host=0.0.0.0"]

