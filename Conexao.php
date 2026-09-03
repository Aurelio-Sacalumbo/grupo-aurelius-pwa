<?php
// Substitua o session_start(); seco por esta trava inteligente:
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// 1. Configuração para o RENDER (Produção)
if (getenv('DB_HOST')) {
    $db_host = getenv('DB_HOST');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD') ?: "";
    $db_name = getenv('DB_NAME');
} else {
    // 2. Configuração para o XAMPP (Local)
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";
}

// PRIMEIRO: Cria a conexão que o Principal.php espera
$conexao_aurelius = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Fallback caso o XAMPP rejeite o IP 127.0.0.1
if (!$conexao_aurelius && !getenv('DB_HOST')) {
    $conexao_aurelius = @mysqli_connect("localhost", "root", "", "aurelius_salao");
}

// Se não ligar em nenhum dos dois, exibe o erro
if (!$conexao_aurelius) {
    die("🚨 Falha na ligação ao banco de dados: " . mysqli_connect_error());
}

// AGORA SIM: Com a conexão criada com sucesso, aplicamos as configurações
mysqli_set_charset($conexao_aurelius, "utf8mb4");
mysqli_query($conexao_aurelius, "SET SESSION sql_mode=''");




