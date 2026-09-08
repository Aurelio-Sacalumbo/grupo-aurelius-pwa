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

echo "<h3>📤 Sincronizando tabelas de faturamento e faturas com a Nuvem...</h3>";

// Conectar ao Banco Local (Origem dos novos dados)
$conn_local = mysqli_connect($local_host, $local_user, $local_pass, $local_name);
if (!$conn_local) { die("🚨 Erro ao ligar ao banco LOCAL: " . mysqli_connect_error()); }
mysqli_set_charset($conn_local, "utf8mb4");

// Conectar ao Banco Online (Destino na Railway)
$conn_online = mysqli_connect($online_host, $online_user, $online_pass, $online_name, $online_port);
if (!$conn_online) { die("🚨 Erro ao ligar ao banco ONLINE: " . mysqli_connect_error()); }
mysqli_set_charset($conn_online, "utf8mb4");

// Desativa temporariamente a verificação de integridade no servidor online para o upload
mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 0");

// Tabelas dinâmicas que guardam os novos pedidos e o faturamento
$tabelas = ['pagamentos', 'atendimentos', 'faturamento_parceiros', 'historico_vendas']; 

foreach ($tabelas as $tabela) {
    echo "Fazendo upload dos dados da tabela: <strong>$tabela</strong>...<br>";
    
    // Puxa o histórico atual do seu XAMPP local
    $resultado_local = mysqli_query($conn_local, "SELECT * FROM $tabela");
    
    $linhas_enviadas = 0;
    while ($linha = mysqli_fetch_assoc($resultado_local)) {
        $colunas = implode(", ", array_keys($linha));
        
        $valores_escapados = array_map(function($val) use ($conn_online) {
            return is_null($val) ? "NULL" : "'" . mysqli_real_escape_string($conn_online, $val) . "'";
        }, array_values($linha));
        
        $valores = implode(", ", $valores_escapados);
        
        // INSERT IGNORE: Envia os novos pedidos do hhhhhhh e do Malaquias sem duplicar os antigos
        $query_insert = "INSERT IGNORE INTO $tabela ($colunas) VALUES ($valores)";
        if (mysqli_query($conn_online, $query_insert)) {
            if (mysqli_affected_rows($conn_online) > 0) {
                $linhas_enviadas++;
            }
        }
    }
    echo "✅ Concluído! <strong>$linhas_enviadas</strong> novos registos enviados para a nuvem em <strong>$tabela</strong>.<br><br>";
}

// Reativa as verificações de segurança no servidor online
mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 1");

echo "<h3>🎉 Banco de dados sincronizado! O faturamento atual já deve responder no Render!</h3>";
?>