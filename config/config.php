<?php
// Garante que o ficheiro de ligação à base de dados está incluído primeiro
// O dirname(__DIR__) garante o caminho correto mesmo mudando de hospedagem
require_once dirname(__DIR__) . '/config/Banco.php';

// Configurações Globais do Sistema
define('BASE_URL', getenv('APP_URL') ?: 'http://localhost/grupo-aurelius-pwa/');
define('SITENAME', 'Grupo Aurelius');

// Configurações de Fuso Horário para evitar erros de data no servidor
date_default_timezone_set('Africa/Luanda'); 

// Ativação de logs de erro ocultos para produção (Segurança na Hostinger/Render)
if (getenv('DB_HOST')) {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    // Ambiente Local (XAMPP) - Mostra tudo para ajudar a programar
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
?>