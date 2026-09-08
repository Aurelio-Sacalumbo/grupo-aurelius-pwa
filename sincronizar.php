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

echo "<h3>🔄 A iniciar sincronização de dados operacionais e faturamento...</h3>";

// Conectar ao Banco Online
$conn_online = mysqli_connect($online_host, $online_user, $online_pass, $online_name, $online_port);
if (!$conn_online) { 
    die("🚨 Erro ao ligar ao banco ONLINE: " . mysqli_connect_error()); 
}
mysqli_set_charset($conn_online, "utf8mb4");

// Conectar ao Banco Local
$conn_local = mysqli_connect($local_host, $local_user, $local_pass, $local_name);
if (!$conn_local) { 
    die("🚨 Erro ao ligar ao banco LOCAL: " . mysqli_connect_error()); 
}
mysqli_set_charset($conn_local, "utf8mb4");

// Desativa temporariamente as travas de chaves estrangeiras para evitar erros fatais
mysqli_query($conn_local, "SET FOREIGN_KEY_CHECKS = 0");

// Lista Completa das tabelas necessárias para reconstruir os recibos e faturas
$tabelas = [
    'clientes', 
    'funcionarios', 
    'profissionais', 
    'servicos', 
    'agendamentos', 
    'atendimentos', 
    'pagamentos', 
    'faturamento_parceiros', 
    'historico_vendas'
]; 

foreach ($tabelas as $tabela) {
    echo "Sincronizando dados atuais da tabela: <strong>$tabela</strong>...<br>";
    
    // Puxa os dados mais recentes do servidor online
    $resultado = mysqli_query($conn_online, "SELECT * FROM $tabela");
    if (!$resultado) {
        echo "⚠️ Tabela $tabela não encontrada no online ou vazia. Avançando...<br><br>";
        continue;
    }
    
    $linhas_inseridas = 0;
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $colunas = implode(", ", array_keys($linha));
        
        // Trata strings e valores nulos adequadamente para o SQL
        $valores_escapados = array_map(function($val) use ($conn_local) {
            return is_null($val) ? "NULL" : "'" . mysqli_real_escape_string($conn_local, $val) . "'";
        }, array_values($linha));
        
        $valores = implode(", ", $valores_escapados);
        
        // INSERT IGNORE: Garante inserção rápida sem duplicar chaves primárias existentes
        $query_insert = "INSERT IGNORE INTO $tabela ($colunas) VALUES ($valores)";
        if (mysqli_query($conn_local, $query_insert)) {
            if (mysqli_affected_rows($conn_local) > 0) {
                $linhas_inseridas++;
            }
        }
    }
    echo "✅ Concluído! <strong>$linhas_inseridas</strong> novos registos sincronizados em $tabela.<br><br>";
}

// Reativa as verificações de segurança do banco local
mysqli_query($conn_local, "SET FOREIGN_KEY_CHECKS = 1");

echo "<h3>🎉 Todos os pedidos, serviços e profissionais foram atualizados com sucesso!</h3>";
?>