FROM php:8.2-apache

# Ativa o módulo de reescrita do Apache para ler o .htaccess
RUN a2enmod rewrite

# Copia todo o conteúdo da sua pasta para o diretório web do Docker
COPY . /var/www/html/

# Garante que o Apache tem permissões para ler/escrever ficheiros e carregar as fotos 177*.jpg
RUN chown -R www-data:www-data /var/www/html/

# Expõe a porta de rede padrão
EXPOSE 80