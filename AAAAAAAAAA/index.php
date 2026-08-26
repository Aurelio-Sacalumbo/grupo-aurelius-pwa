RewriteEngine On

# Impede o erro 404 se o ficheiro ou pasta real existir
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Redireciona tudo para o seu index.php ou controlador de rotas
RewriteRule ^(.*)$ index.php [L,QSA]