<?php
// =========================================================================
// 🔮 ECOSSISTEMA MESTRE - LIGAÇÃO TOTALMENTE MYSQL (XAMPP LOCAL & AIVEN NUVEM)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuração oficial do fuso horário de Angola
date_default_timezone_set('Africa/Luanda');

// 🟢 1. DETEÇÃO AUTOMÁTICA DE AMBIENTE (LOCALHOST VS HOSPEDAGEM SEGURA)
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    
    // 💻 AMBIENTE LOCAL (Configuração para o seu XAMPP/MySQL)
    $db_host = "127.0.0.1";
    $db_port = "3306";
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";

} else {
    
    // ☁️ AMBIENTE DE HOSPEDAGEM REAL (Puxa os dados injetados pelo painel do Render para o Aiven)
    $db_host = getenv('DB_HOST');
    $db_port = getenv('DB_PORT');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD');
    $db_name = getenv('DB_NAME');
}

// 🟢 2. PONTE DE CONEXÃO MYSQLI TRADICIONAL (Para listagens e Principal.php)
$mysqli = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, (int)$db_port);

if ($mysqli) {
    mysqli_set_charset($mysqli, "utf8mb4");
} else {
    die("🚨 Grupo Aurélius - Falha técnica na ligação ao motor MySQLi: " . mysqli_connect_error());
}

// 🟢 3. MOTOR PDO UNIFICADO (Para Faturas e Módulos Modernos)
try {
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("🚨 Falha na infraestrutura PDO Aurélius Central: " . $e->getMessage());
}

// 🟢 4. MAPA GLOBAL DE COMPATIBILIDADE (Garante que nenhuma variável antiga quebre)
$conexao_link     = $mysqli;
$conexao_aurelius = $mysqli;
$conexao          = $mysqli;
$link             = $mysqli;