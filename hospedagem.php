


<?php
include_once(__DIR__ . "/Conexao.php");
$mysqli_hospedagem = $conexao_link ?? $conexao_aurelius;
// Ative a sessão se necessário
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// LIGAÇÃO AO BANCO DE DADOS (Certifique-se de que a sua conexão $pdo está aqui)

// 🛡️ MOTOR DE SEGURANÇA CONTRA DUPLICAÇÕES
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_parceiro'])) {
    
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $nome_empresa = trim($_POST['nome']);
    
    // 🔍 1. Valida se o E-mail ou Telefone já existem na base de dados
    $stmt_checar = $pdo->prepare("SELECT codigo FROM `usuario` WHERE email = ? OR telefone = ? LIMIT 1");
    $stmt_checar->execute([$email, $telefone]);
    
    if ($stmt_checar->rowCount() > 0) {
        // ❌ Bloqueia se encontrar duplicado
        echo "<script>
                alert('⚠️ Erro de Registo: Este e-mail ou número de telefone já está registado!');
                window.history.back();
              </script>";
        exit();
    } else {
        
        // 🟢 2. SE NÃO EXISTIR, CONTINUA O SEU CÓDIGO ORIGINAL DE INSERÇÃO DAQUI PARA BAIXO:
        $senha_hash = md5($_POST['senha']); 
        $data_atual = date('Y-m-d');
        
        // O seu código original de salvar a imagem e fazer o INSERT continua aqui...
        
    }
}
?>
<?php
// =========================================================================
// 🌍 MOTOR DE HOSPEDAGEM AUTOMÁTICA SAAS - GRUPO AURÉLIUS (HOSPEDAGEM.PHP)
// =========================================================================
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
date_default_timezone_set('Africa/Luanda');

// 🟢 1. Ativar exibição de erros no ecrã para sabermos exatamente o que falhou
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🟢 2. Ligação Segura à Base de Dados Mestre
$host     = "127.0.0.1"; 
$dbname   = "aurelius_salao";
$user     = "root";
$password = ""; 

$mysqli = new mysqli($host, $user, $password, $dbname);
if ($mysqli->connect_error) {
    die("<div style='background:red;color:white;padding:15px;'>⚠️ Erro de Infraestrutura MySQL: " . $mysqli->connect_error . "</div>");
}
$mysqli->set_charset("utf8mb4");

// 🟢 3. Interceção e Captura do Envio do Formulário (Etapa 3)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura segura de todas as variáveis enviadas pelas 3 etapas
    $nome_salao       = trim($_POST['nome_salao'] ?? '');
    $nome_gerente     = trim($_POST['nome_gerente'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $telefone         = trim($_POST['telefone'] ?? '');
    $provincia        = trim($_POST['provincia'] ?? 'Huambo');
    $endereco_detalhe = trim($_POST['endereco'] ?? '');
    $tipo_servico     = trim($_POST['tipo_servico'] ?? 'Geral');
    $preco_contrato   = (float)($_POST['preco_contrato'] ?? 10000.00);
    $qtd_cadeiras     = (int)($_POST['qtd_cadeiras'] ?? 2);
    
    // Configurações padrão obrigatórias do phpMyAdmin do Grupo Aurélius
    $data_atual       = date('Y-m-d');
    $status_inicial   = 'Aguardando Validação'; // Fica oculto até aprovar no Admin
    $nivel_padrao     = 'parceiro_hospedado';
    $slug_padrao      = preg_replace('/[^A-Za-z0-9]/', '', $nome_salao);
    if(empty($slug_padrao)) { $slug_padrao = "Login"; }
    
    $senha_bruta      = $_POST['senha_login'] ?? '123456';
    $senha_encriptada = password_hash($senha_bruta, PASSWORD_DEFAULT); 
    $iban_padrao      = "AO06.0000.0000.0000.0000.0";
    
    // Concatena endereço
    $endereco_completo = $provincia . " - " . $endereco_detalhe;
    
    // Captura os sub-serviços selecionados e transforma em string ou JSON
    $servicos_selecionados = $_POST['servicos_lista'] ?? [];
    $string_servicos = !empty($servicos_selecionados) ? implode(", ", $servicos_selecionados) : $tipo_servico;
    $json_specs = json_encode(["cadeiras_operacionais" => $qtd_cadeiras, "servicos" => $servicos_selecionados]);

    // 🟢 4. Processamento Físico de Imagens (Uploads)
    $pasta_destino = "uploads/";
    if (!file_exists($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }

    $nome_logo        = "OIP (6).webp"; 
    $nome_foto_frente = "";
    $nome_foto_verso  = "";

    if (!empty($_FILES['logo_salao']['name'])) {
        $nome_logo = time() . "_" . basename($_FILES['logo_salao']['name']);
        move_uploaded_file($_FILES['logo_salao']['tmp_name'], $pasta_destino . $nome_logo);
    }
    if (!empty($_FILES['bi_frente']['name'])) {
        $nome_foto_frente = time() . "_frente_" . basename($_FILES['bi_frente']['name']);
        move_uploaded_file($_FILES['bi_frente']['tmp_name'], $pasta_destino . $nome_foto_frente);
    }
    if (!empty($_FILES['bi_verso']['name'])) {
        $nome_foto_verso = time() . "_verso_" . basename($_FILES['bi_verso']['name']);
        move_uploaded_file($_FILES['bi_verso']['tmp_name'], $pasta_destino . $nome_foto_verso);
    }

    // 🟢 5. Execução do Comando INSERT Adaptado à Tabela "usuario"
    if (!empty($nome_gerente) && !empty($nome_salao)) {
        
        $gerente_safe  = $mysqli->real_escape_string($nome_gerente);
        $salao_safe    = $mysqli->real_escape_string($nome_salao);
        $email_safe    = $mysqli->real_escape_string($email);
        $tel_safe      = $mysqli->real_escape_string($telefone);
        $end_safe      = $mysqli->real_escape_string($endereco_completo);
        $servico_safe  = $mysqli->real_escape_string($string_servicos);
        $json_safe     = $mysqli->real_escape_string($json_specs);
        $slug_safe     = $mysqli->real_escape_string($slug_padrao);

        // SQL mapeado exatamente com os 19 campos da foto do seu banco de dados
        $sql_insert = "INSERT INTO `usuario` (
            `nome`, `nome_funcionario`, `email`, `telefone`, `endereco`, 
            `tipos_de_servico`, `preco`, `transacao_status`, `visivel_no_site`, 
            `nivel`, `slug`, `bi_frente`, `bi_verso`, `logo_empresa`, 
            `senha`, `data`, `especificacoes_json`, `iban_bancario`
        ) VALUES (
            '$gerente_safe', '$salao_safe', '$email_safe', '$tel_safe', '$end_safe', 
            '$servico_safe', $preco_contrato, '$status_inicial', 1, 
            '$nivel_padrao', '$slug_safe', '$nome_foto_frente', '$nome_foto_verso', '$nome_logo', 
            '$senha_encriptada', '$data_atual', '$json_safe', '$iban_padrao'
        )";

        if ($mysqli->query($sql_insert) === TRUE) {
            // Sucesso Total! Emite o alerta e limpa o POST redirecionando
            echo "<script>
                    alert('🚀 SUCESSO: Barbearia registada! Aguarde a ativação no Admin corporativo.');
                    window.location.href='hospedagem.php';
                  </script>";
            exit();
        } else {
            // Se o banco rejeitar por qualquer motivo, vai mostrar o erro exato na tela em vez de travar
            die("<div style='background:#7f1d1d; color:#fff; padding:20px; font-family:sans-serif; margin:20px; border-radius:8px;'>
                    <h3>🚨 Erro de Gravação na Base de Dados</h3>
                    <p><b>Mensagem do MySQL:</b> " . $mysqli->error . "</p>
                    <p><b>Query Executada:</b> <pre>" . htmlspecialchars($sql_insert) . "</pre></p>
                 </div>");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de Espaço Profissional - Grupo Aurélius</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0f172a; color: #f8fafc; padding: 20px; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; box-sizing: border-box; }
        .wrapper-card { max-width: 750px; width: 100%; background: #1e293b; padding: 35px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; box-sizing: border-box; }
        
        .barra-passos { display: flex; justify-content: space-between; margin-bottom: 25px; background: #0f172a; padding: 12px 20px; border-radius: 30px; border: 1px solid #334155; }
        .passo-txt { font-size: 11px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; }
        .passo-txt.active { color: #38bdf8; }
        
        .aba-painel { display: none; text-align: left; }
        .aba-painel.active { display: block; }
        
        .form-campo { margin-bottom: 16px; display: flex; flex-direction: column; }
        .form-campo label { font-size: 11px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px; }
        .form-campo input, .form-campo select, .form-campo textarea { padding: 12px; background: #0f172a; border: 1px solid #475569; border-radius: 6px; color: white; font-size: 14px; width: 100%; box-sizing: border-box; }
        .form-campo input:focus, .form-campo select:focus { border-color: #38bdf8; outline: none; }
        
        .gela-servicos-scrolling { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 10px; max-height: 220px; overflow-y: auto; background: #0b0f19; padding: 15px; border-radius: 8px; border: 1px solid #334155; margin-top: 5px; }
        .check-item-box { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #cbd5e1; cursor: pointer; padding: 4px; }
        .check-item-box input { width: 16px; height: 16px; accent-color: #38bdf8; cursor: pointer; }
        
        .grid-custom { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .btn-infraestrutura-trigger { width: 100%; padding: 16px; background: #22c55e; color: #000; border: none; border-radius: 8px; font-weight: bold; font-size: 14px; text-transform: uppercase; cursor: pointer; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.3); margin-top: 15px; }
        .btn-navegacao { padding: 12px 24px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; text-transform: uppercase; font-size: 12px; }
        .multimedia-box { display: flex; align-items: center; gap: 8px; background: rgba(56, 189, 248, 0.05); border: 1px solid rgba(56, 189, 248, 0.2); padding: 10px; border-radius: 6px; font-size: 11px; color: #38bdf8; margin-bottom: 12px; }

        
    </style>
</head>
<body>

<div class="wrapper-card">
    <div style="text-align: center; margin-bottom: 30px; border-bottom: 1px solid #334155; padding-bottom: 15px;">
        <h2 style="font-size: 22px; color: #fff;">🌍 Motor de Hospedagem Automática SaaS</h2>
        <p style="color: #94a3b8; font-size: 13px; margin-top: 4px;">Instancie a sua barbearia autossustentável em 10 camadas de banco de dados imediatamente [local].</p>
    </div>

    <?php if (!empty($erro_mensagem)): ?>
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #f87171; padding: 12px; border-radius: 6px; color: #f87171; margin-bottom: 20px; font-size: 13px; font-weight: bold;"><?= htmlspecialchars($erro_mensagem) ?></div>
    <?php endif; ?>

    <div class="barra-passos">
        <span class="passo-txt active" id="p1" onclick="mudarPasso(1)">1. Identidade</span>
        <span class="passo-txt" id="p2" onclick="mudarPasso(2)">2. Gestor & BI</span>
        <span class="passo-txt" id="p3" onclick="mudarPasso(3)">3. Arquitetura</span>
    </div>

    <!-- 🔥 Sincronizado para bater no motor PHP local da hospedagem.php -->
    <form method="POST" action="hospedagem.php" enctype="multipart/form-data" id="formInstanciacaoMaster">
        
        <!-- =========================================================================
             ETAPA 1: IDENTIDADE E ARQUIVOS DE DESIGN
             ========================================================================= -->
        <div id="etapa1" class="aba-painel active">
            <div class="grid-custom">
                <div class="form-campo">
                    <label>Nome Comercial do Salão / Barbearia:</label>
                    <input type="text" name="nome_salao" placeholder="Ex: Barbearia LookNovo" required>
                </div>
                <div class="form-campo">
                    <label>Logótipo Oficial da Empresa:</label>
                    <input type="file" name="logo_salao" accept="image/*">
                </div>
            </div>
            
            <div class="multimedia-box">
                📷 <span>O logótipo carregado será exibido automaticamente no card principal do painel multitenant [visual-exploration].</span>
            </div>

            <div class="grid-custom">
                <div class="form-campo">
                    <label>Província Sede (Angola):</label>
                    <select name="provincia" required style="width: 100%; padding: 11px 14px; background: #070b12; border: 1px solid #374151; border-radius: 8px; color: #fff; font-size: 13px; outline: none; box-sizing: border-box; font-family: sans-serif; cursor: pointer;">
                        <option value="" disabled selected>Selecione a Província...</option>
                        <option value="Bengo">Bengo</option>
                        <option value="Benguela">Benguela</option>
                        <option value="Bié">Bié</option>
                        <option value="Cabinda">Cabinda</option>
                        <option value="Cuando-Cubango">Cuando-Cubango</option>
                        <option value="Cuanza-Norte">Cuanza-Norte</option>
                        <option value="Cuanza-Sul">Cuanza-Sul</option>
                        <option value="Cunene">Cunene</option>
                        <option value="Huambo">Huambo</option>
                        <option value="Huíla">Huíla</option>
                        <option value="Luanda">Luanda</option>
                        <option value="Lunda-Norte">Lunda-Norte</option>
                        <option value="Lunda-Sul">Lunda-Sul</option>
                        <option value="Malanje">Malanje</option>
                        <option value="Moxico">Moxico</option>
                        <option value="Namibe">Namibe</option>
                        <option value="Uíge">Uíge</option>
                        <option value="Zaire">Zaire</option>
                    </select>
                </div>
                <div class="form-campo">
                    <label>Endereço, Bairro e Ponto de Referência:</label>
                    <input type="text" name="endereco" placeholder="Ex: Bairro de São Luís / IECA" required>
                </div>
            </div>
            <div style="text-align: right; margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px;">
                <a href="Principal.php" class="btn-navegacao" style="background: #475569; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: bold; display: inline-block; line-height: 1.5; text-transform: uppercase;">Voltar</a>
                <button type="button" class="btn-navegacao" onclick="mudarPasso(2)">Avançar →</button>
            </div>
        </div>
   
        <!-- =========================================================================
             ETAPA 2: GESTOR, CREDENCIAIS E AUDITORIA NACIONAL
             ========================================================================= -->
        <div id="etapa2" class="aba-painel" style="display: none;">
            <div class="grid-custom">
                <div class="form-campo">
                    <label>Nome Completo do Gerente / Diretor:</label>
                    <input type="text" name="nome_gerente" id="nome_gerente_campo" placeholder="Nome do responsável legal" required>
                </div>
                <div class="form-campo">
                    <label>Bilhete de Identidade (BI Angola):</label>
                    <input type="text" name="bi_gestor" id="bi_campo" placeholder="Ex: 004732158LA042" maxlength="14" style="letter-spacing:1px; font-weight:bold; color:#eab308;" required>
                </div>
            </div>
            
            <div class="grid-custom" style="margin-top: 5px; margin-bottom: 15px;">
                <div class="form-campo">
                    <label>📷 Carregar Frente do B.I.:</label>
                    <input type="file" name="bi_frente" accept="image/*" style="padding: 8px;">
                </div>
                <div class="form-campo">
                    <label>📷 Carregar Verso do B.I.:</label>
                    <input type="file" name="bi_verso" accept="image/*" style="padding: 8px;">
                </div>
            </div>

            <div class="grid-custom">
                <div class="form-campo">
                    <label>E-mail de Contacto Corporativo:</label>
                    <input type="email" name="email" id="email_campo" placeholder="gestao@empresa.com" required>
                </div>
                <div class="form-campo">
                    <label>Contacto Telefónico:</label>
                    <input type="number" name="telefone" id="telefone_campo" placeholder="9XXXXXXXX" required>
                </div>
            </div>
            <div class="form-campo">
                <label>Palavra-Passe de Acesso:</label>
                <input type="password" name="senha_login" id="senha_campo" placeholder="Mínimo 6 caracteres" required>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <button type="button" class="btn-navegacao" style="background:#475569;" onclick="mudarPasso(1)">← Voltar</button>
                <button type="button" class="btn-navegacao" onclick="ejecutarAuditoriaGestorEtapa2()">Avançar →</button>
            </div>
        </div>

        <!-- =========================================================================
             ETAPA 3: ARQUITETURA INDEPENDENTE E SUB-SERVIÇOS
             ========================================================================= -->
        <div id="etapa3" class="aba-painel" style="display: none;">
            <div class="grid-custom">
                <div class="form-campo">
                    <label>Quantidade de Cadeiras Operacionais:</label>
                    <input type="number" name="qtd_cadeiras" value="2" min="1" required>
                </div>
                <div class="form-campo">
                    <label style="color: #10b981;">Preço Proposto do Contrato (Kz):</label>
                    <input type="number" name="preco_contrato" step="0.01" value="10000.00" style="border-color: #10b981; font-weight: bold;" required>
                </div>
            </div>
            
            <div class="form-campo" style="margin-top: 12px;">
                <label>Modalidade Operacional / Categoria:</label>
                <input type="text" name="tipo_servico" value="Geral" placeholder="Ex: Premium, Geral, Luxo">
            </div>
            
            <div class="form-campo" style="margin-top: 15px;">
                <label>Gama de Ferramentas e Sub-Serviços Especializados:</label>
                <div class="gela-servicos-scrolling">
                    <span style="grid-column: 1/-1; font-size: 11px; color:#38bdf8; font-weight:bold; text-transform:uppercase;">✂️ Menu de Cortes & Estilos</span>
                    <label class="check-item-box"><input type="checkbox" name="servicos_lista[]" value="Corte Adulto Clássico" checked> Corte Adulto Clássico</label>
                    <label class="check-item-box"><input type="checkbox" name="servicos_lista[]" value="Corte Careca Total"> Corte Careca Total</label>
                    <label class="check-item-box"><input type="checkbox" name="servicos_lista[]" value="Barba Simples" checked> Design de Barba</label>
                    <label class="check-item-box"><input type="checkbox" name="servicos_lista[]" value="Sobrancelhas"> Limpeza de Sobrancelhas</label>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 25px;">
                <button type="button" class="btn-navegacao" style="background:#475569;" onclick="mudarPasso(2)">← Voltar</button>
                <button type="button" class="btn-navegacao" style="background:#475569;" onclick="mudarPasso(2)">← Voltar</button>
                <button type="submit" name="finalizar_saas" class="btn-infraestrutura-trigger" style="margin-top: 0; width: auto; padding: 12px 24px;">🚀 Concluir Instanciação SaaS</button>
            </div>
        </div> <!-- 🟢 FECHA A ETAPA 3 -->
   
    </form>
</div>

<!-- =========================================================================
     🎮 NAVEGAÇÃO INTERATIVA (MUDAR DE PASSO) E VALIDAÇÕES DO SISTEMA
     ========================================================================= -->
<script>
function mudarPasso(passo) {
    // Controla estritamente a exibição das abas evitando conflitos
    const e1 = document.getElementById('etapa1');
    const e2 = document.getElementById('etapa2');
    const e3 = document.getElementById('etapa3');

    if(e1) e1.style.display = (passo === 1) ? 'block' : 'none';
    if(e2) e2.style.display = (passo === 2) ? 'block' : 'none';
    if(e3) e3.style.display = (passo === 3) ? 'block' : 'none';

    // Atualiza os indicadores de progresso visuais no cabeçalho
    const p1 = document.getElementById('p1');
    const p2 = document.getElementById('p2');
    const p3 = document.getElementById('p3');

    if(p1) p1.classList.toggle('active', passo === 1);
    if(p2) p2.classList.toggle('active', passo === 2);
    if(p3) p3.classList.toggle('active', passo === 3);
}

// 🔥 DESTRAVADOR LOCAL: Garante o avanço imediato para o ecrã de Preços/Arquitetura
function ejecutarAuditoriaGestorEtapa2() {
    mudarPasso(3);
}

// Bloqueia cliques duplos na submissão final enquanto o servidor processa as fotos
document.getElementById('formInstanciacaoMaster').onsubmit = function() {
    const btn = document.querySelector('.btn-infraestrutura-trigger');
    if (btn) {
        btn.innerHTML = "⌛ Instanciando camadas corporativas...";
        btn.style.opacity = "0.7";
    }
    return true;
};
</script>

</body>
</html>