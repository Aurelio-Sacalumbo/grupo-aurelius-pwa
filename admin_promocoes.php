<?php
if (!isset($_SESSION)) { session_start(); }
$mysqli = new mysqli("127.0.0.1", "root", "", "aurelius_salao");
$mysqli->set_charset("utf8");

// Garante que sabemos qual é a barbearia ligada
if (!isset($_SESSION['empresa_codigo'])) { die("Sessão expirada. Faça login novamente."); }
$id_barbearia = $_SESSION['empresa_codigo'];

// Processa a atualização do desconto relâmpago
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto_id'])) {
    $id_prod = (int)$_POST['produto_id'];
    $desconto = (int)$_POST['desconto_relampago'];
    
    // Garante que o desconto está entre 0% e 90%
    if ($desconto >= 0 && $desconto <= 90) {
        $stmt = $mysqli->prepare("UPDATE `produtos_cosmeticos` SET `desconto_relampago` = ? WHERE `id` = ? AND `empresa_id` = ?");
        $stmt->bind_param("iii", $desconto, $id_prod, $id_barbearia);
        if ($stmt->execute()) {
            echo "<script>alert('Campanha Relâmpago atualizada com sucesso!'); window.location.href='admin_promocoes.php';</script>";
        }
    }
}

// Procura os produtos deste salão para listar no painel de gestão
$produtos = $mysqli->query("SELECT * FROM `produtos_cosmeticos` WHERE `empresa_id` = '$id_barbearia'");
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Aurelius Business - Campanhas Relâmpago</title>
    <style>
        body { background-color: #0b1a30; color: #fff; font-family: sans-serif; padding: 40px; }
        .box-gestao { max-width: 600px; margin: 0 auto; background: #0f172a; padding: 25px; border-radius: 12px; border: 1px solid #1e293b; }
        .linha-produto { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #1e293b; }
        .select-desconto { padding: 8px; background: #1e293b; color: white; border: 1px solid #38bdf8; border-radius: 6px; }
        .btn-salvar { background: #22c55e; color: white; padding: 8px 15px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

<div class="box-gestao">
    <h3 style="color: #38bdf8; margin-bottom: 20px;">⚡ Ativar Descontos Relâmpago no Balcão</h3>
    <p style="color: #a1a1aa; font-size: 14px; margin-bottom: 20px;">Selecione a percentagem de desconto para os produtos que pretende escoar mais rapidamente esta semana.</p>

    <?php if ($produtos && $produtos->num_rows > 0): ?>
        <?php while($prod = $produtos->fetch_assoc()): ?>
            <div class="linha-produto">
                <div>
                    <span style="font-weight: bold; display: block;"><?php echo htmlspecialchars($prod['nome_produto']); ?></span>
                    <span style="font-size: 13px; color: #eab308;"><?php echo number_format($prod['preco'], 2, ',', '.'); ?> AOA</span>
                </div>
                <form method="POST" action="" style="display: flex; gap: 10px; align-items: center; margin: 0;">
                    <input type="hidden" name="produto_id" value="<?php echo $prod['id']; ?>">
                    <select name="desconto_relampago" class="select-desconto">
                        <option value="0" <?php echo $prod['desconto_relampago'] == 0 ? 'selected' : ''; ?>>Sem Desconto</option>
                        <option value="10" <?php echo $prod['desconto_relampago'] == 10 ? 'selected' : ''; ?>>10% OFF</option>
                        <option value="20" <?php echo $prod['desconto_relampago'] == 20 ? 'selected' : ''; ?>>20% OFF</option>
                        <option value="30" <?php echo $prod['desconto_relampago'] == 30 ? 'selected' : ''; ?>>30% OFF</option>
                        <option value="50" <?php echo $prod['desconto_relampago'] == 50 ? 'selected' : ''; ?>>50% OFF (Metade do Preço)</option>
                    </select>
                    <button type="submit" class="btn-salvar">Aplicar</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="color: #a1a1aa; font-style: italic;">Adicione produtos ao seu stock antes de criar campanhas.</p>
    <?php endif; ?>
</div>

</body>
</html>