FROM php:8.4-apache
RUN apt-get update && apt-get upgrade -y && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
