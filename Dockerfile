FROM php:7.4-apache

COPY . /var/www/html/parking

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]