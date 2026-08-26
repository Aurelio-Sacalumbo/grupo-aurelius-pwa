<?php
// =========================================================================
// 🖨️ EMISSOR DE FATURAS PREMIUM - ECOSSISTEMA AURÉLIUS SAAS (EDER CORE v3)
// =========================================================================
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Africa/Luanda');

include_once("Conexao.php");

// 1. CAPTURA O ID DA URL (?id=... ou ?id_pagamento=...)
$id_pagamento = isset($_GET['id']) ? intval($_GET['id']) : (isset($_GET['id_pagamento']) ? intval($_GET['id_pagamento']) : 0);

if ($id_pagamento === 0) {
    try {
        $stmt_ultimo = $pdo->query("SELECT id_pagamento FROM pagamentos ORDER BY id_pagamento DESC LIMIT 1");
        $ultimo = $stmt_ultimo->fetch(PDO::FETCH_ASSOC);
        $id_pagamento = $ultimo ? intval($ultimo['id_pagamento']) : 101;
    } catch (PDOException $e) {
        die("Erro ao ler base de dados.");
    }
}

try {
    // 2. 🟢 QUERY AVANÇADA COM CRUZA-DADOS (JOIN): Se a coluna 'funcionario' for um ID, busca automaticamente o nome real do profissional
    $stmt = $pdo->prepare("
        SELECT p.*, f.nome AS nome_funcionario_real 
        FROM pagamentos p 
        LEFT JOIN funcionarios f ON (p.funcionario = f.id_funcionario OR p.profissional = f.id_funcionario)
        WHERE p.id_pagamento = ?
    ");
    $stmt->execute([$id_pagamento]);
    $pagamento = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pagamento) {
        die("<h3 style='text-align:center; font-family:sans-serif; margin-top:50px; color:#d32f2f;'>Fatura não encontrada no sistema central.</h3>");
    }

    // 3. RESOLVE O NOME DO PROFISSIONAL SEM MOSTRAR O NÚMERO 1
    $atendente_final = "Não Alocado";
    if (!empty($pagamento['nome_funcionario_real'])) {
        $atendente_final = $pagamento['nome_funcionario_real'];
    } elseif (!empty($pagamento['funcionario']) && !is_numeric($pagamento['funcionario'])) {
        $atendente_final = $pagamento['funcionario'];
    } elseif (!empty($pagamento['profissional']) && !is_numeric($pagamento['profissional'])) {
        $atendente_final = $pagamento['profissional'];
    }

    $telefone_cliente_final = $pagamento['cliente_telephone'] ?? ($pagamento['cliente_telefone'] ?? '900000000');
    $desconto_kz = floatval($pagamento['desconto']);
    $valor_bruto = floatval($pagamento['valor']);
    $is_premium_cliente = ($desconto_kz > 0);
    $total_final = $pagamento['valor_liquido'] > 0 ? floatval($pagamento['valor_liquido']) : $valor_bruto;
    $preco_tabela_exibicao = $is_premium_cliente ? ($total_final + $desconto_kz) : $total_final;

    // 4. API DO QR CODE GOOGLE CHARTS ENDPOINT
    $texto_qrcode = "Aurelius - Fatura: #FAC-" . $id_pagamento . " | Atendente: " . $atendente_final . " | Total: " . number_format($total_final, 0, '', '') . " AOA";
    $url_qrcode = "https://googleapis.com" . urlencode($texto_qrcode) . "&choe=UTF-8";

} catch (PDOException $e) {
    die("Erro interno no servidor: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Fatura_Premium_#FAC-<?php echo $id_pagamento; ?></title>
    <style>
        body { background: radial-gradient(circle at top, #0f172a 0%, #070a13 100%); margin: 0; padding: 0; font-family: 'Segoe UI', system-ui, sans-serif; min-height: 100vh; }
        
        .topo-acoes-fatura { max-width: 460px; margin: 25px auto 0 auto; display: flex; justify-content: flex-end; padding: 0 15px; }
        .btn-fechar-recibo { background: #ef4444; color: white; padding: 9px 20px; border-radius: 30px; font-weight: bold; text-decoration: none; font-size: 11px; text-transform: uppercase; border: 1px solid #dc2626; box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3); transition: 0.2s; }
        .btn-fechar-recibo:hover { background: #dc2626; transform: translateY(-1.5px); }

        /* 👑 COR BRILHANTE E GRADIENTE VISUAL PREMIUM */
        .conteudo-fatura { background: #ffffff; color: #0f172a; width: 92%; max-width: 440px; margin: 15px auto 50px auto; padding: 35px 30px; border-radius: 16px; box-shadow: 0 20px 50px rgba(0, 210, 255, 0.15); border-top: 10px solid #eab308; box-sizing: border-box; position: relative; overflow: hidden; }
        .conteudo-fatura::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(234, 179, 8, 0.03) 0%, rgba(255,255,255,0) 100%); pointer-events: none; }
        
        .topo-centro { text-align: center; margin-bottom: 25px; }
        .linha-pontilhada { border-top: 2px dashed #cbd5e1; margin: 18px 0; position: relative; }
        .row-item { display: flex; justify-content: space-between; font-size: 13.5px; margin-bottom: 8px; color: #334155; }
        .row-item strong { color: #0f172a; font-weight: 700; }
        
        /* BLOCO DE TOTAL COM RESPANDOR NEON */
        .bloco-total { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1px solid #334155; padding: 15px; margin-top: 20px; font-size: 15px; font-weight: bold; color: #4ade80; border-radius: 8px; box-shadow: 0 4px 15px rgba(34, 197, 94, 0.15); }
        .bloco-total span { color: #fff; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        .bloco-total strong { font-size: 19px; color: #22c55e; font-family: monospace; }
        
        .btn-print { display: block; width: 100%; padding: 14px; background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); color: #000; border: none; font-weight: 800; text-transform: uppercase; cursor: pointer; margin-top: 25px; font-size: 12px; letter-spacing: 1px; border-radius: 8px; box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3); transition: 0.2s; }
        .btn-print:hover { background: linear-gradient(135deg, #ca8a04 0%, #a16207 100%); transform: translateY(-1px); }
        
        @media print { body { background: white; } .conteudo-fatura { margin: 0 auto; box-shadow: none; border-top: none; padding: 10px; width: 100%; } .btn-print, .topo-acoes-fatura { display: none; } }
    </style>
</head>
<body>

    <div class="topo-acoes-fatura">
        <a href="Dashboard.php" class="btn-fechar-recibo">✕ Fechar Recibo</a>
    </div>

    <div class="conteudo-fatura">
        <div class="topo-centro">
            <div style="background: rgba(234, 179, 8, 0.1); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; border: 1px solid #eab308;">
                <span style="font-size: 24px; color: #eab308;">🎌</span>
            </div>
            <h2 style="margin: 0; font-size: 19px; color: #0f172a; font-weight: 800; letter-spacing: 0.5px;">COMPROVATIVO DE CAIXA</h2>
            <span style="font-size: 10.5px; color: #64748b; text-transform: uppercase; font-weight: bold; letter-spacing: 1px; display: block; margin-top: 3px;">Rede de Distribuição & Estética Aurélius</span>
        </div>

        <div class="linha-pontilhada"></div>

        <!-- Metadados Operacionais -->
        <div class="row-item"><span>Fatura Referência:</span><strong>#FAC-<?= $id_pagamento ?></strong></div>
        <div class="row-item"><span>Data de Emissão:</span><strong><?= date('d/m/Y H:i', strtotime($pagamento['data_registro'])) ?></strong></div>
        <div class="row-item"><span>Estado de Liquidação:</span><span style="color: #16a34a; font-weight: 800;">✓ CONFIRMADO</span></div>
        
        <!-- 🟢 CAMPO CORRIGIDO: Exibe automaticamente o Nome do Mestre em vez do número 1 -->
        <div class="row-item"><span>Profissional / Atendente:</span><strong style="color: #2563eb; text-transform: uppercase;"><?= htmlspecialchars($atendente_final) ?></strong></div>

        <div class="linha-pontilhada"></div>

        <!-- Dados do Comprador -->
        <div class="row-item"><span>Cliente Destinatário:</span><strong><?= htmlspecialchars($pagamento['cliente'] ?? 'Consumidor Final') ?></strong></div>
        <div class="row-item"><span>Terminal Eletrónico:</span><span><?= htmlspecialchars($telefone_cliente_final) ?></span></div>

        <div class="linha-pontilhada"></div>

        <!-- Detalhes Contábeis -->
        <div style="font-size: 11px; font-weight: bold; color: #64748b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Artigo / Serviço Processado:</div>
        <div style="font-size: 14.5px; font-weight: 800; margin-bottom: 12px; color: #0f172a; border-left: 3px solid #ca8a04; padding-left: 8px;"><?= htmlspecialchars($pagamento['servico']) ?></div>

        <div class="row-item"><span>Preço de Tabela Base:</span><span><?= number_format($preco_tabela_exibicao, 2, ',', '.') ?> AOA</span></div>
        
        <?php if ($is_premium_cliente): ?>
            <div class="row-item" style="color: #ca8a04; font-weight: bold;"><span>Estatuto VIP PWA (20% OFF):</span><span>-<?= number_format($desconto_kz, 2, ',', '.') ?> AOA</span></div>
        <?php endif; ?>

        <div class="bloco-total display: flex; justify-content: space-between; align-items: center;">
            <span>LÍQUIDO PAGO NA APP:</span>
            <strong><?= number_format($total_final, 2, ',', '.') ?> AOA</strong>
        </div>

        <!-- Autenticidade QR Code Google Endpoint -->
        <div style="text-align: center; margin-top: 25px; background: #f8fafc; padding: 18px; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <img src="<?= $url_qrcode ?>" alt="Autenticação Digital QR" style="display: block; margin: 0 auto 10px auto; width: 120px; height: 120px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <span style="font-size: 10px; color: #64748b; display: block; font-family: sans-serif; line-height: 1.4;">Passe a câmara do telemóvel para auditar a autenticidade deste cupão.</span>
        </div>

        <div class="linha-pontilhada"></div>
        
        <p style="text-align: center; font-size: 11px; color: #64748b; margin: 0 0 20px 0; font-weight: 600; letter-spacing: 0.3px; line-height: 1.4;">
            ✓ Autenticação Eletrónica Registada<br>
            Obrigado por escolher os serviços da rede Aurélius!
        </p>
        
        <!-- 🟢 BOTÃO DE IMPRESSÃO PROFISSIONAL E IMPONENTE -->
        <button class="btn-print" onclick="window.print()">🖨️ Executar Impressão Física</button>
    </div>
</body>
</html>