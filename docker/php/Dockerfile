FROM composer:2 AS composer

FROM php:7.4-fpm-alpine

RUN apk add --update \
    $PHPIZE_DEPS

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

ADD php.ini /usr/local/etc/php

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm", "-F"]
