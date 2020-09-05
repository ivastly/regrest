FROM php:7.4-cli
RUN apt update \
    && pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug
