FROM php:8.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN /etc/init.d/apache2 restart
