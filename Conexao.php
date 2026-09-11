<?php
// =========================================================================
// 🔮 ECOSSISTEMA MESTRE REATIVO - CONEXÃO INTEGRADA (AIVEN & XAMPP LOCAL)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuração obrigatória do fuso horário de Angola
date_default_timezone_set('Africa/Luanda');

// 1. DETEÇÃO AUTOMÁTICA DE AMBIENTE (Computador Local vs Servidor Render)
if (getenv('DB_HOST') || $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    
    // ☁️ CREDENCIAIS REAIS EXTRAÍDAS DA TUA CONSOLA AIVEN (mysql-1a34c184)
    $db_host = "mysql-1a34c184-aureliosacalumbo42-bf60.a.aivencloud.com"; // 👈 Corrigido para .a.
    $db_port = 22002;                                                    // 👈 Porta Real da Aiven
    $db_user = "avnadmin";                                                 // 👈 Utilizador Oficial
    $db_pass = "AVNS_6AyaHMtSplThuvy6uGm";                                 // 👈 Senha Real de Produção
    $db_name = "defaultdb";                                                // 👈 Nome do Banco Padrão

    // Conexão PDO Nuvem para os motores modernos de faturas e listagens
    try {
        $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->exec("SET SESSION sql_mode=''"); // Remove o modo rígido do MySQL 8.4
    } catch (PDOException $e) {
        die("🚨 Falha na infraestrutura PDO Aurélius na Nuvem: " . $e->getMessage());
    }

    // Conexão MySQLi Nuvem (Tratamento para a rota principal do salão)
    $mysqli = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, (int)$db_port);

} else {
    
    // 💻 CREDENCIAIS PARA O TEU XAMPP LOCAL (COMPUTADOR)
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
    
    // Fallback de segurança se o XAMPP rejeitar o IP 127.0.0.1
    if (!$mysqli) {
        $mysqli = @mysqli_connect("localhost", "root", "", "aurelius_salao");
    }
}

// 2. REDE DE SEGURANÇA SE NENHUM MOTOR CONECTAR
if (!$mysqli) {
    die("🚨 Grupo Aurélius - Falha de ligação ao motor MySQLi: " . mysqli_connect_error());
}

// 3. PONTES DE COMPATIBILIDADE (Garante que nenhuma outra página do site quebre)
$conexao_link = $mysqli;
$conexao_aurelius = $mysqli;
$conexao = $mysqli;
$link = $mysqli;

// Aplica as diretivas UTF-8 globais nas duas conexões
mysqli_set_charset($mysqli, "utf8mb4");
mysqli_query($mysqli, "SET SESSION sql_mode=''");