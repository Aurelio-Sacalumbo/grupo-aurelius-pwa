<?php
// =========================================================================
// 📂 RETAGUARDA TÉCNICA - HERANÇA FACILITADORA DO ECOSSISTEMA
// =========================================================================

// Se o ecossistema central ainda não foi chamado, inclui o conector mestre
if (!isset($pdo) || !isset($mysqli)) {
    if (file_exists(__DIR__ . "/../Conexao.php")) {
        include_once(__DIR__ . "/../Conexao.php");
    } elseif (file_exists(__DIR__ . "/Conexao.php")) {
        include_once(__DIR__ . "/Conexao.php");
    }
}

// Garante o mapeamento global de compatibilidade para os sub-módulos
$conexao_link     = $mysqli;
$conexao_aurelius = $mysqli;
$conexao          = $mysqli;
$link             = $mysqli;