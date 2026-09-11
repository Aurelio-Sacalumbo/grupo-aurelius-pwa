FROM php:8.2-apache

# Instala as dependências necessárias para o PostgreSQL e limpa resíduos
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Ativa o módulo de reescrita do Apache
RUN a2enmod rewrite

# Altera a configuração do Apache para permitir a leitura do .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copia os ficheiros do projeto para o diretório web do servidor
COPY . /var/www/html/

# Ajusta as permissões de leitura e escrita para o servidor Apache
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80