FROM php:7.4-cli
RUN apt update \
    && apt install -y git \
    && pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug
