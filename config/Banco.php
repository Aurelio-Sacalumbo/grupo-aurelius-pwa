<?php
// =========================================================================
// 🔮 ECOSSISTEMA MESTRE - LIGAÇÃO UNIFICADA POSTGRESQL & MYSQL 
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuração oficial do fuso horário de Angola
date_default_timezone_set('Africa/Luanda');

// 🟢 1. REAPROVEITAMENTO INTELIGENTE DE VARIÁVEIS EXISTENTES
$pdo = $pdo ?? null;

// 🟢 2. DETEÇÃO AUTOMÁTICA DE AMBIENTE (LOCALHOST VS HOSPEDAGEM SEGURA)
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    
    // 💻 AMBIENTE LOCAL (Configuração para o seu XAMPP/MySQL)
    $db_driver = "mysql";
    $db_host   = "127.0.0.1";
    $db_port   = "3306";
    $db_user   = "root";
    $db_pass   = "";
    $db_name   = "aurelius_salao";

} else {
    
    // ☁️ AMBIENTE DE HOSPEDAGEM REAL (Puxa os dados injetados pelo painel do Render)
    $db_driver = "pgsql";
    $db_host   = getenv('DB_HOST') ?: "://supabase.com";
    $db_port   = getenv('DB_PORT') ?: "5432";
    $db_user   = getenv('DB_USER') ?: "postgres.jbuollwurahyrhxfldqz";
    $db_pass   = getenv('DB_PASSWORD') ?: "Huambo@2026";
    $db_name   = getenv('DB_NAME') ?: "postgres";
}

// 🟢 3. MOTOR PDO UNIFICADO (Conecta dinamicamente ao MySQL ou Postgres)
if (!$pdo) {
    try {
        if ($db_driver === "pgsql") {
            // String de conexão para o Supabase (PostgreSQL)
            $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name";
            $pdo = new PDO($dsn, $db_user, $db_pass);
        } else {
            // String de conexão para o XAMPP Local (MySQL)
            $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->exec("SET SESSION sql_mode=''");
        }
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        die("🚨 Falha na infraestrutura PDO Aurélius Central: " . $e->getMessage());
    }
}

// 🟢 4. PONTE DE ADAPTAÇÃO FAKE PARA CÓDIGOS ANTIGOS (Evita erros fatais de mysqli)
// Como o PostgreSQL não suporta funções mysqli_*, injetamos o PDO nas variáveis globais
$mysqli           = $pdo;
$conexao_link     = $pdo;
$conexao_aurelius = $pdo;
$conexao          = $pdo;
$link             = $pdo;