# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Ativa as extensões do MySQL/MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN echo "DirectoryIndex Principal.php index.php index.html" >> /etc/apache2/apache2.conf

# Copia os arquivos do site para o servidor
COPY . /var/www/html/

# Altera a porta padrão do Apache de 80 para 10000 (Exigência do Render)
RUN sed -i 's/80/10000/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

# 🎯 DIRETRIZ CRÍTICA: Força o Apache a usar o Principal.php como página inicial padrão
RUN echo "DirectoryIndex Principal.php index.php index.html" >> /etc/apache2/apache2.conf

# Garante as permissões de leitura
RUN chown -R www-data:www-data /var/www/html/

# Expõe a porta correta do Render
EXPOSE 10000