<?php
// =========================================================================
// 🚀 PAINEL DE INVENTÁRIO COM SELEÇÃO DE DESTINO EXCLUSIVO - GRUPO AURÉLIUS
// =========================================================================
if (!isset($_SESSION)) { 
    session_start(); 
}
date_default_timezone_set('Africa/Luanda');

$mysqli = new mysqli("127.0.0.1", "root", "", "aurelius_salao");
if ($mysqli->connect_error) { 
    die("Falha na ligação técnica: " . $mysqli->connect_error); 
}
$mysqli->set_charset("utf8");

// Puxa todas as lojas parceiras para alimentar o seletor do formulário
$query_seletor_lojas = $mysqli->query("SELECT id, nome_loja FROM lojas WHERE visivel_no_site = 1 ORDER BY nome_loja ASC");

$mensagem_feedback = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o ID da loja selecionada no menu dropdown (Garante o isolamento absoluto)
    $id_loja_alvo = intval($_POST['loja_destino_id']);
    
    $nome  = $mysqli->escape_string(trim($_POST['nome_produto']));
    $preco = (float)$_POST['preco'];
    $stock = (int)$_POST['stock_atual'];
    $nome_imagem = 'default_cosmetico.jpg'; 

    // Processamento seguro de upload da fotografia
    if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] == 0) {
        $diretorio_destino = 'uploads/';
        if (!is_dir($diretorio_destino)) { 
            mkdir($diretorio_destino, 0777, true); 
        }
        
        $extensao = strtolower(pathinfo($_FILES['foto_produto']['name'], PATHINFO_EXTENSION));
        $extesoes_permitidas = array('jpg', 'jpeg', 'png', 'webp');
        
        if (in_array($extensao, $extesoes_permitidas)) {
            $nome_imagem = 'prod_' . uniqid() . '.' . $extensao;
            move_uploaded_file($_FILES['foto_produto']['tmp_name'], $diretorio_destino . $nome_imagem);
        }
    }

    if ($id_loja_alvo > 0 && !empty($nome) && $preco > 0) {
        // Insere na tabela 'produtos_cosmeticos' amarrando o produto ao ID da loja escolhida
        $stmt = $mysqli->prepare("INSERT INTO produtos_cosmeticos (empresa_id, nome_produto, preco, stock_atual, imagem) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdis", $id_loja_alvo, $nome, $preco, $stock, $nome_imagem);
        
        if ($stmt->execute()) {
            echo "<script>alert('🎉 Produto vinculado com sucesso à loja selecionada!'); window.location.href='Lojas.php';</script>";
            exit;
        } else {
            $mensagem_feedback = "🚨 Erro ao gravar dados no MySQL: " . $mysqli->error;
        }
    } else {
        $mensagem_feedback = "🚨 Erro: Selecione uma loja de destino válida.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Aurelius Business - Direcionar Produto</title>
    <style>
        body { background-color: #0b1a30; color: #fff; font-family: sans-serif; padding: 40px; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .form-container { max-width: 480px; width: 100%; background: #0f172a; padding: 30px; border-radius: 12px; border: 1px solid #1e293b; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .input-campo { width: 100%; padding: 12px; background: #1e293b; border: 1px solid #38bdf8; border-radius: 6px; color: white; margin-bottom: 15px; margin-top: 5px; box-sizing: border-box; font-size: 14px; }
        .btn-enviar { width: 100%; background: #22c55e; color: #000; font-weight: bold; padding: 14px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2); }
        .btn-enviar:hover { background: #16a34a; }
    </style>
</head>
<body>

<div class="form-container">
    <h3 style="color: #38bdf8; margin-top: 0; margin-bottom: 5px;">🚀 Direcionar Novo Cosmético</h3>
    <p style="color: #94a3b8; font-size: 12px; margin: 0 0 20px 0;">Escolha a loja de destino para isolar os dados e evitar misturas no Marketplace.</p>
    
    <?php if(!empty($mensagem_feedback)): ?>
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #f87171; padding: 10px; border-radius: 6px; color: #f87171; margin-bottom: 15px; font-size: 13px; text-align: center;"><?php echo $mensagem_feedback; ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        
        <!-- 🟢 SELETOR DE LOJAS PARCEIRAS COM FECHAMENTO CORRIGIDO -->
        <label style="color: #eab308; font-weight: bold;">Para qual Loja deseja enviar este produto?</label>
        <select name="loja_destino_id" class="input-campo" style="border-color: #eab308;" required>
            <option value="">-- Escolha o Fornecedor de Destino --</option>
            <?php while($loja_opc = $query_seletor_lojas->fetch_assoc()): ?>
                <option value="<?php echo $loja_opc['id']; ?>">🏬 <?php echo htmlspecialchars($loja_opc['nome_loja']); ?></option>
            <?php endwhile; ?> <!-- 🟢 CORRIGIDO: Agora usa endwhile de forma simétrica -->
        </select>

        <label>Nome do Produto:</label>
        <input type="text" name="nome_produto" class="input-campo" placeholder="Ex: Pomada Efeito Matte Elegance" required>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label>Preço de Venda (Kz):</label>
                <input type="number" step="0.01" name="preco" class="input-campo" placeholder="4500" required>
            </div>
            <div>
                <label>Quantidade em Stock:</label>
                <input type="number" name="stock_atual" class="input-campo" placeholder="12" required>
            </div>
        </div>

        <label>Fotografia Real do Produto:</label>
        <input type="file" name="foto_produto" class="input-campo" accept="image/*" style="border: 1px dashed #38bdf8; background: transparent; padding: 10px; cursor: pointer;">

        <button type="submit" class="btn-enviar">Disponibilizar na Loja Escolhida ⚡</button>
        
        <div style="text-align: center; margin-top: 15px;">
            <a href="Lojas.php" style="color: #64748b; text-decoration: none; font-size: 12px; font-weight: bold;">← Ver Vitrina Pública</a>
        </div>
    </form>
</div>

</body>
</html>