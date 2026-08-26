FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/html/
RUN a2enmod rewrite && chown -R www-data:www-data /var/www/html/
EXPOSE 80