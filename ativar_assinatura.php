<?php
// activar_assinatura.php - Atualização e Ativação Rápida
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("Conexao.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Reutiliza ou cria a ligação nativa com o banco do seu XAMPP
$link_comercial = $conexao_aurelius ?? $conexao ?? $link ?? null;
if (!$link_comercial) {
    $link_comercial = @mysqli_connect("127.0.0.1", "root", "", "aurelius_salao");
}

if ($id > 0 && $link_comercial) {
    // Define a validação estendida por mais um ano a partir do momento do clique do gestor
    $data_ativacao = date('Y-m-d H:i:s');
    $data_expiracao = date('Y-m-d H:i:s', strtotime('+1 year'));
    
    // Atualiza a linha específica na tabela 'assinaturas'
    $query_update = "UPDATE `assinaturas` 
                     SET `status` = 'Ativo', `data_inicio` = '$data_ativacao', `data_fim` = '$data_expiracao' 
                     WHERE `id_assinatura` = $id";
                     
    mysqli_query($link_comercial, $query_update);
}

// Recarrega o painel administrativo instantaneamente
header("Location: admini.php");
exit;