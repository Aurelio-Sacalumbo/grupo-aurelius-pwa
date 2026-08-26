FROM php:8.2-apache

# Instala as dependências necessárias e as extensões MySQLi e PDO
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Ativa o módulo de reescrita do Apache para ler o .htaccess
RUN a2enmod rewrite

# Copia todo o conteúdo da pasta local para o servidor
COPY . /var/www/html/

# Ajusta as permissões de leitura do servidor Apache
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80