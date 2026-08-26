<?php
// =========================================================================
// 🚀 CREDENCIAIS OFICIAIS E ATIVAS DO ECOSSISTEMA CLOUD (RAILWAY)
// =========================================================================

$host     = "tramway.proxy.rlwy.net";
$usuario  = "root";
$senha    = "XpsebaXyWAxEsmWHSWUghUdIiwkuxWDj";
$banco    = "railway";
$porta    = 39556;

// Criação da conexão oficial adaptada para a nuvem
$conexao_aurelius = mysqli_connect($host, $usuario, $senha, $banco, $porta);

if (!$conexao_aurelius) {
    die("Falha na conexão com a nuvem: " . mysqli_connect_error());
}

// Garante o suporte a caracteres especiais, acentos e emojis das barbearias
mysqli_set_charset($conexao_aurelius, "utf8mb4");

// 🟢 PONTES DE COMPATIBILIDADE: Mantém vivas todas as suas variáveis antigas do XAMPP
$conexao = $conexao_aurelius;
$link    = $conexao_aurelius;
$conn    = $conexao_aurelius;
?>