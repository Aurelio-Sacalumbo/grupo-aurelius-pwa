<?php
// =========================================================================
// 🛒 ENGINE SAAS B2B/B2C - CRIAÇÃO DE LOJAS AUTOMÁTICAS E LOGÍSTICA - AURÉLIUS
// =========================================================================
if (!isset($_SESSION)) { 
    session_start(); 
}
date_default_timezone_set('Africa/Luanda');

// Conexão Central com o Banco de Dados
$mysqli = new mysqli("127.0.0.1", "root", "", "aurelius_salao");
if ($mysqli->connect_error) { 
    die("Falha na ligação técnica do ecossistema: " . $mysqli->connect_error); 
}
$mysqli->set_charset("utf8");

$mensagem_sucesso = "";
$mensagem_erro = "";

// 🟢 CONTROLADOR 1: DETEÇÃO E PROCESSAMENTO DO FORMULÁRIO DE 4 PASSOS DE CRIAÇÃO DA LOJA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['disparar_registro_loja_aurélys'])) {
    
    $nome_loja        = $mysqli->escape_string(trim($_POST['nome_loja']));
    $provincia_sede   = $mysqli->escape_string($_POST['provincia']);
    $municipio_sede   = $mysqli->escape_string($_POST['municipio']);
    $endereco_exacto  = $mysqli->escape_string(trim($_POST['endereco']));
    $email_loja       = $mysqli->escape_string(trim($_POST['email']));
    $iban_bancario    = isset($_POST['iban_bancario']) ? $mysqli->escape_string(trim($_POST['iban_bancario'])) : ''; 
    $telefone_loja    = $mysqli->escape_string(trim($_POST['telefone']));
    $pin_cadastro     = $mysqli->escape_string(trim($_POST['pin_cadastro'])); 
    
    // Captura Avançada de Requisitos de E-Commerce & Logística (Abas 3 e 4)
    $escala_catalogo     = isset($_POST['escala_catalogo']) ? $mysqli->escape_string($_POST['escala_catalogo']) : 'pequeno';
    $controlo_stock      = isset($_POST['controlo_stock_ecommerce']) ? $mysqli->escape_string($_POST['controlo_stock_ecommerce']) : 'estrito';
    $calculo_frete       = isset($_POST['calculo_frete']) ? $mysqli->escape_string($_POST['calculo_frete']) : 'fixo_municipio';
    $metodos_entrega     = isset($_POST['metodos_entrega']) ? $_POST['metodos_entrega'] : [];
    $pagamentos_loja     = isset($_POST['pagamentos_loja']) ? $_POST['pagamentos_loja'] : [];
    $design_layout       = isset($_POST['design_layout']) ? $mysqli->escape_string($_POST['design_layout']) : 'moderno_dark';
    $cor_primaria_custom = isset($_POST['cor_primaria_custom']) ? $mysqli->escape_string($_POST['cor_primaria_custom']) : '#1e3a8a';
    $cor_destaque_custom = isset($_POST['cor_destaque_custom']) ? $mysqli->escape_string($_POST['cor_destaque_custom']) : '#eab308';

    // Montagem estruturada do JSON para gravação isolada na tabela lojas
    $requisitos_loja = array(
        'escala_catalogo'   => $escala_catalogo,
        'controlo_stock'    => $controlo_stock,
        'calculo_frete'     => $calculo_frete,
        'metodos_entrega'   => $metodos_entrega,
        'pagamentos_loja'   => $pagamentos_loja,
        'design_layout'     => $design_layout,
        'cor_primaria'      => $cor_primaria_custom,
        'cor_destaque'      => $cor_destaque_custom,
        'modulo_produtos'   => 'Sim',
        'comissao_retida'   => 10.00, 
        'data_criacao'      => date('Y-m-d H:i:s')
    );
    $especificacoes_json = $mysqli->escape_string(json_encode($requisitos_loja, JSON_UNESCAPED_UNICODE));

    // Validação estrita de credenciais duplicadas na tabela lojas
    $check_email = $mysqli->query("SELECT id FROM lojas WHERE email_mercantil = '$email_loja' LIMIT 1");
    if ($check_email && $check_email->num_rows > 0) {
        $mensagem_erro = "🚨 Conflito Comercial: Este e-mail mercantil já se encontra registado noutra distribuidora.";
    }

    if (empty($mensagem_erro)) {
        $slug_loja = str_replace(' ', '', ucwords(preg_replace('/[^a-zA-Z0-9 ]/', '', $nome_loja)));
        $data_atual = date('Y-m-d');

        // 1. GERAÇÃO AUTOMÁTICA DO ID DO PARCEIRO
        $id_publico_loja = "AUR-" . rand(1000, 9999);

        // 2. INSERÇÃO NA TABELA LOJAS
        $sql_loja_nova = "INSERT INTO lojas (id_publico, pin_acesso, nome_loja, email_mercantil, telefone_corporativo, endereco_armazem, slug_loja, transacao_status, visivel_no_site, especificacoes_json, data_cadastro, iban_bancario) 
                          VALUES ('$id_publico_loja', '$pin_cadastro', '$nome_loja', '$email_loja', '$telefone_loja', '$endereco_exacto ($municipio_sede, $provincia_sede)', '$slug_loja', 'Confirmado', 1, '$especificacoes_json', '$data_atual', '$iban_bancario')";

       // DENTRO DO IF DE SUCESSO DO INSERT DE LOJAS:
if ($mysqli->query($sql_loja_nova)) {
    $id_nova_loja = $mysqli->insert_id;

    // 🔒 UNIFORMIZAÇÃO EXATA: Força as chaves corretas para o login_parceiros e admin_venda lerem
    $_SESSION['loja_id']        = $id_nova_loja; 
    $_SESSION['empresa_codigo'] = null; // Limpa para não misturar com barbearias
    $_SESSION['nome_loja']      = $nome_loja;

    echo "<script>
            alert('🎉 Parabéns! A sua Loja foi criada com sucesso! ID: " . $id_publico_loja . "');
            window.location.href = 'Admin_Venda.php';
          </script>";
    exit;
}
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de Nova Loja - Grupo Aurélius</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0f172a; color: #f8fafc; padding: 20px; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; box-sizing: border-box; }
        .wrapper-card { max-width: 680px; width: 100%; background: #1e293b; padding: 35px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; box-sizing: border-box; }
        .barra-passos { display: flex; justify-content: space-between; margin-bottom: 25px; background: #0f172a; padding: 12px 20px; border-radius: 30px; border: 1px solid #334155; }
        .passo-txt { font-size: 11px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .passo-txt.active { color: #eab308; }
        .aba-painel { display: none; text-align: left; }
        .aba-painel.active { display: block; }
        .form-campo { margin-bottom: 18px; text-align: left; }
        label { display: block; font-size: 11px; color: #38bdf8; font-weight: bold; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], select, textarea { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #f8fafc; font-size: 14px; box-sizing: border-box; transition: border-color 0.3s; }
        input:focus, select:focus, textarea:focus { border-color: #eab308; outline: none; }
        .grid-custom { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .grid-boxes { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; background: #0f172a; padding: 15px; border-radius: 10px; border: 1px dashed #475569; }
        .item-check { display: flex; align-items: center; gap: 10px; color: #e2e8f0; font-size: 13px; cursor: pointer; padding: 6px; border-radius: 6px; transition: background 0.2s; }
        .item-check:hover { background: #1e293b; }
        .item-check input { width: auto; cursor: pointer; accent-color: #eab308; }
        .bloco-subseccao { margin-top: 20px; background: #111827; padding: 18px; border-radius: 12px; border: 1px solid #1e293b; }
        .bloco-subseccao h4 { margin: 0 0 12px 0; font-size: 12px; color: #38bdf8; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-nav { padding: 12px 24px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 13px; text-transform: uppercase; transition: all 0.3s; }
        .btn-ant { background: #475569; color: white; float: left; }
        .btn-ant:hover { background: #334155; }
        .btn-seg { background: #eab308; color: #000; float: right; }
        .btn-seg:hover { background: #ca8a04; }
        .btn-enviar { background: #22c55e; color: #000; float: right; font-weight: bold; font-size: 14px; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.3); }
        .btn-enviar:hover { background: #16a34a; transform: translateY(-1px); }
        .alert-box { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; }
    </style>
</head>
<body>

<div class="wrapper-card">
<h2>Cria o teu espaço de vendas </h2>
    <div class="barra-passos">
        <div class="passo-txt active" id="ind-1">1. Sede</div>
        <div class="passo-txt" id="ind-2">2. Conta</div>
        <div class="passo-txt" id="ind-3">3. E-Commerce</div>
        <div class="passo-txt" id="ind-4">4. Aparência</div>
    </div>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="alert-box"><?php echo $mensagem_erro; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        
        <!-- =========================================================================
             🖼️ ABA 1: CONFIGURAÇÃO DE SEDE LOCAL E IDENTIFICAÇÃO MERCANTIL
             ========================================================================= -->
        <div id="aba-1" class="aba-painel active">
            <h3 style="color: #eab308; font-size: 14px; text-transform: uppercase; margin-bottom: 20px; border-left: 3px solid #eab308; padding-left: 8px;">1. Dados de Localização da Loja</h3>
            
            <div class="form-campo">
                <label>Nome Comercial da Loja Fornecedora:</label>
                <input type="text" name="nome_loja" id="nome_loja" required placeholder="Ex:Loja CSH Ltd">
            </div>
            
            <div class="grid-custom">
                <div class="form-campo">
                    <label>Província de Distribuição:</label>
                    <select name="provincia" id="provincia">
                    <option value="Selecionar" selected>Selecione uma Província</option>
                        <option value="Bengo">Bengo</option>
                        <option value="Benguela">Benguela</option>
                        <option value="Bié">Bié</option>
                        <option value="Cabinda">Cabinda</option>
                        <option value="Cuanza Norte">Cuanza Norte</option>
                        <option value="Cuanza Sul">Cuanza Sul</option>
                        <option value="Cuando Cubango">Cuando Cubango</option>
                        <option value="Cunene">Cunene</option>
                        <option value="Huambo">Huambo</option>
                        <option value="Huambo">Huíla</option>
                        <option value="Luanda">Luanda</option>
                        <option value="Lunda Norte">Lunda Norte</option>
                        <option value="Lunda Sul">Lunda Sul</option>
                        <option value="Malanje">Malanje</option>
                        <option value="Moxico">Moxico</option>
                        <option value="Namibe">Namibe</option>
                        <option value="Uíge">Uíge</option>
                        <option value="Zaire">Zaire</option>
                    </select>
                </div>
                <div class="form-campo">
                    <label>Município Sede do Armazém:</label>
                    <input type="text" name="municipio" id="municipio" required placeholder="Ex: Lubango, Maianga...">
                </div>
            </div>

            <div class="form-campo">
                <label>Localização do Endereço Físico Completo/ Escritório:</label>
                <input type="text" name="endereco" id="endereco" required placeholder="Rua, Bairro, número da porta e pontos de referência...">
            </div>

            <div style="margin-top: 30px; height: 40px;">
          

                <button type="button" class="btn-nav btn-seg" Style="margin-left:50px;" onclick="avancarParaAba2()">Seguinte (Credenciais) →</button>

                <button type="button" class="btn-nav btn-seg"  ><a Style="text-decoration:none;" href="Principal.php"> ← Voltar</a> </button>
            </div>
        </div>

        <!-- =========================================================================
             🔐 ABA 2: SEGURANÇA E ACESSO MERCANTIL
             ========================================================================= -->
             <div id="aba-2" class="aba-painel">
             <h3 style="color: #eab308; font-size: 14px; text-transform: uppercase; margin-bottom: 20px; border-left: 3px solid #eab308; padding-left: 8px;">2. Credenciais de Login Comercial</h3>
             
             <div class="grid-custom">
                 <div class="form-campo">
                     <label>E-mail Mercantil (Apenas Notificações):</label>
                     <input type="email" name="email" id="email" required placeholder="Ex: vendas@empresa.com">
                 </div>
                 <div class="form-campo">
                     <label>Terminal Telefónico:</label>
                     <input type="number" name="telefone" id="telefone" required placeholder="Ex: 923000000">
                 </div>
             </div>
 
             <div class="form-campo" style="margin-top: 15px;">
    <label>IBAN Bancário da Conta Escrow (Para Repasse de Vendas):</label>
    <input type="text" name="iban_bancario" id="iban_bancario" required placeholder="AO06.0000.0000.0000.0000.0" style="width: 100%;">
</div>
             <div class="grid-custom">
                 <div class="form-campo">
                     <label>Defina o seu PIN de Acesso (0 a 9 dígitos):</label>
                     <input type="number" name="pin_cadastro" id="pin_cadastro" required min="0" max="999999999" placeholder="Ex: 123456" oninput="if(this.value.length > 9) this.value = this.value.slice(0,9);">
                 </div>
                 <div class="form-campo">
                     <label>Confirmar PIN de Acesso:</label>
                     <input type="number" id="pin_confirmacao" required min="0" max="999999999" placeholder="Repita o PIN" oninput="if(this.value.length > 9) this.value = this.value.slice(0,9);">
                 </div>
             </div>
 
             <div style="margin-top: 30px; height: 40px;">
                 <button type="button" class="btn-nav btn-ant" onclick="irParaAba(1)">← Voltar</button>
                 <button type="button" class="btn-nav btn-seg" onclick="avancarParaAba3()">Seguinte (Logística) →</button>
             </div>
         </div>

        <!-- =========================================================================
             📦 ABA 3: ENGENHARIA DE LOGÍSTICA E E-COMMERCE ATACADISTA
             ========================================================================= -->
        <div id="aba-3" class="aba-painel">
            <h3 style="color: #22c55e; font-size: 14px; text-transform: uppercase; margin-bottom: 20px; border-left: 3px solid #22c55e; padding-left: 8px;">3. Infraestrutura de E-Commerce & Logística Global</h3>
            
            <div class="grid-custom">
                <div class="form-campo">
                    <label>Tipos de Emporesa:</label>
                    <select name="escala_catalogo">
                        <option value="pequeno">Pequeno Porte (Até 50 Produtos Cosméticos)</option>
                        <option value="medio" selected>Médio Porte (Até 500 Produtos - Distribuidor Regional)</option>
                        <option value="atacadista">Grande Porte / Grossista (Produtos Ilimitados)</option>
                    </select>
                </div>
                <div class="form-campo">
                    <label>Políticas de Gestão de Stock:</label>
                    <select name="controlo_stock_ecommerce">
                        <option value="estrito">Bloquear Vendas Automáticas se o Stock Chegar a 0</option>
                        <option value="sob_encomenda">Permitir Venda sob Encomenda (Prazo Adicional)</option>
                    </select>
                </div>
            </div>

            <div class="bloco-subseccao">
                <h4> Métodos de Entrega Disponíveis na Loja:</h4>
                <div class="grid-boxes" style="grid-template-columns: 1fr;">
                    <label class="item-check"><input type="checkbox" name="metodos_entrega[]" value="Levantamento Local" checked>  Levantamento Físico no Armazém / Balcão</label>
                    <label class="item-check"><input type="checkbox" name="metodos_entrega[]" value="Estafeta Rapido" checked>  Entrega Local </label>
                    <label class="item-check"><input type="checkbox" name="metodos_entrega[]" value="Frete Interprovincial" checked>Entrega Global(Inter-Provincial)</label>
                </div>
            </div>

            <div class="form-campo" style="margin-top: 15px;">
                <label>Regra de Cobrança de Frete por Distância:</label>
                <select name="calculo_frete">
                    <option value="fixo_municipio">Preço Fixo Apenas para o Município Sede</option>
                    <option value="a_cobrar_distancia" selected>🚨 Frete a Cobrar no Destino (Calculado por KM )</option>
                </select>
            </div>

            <div class="bloco-subseccao">
                <h4>Liquidação Financeira Ativos:</h4>
                <div class="grid-boxes">
                    <label class="item-check"><input type="checkbox" name="pagamentos_loja[]" value="AppyPay_Express" checked> Multicaixa Express</label>
                    <label class="item-check"><input type="checkbox" name="pagamentos_loja[]" value="Unitel_Money" checked> Unitel Money</label>
                </div>
            </div>

            <div style="margin-top: 30px; height: 40px;">
                <button type="button" class="btn-nav btn-ant" onclick="irParaAba(2)">← Voltar</button>
                <button type="button" class="btn-nav btn-seg" onclick="avancarParaAba4()">Seguinte (Aparência) →</button>
            </div>
        </div>

       <!-- =========================================================================
     🎨 ABA 4: CUSTOMIZAÇÃO DE DESIGN E GEOMETRIA FLUIDA
     ========================================================================= -->
<div id="aba-4" class="aba-painel">
<h3 style="color: #38bdf8; font-size: 14px; text-transform: uppercase; margin-bottom: 20px; border-left: 3px solid #38bdf8; padding-left: 8px;">4. Formato da Interface</h3>

<div class="form-campo">
    <label>Estilo Arquitetónico da Loja :</label>
    <select name="design_layout" style="width: 100%;">
        <option value="moderno_dark" selected>Modern Dark (Preto Profundo, Sombras Intensas & Neon Reativo)</option>
        <option value="premium_gold">Premium Gold (Executivo, Detalhes em Ouro Metálico e Castanho)</option>
        <option value="clean_light">Minimalist Light (Branco Puro & Iluminação de Estúdio)</option>
    </select>
</div>

<div class="grid-custom">
    <div class="form-campo">
        <label>Cor Primária dos Botões Ativos e Títulos:</label>
        <input type="color" name="cor_primaria_custom" value="#1e3a8a" style="height:45px; padding:0; cursor:pointer;">
    </div>
    <div class="form-campo">
        <label>Cor de Destaque para Efeitos de Passagem (Hover):</label>
        <input type="color" name="cor_destaque_custom" value="#eab308" style="height:45px; padding:0; cursor:pointer;">
    </div>
</div>

<div class="bloco-subseccao" style="border: 1px dashed #38bdf8; padding: 15px; border-radius: 8px; margin-top: 15px;">
    <h4>📐 Geometria Espacial dos Componentes:</h4>
    <select id="formato_geometria" onchange="atualizarPrevisualizacaoLojaForma()" style="width: 100%;">
        <option value="quadrado">Quadrado Perfeito (Linhas Retas Rígidas - 0px)</option>
        <option value="retangulo" selected>Retângulo Suave (Bordas Arredondadas Modernas - 12px)</option>
        <option value="bolla">Formato Bola / Círculo Total (Totalmente Ovalado - 50%)</option>
        <option value="hexagono">Hexágono Futurista (Colmeia Digital Cypher)</option>
    </select>

    <div class="form-campo" style="text-align: center; margin-top: 15px;">
        <label style="color: #ca8a04; font-weight: bold; display: block; margin-bottom: 5px;">👁️ Pré-visualização do Formato Comercial:</label>
        <div style="display: flex; justify-content: center; align-items: center; padding: 15px; background: #0f172a; border-radius: 8px;">
            <div id="demo_forma_loja" style="width: 80px; height: 80px; background: linear-gradient(135deg, #1e3a8a, #eab308); transition: all 0.3s; border-radius: 12px;"></div>
        </div>
    </div>
</div>

<!-- 🎉 MENSAGEM FINAL DE BOAS-VINDAS E REVISÃO CONTRATUAL -->
<div class="bloco-subseccao" style="margin-top: 25px; border: 1px dashed #22c55e; background: rgba(34, 197, 94, 0.05); padding: 20px; border-radius: 12px; text-align: center;">
    <h3 style="color: #22c55e; margin: 0 0 10px 0; font-size: 15px; text-transform: uppercase; font-weight: bold;">🎉 Quase Lá! O seu Império Comercial está pronto</h3>
    <p style="color: #e2e8f0; font-size: 13px; line-height: 1.6; margin: 0 0 12px 0; text-align: justify;">
        Seja muito bem-vindo ao ecossistema de e-commerce do **Grupo Aurélius**! A sua distribuidora foi configurada com absoluto isolamento logístico e de catálogo mercantil.
    </p>
    <p style="color: #94a3b8; font-size: 12px; line-height: 1.5; margin: 0; text-align: justify;">
        📌 **Próximos Passos**: Analisaremos imediatamente os seus requisitos de frete e métodos de entrega. Entraremos em contacto para acertar os trâmites contratuais de parceria, validar a sua conta e liberar o disparo dos agendamentos de pagamentos via Multicaixa Express e Unitel Money.
    </p>
</div>

<div style="margin-top: 30px; height: 40px;">
    <button type="button" class="btn-nav btn-ant" onclick="irParaAba(3)">← Voltar</button>
    <button type="submit" name="disparar_registro_loja_aurélys" class="btn-nav btn-enviar">⚡ Lançar Loja Cosmética Autónoma</button>
</div>
</div>

</form>
</div>

<script>
// 🕹️ MOTOR DE NAVEGAÇÃO DE ABAS SAAS COMERCIAL
function irParaAba(numeroAba) {
document.querySelectorAll('.aba-painel').forEach(aba => aba.classList.remove('active'));
document.querySelectorAll('.passo-txt').forEach(ind => ind.classList.remove('active'));

var abaAlvo = document.getElementById('aba-' + numeroAba);
var indAlvo = document.getElementById('ind-' + numeroAba);

if(abaAlvo) abaAlvo.classList.add('active');
if(indAlvo) indAlvo.classList.add('active');
}

function avancarParaAba2() {
if (document.getElementById('nome_loja').value.trim() === "" || document.getElementById('municipio').value.trim() === "") {
    alert("🚨 Dados em falta:\nIntroduza o Nome Comercial da Distribuidora e o Município Sede.");
    return;
}
irParaAba(2);
}

function avancarParaAba3() {
var email = document.getElementById('email').value.trim();
var tel = document.getElementById('telefone').value.trim();

// Captura os novos campos de PIN da sua Aba 2
var pin1 = document.getElementById('pin_cadastro').value;
var pin2 = document.getElementById('pin_confirmacao').value;

if (email === "" || tel === "") {
    alert("🚨 Campos Obrigatórios:\nPreencha o E-mail Mercantil e o Terminal Telefónico.");
    return;
}

if (pin1 === "" || pin2 === "") {
    alert("🚨 Segurança em falta:\nPor favor, defina e confirme o seu PIN de acesso.");
    return;
}

if (pin1 !== pin2) {
    alert("❌ Incompatibilidade de PIN:\nOs códigos numéricos introduzidos não coincidem. Verifique-os.");
    return;
}

irParaAba(3);
}

function avancarParaAba4() {
irParaAba(4);
}

// 🕹️ RENDERIZAÇÃO GEOMÉTRICA DE FORMAS EM TEMPO REAL
function atualizarPrevisualizacaoLojaForma() {
var forma = document.getElementById('formato_geometria').value;
var demo = document.getElementById('demo_forma_loja');
if(!demo) return;

demo.style.clipPath = "none";
demo.style.borderRadius = "0px";

if (forma === 'retangulo') demo.style.borderRadius = "12px";
if (forma === 'bolla') demo.style.borderRadius = "50%";
if (forma === 'hexagono') demo.style.clipPath = "polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%)";
}

document.addEventListener("DOMContentLoaded", function() {
atualizarPrevisualizacaoLojaForma();
});
</script>
</body>
</html>