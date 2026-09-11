<?php
// =========================================================================
// 🔑 CONEXÃO MASTER COMPATÍVEL COM INFRAESTRUTURA AIVEN MYSQL (BLINDADA)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_localhost = ($_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost');

if ($is_localhost) {
    // Configurações Locais de Desenvolvimento (XAMPP)
    $host     = "127.0.0.1";
    $port     = 3306;
    $dbname   = "aurelius_salao";
    $username = "root";
    $password = "";
} else {
    // ✨ CREDENCIAIS EXATAS DA TUA NOVA INFRAESTRUTURA AIVEN CLOUD
    $host     = "://aivencloud.com"; 
    $port     = 22002; 
    $dbname   = "defaultdb";
    $username = "avnadmin";
    // RELEMBRE: Insira a senha real revelada no painel da Aiven aqui abaixo
    $password = "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ"; 
}

try {
    // ✨ SOLUÇÃO DA LINHA 34: Removeu-se a constante inexistente que travava o Render
    $opcoes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4, SESSION sql_mode=''"
    ];
    
    // Inicia a conexão segura nativa que roda em qualquer servidor do mundo
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, $opcoes);
} catch (PDOException $e) {
    die("<p style='color:red; text-align:center; font-family:sans-serif;'>🚨 Falha de Infraestrutura no Ecossistema Aurélius: " . $e->getMessage() . "</p>");
}
?>