<?php
// atualizar_cargos.php - Processamento de Alteração Salarial
include_once("Conexao.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_cargo = isset($_POST['id_cargo']) ? intval($_POST['id_cargo']) : 0;
    $novo_salario = isset($_POST['novo_salario']) ? floatval($_POST['novo_salario']) : 0;

    if ($id_cargo > 0 && $novo_salario > 0) {
        try {
            // 🛡️ ALINHAMENTO SQL: Altera o campo exato 'salario_base' usando a chave primária 'id_cargo'
            $stmt = $pdo->prepare("UPDATE cargos_salarios SET salario_base = ? WHERE id_cargo = ?");
            $stmt->execute([$novo_salario, $id_cargo]);

            // Retorna ao painel com uma mensagem de sucesso
            header("Location: Admini.php?status=sucesso_cargo");
            exit;
        } catch (PDOException $e) {
            die("Erro técnico ao atualizar salário: " . $e->getMessage());
        }
    } else {
        header("Location: Admini.php?status=erro_dados");
        exit;
    }
}
?>
Use o código com cuidado.2. Consultas PHP Corrigidas para o Topo do Ficheiro (Admini.php)Substitua as consultas do topo do seu arquivo Admini.php por estas, que realizam os cruzamentos (INNER JOIN) corretos entre as tabelas funcionarios e cargos_salarios:php<?php
// Topo do ficheiro Admini.php
include_once("Conexao.php");

try {
    // 1. Puxa os dados reais da tabela cargos_salarios para a tabela de referência e select do formulário
    $stmt_cargos = $pdo->query("SELECT * FROM cargos_salarios ORDER BY id_cargo ASC");
    $lista_referencia_cargos = $stmt_cargos->fetchAll(PDO::FETCH_ASSOC);

    // 2. Puxa a folha de pagamento cruzando os funcionários com as suas respetivas funções e salários base
    // NOTA: Ajuste o nome da coluna de relacionamento se no seu banco for id_cargo ou cargo_id
    $stmt_folha = $pdo->query("SELECT f.*, c.nome_cargo, c.salario_base 
                               FROM funcionarios f 
                               INNER JOIN cargos_salarios c ON f.id_cargo = c.id_cargo 
                               ORDER BY f.nome ASC");
    $folha_equipa = $stmt_folha->fetchAll(PDO::FETCH_ASSOC);

    // 3. Faturamento Diário (Calcula as sessões reais que cada profissional realizou na tabela pagamentos)
    $hoje = date('Y-m-d');
    $stmt_lucros = $pdo->prepare("SELECT profissional, COUNT(*) as total_atendimentos, SUM(valor_liquido) as total_gerado 
                                  FROM pagamentos 
                                  WHERE data_servico = ? 
                                  GROUP BY profissional 
                                  ORDER BY total_gerado DESC");
    $stmt_lucros->execute([$hoje]);
    $ranking_lucros = $stmt_lucros->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Inicializa como vazio em caso de falha estrutural para a página não quebrar
    $lista_referencia_cargos = [];
    $folha_equipa = [];
    $ranking_lucros = [];
}
?>