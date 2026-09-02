<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Credenciais dinâmicas (Local vs Nuvem)
$host     = getenv('DB_HOST') ?: "altaria.proxy.rlwy.net";
$port     = getenv('DB_PORT') ?: "52030";
$dbname   = getenv('DB_NAME') ?: "railway";
$user     = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ";

try {
    // 1. Instancia o PDO corretamente
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    
    // 2. Define os atributos de erro e busca
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // 3. Desativa o modo rígido de agrupamento
    $pdo->exec("SET SESSION sql_mode=''");

    // Cria a variável compatível em MySQLi para os outros arquivos
    $conexao_link = @mysqli_connect($host . ":" . $port, $user, $password, $dbname);

} catch (PDOException $e) {
    // Fallback para o XAMPP Local caso a nuvem falhe
    if (!getenv('DB_HOST')) {
        try {
            $pdo = new PDO("mysql:host=127.0.0.1;dbname=aurelius_salao;charset=utf8mb4", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET SESSION sql_mode=''");
            $conexao_link = @mysqli_connect("127.0.0.1", "root", "", "aurelius_salao");
        } catch (PDOException $ex) {
            die("Erro crítico de ligação: " . $ex->getMessage());
        }
    } else {
        die("Erro na ligação PDO: " . $e->getMessage());
    }
}
?>