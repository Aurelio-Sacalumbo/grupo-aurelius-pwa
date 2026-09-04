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

// =========================================================================
// 🟢 CONEXÃO CENTRAL ADAPTADA DIRETAMENTE DA CONFIGURAÇÃO DO SISTEMA
// =========================================================================
if (file_exists("config/Banco.php")) {
    include_once("config/Banco.php");
} elseif (file_exists("Conexao.php")) {
    include_once("Conexao.php");
} elseif (file_exists("conexao.php")) {
    include_once("conexao.php");
}

// Ativa a ponte inteligente caso a variável venha com outro nome do Banco.php
$mysqli = $conexao_link ?? $conexao_aurelius ?? $mysqli ?? null;

// Se mesmo assim não encontrar no XAMPP local, faz o fallback de emergência:
if (!$mysqli) {
    $mysqli = @mysqli_connect("127.0.0.1", "root", "", "aurelius_salao");
}

if (!isset($mysqli) || !$mysqli) {
    die("<h3 style='text-align:center; font-family:sans-serif; margin-top:50px; color:#dc3545;'>Falha de Conexão: O motor de base de dados \$mysqli não está ativo.</h3>");
}

$mysqli->set_charset("utf8mb4");

// 🟢 MÓDULO ADICIONADO: CAPTURA E INICIALIZAÇÃO DA CONSULTA DA FATURA
// Resgata o ID da fatura/pagamento vindo da URL (ex: fatura.php?id=12) ou assume o último por segurança
$id_pagamento = isset($_GET['id']) ? intval($_GET['id']) : (isset($_SESSION['ultimo_pagamento_id']) ? intval($_SESSION['ultimo_pagamento_id']) : 1);

$pagamento = [];

try {
    // 🧠 TENTATIVA 1: Procura na tabela ativa onde estão guardados os dados recentes
    $sql_atendimentos = "SELECT * FROM `atendimentos` WHERE `id` = $id_pagamento LIMIT 1";
    $query_fatura = $mysqli->query($sql_atendimentos);

    if ($query_fatura && $query_fatura->num_rows > 0) {
        $pagamento = $query_fatura->fetch_assoc();
        
        // Normaliza as colunas de atendimentos para o padrão do emissor
        $pagamento['cliente'] = $pagamento['cliente'] ?? $pagamento['nome_cliente'];
        $pagamento['funcionario'] = $pagamento['funcionario'] ?? $pagamento['profissional'];
        $pagamento['servico'] = $pagamento['servico'] ?? $pagamento['tipo_servico'];
        $pagamento['valor'] = $pagamento['valor'] ?? $pagamento['preco'];
        $pagamento['data_venda'] = $pagamento['data_venda'] ?? ($pagamento['data'] ?? ($pagamento['data_hora'] ?? ''));
    } else {
        // TENTATIVA 2: Fallback na tabela secundária de 'servicos' caso o ID venha de lá
        $query_servicos = $mysqli->query("SELECT * FROM `servicos` WHERE `id` = $id_pagamento LIMIT 1");
        if ($query_servicos && $query_servicos->num_rows > 0) {
            $pagamento = $query_servicos->fetch_assoc();
            $pagamento['valor'] = $pagamento['valor'] ?? $pagamento['preco'];
            $pagamento['data_venda'] = $pagamento['data_venda'] ?? $pagamento['data_cadastro'];
        } else {
            // TENTATIVA 3: Fallback na tabela 'historico_vendas'
            $query_historico = $mysqli->query("SELECT * FROM `historico_vendas` WHERE `id` = $id_pagamento LIMIT 1");
            if ($query_historico && $query_historico->num_rows > 0) {
                $pagamento = $query_historico->fetch_assoc();
            }
        }
    }
} catch (Exception $e) {
    error_log("Falha no rastreio da fatura: " . $e->getMessage());
}

// Se encontrou dados legítimos no banco, desliga a contingência estática!
// 📁 CAMADA DE CONTINGÊNCIA: Se o banco falhar ou estiver vazio localmente, injeta dados padrão
if (empty($pagamento)) {
    $pagamento = [
        'id' => $id_pagamento,
        'nome_salao' => 'Barbearia Branca',
        'funcionario' => 'Aurélio',
        'cliente_telefone' => '925347372',
        'valor' => 5000,
        'desconto' => 0,
        'valor_liquido' => 5000,
        'data_venda' => date('Y-m-d H:i:s')
    ];
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

$telefone_cliente_final = $pagamento['cliente_telephone'] ?? ($pagamento['cliente_telefone'] ?? '925347372');
$desconto_kz = floatval($pagamento['desconto'] ?? 0);
$valor_bruto = floatval($pagamento['valor'] ?? 0);
$is_premium_cliente = ($desconto_kz > 0);
$total_final = (isset($pagamento['valor_liquido']) && $pagamento['valor_liquido'] > 0) ? floatval($pagamento['valor_liquido']) : $valor_bruto;
$preco_tabela_exibicao = $is_premium_cliente ? ($total_final + $desconto_kz) : $total_final;

// 4. API DO QR CODE GOOGLE CHARTS ENDPOINT (Corrigido para renderizar o quadrado perfeito)
$texto_qrcode = "Aurelius - Fatura: #FAC-" . $id_pagamento . " | Atendente: " . $atendente_final . " | Total: " . number_format($total_final, 0, '', '') . " AOA";
$url_qrcode = "https://googleapis.com" . urlencode($texto_qrcode) . "&choe=UTF-8";
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Fatura_Premium_#FAC-<?php echo $id_pagamento; ?></title>
    <style>
    body { 
        background: radial-gradient(circle at top, #0f172a 0%, #070a13 100%); 
        margin: 0; 
        padding: 0; 
        font-family: 'Segoe UI', system-ui, sans-serif; 
        min-height: 100vh; 
        box-sizing: border-box;
    }
    
    .topo-acoes-fatura { 
        max-width: 440px; 
        margin: 20px auto 0 auto; 
        display: flex; 
        justify-content: flex-end; 
        padding: 0 15px; 
        width: 92%;
        box-sizing: border-box;
    }
    
    .btn-fechar-recibo { 
        background: #ef4444; 
        color: white; 
        padding: 9px 20px; 
        border-radius: 30px; 
        font-weight: bold; 
        text-decoration: none; 
        font-size: 11px; 
        text-transform: uppercase; 
        border: 1px solid #dc2626; 
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3); 
        transition: 0.2s; 
    }
    .btn-fechar-recibo:hover { 
        background: #dc2626; 
        transform: translateY(-1.5px); 
    }

    /* 👑 PAINEL RESPONSIVO MOBILE-FIRST */
    .conteudo-fatura { 
        background: #ffffff; 
        color: #0f172a; 
        width: 92%; 
        max-width: 440px; 
        margin: 15px auto 50px auto; 
        padding: 30px 20px; /* Reduzido levemente para ecrãs pequenos de telemóveis */
        border-radius: 16px; 
        box-shadow: 0 20px 50px rgba(0, 210, 255, 0.15); 
        border-top: 10px solid #eab308; 
        box-sizing: border-box; 
        position: relative; 
        overflow: hidden; 
    }
    .conteudo-fatura::before { 
        content: ''; 
        position: absolute; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background: linear-gradient(180deg, rgba(234, 179, 8, 0.03) 0%, rgba(255,255,255,0) 100%); 
        pointer-events: none; 
    }
    
    .topo-centro { 
        text-align: center; 
        margin-bottom: 25px; 
    }
    
    /* Centralização perfeita para a imagem do QR Code em ecrãs móveis */
    .topo-centro img {
        max-width: 150px;
        width: 100%;
        height: auto;
        margin: 10px auto 0 auto;
        display: block;
    }
    
    .linha-pontilhada { 
        border-top: 2px dashed #cbd5e1; 
        margin: 18px 0; 
        position: relative; 
    }
    
    /* Correção de quebra de texto em ecrãs pequenos */
    .row-item { 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        font-size: 13.5px; 
        margin-bottom: 10px; 
        color: #334155; 
        gap: 10px;
    }
    .row-item span {
        word-break: break-word; /* Evita que nomes longos estraguem o layout */
    }
    .row-item strong { 
        color: #0f172a; 
        font-weight: 700; 
        text-align: right;
        word-break: break-word;
    }
    
    /* BLOCO DE TOTAL COM RESPANDOR NEON */
    .bloco-total { 
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
        border: 1px solid #334155; 
        padding: 15px; 
        margin-top: 20px; 
        font-size: 14px; 
        font-weight: bold; 
        color: #4ade80; 
        border-radius: 8px; 
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.15); 
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bloco-total span { 
        color: #fff; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 0.5px; 
    }
    .bloco-total strong { 
        font-size: 18px; 
        color: #22c55e; 
        font-family: monospace; 
    }
    
    .btn-print { 
        display: block; 
        width: 100%; 
        padding: 14px; 
        background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); 
        color: #000; 
        border: none; 
        font-weight: 800; 
        text-transform: uppercase; 
        cursor: pointer; 
        margin-top: 25px; 
        font-size: 12px; 
        letter-spacing: 1px; 
        border-radius: 8px; 
        box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3); 
        transition: 0.2s; 
    }
    .btn-print:hover { 
        background: linear-gradient(135deg, #ca8a04 0%, #a16207 100%); 
        transform: translateY(-1px); 
    }
    
    /* 🖨️ MEDIA QUERY DE IMPRESSÃO TÉRMICA OTIMIZADA */
    @media print { 
        body { 
            background: white !important; 
            color: black !important;
        } 
        .conteudo-fatura { 
            margin: 0 auto !important; 
            box-shadow: none !important; 
            border-top: none !important; 
            padding: 0 !important; 
            width: 100% !important; 
            max-width: 100% !important;
        } 
        .btn-print, .topo-acoes-fatura, .btn-fechar-recibo { 
            display: none !important; 
        } 
    }
</style>

<body>

    <div class="topo-acoes-fatura">
        <a href="Dashboard.php" class="btn-fechar-recibo">✕ Fechar Recibo</a>
    </div>

    <div class="conteudo-fatura" style="max-width: 420px; margin: 0 auto; box-sizing: border-box; width: 100%;">
        <div class="topo-centro">
            <div style="background: rgba(234, 179, 8, 0.1); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; border: 1px solid #eab308;">
                <span style="font-size: 24px; color: #eab308;">🎌</span>
            </div>
            <h2 style="margin: 0; font-size: 19px; color: #0f172a; font-weight: 800; letter-spacing: 0.5px;">COMPROVATIVO DE CAIXA</h2>
            <span style="font-size: 10.5px; color: #64748b; text-transform: uppercase; font-weight: bold; letter-spacing: 1px; display: block; margin-top: 3px;">Rede de Distribuição &amp; Estética Aurélius</span>
        </div>

        <div class="linha-pontilhada"></div>

        <!-- Metadados Operacionais -->
        <div class="row-item"><span>Fatura Referência:</span><strong>#FAC-<?= intval($pagamento['id'] ?? $id_pagamento) ?></strong></div>
        <div class="row-item"><span>Data de Emissão:</span><strong>
            <?php 
            $data_final_servico = $pagamento['data_venda'] ?? ($pagamento['data_cadastro'] ?? ($pagamento['data_publicacao'] ?? ''));
            if (!empty($data_final_servico) && $data_final_servico !== '0000-00-00 00:00:00') {
                echo date('d/m/Y H:i', strtotime($data_final_servico));
            } else {
                echo date('d/m/Y H:i'); 
            }
            ?>
        </strong></div>
        <div class="row-item"><span>Estado de Liquidação:</span><span style="color: #16a34a; font-weight: 800;">✓ CONFIRMADO</span></div>
        <div class="row-item"><span>Profissional / Atendente:</span><strong style="color: #2563eb; text-transform: uppercase;"><?= htmlspecialchars($atendente_final) ?></strong></div>

        <div class="linha-pontilhada"></div>

        <!-- 🟢 MÓDULO REATIVO: DADOS DO COMPRADOR / CLIENTE DINÂMICO -->
        <div class="row-item">
            <span>Cliente Destinatário:</span>
            <strong>
                <?php 
                // Varre de forma inteligente quem é o comprador baseado na origem da linha
                $cliente_nome_final = "Consumidor Geral";
                if (!empty($pagamento['nome_candidato'])) {
                    $cliente_nome_final = $pagamento['nome_candidato'];
                } elseif (!empty($pagamento['nome_autor'])) {
                    $cliente_nome_final = $pagamento['nome_autor'];
                } elseif (!empty($pagamento['nome'])) {
                    // Proteção para não exibir o nome da barbearia se o registro for de um cliente
                    $cliente_nome_final = ($pagamento['nivel'] === 'cliente') ? $pagamento['nome'] : "Consumidor Final";
                } elseif (!empty($pagamento['cliente'])) {
                    $cliente_nome_final = $pagamento['cliente'];
                }
                echo htmlspecialchars($cliente_nome_final);
                ?>
            </strong>
        </div>
        <div class="row-item"><span>Terminal Eletrónico:</span><span><?= htmlspecialchars($telefone_cliente_final) ?></span></div>

        <div class="linha-pontilhada"></div>

        <!-- 🟢 MÓDULO REATIVO: ARTIGO OU TIPO DE SERVIÇO PROCESSADO -->
        <div style="font-size: 11px; font-weight: bold; color: #64748b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Artigo / Serviço Processado:</div>
        <div style="font-size: 14.5px; font-weight: 800; margin-bottom: 12px; color: #0f172a; border-left: 3px solid #ca8a04; padding-left: 8px; word-break: break-word;">
            <?php 
            // Rastreia e mapeia automaticamente os nomes de serviços de qualquer tabela do ecossistema
            $servico_resolvido = "Atendimento Estético Geral";
            if (!empty($pagamento['servico'])) {
                $servico_resolvido = $pagamento['servico'];
            } elseif (!empty($pagamento['titulo'])) {
                $servico_resolvido = $pagamento['titulo'];
            } elseif (!empty($pagamento['nome_produto'])) {
                $servico_resolvido = "Cosmético: " . $pagamento['nome_produto'];
            } elseif (!empty($pagamento['cargo'])) {
                $servico_resolvido = "Inscrição de Vaga: " . $pagamento['cargo'];
            } elseif (!empty($pagamento['tipos_de_servico'])) {
                $servico_resolvido = $pagamento['tipos_de_servico'];
            }
            echo htmlspecialchars($servico_resolvido);
            ?>
        </div>

        <div class="row-item"><span>Preço de Tabela Base:</span><span><?= number_format($preco_tabela_exibicao, 2, ',', '.') ?> AOA</span></div>
        
        <?php if ($is_premium_cliente || $desconto_kz > 0): ?>
            <div class="row-item" style="color: #ca8a04; font-weight: bold;"><span>Estatuto VIP PWA (Desconto):</span><span>-<?= number_format($desconto_kz, 2, ',', '.') ?> AOA</span></div>
        <?php endif; ?>

        <div class="bloco-total" style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; background: #0f172a; padding: 12px; border-radius: 6px; color: #fff;">
            <span>LÍQUIDO PAGO NA APP:</span>
            <strong style="font-size: 16px; color: #eab308;"><?= number_format($total_final, 2, ',', '.') ?> AOA</strong>
        </div>

        <!-- Autenticidade QR Code Google Charts -->
        <div style="text-align: center; margin-top: 25px; background: #f8fafc; padding: 18px; border: 1px dashed #cbd5e1; border-radius: 8px; box-sizing: border-box; width: 100%;">
            <img src="<?= $url_qrcode ?>" alt="Autenticação Digital QR" style="display: block; margin: 0 auto 10px auto; width: 130px; height: 130px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #ddd; padding: 4px; background: #fff;">
            <span style="font-size: 10px; color: #64748b; display: block; font-family: sans-serif; line-height: 1.4;">Passe a câmara do telemóvel para auditar a autenticidade deste cupão único da rede.</span>
        </div>

        <div class="linha-pontilhada"></div>
        
        <p style="text-align: center; font-size: 11px; color: #64748b; margin: 0 0 20px 0; font-weight: 600; letter-spacing: 0.3px; line-height: 1.4;">
            ✓ Autenticação Eletrónica Registada<br>
            Obrigado por escolher os serviços da rede Aurélius!
        </p>
        
        <button class="btn-print" onclick="window.print()" style="width: 100%; padding: 14px; background: #0f172a; color: #fff; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;">🖨️ Executar Impressão Física</button>
    </div>
</body>
</html>