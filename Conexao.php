<?php
// 🟢 Valores diretos da Aiven (Substitui pelos teus dados reais da Aiven)
$host = '://aivencloud.com'; // APENAS o texto, SEM "mysql://" e SEM ":24307"
$port = '24307';                                        // A porta entra aqui, separada
$db   = 'defaultdb';                                    // O nome da base de dados da Aiven
$user = 'avnadmin';                                     // O utilizador padrão da Aiven
$pass = 'SUA_SENHA_AIVEN_AQUI'; 
$ssl  = true;                                           // Aiven exige ligação segura SSL

try {
    // A string dsn CORRETA deve separar o host da porta com ponto e vírgula (port=)
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    
    // Configuração obrigatória para o SSL da Aiven não rejeitar o Render
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => true, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    die("🚨 Falha na infraestrutura PDO Aurélius: " . $e->getMessage());
}