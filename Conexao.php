<?php
// =========================================================================
// 🔑 CONEXÃO CENTRALIZADA AMBIENTALIZADA — ECOSSISTEMA BARBEARIASANGOLA (AIVEN)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Deteta automaticamente se está a rodar no computador (Localhost) ou na Nuvem (Render)
$is_localhost = ($_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost');

if ($is_localhost) {
    // 🖥️ Ambiente Local (XAMPP)
    $db_host = "127.0.0.1";
    $db_port = 3306;
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";
} else {
    // 🌍 Ambiente de Produção Online (Render conectado à Aiven MySQL 8.4)
    $db_host = "://aivencloud.com";
    $db_port = 22002;
    $db_user = "avnadmin";
    $db_pass = "AVNS_6AyaHMtSplThuvy6uGm"; // Senha real ativa da Aiven
    $db_name = "defaultdb";
}

// 1. ENGINE DE CONEXÃO PDO (Para o monitor de fluxo, pautas e gráficos)
try {
    $opcoes_pdo = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4, SESSION sql_mode=''"
    ];
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, $opcoes_pdo);
} catch (PDOException $e) {
    die("🚨 Falha na infraestrutura PDO Aurélius: " . $e->getMessage());
}

// 2. ENGINE DE CONEXÃO MYSQLI TRADICIONAL (Suporte para faturamento, login e perdas)
if ($is_localhost) {
    $conexao_aurelius = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
    // Fallback caso o Windows rejeite o IP de loopback
    if (!$conexao_aurelius) {
        $conexao_aurelius = @mysqli_connect("localhost", "root", "", "aurelius_salao");
    }
} else {
    // Conexão segura nativa para o Linux do Render
    $conexao_aurelius = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
}

// Se não ligar a nenhuma das duas portas, dispara o aviso estrutural
if (!$conexao_aurelius) {
    die("🚨 Erro Crítico: A infraestrutura de ligação híbrida não pôde ser iniciada: " . mysqli_connect_error());
}

// Aplicação global de charset e desativação do modo estrito SQL
mysqli_set_charset($conexao_aurelius, "utf8mb4");
mysqli_query($conexao_aurelius, "SET SESSION sql_mode=''");

// Cria variáveis de compatibilidade caso outras páginas usem nomes diferentes
$conn = $conexao_aurelius;
?>