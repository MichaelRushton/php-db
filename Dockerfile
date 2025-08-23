ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-alpine
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apk add --no-cache autoconf g++ linux-headers make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ linux-headers make