<?php
// =========================================================================
// 🔌 CONECTOR MESTRE FLEXÍVEL (LOCAL & NUVEM) - GRUPO AURÉLIUS
// =========================================================================
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// Deteta automaticamente se está no Render (lendo variáveis de ambiente) ou no XAMPP local
$host     = getenv('DB_HOST')     ?: "127.0.0.1"; 
$dbname   = getenv('DB_NAME')     ?: "aurelius_salao";
$user     = getenv('DB_USER')     ?: "root";
$password = getenv('DB_PASSWORD') ?: ""; 
$port     = getenv('DB_PORT')     ?: "3306";

try {
    // Liga o PDO para as consultas modernas
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Liga o MySQLi para compatibilidade com códigos antigos
    $mysqli = new mysqli($host, $user, $password, $dbname, $port);
    $mysqli->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // Se falhar no Render, mostra o erro técnico real para debug rápido
    if (getenv('DB_HOST')) {
        die("🚨 <b>Erro de Conexão na Nuvem:</b> " . $e->getMessage());
    }
    
    die("<div style='background:#7f1d1d; color:#fff; padding:20px; font-family:sans-serif; text-align:center; border-radius:8px; margin:50px auto; max-width:500px;'>
            🚨 <b>Erro do Banco de Dados Local:</b> Não foi possível ligar ao MySQL do XAMPP.<br>
            Certifique-se de que o painel do XAMPP está aberto e o MySQL está em 'Start'.
         </div>");
}
?>