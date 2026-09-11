<?php
// =========================================================================
// 🔑 CONEXÃO MASTER CENTRALIZADA — ECOSSISTEMA BARBEARIASANGOLA (AIVEN)
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
    // ✨ CREDENCIAIS NATIVAS DA INFRAESTRUTURA AIVEN CLOUD
    $host     = "://aivencloud.com"; 
    $port     = 22002; 
    $dbname   = "defaultdb";
    $username = "avnadmin";
    $password = "AVNS_6AyaHMtSplThuvy6uGm";
}

try {
    $opcoes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4, SESSION sql_mode=''"
    ];
    
    // Instancia a conexão mestre global do ecossistema
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, $opcoes);
    
    // Cria um fallback de compatibilidade caso alguma página antiga ainda procure pela variável $conn
    $conn = @mysqli_connect($host, $username, $password, $dbname, $port);
    if($conn) { mysqli_set_charset($conn, "utf8mb4"); }

} catch (PDOException $e) {
    die("<p style='color:red; text-align:center; font-family:sans-serif;'>🚨 Falha na Infraestrutura de Ligação: " . $e->getMessage() . "</p>");
}
?>