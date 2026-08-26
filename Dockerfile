FROM php:8.2-apache

# Instala as extensões nativas do MySQL para PDO
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo pdo_mysql

# Ativa o módulo de reescrita do Apache para ler o .htaccess
RUN a2enmod rewrite

# Copia todo o conteúdo da pasta local para o servidor
COPY . /var/www/html/

# Ajusta as permissões de leitura do servidor Apache
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80