<?php
// atualizar_status_funcionario.php
header('Content-Type: application/json; charset=utf-8');
include_once("Conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id_funcionario']) ? intval($_POST['id_funcionario']) : 0;
    $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status']), ENT_QUOTES, 'UTF-8') : '';

    if ($id > 0 && !empty($status)) {
        try {
            $stmt = $pdo->prepare("UPDATE funcionarios SET status = ? WHERE id_funcionario = ?");
            $executou = $stmt->execute([$status, $id]);
            echo json_encode(['sucesso' => $executou]);
            exit;
        } catch (PDOException $e) {
            echo json_encode(['sucesso' => false, 'mensagem' => $e->getMessage()]);
            exit;
        }
    }
}
echo json_encode(['sucesso' => false, 'mensagem' => 'Requisição inválida']);