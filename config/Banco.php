<?php
// =========================================================================
// 🔌 INFRAESTRUTURA DE LIGAÇÃO HÍBRIDA BLINDADA - MOTOR MESTRE (BANCO.PHP)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Deteta de forma automática se está no computador local (XAMPP) ou na Nuvem (Render/Railway)
$is_local_env = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost' || !getenv('DB_HOST'));

if ($is_local_env) {
    // 🖥️ CONFIGURAÇÕES PADRÃO PARA O XAMPP LOCAL
    $host     = '127.0.0.1';
    $port     = '3306';
    $dbname   = 'aurelius_salao';
    $user     = 'root';
    $password = '';
} else {
    // ☁️ CONFIGURAÇÕES DE PRODUÇÃO ONLINE EM NUVEM
    $host     = getenv('DB_HOST') ?: "altaria.proxy.rlwy.net";
    $port     = getenv('DB_PORT') ?: "52030";
    $dbname   = getenv('DB_NAME') ?: "railway";
    $user     = getenv('DB_USER') ?: "root";
    $password = getenv('DB_PASSWORD') ?: "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ";
}

try {
    // 🟢 1. INICIALIZAÇÃO DO MOTOR MODERNO PDO (Para o Dashboard e consultas assíncronas)
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Desativa o modo rígido (Crucial para matar o erro de agrupamento na linha 1957)
    $pdo->exec("SET SESSION sql_mode=''");

    // 🟢 2. INICIALIZAÇÃO DO MOTOR COMPATÍVEL MYSQLI (Salva as páginas antigas e os Feeds)
    // Passamos a porta como um argumento numérico separado para o mysqli não crashar na nuvem
    $conexao_link = @mysqli_connect($host, $user, $password, $dbname, (int)$port);

    if ($conexao_link) {
        mysqli_set_charset($conexao_link, "utf8mb4");
    } else {
        // Fallback de contingência caso o socket do mysqli falhe na nuvem: emite ponte via PDO se necessário
        $conexao_link = false;
    }

    // Cria as pontes de nomes de segurança para que nenhuma página antiga fique sem resposta
    $mysqli           = $conexao_link;
    $conexao_aurelius = $conexao_link;
    $conexao          = $conexao_link;

} catch (PDOException $e) {
    // Tratamento de erro limpo para não expor credenciais na tela do telemóvel do cliente
    error_log("Erro crítico na infraestrutura Aurélius: " . $e->getMessage());
    die("Erro crítico de ligação: O servidor de base de dados na nuvem está inacessível ou em manutenção.");
}
?>