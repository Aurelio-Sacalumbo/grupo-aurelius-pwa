<?php
// =========================================================================
// 🔮 ECOSSISTEMA MESTRE - LIGAÇÃO TOTALMENTE MYSQL (XAMPP LOCAL & AIVEN NUVEM)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Africa/Luanda');

// 1. DETEÇÃO AUTOMÁTICA DE AMBIENTE
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    
    // 💻 AMBIENTE LOCAL (Configuração para o seu XAMPP)
    $db_host = "127.0.0.1";
    $db_port = "3306";
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";

} else {
    
    // ☁️ AMBIENTE DE HOSPEDAGEM REAL (Puxa os dados que salvamos no Render)
    $db_host = getenv('DB_HOST');
    $db_port = getenv('DB_PORT') ?: 22002;
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD');
    $db_name = getenv('DB_NAME') ?: "defaultdb";
}

// 2. PONTE DE CONEXÃO MYSQLI TRADICIONAL
$conexao_aurelius = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, (int)$db_port);
$mysqli = $conexao_aurelius; // Clone para compatibilidade

if ($conexao_aurelius) {
    mysqli_set_charset($conexao_aurelius, "utf8mb4");
} else {
    die("🚨 Grupo Aurélius - Falha técnica na ligação ao motor MySQLi: " . mysqli_connect_error());
}

// 3. MOTOR PDO UNIFICADO (Para faturas e gráficos)
try {
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("🚨 Falha na infraestrutura PDO Aurélius Central: " . $e->getMessage());
}

// Mapa global de compatibilidade para arquivos antigos
$conexao_link = $conexao_aurelius;
$conexao = $conexao_aurelius;
$link = $conexao_aurelius;