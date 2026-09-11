<?php
// =========================================================================
// 🔑 CONEXÃO MASTER PROVENIENTES DO ECOSSISTEMA BARBEARIASANGOLA (AIVEN)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_localhost = ($_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost');

if ($is_localhost) {
    $host     = "127.0.0.1";
    $port     = 3306;
    $dbname   = "aurelius_salao";
    $username = "root";
    $password = "";
} else {
    $host     = "mysql-1a34c184-aureliosacalumbo42-bf60.a.aivencloud.com"; 
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
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, $opcoes);
} catch (PDOException $e) {
    die("<p style='color:red; text-align:center;'>🚨 Erro de Rede: " . $e->getMessage() . "</p>");
}
?>