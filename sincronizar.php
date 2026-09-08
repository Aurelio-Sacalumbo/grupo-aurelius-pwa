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

echo "<h3>📤 A enviar dados locais (Anúncios) para as Nuvens (Railway)...</h3>";

// Conectar ao Banco Local (Origem)
$conn_local = mysqli_connect($local_host, $local_user, $local_pass, $local_name);
if (!$conn_local) { die("🚨 Erro ao ligar ao banco LOCAL: " . mysqli_connect_error()); }
mysqli_set_charset($conn_local, "utf8mb4");

// Conectar ao Banco Online (Destino)
$conn_online = mysqli_connect($online_host, $online_user, $online_pass, $online_name, $online_port);
if (!$conn_online) { die("🚨 Erro ao ligar ao banco ONLINE: " . mysqli_connect_error()); }
mysqli_set_charset($conn_online, "utf8mb4");

// Desativa as travas de segurança na Railway temporariamente para o upload
mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 0");

// A tabela que guarda os produtos/anúncios que vimos no seu código anterior!
$tabelas = ['anuncios']; 

foreach ($tabelas as $tabela) {
    echo "Fazendo upload da tabela: <strong>$tabela</strong>...<br>";
    
    // Puxa os dados do seu computador local
    $resultado_local = mysqli_query($conn_local, "SELECT * FROM $tabela");
    
    $linhas_enviadas = 0;
    while ($linha = mysqli_fetch_assoc($resultado_local)) {
        $colunas = implode(", ", array_keys($linha));
        
        $valores_escapados = array_map(function($val) use ($conn_online) {
            return is_null($val) ? "NULL" : "'" . mysqli_real_escape_string($conn_online, $val) . "'";
        }, array_values($linha));
        
        $valores = implode(", ", $valores_escapados);
        
        // Insere na Railway online. Se já existir o ID, ele ignora para não duplicar
        $query_insert = "INSERT IGNORE INTO $tabela ($colunas) VALUES ($valores)";
        if (mysqli_query($conn_online, $query_insert)) {
            if (mysqli_affected_rows($conn_online) > 0) {
                $linhas_enviadas++;
            }
        }
    }
    echo "✅ Sucesso! <strong>$linhas_enviadas</strong> novos anúncios enviados para o servidor online.<br><br>";
}

// Reativa as travas de segurança na Railway
mysqli_query($conn_online, "SET FOREIGN_KEY_CHECKS = 1");

echo "<h3>🎉 Upload concluído! Os produtos já devem aparecer no Render!</h3>";
?>