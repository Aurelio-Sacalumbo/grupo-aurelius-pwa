<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (getenv('DB_HOST')) {
    // Produção (Render -> Banco na Railway)
    $db_host = "altaria.proxy.rlwy.net";
    $db_port = 52030;
    $db_user = "root";
    $db_pass = "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ";
    $db_name = "railway";
    
    // Conexão PDO com a porta especificada para o Render
    try {
        $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Falha de conexão PDO: " . $e->getMessage());
    }
    
    // Conexão MySQLi tradicional (caso use os dois no projeto)
    $conexao_aurelius = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

} else {
    // Ambiente Local (XAMPP)
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_pass = "";
    $db_name = "aurelius_salao";
    
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Falha de conexão PDO Local: " . $e->getMessage());
    }
    
    $conexao_aurelius = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
}
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




