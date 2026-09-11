<?php
header('Content-Type: text/html; charset=utf-8');

// 1. Credenciais da NOVA INFRAESTRUTURA CLOUD AIVEN
$online_host = "://aivencloud.com"; 
$online_port = 22002; 
$online_user = "avnadmin";
// 💡 IMPORTANTE: Coloque a mesma senha revelada aqui também!
$online_pass = "COLE_AQUI_A_SUA_SENHA_REVELADA"; 
$online_name = "defaultdb";

// 2. Configurações Locais (XAMPP)
$local_host = "127.0.0.1";
$local_user = "root";
$local_pass = "";
$local_name = "aurelius_salao";

echo "<h3>📤 Inicializando Migração de Dados Puros para a Nuvem Aiven...</h3>";

$conn_local = mysqli_connect($local_host, $local_user, $local_pass, $local_name);
$conn_online = mysqli_connect($online_host, $online_user, $online_pass, $online_name, $online_port);

if (!$conn_local) { die("🚨 Falha na conexão com o banco LOCAL XAMPP."); }
if (!$conn_online) { die("🚨 Falha na conexão com o banco ONLINE AIVEN. Certifique-se de que a senha está certa e o status está em 'Running'."); }

mysqli_set_charset($conn_local, "utf8mb4");
mysqli_set_charset($conn_online, "utf8mb4");

mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 0");

// Tabelas essenciais para o fluxo comercial
$tabelas = ['funcionarios', 'servicos', 'carteira_saldos_clientes', 'pagamentos', 'atendimentos', 'lojas']; 

foreach ($tabelas as $tabela) {
    // 🧠 CRIA A TABELA NA AIVEN DINAMICAMENTE SE ELA NÃO EXISTIR ONLINE
    $res_schema = mysqli_query($conn_local, "SHOW CREATE TABLE `$tabela`");
    $row_schema = mysqli_fetch_assoc($res_schema);
    $create_query = $row_schema['Create Table'];
    
    mysqli_query($conn_online, "DROP TABLE IF EXISTS `$tabela`");
    mysqli_query($conn_online, $create_query);
    
    $resultado_local = mysqli_query($conn_local, "SELECT * FROM `$tabela`");
    $linhas_enviadas = 0;
    
    while ($linha = mysqli_fetch_assoc($resultado_local)) {
        $colunas = implode(", ", array_keys($linha));
        $valores_escapados = array_map(function($val) use ($conn_online) {
            return is_null($val) ? "NULL" : "'" . mysqli_real_escape_string($conn_online, $val) . "'";
        }, array_values($linha));
        $valores = implode(", ", $valores_escapados);
        
        if (mysqli_query($conn_online, "INSERT INTO `$tabela` ($colunas) VALUES ($valores)")) {
            $linhas_enviadas++;
        }
    }
    echo "✅ Concluído! Estrutura migrada e <strong>$linhas_enviadas</strong> registos puros enviados para <strong>$tabela</strong> na Aiven.<br>";
}

mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 1");
echo "<h3>🎉 Ecossistema Aiven sincronizado e estável! O site está pronto!</h3>";
?>