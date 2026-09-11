<?php
// =========================================================================
// 🔑 CONEXÃO MASTER COMPATÍVEL COM INFRAESTRUTURA AIVEN MYSQL (FIXED)
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
    // ✨ CREDENCIAIS EXATAS CORRIGIDAS CONTRA O ERRO DE ENDEREÇO NO RENDER
    $host     = "://aivencloud.com"; 
    $port     = 22002; 
    $dbname   = "defaultdb";
    $username = "avnadmin";
    $password = "AVNS_6AyaHMtSplThuvy6uGm"; // Senha real ativa da Aiven
}

try {
    // Inicialização segura do motor PDO adaptado para o Linux do Render
    $opcoes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4, SESSION sql_mode=''"
    ];
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, $opcoes);
} catch (PDOException $e) {
    die("<p style='color:red; text-align:center; font-family:sans-serif;'>🚨 Falha de Infraestrutura no Ecossistema Aurélius: " . $e->getMessage() . "</p>");
}
?>