FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /docker-practice
COPY ../../.. /docker-practice

RUN a2enmod rewrite