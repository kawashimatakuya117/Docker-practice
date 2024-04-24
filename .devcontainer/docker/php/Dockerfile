FROM php:8.2-apache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales graphviz libfreetype6-dev libjpeg62-turbo-dev libpng-dev mariadb-client gnupg && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    locale-gen en_US.UTF-8 && \
    localedef -f UTF-8 -i en_US en_US.UTF-8 && \
    docker-php-ext-install intl pdo_mysql zip bcmath gd && \
    # composer
    composer config -g process-timeout 3600 && \
    composer config -g repos.packagist composer https://packagist.org

WORKDIR /docker-practice

RUN a2enmod rewrite