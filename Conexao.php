<?php
// =========================================================================
// 🔮 ECOSSISTEMA MESTRE - ARQUIVO CENTRAL DE LIGAÇÃO UNIFICADA (AIVEN & XAMPP)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuração padrão do fuso horário de Angola
date_default_timezone_set('Africa/Luanda');

// 1. DETEÇÃO AUTOMÁTICA DE AMBIENTE (Se houver variáveis do Render ou Aiven)
if (getenv('DB_HOST') || $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    
    // ☁️ CONFIGURAÇÃO DE PRODUÇÃO: NUVEM DA AIVEN ATIVA (mysql-1a34c184)
    // Puxa as variáveis de ambiente do Render de forma segura, com fallback fixo do teu painel Aiven
    $db_host = getenv('DB_HOST') ?: "://aivencloud.com";
    $db_port = getenv('DB_PORT') ?: 52030; // ⚠️ Verifique se a porta gerada no painel Aiven é esta
    $db_user = getenv('DB_USER') ?: "avnadmin";
    $db_pass = getenv('DB_PASSWORD') ?: "SUBSTITUA_PELA_SENHA_REAL_DO_TEU_PAINEL_AIVEN"; 
    $db_name = getenv('DB_NAME') ?: "railway"; // Nome do banco padrão gerado na nuvem

    // Conexão PDO Nuvem para os motores modernos de mini-pautas e faturas
    try {
        $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->exec("SET SESSION sql_mode=''");
    } catch (PDOException $e) {
        die("🚨 Falha na infraestrutura PDO Aurélius na Nuvem: " . $e->getMessage());
    }

    // Conexão MySQLi Nuvem com Porta Separada para evitar erro 2002 (Connection Refused)
    $mysqli = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, (int)$db_port);

} else {
    
    // 💻 CONFIGURAÇÃO LOCAL: SEU COMPUTADOR (XAMPP / LOCALHOST)
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";

    // Conexão PDO Local
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->exec("SET SESSION sql_mode=''");
    } catch (PDOException $e) {
        die("🚨 Falha na infraestrutura PDO Aurélius Local: " . $e->getMessage());
    }

    // Conexão MySQLi Local
    $mysqli = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    // Fallback caso o XAMPP rejeite o IP 127.0.0.1
    if (!$mysqli) {
        $mysqli = @mysqli_connect("localhost", "root", "", "aurelius_salao");
    }
}

// 2. REDE DE SEGURANÇA: SE NÃO LIGAR EM NENHUM DOS DOIS, PARA E EXIBE O ERRO REAL
if (!$mysqli) {
    die("🚨 Grupo Aurélius - Falha catastrófica na ligação MySQLi: " . mysqli_connect_error());
}

// 3. COMPATIBILIDADE DE VARIÁVEIS (Garante que nenhum outro arquivo do projeto quebre)
$conexao_link = $mysqli;
$conexao_aurelius = $mysqli;
$conexao = $mysqli;
$link = $mysqli;

// Aplica as diretivas UTF-8 e remove o modo rígido de agrupamento do SQL
mysqli_set_charset($mysqli, "utf8mb4");
mysqli_query($mysqli, "SET SESSION sql_mode=''");