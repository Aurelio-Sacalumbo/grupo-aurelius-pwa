<?php
header('Content-Type: text/html; charset=utf-8');

// 1. Configurações do Banco Online (Railway)
$online_host = "altaria.proxy.rlwy.net"; 
$online_port = 52030; 
$online_user = "root";
$online_pass = "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ";
$online_name = "railway";

// 2. Configurações do Banco Local (XAMPP)
$local_host = "127.0.0.1";
$local_user = "root";
$local_pass = "";
$local_name = "aurelius_salao";

echo "<h3>📤 Sincronizando tabelas de faturamento, saldos e profissionais com a Nuvem...</h3>";

$conn_local = mysqli_connect($local_host, $local_user, $local_pass, $local_name);
if (!$conn_local) { die("🚨 Erro ao ligar ao banco LOCAL: " . mysqli_connect_error()); }
mysqli_set_charset($conn_local, "utf8mb4");

$conn_online = mysqli_connect($online_host, $online_user, $online_pass, $online_name, $online_port);
if (!$conn_online) { die("🚨 Erro ao ligar ao banco ONLINE: " . mysqli_connect_error()); }
mysqli_set_charset($conn_online, "utf8mb4");

mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 0");

// ✨ ATUALIZAÇÃO: Adicionadas tabelas de carteira e funcionários para sincronismo financeiro total
$tabelas = [
    'funcionarios', 
    'carteira_saldos_clientes', 
    'pagamentos', 
    'atendimentos', 
    'faturamento_parceiros', 
    'historico_vendas'
]; 

foreach ($tabelas as $tabela) {
    echo "Sincronizando tabela: <strong>$tabela</strong>...<br>";
    
    $resultado_local = mysqli_query($conn_local, "SELECT * FROM $tabela");
    $linhas_enviadas = 0;
    
    while ($linha = mysqli_fetch_assoc($resultado_local)) {
        $colunas = implode(", ", array_keys($linha));
        
        $valores_escapados = array_map(function($val) use ($conn_online) {
            return is_null($val) ? "NULL" : "'" . mysqli_real_escape_string($conn_online, $val) . "'";
        }, array_values($linha));
        
        $valores = implode(", ", $valores_escapados);
        
        $query_insert = "INSERT IGNORE INTO $tabela ($colunas) VALUES ($valores)";
        if (mysqli_query($conn_online, $query_insert)) {
            if (mysqli_affected_rows($conn_online) > 0) {
                $linhas_enviadas++;
            }
        }
    }
    echo "✅ Concluído! <strong>$linhas_enviadas</strong> novos registos migrados para a Railway em <strong>$tabela</strong>.<br><br>";
}

mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 1");

echo "<h3>🎉 Ecossistema sincronizado com sucesso! Abre o Render para testar os resultados!</h3>";
?>