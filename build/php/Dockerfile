FROM php:fpm

RUN apt-get update && apt-get install -y git libzip-dev

RUN docker-php-ext-install bcmath sockets zip

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1