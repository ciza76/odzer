FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libintl \
    libexif-dev

RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    intl \
    exif

RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

RUN apk add mysql mysql-client
RUN apk add mariadb-connector-c