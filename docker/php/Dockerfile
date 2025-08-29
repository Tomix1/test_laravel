FROM php:8.4-fpm

WORKDIR /var/www/html

# Install base software
RUN apt-get update \
    && apt-get install -y \
        zsh \
        git \
        curl \
        zip \
        unzip \
        libzip-dev \
        wget

# Install base php extensions
RUN pecl install \
        redis \
        zip

RUN docker-php-ext-install \
        pdo \
        pdo_mysql

# Install FPM default port number
EXPOSE 9000

# Install composer
RUN curl -sS https://getcomposer.org/installer  \
    | php -- --install-dir=/usr/local/bin --filename=composer