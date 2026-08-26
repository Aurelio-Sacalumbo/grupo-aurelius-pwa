<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['servico_vip']) && isset($_GET['desconto_cupao'])) {
    // Grava de forma segura na sessão ativa do utilizador
    $_SESSION['servico_pre_selecionado'] = trim($_GET['servico_vip']);
    $_SESSION['desconto_cupao_ganho']   = intval($_GET['desconto_cupao']);
    
    // Alimenta as variáveis locais para forçar o abatimento no caixa superior
    $nome_servico_pre = $_SESSION['servico_pre_selecionado'];
    $desconto_pre_calculado = $_SESSION['desconto_cupao_ganho'];
} else {
    // Se o cliente entrar direto no link da barbearia, limpa para não acumular lixo
    unset($_SESSION['servico_pre_selecionado']);
    unset($_SESSION['desconto_cupao_ganho']);
}

$mysqli = new mysqli("127.0.0.1", "root", "", "aurelius_salao");
$mysqli->set_charset("utf8");


if (isset($_GET['empresa'])) {
    $nova_empresa = (int)$_GET['empresa'];
    
    // Se o cliente mudou de salão, limpa os descontos do salão anterior
    if (isset($_SESSION['empresa_codigo']) && $_SESSION['empresa_codigo'] !== $nova_empresa) {
        unset($_SESSION['servico_pre_selecionado']);
        unset($_SESSION['desconto_cupao_ganho']);
    }
    
    $_SESSION['empresa_codigo'] = $nova_empresa;
}

// Se não houver barbearia selecionada, manda de volta para a tela inicial
if (!isset($_SESSION['empresa_codigo'])) {
    header("Location: frame.php");
    exit();
}

$id_da_barbearia = $_SESSION['empresa_codigo'];

// Busca no banco os dados exclusivos da barbearia que o cliente está a visitar
$query_barbearia = $mysqli->query("SELECT * FROM `usuario` WHERE `codigo` = '$id_da_barbearia'");
$dados_barbearia = $query_barbearia->fetch_assoc();


// 2. 👨🏼‍🦰 CAPTURA O CLIENTE LOGADO: (Opcional, se o cliente já tiver feito login com e-mail dele)
$nome_do_cliente = "Cliente Visitante"; 
if (isset($_SESSION['cliente_nome'])) {
    $nome_do_cliente = $_SESSION['cliente_nome'];
}

// =========================================================================
// 🚀 CAPTURA DE CUPÕES VINDOS DO RANKING DA PÁGINA PRINCIPAL
// =========================================================================
if (isset($_GET['servico_vip']) && isset($_GET['desconto_cupao'])) {
    // Injeta o nome do serviço e o desconto ganho direto na memória da sessão
    $_SESSION['servico_pre_selecionado'] = trim($_GET['servico_vip']);
    $_SESSION['desconto_cupao_ganho']   = intval($_GET['desconto_cupao']);
} else {
    // Limpa se o cliente entrou de forma direta para não acumular descontos velhos
    unset($_SESSION['servico_pre_selecionado']);
    unset($_SESSION['desconto_cupao_ganho']);
}
?>

<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Aurelius - Salão de Beleza e Barbearia</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background-color: #0b1a30; color: #ffffff; padding-bottom: 80px;  width:90%; margin-left:100px; margin-top:30px; margin-bottom:10px;}
        
        /* Menu Superior */
        nav { display: flex; justify-content: space-between; align-items: center; background-color: #e0e0e0; padding: 10px 20px; }
        /* --- REGRAS DE ADAPTAÇÃO PARA TELEMÓVEL --- */
@media (max-width: 900px) {
    /* Esconde os botões azuis grandes do topo */
    #menuDesktop {
        display: flex;
        list-style: none;
        gap: 15px; /* Espaço entre os botões */
        margin-right: 20px; /* Alasta o último botão da borda direita */
    }
    /* Mostra o ícone de 3 barras no canto direito */
    .Menu-Icon {
        display: block !important;
    }
}
        .logo { color: #d32f2f; cursor: pointer; }
        .logo h6 { color: #0b1a30; font-size: 11px; margin-top: -2px; }
        .ul {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            margin-right: 25px; /* 
            gap: 10px;          /
        }
        
        .ul li {
            list-style: none;
            margin: 0;
        }
        
        .ul li a { 
            display: block; 
            background-color: #0088cc; 
            color: white; 
            padding: 10px 15px; /* 👈 Reduzido ligeiramente para caber melhor em ecrãs menores */
            text-decoration: none; 
            border-radius: 12px; 
            font-size: 13px; 
            font-weight: bold; 
            text-align: center; 
            min-width: 100px;   /* 👈 Ajustado de 110px para 100px para dar mais folga */
            border: 1px solid #006699; 
            white-space: nowrap; /* 👈 Evita que o texto quebre em duas linhas dentro do botão */
        }
        /* Efeito de destaque ao passar o rato sobre os passos do atendimento */
.painel-boas-vindas .aba-balanco-infinito:hover {
    background-color: #1e293b !important;
    border-color: #38bdf8 !important;
    box-shadow: 0 10px 20px rgba(56, 189, 248, 0.15);
    transform: translateY(-4px);
    cursor: default;
}

        @keyframes dancaCaixas {
    0% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-3px) rotate(-0.5deg); }
    50% { transform: translateY(0px) rotate(0deg); }
    75% { transform: translateY(-3px) rotate(0.5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

        /* Conteedores Principais */
        .container { max-width: 1200px; margin: 20px auto; padding: 0 15px; }
        .painel-azul { background-color: #21409a; border: 2px dashed #0088cc; border-radius: 15px; padding: 20px; margin-bottom: 20px; }
        @media print {
    body * { visibility: hidden !important; }
    #area-impressao-global, #area-impressao-global * { visibility: visible !important; }
    #area-impressao-global { position: absolute !important; left: 0 !important; top: 0 !important; width: 100% !important; }
}


.passo-card {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    /* Efeito ao passar o rato (Hover) */
    .passo-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: #38bdf8;
        background-color: #111e36;
        box-shadow: 0 10px 25px -5px rgba(56, 189, 248, 0.2);
    }

    /* Brilho reflexivo interno ao passar o rato */
    .passo-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.1), transparent);
        transition: 0.5s;
    }
    .passo-card:hover::before {
        left: 100%;
    }

    /* Animação de pulso no emoji */
    .passo-card:hover .emoji-animado {
        animation: pulsoEmoji 0.6s ease-in-out infinite alternate;
    }

    @keyframes pulsoEmoji {
        0% { transform: scale(1); }
        100% { transform: scale(1.3) rotate(10deg); }
    }

    /* Brilho pulsante no bloco de campanha */
    .campanha-bloco {
        background-color: #1e293b;
        border-left: 5px solid #fb923c;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
    }

    #menuDesktop {
    display: flex !important; /* Mantém alinhado em linha no PC */
    gap: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.Menu-Icon {
    display: none !important;
}


@media (max-width: 991px) {
    #menuDesktop, ul#menuDesktop {
        display: none !important;
    }
    
    .Menu-Icon {
        display: block !important;
    }
    
    /* 3. Garante que a barra cinza de navegação distribua o espaço corretamente */
    nav {
        padding: 10px 20px !important;
        width: 100%;
        box-sizing: border-box;
    }
}

    .campanha-bloco:hover {
        box-shadow: 0 0 15px rgba(234, 179, 8, 0.15);
        background-color: #233147;
    }
        .painel-titulo { font-size: 16px; font-weight: bold; margin-bottom: 12px; display: block; color: #fff; }
        
        /* Grid de Inputs do Topo */
        .grid-inputs { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; }
        .input-estilizado { width: 100%; padding: 12px; } /* 👈 Esta era a sua última linha */
        
        /* Bloco Conta Grátis */
        .flex-freemium { display: flex; justify-content: space-between; align-items: flex-start; }
        .info-freemium p { font-size: 13px; color: #cbd5e1; margin-top: 4px; }
        .badge-premium { background-color: #ffcc00; color: #000; padding: 4px 8px; font-weight: bold; font-size: 12px; border-radius: 4px; }
        .btn-upgrade { background-color: #ff9900; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        @media print {
    body * { display: none !important; }
    #area-impressao-global, #area-impressao-global * { display: block !important; background: #fff !important; color: #000 !important; }
}
/* Força qualquer subgrupo ou nível com a classe hidden a sumir por completo */
.hidden {
    display: none !important;
}

/* Garante o comportamento correto das grelhas quando não estiverem ocultas */
.grid-container.hidden, .sub-grupo.hidden {
    display: none !important;
}
        /* Abas de Categorias e Itens */
        .aba-conteudo { display: none; }
        .aba-conteudo.active { display: block; }
        .grid-categorias, .grid-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px; margin-top: 15px; }
        
        .aba-item { background-color: #1e293b; border: 1px solid #334155; border-radius: 10px; color: white; padding: 15px; cursor: pointer; text-align: center; transition: 0.2s; }
        .aba-item:hover { background-color: #334155; }
        .aba-item img { border-radius: 6px; margin-bottom: 8px; object-fit: cover; height: 150px; width: 100%; }
        
        /* Caixa de Confirmação de Preço */
        .preco-container { background-color: #0f172a; border: 2px dashed #22c55e; border-radius: 10px; padding: 20px; text-align: center; margin-top: 20px; }
        .preco-container h3 { margin-bottom: 5px; font-size: 18px; }
        .preco-container p { font-size: 28px; font-weight: bold; color: #22c55e; margin-bottom: 15px; }
        .btn-confirmar { background-color: #22c55e; color: white; border: none; padding: 12px 35px; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; width: 100%; max-width: 300px; }
        .btn-voltar { background-color: #475569; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; margin-bottom: 15px; font-weight: bold; }
        
        /* Rodapé e Parcerias */
        .secao-parcerias { text-align: center; margin: 25px 0; font-size: 12px; color: #94a3b8; border-top: 1px dashed #334155; padding-top: 15px; }
        .lista-parceiros { display: flex; justify-content: center; gap: 20px; margin-top: 8px; font-style: italic; }
        .bloco-institucional { text-align: center; padding: 30px 15px; background-color: #0f172a; border-radius: 12px; margin-top: 20px; }
        .contactos-footer { font-size: 14px; color: #94a3b8; margin-top: 15px; line-height: 1.6; }
        
        /* Cookies */
        .banner-consentimento { position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(15, 23, 42, 0.95); border-top: 1px solid #334155; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: #94a3b8; z-index: 9999; }
        .btn-aceitar { background-color: #22c55e; color: white; border: none; padding: 8px 16px; font-weight: bold; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

<nav style="display: flex; justify-content: space-between; align-items: center; background-color: #e0e0e0; padding: 10px 40px; position: relative; z-index: 1000; width: 100%; box-sizing: border-box;">
    
<!-- Logotipo -->
<div class="logo" onclick="irParaSecao('home')" style="color: #d32f2f; cursor: pointer;">
    <h1 style="font-size: 22px; font-weight: bold; line-height: 1; margin: 0;">🎌AURE<span style="color: #0b1a30;">LIUS</span></h1>
    <h6 style="color: #0b1a30; font-size: 11px; margin: 2px 0 0 0;">Salão de Beleza e Barbearia</h6>
</div>
<!-- =========================================================================
     📱 MENU DESKTOP TOTALMENTE ORGANIZADO, SIMÉTRICO E ALINHADO (DASHBOARD)
     ========================================================================= -->
     <ul class="ul" id="menuDesktop" style="display: flex; align-items: center; gap: 10px; list-style: none; margin: 0; padding: 0;">
    
     <!-- 1. Pagamentos Móveis (Laranja Uniforme) -->
     <li>
         <a href="unitel.php" style="display: block; background-color: #ff6600; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #cc5200; white-space: nowrap;">
             📱 Pagamentos Móveis
         </a>
     </li>
 
     <!-- 2. Serviços (Azul Padrão) -->
     <li>
         <a href="#" onclick="alternarAbas('servicos')" style="display: block; background-color: #0088cc; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #006699; white-space: nowrap;">
             Serviços
         </a>
     </li>
 
     <!-- 3. Photos (Azul Padrão) -->
     <li>
         <a href="#" onclick="alternarAbas('photos')" style="display: block; background-color: #0088cc; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #006699; white-space: nowrap;">
             Photos
         </a>
     </li>
 
     <!-- 4. Sobre Nós (Azul Padrão) -->
     <li>
         <a href="#" onclick="abrirAbas()" style="display: block; background-color: #0088cc; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #006699; white-space: nowrap;">
             Sobre Nós
         </a>
     </li>
 
     <!-- 5. Termos & Privacidade (Azul Padrão) -->
     <li>
         <a href="#" onclick="abrirTermos()" style="display: block; background-color: #0088cc; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #006699; white-space: nowrap;">
             Termos & Privacidade
         </a>
     </li>
 
     <!-- 6. Emitir Última Fatura (Vermelho Alinhado com a Altura das outras abas) -->
     <li>
         <a href="./fatura.php" target="_blank" style="display: block; background-color: #d32f2f; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #b91c1c; white-space: nowrap; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 6px rgba(0,0,0,0.15); transition: 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#d32f2f'">
             🖨️ Emitir Fatura
         </a>
     </li>
 
     <!-- 7. Botão Sair (Vermelho Uniforme de Fechamento) -->
     <li>
         <a href="frame.php" style="display: block; background-color: #d32f2f; color: white; padding: 10px 15px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: bold; text-align: center; border: 1px solid #b91c1c; white-space: nowrap;">
             Sair
         </a>
     </li>
 
 </ul>

<!-- ÍCONE DAS 3 BARRAS (Controlado dinamicamente pelo CSS) -->
<div class="Menu-Icon" onclick="toggleMenu()" style="cursor: pointer;">
    <svg viewBox="0 0 100 80" width="28" height="28" style="fill: #0b1a30; display: block;">
        <rect width="100" height="15" rx="8"></rect>
        <rect y="30" width="100" height="15" rx="8"></rect>
        <rect y="60" width="100" height="15" rx="8"></rect>
    </svg>
</div>

     <!-- MENU LATERAL RETRÁTIL (Mobile Overlay Corrigido) -->
     <div id="menuLateralMobile" style="position: fixed; top: 0; left: -280px; width: 280px; height: 100vh; background-color: #0f172a; border-right: 2px solid #0088cc; box-shadow: 5px 0 15px rgba(0,0,0,0.5); transition: 0.3s ease; padding: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 15px;">
     <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #1e293b; padding-bottom: 10px;">
         <strong style="color: #fff; font-size: 18px;">AURELIUS</strong>
         <!-- Botão de fechar (X) -->
         <span onclick="toggleMenu()" style="font-size: 24px; color: #ef4444; cursor: pointer; font-weight: bold;">&times;</span>
     </div>
     
     <!-- Botão Sair redireciona direto para a página de logout -->
     <a href="frame.php" style="background:#ef4444; color:white; padding:12px; text-decoration:none; border-radius:8px; font-weight:bold; text-align:center;">Sair</a>
    
     <a href="./fatura.php" target="_blank" style="display: inline-block; background-color: #d32f2f; color: #ffffff; text-decoration: none; padding: 12px 24px; font-size: 13px; font-weight: bold; border-radius: 20px !important; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid #b91c1c; box-shadow: 0 4px 6px rgba(0,0,0,0.15); transition: 0.2s; font-family: sans-serif;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#d32f2f'">
        🖨️ Emitir Última Fatura
    </a>

     <!-- Links operacionais integrados com o sistema de abas principal -->
     <a href="#" onclick="alternarAbas('servicos'); toggleMenu(); return false;" style="background:#0088cc; color:white; padding:12px; text-decoration:none; border-radius:8px; font-weight:bold; text-align:center;">Serviços</a>
     
     <a href="#" onclick="alternarAbas('photos'); toggleMenu(); return false;" style="background:#0088cc; color:white; padding:12px; text-decoration:none; border-radius:8px; font-weight:bold; text-align:center;">Photos</a>

     <a href="#" onclick="abrirAbas(); toggleMenu(); return false;" style="background:#0088cc; color:white; padding:12px; text-decoration:none; border-radius:8px; font-weight:bold; text-align:center;">Sobre Nós</a>
     
     <a href="#" onclick="abrirTermos(); toggleMenu(); return false;" style="background:#0088cc; color:white; padding:12px; text-decoration:none; border-radius:8px; font-weight:bold; text-align:center;">Termos & Privacidade</a>
 </div>
</nav>

<div class="painel-azul" id="dadosAgendamento" style="margin-top: 25px;">
            <span class="painel-titulo">Dados de Atendimento da Sessão</span>
            <div class="grid-inputs">
                <input type="text" id="inputNomeCliente" placeholder="Nome do Cliente (Obrigatório)" class="input-estilizado">
                <select id="inputFuncionario" class="input-estilizado">
                    <option value="">Selecione um profissional...</option>
                    <option value="Handanga">1º Handanga (Barbeiro)</option>
                    <option value="Albino">2º Albino (Esteticista /Barbeiro/ Manicure)</option>
                    <option value="Dalton"> 3º Dalton (Manicure)</option>
                    <option value="Fernandinho">4º Fernandinho (Barbeiro)</option>
                    <option value="Aurélio">5º Aurélio (Cabelereiro)</option>
                    <option value="Raimundo">6º Raimundo (Pedicure)</option>
                    <option value="Angelino">7º Angelino (Cabelereiro)</option>
                    <option value="Tuxa">8º Tuxa (Cabelereira)</option>
                    <option value="Edna">9º Edna (Cabelereira)</option>
                    <option value="Belma">10º Belma (Cabelereira)</option>
                </select>
                <input type="date" id="inputDataServico" class="input-estilizado">
                <input type="time" id="inputHoraServico" class="input-estilizado">

            </div>
        </div>

    </div>

    <div class="container">
    
    <!-- ABA HOME (TUDO DEVE FICAR DENTRO DELA PARA NÃO SUMIR) -->
    <div id="secao-home" class="aba-conteudo active">

        <!-- Banner de Destaque ÚNICO -->
        <div style="background: linear-gradient(135deg, #1e40af, #f97316); border-radius: 15px; padding: 25px; text-align: center; margin-bottom: 25px; border: 1px solid #3b82f6; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <h2 style="font-size: 24px; font-weight: bold; color: #ffffff; letter-spacing: 0.5px;">✨ BEM-VINDO A BARBEARIA BRANCA ✨</h2>
            <p style="font-size: 14px; color: #93c5fd; margin-top: 6px;">Transforme o seu visual com os melhores profissionais do Huambo</p>
        </div>
       

<!-- PAINEL DE VISUALIZAÇÃO ESTILO COMPROVATIVO NEON (Colorido por natureza no ecrã) -->
<div id="faturaPainelNatural" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background-color: rgba(11, 26, 48, 0.95); z-index: 99999; justify-content: center; align-items: center; overflow-y: auto; padding: 20px; box-sizing: border-box;">
    
    <!-- Caixa Principal com Fundo Escuro e Borda Azul Brilhante (Idêntico à sua Imagem) -->
    <div style="background-color: #111e35 !important; color: #ffffff !important; width: 100%; max-width: 440px; padding: 30px; border: 3px solid #0088cc !important; border-radius: 16px !important; box-sizing: border-box; box-shadow: 0 0 25px rgba(0, 136, 204, 0.4); position: relative; text-align: center;">
        
        <!-- Botão Fechar no Canto -->
        <span onclick="fecharFaturaNatural()" class="no-print" style="position: absolute; top: 15px; right: 20px; color: #ef4444; font-size: 26px; cursor: pointer; font-weight: bold; font-family: sans-serif;">&times;</span>

        <!-- Cabeçalho Centralizado -->
        <div style="margin-bottom: 20px; border-bottom: 1px dashed #334155; padding-bottom: 15px;">
            <h2 style="color: #38bdf8 !important; margin: 0; font-size: 22px; font-weight: bold; font-family: sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">BARBEARIA BRANCA</h2>
            <p style="color: #94a3b8 !important; font-size: 12px; margin: 5px 0 0 0; font-family: sans-serif;">Comprovativo de Atendimento Geral</p>
        </div>

        <!-- Dados do Atendimento Alinhados -->
        <div style="font-family: sans-serif; text-align: left; font-size: 13px; line-height: 1.8; margin-bottom: 25px; padding: 0 5px;">
            <div style="margin-bottom: 10px;"><span style="color: #64748b; font-size: 11px; font-weight: bold; display: block; text-transform: uppercase;">REGISTO:</span><strong style="color: #cbd5e1; font-size: 14px;">nº <span id="natIdPagamento">62</span></strong></div>
            <div style="margin-bottom: 10px;"><span style="color: #64748b; font-size: 11px; font-weight: bold; display: block; text-transform: uppercase;">CLIENTE:</span><strong style="color: #ffffff; font-size: 15px;" id="natNomeCliente">Maria figueredo</strong></div>
            <div style="margin-bottom: 10px;"><span style="color: #64748b; font-size: 11px; font-weight: bold; display: block; text-transform: uppercase;">PROFISSIONAL:</span><strong style="color: #cbd5e1; font-size: 14px;" id="natProfissional">Aurélio</strong></div>
            <div style="margin-bottom: 10px;"><span style="color: #64748b; font-size: 11px; font-weight: bold; display: block; text-transform: uppercase;">SERVIÇO:</span><strong style="color: #cbd5e1; font-size: 14px;" id="natServicoNome">Queratina / Selagem</strong></div>
            <div style="margin-bottom: 10px;"><span style="color: #64748b; font-size: 11px; font-weight: bold; display: block; text-transform: uppercase;">DATA/HORA:</span><strong style="color: #cbd5e1; font-size: 14px;" id="natDataEmissao">2026-11-10 às 00:00</strong></div>
        </div>

        <!-- Módulo de Código QR Dinâmico para Auditoria -->
        <div style="display: flex; justify-content: center; margin-bottom: 20px;">
            <div style="background: #fff; padding: 4px; border-radius: 4px;">
                <img id="natQrCode" src="" alt="QR" style="display: block; width: 80px; height: 80px;">
            </div>
        </div>

        <!-- 💰 EXIBIÇÃO DE VALORES E DESCONTOS CONDICIONAIS -->
        <div style="margin-top: 25px; border-top: 1px dashed #334155; padding-top: 15px; font-family: sans-serif;">
            
       
            <div id="printBlocoPremiumPrecos" style="display: none; flex-direction: column; gap: 6px; margin-bottom: 15px; padding: 0 5px; text-align: left;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #94a3b8;">
                    <span>Preço de Tabela (Original):</span>
                    <span id="natSubtotal" style="color: #cbd5e1; font-weight: bold;">0 Kz</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #ef4444; font-weight: bold;">
                    <span>Desconto Membro VIP (-20%):</span>
                    <span id="natDescontoValor">- 0 Kz</span>
                </div>
            </div>

            <!-- BARRA VERDE DE FATURAÇÃO (Exibe o Preço Final Real Cobrado) -->
            <div style="background-color: #0b1a30; border-left: 4px solid #22c55e; padding: 15px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <span style="color: #22c55e; font-size: 11px; font-weight: bold; text-transform: uppercase;">
                    <span id="natTextoTotalTitulo">TOTAL PAGO</span>:
                </span>
                <strong style="color: #22c55e; font-size: 20px;" id="natTotalFinal">14.000,00 Kz</strong>
            </div>

        </div>

        <!-- Rodapé Centralizado com a Localização do Huambo -->
        <div style="text-align: center; font-size: 12px; color: #38bdf8; font-family: sans-serif; line-height: 1.5; margin-bottom: 25px; border-top: 1px dashed #334155; padding-top: 15px;">
            Obrigado pela preferência, tua pandula!<br>
            <small style="color: #64748b; font-size: 11px; display: block; margin-top: 5px;"> Barbearia Branca localizado no Huambo<br>Bairro de São Luís / junto a igreja Ieca</small>
        </div>

        <!-- Botão Azul Claro de Confirmação Igualzinho ao da sua Imagem -->
        <div class="no-print">
            <button onclick="window.print()" style="width: 100%; background-color: #38bdf8 !important; color: #0b1a30 !important; border: none; padding: 12px; font-size: 14px; font-weight: bold; border-radius: 8px; cursor: pointer; text-transform: uppercase; display: flex; align-items: center; justify-content: center; gap: 8px; font-family: sans-serif; box-shadow: 0 4px 10px rgba(56, 189, 248, 0.25);">
                🖨️ CONFIRMAR IMPRESSÃO
            </button>
        </div>

    </div>
</div>

<style>
/* ⚡ CONTROLO CORPORATIVO DE IMPRESSÃO - CONVERTE PARA BRANCO ECONÓMICO NO PAPEL */
@media print {
    body > * { display: none !important; }
    #faturaPainelNatural { display: flex !important; background: #ffffff !important; position: absolute; left: 0; top: 0; width: 100%; height: 100%; padding: 0; }
    #faturaPainelNatural > div { background-color: #ffffff !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; border-radius: 0px !important; box-shadow: none !important; margin: 40px auto !important; width: 90% !important; max-width: 440px !important; padding: 20px !important; }
    #faturaPainelNatural h2 { color: #0b1a30 !important; }
    #faturaPainelNatural strong { color: #0f172a !important; }
    #faturaPainelNatural span { color: #475569 !important; }
    .no-print, #faturaPainelNatural button, #faturaPainelNatural span[onclick] { display: none !important; }
    * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
}
</style>

















        <!-- BOTÃO INTERATIVO ÚNICO -->
        <div style="text-align: center; margin-bottom: 25px;">
            <button id="btnToggleFuncionarios" onclick="toggleFuncionarios()" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #ffffff; border: none; padding: 12px 26px; font-size: 15px; font-weight: bold; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.3); transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 0.5px; outline: none;">
                 Ver Funcionários
            </button>
        </div>

        <?php
        // Carrega os funcionários direto do banco via PDO (Conexao.php)
        include_once("../Conexao.php");
        try {
            $query_cards = $pdo->query("SELECT * FROM funcionarios ORDER BY nome ASC");
            $lista_cards = $query_cards->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $lista_cards = [];
        }
        ?>

        <!-- LISTA DE PROFISSIONAIS (Inicia oculta e obedece 100% ao botão) -->
        <div id="secaoFuncionarios" style="margin: 0 auto 30px auto; max-width: 1200px; padding: 0 15px; display: none;">
            <h3 style="color: #fff; font-size: 14px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                 Status dos Profissionais:
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 15px;">
                <?php if(empty($lista_cards)): ?>
                    <p style="color: #94a3b8; grid-column: 1/-1;">Nenhum profissional cadastrado no sistema.</p>
                <?php else: ?>
                    <?php foreach($lista_cards as $card): 
                        $corCard = '#22c55e'; // Verde padrão para 'Ativo' ou 'Disponível'
                        if (strpos($card['status'], 'Ausente') !== false || strpos($card['status'], 'Folga') !== false) {
                            $corCard = '#ef4444'; // Vermelho
                        } elseif (strpos($card['status'], 'Atendimento') !== false || strpos($card['status'], 'Em') !== false) {
                            $corCard = '#ffaa00'; // Laranja
                        }
                    ?>
                        <div style="background: #1e293b; border: 1px solid #334155; padding: 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.15);">
                            <span style="color: #cbd5e1; font-weight: bold;"><?php echo htmlspecialchars($card['nome']); ?></span>
                            <span id="status-text-<?php echo $card['id_funcionario']; ?>" style="font-weight: bold; color: <?php echo $corCard; ?>;">
                                <?php echo htmlspecialchars($card['status']); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>




    <!-- ÁREA DE EXIBIÇÃO: Onde as fotos salvas vão aparecer depois -->
    <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-top: 30px;">
        <?php
        // Bloco opcional para listar as fotos já guardadas na tabela 'anuncios'
        try {
            $queryFotos = $pdo->query("SELECT * FROM anuncios ORDER BY id_announcement DESC");
            $listaFotos = $queryFotos->fetchAll();
            foreach ($listaFotos as $f):
        ?>
            <div class="aba-item" style="background: #1e293b; padding: 10px; border-radius: 8px; text-align: center;">
                <!-- O campo 'image_url' deve bater com o nome da coluna da sua tabela de anúncios -->
                <img src="<?php echo htmlspecialchars($f['image_url']); ?>" style="width: 100%; height: 130px; object-fit: cover; border-radius: 6px;">
                <strong style="font-size: 12px; display: block; margin-top: 8px;"><?php echo htmlspecialchars($f['title']); ?></strong>
            </div>
        <?php 
            endforeach;
        } catch (PDOException $e) {
            echo "<p style='font-size:12px; opacity:0.5; grid-column: 1/-1;'></p>";
        }
        ?>
    </div>
</div>
















<!-- =========================================================================
     📸 SECÇÃO: PHOTOS & VÍDEOS COM EXEMPLOS REAIS, DINÂMICOS E DIRECIONAMENTO ISOLADO
     ========================================================================= -->
     <div id="secao-photos" class="aba-conteudo" style="display: none; width:92%; margin:20px auto; position: relative; font-family: 'Segoe UI', Arial, sans-serif;">
    
     <!-- Cabeçalho da Galeria com Botão Voltar (X) Integrado -->
     <div class="aba-galeria" style="background:linear-gradient(135deg, #10383b, #1d4d50); color:white; padding:20px; border-radius:10px; margin-bottom:20px; text-align:center; position: relative;">
         
         <!-- ❌ BOTÃO X VOLTAR: Permite fechar a secção e regressar à Home -->
         <span onclick="alternarAbas('servicos')" style="position: absolute; top: 12px; right: 20px; color: #ef4444; font-size: 26px; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.color='#f87171'; this.style.transform='scale(1.1)';" onmouseout="this.style.color='#ef4444'; this.style.transform='scale(1)';">
             &times;
         </span>
 
         <h4 style="margin: 0; font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">Portfólio & Galeria de Tendências</h4>
         <p style="font-size:12px; opacity:0.8; margin-top:4px; margin-bottom: 0;">Exemplos de inspirações e trabalhos executados no Huambo.</p>
     </div>
 
     <!-- 🎛️ PAINÉIS DE UPLOAD (FOTOS & VÍDEOS SEPARADOS) -->
     <div style="display: flex; gap: 20px; max-width: 1100px; margin: 0 auto 30px auto; flex-wrap: wrap;">
         
         <!-- FORMULÁRIO A: CARREGAR FOTOS -->
         <div class="painel-azul" style="flex: 1; min-width: 280px; background: #0f172a; border: 1px solid #1d4d50; padding: 20px; border-radius: 8px;">
             <span class="painel-titulo" style="font-size: 14px; font-weight: bold; color: #fff; display: block; margin-bottom: 10px;"> Carregar Nova Foto</span>
             <form action="guardar_foto.php" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px; text-align:left;">
                 <label style="color: #fff; font-size: 13px; font-weight: bold;">Título do Trabalho:</label>
                 <input type="text" name="titulo_foto" placeholder="Ex: Barba Alinhada" required style="padding: 10px; border-radius: 4px; border: none; background: #fff; color: #333; width: 100%; box-sizing: border-box;">
                 <label style="color: #fff; font-size: 13px; font-weight: bold;">Escolher Foto:</label>
                 <input type="file" name="ficheiro_foto" accept="image/*" required style="color: #fff; font-size: 13px;">
                 <button type="submit" style="background: #10b981; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer; text-transform: uppercase; font-size: 12px;">Carregar Foto</button>
             </form>
         </div>
 
         <!-- FORMULÁRIO B: CARREGAR VÍDEOS -->
         <div class="painel-azul" style="flex: 1; min-width: 280px; background: #0f172a; border: 1px solid #1d4d50; padding: 20px; border-radius: 8px;">
             <span class="painel-titulo" style="font-size: 14px; font-weight: bold; color: #fff; display: block; margin-bottom: 10px;"> Carregar Novo Vídeo</span>
             <form action="guardar_video.php" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px; text-align:left;">
                 <label style="color: #fff; font-size: 13px; font-weight: bold;">Título do Vídeo:</label>
                 <input type="text" name="titulo_video" placeholder="Ex: Comercial do Corte" required style="padding: 10px; border-radius: 4px; border: none; background: #fff; color: #333; width: 100%; box-sizing: border-box;">
                 <label style="color: #fff; font-size: 13px; font-weight: bold;">Escolher Vídeo (MP4):</label>
                 <input type="file" name="ficheiro_video" accept="video/mp4" required style="color: #fff; font-size: 13px;">
                 <button type="submit" style="background: #ca8a04; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer; text-transform: uppercase; font-size: 12px;">Carregar Vídeo</button>
             </form>
         </div>
 
     </div>
 
     <!-- GRADE DE MÍDIAS AUTOMATIZADA -->
     <span class="painel-titulo" style="font-size: 14px; font-weight: bold; color: #fff; display: block; margin-bottom: 15px; border-left: 3px solid #10b981; padding-left: 8px; text-align: left;"> Inspirações de Cortes e Trabalhos</span>
     <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; width:100%; margin-bottom:40px;">
         <?php
         try {
             $queryFotos = $pdo->query("SELECT * FROM anuncios WHERE ativo = 1 ORDER BY id_anuncio DESC");
             $listaFotos = $queryFotos->fetchAll(PDO::FETCH_ASSOC);
         } catch (PDOException $e) {
             $listaFotos = [];
         }
 
         if (count($listaFotos) > 0): 
             foreach ($listaFotos as $fotoItem): 
                 // Deteta automaticamente se o ficheiro guardado é uma imagem ou vídeo pela extensão
                 $arquivo = htmlspecialchars($fotoItem['imagem']);
                 $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                 $is_video = in_array($extensao, ['mp4', 'mov', 'avi', 'mpeg']);
         ?>
                 <div class="aba-item" style="background:#1e293b; padding:10px; border-radius:8px; text-align:center; box-shadow: 0 4px 6px rgba(0,0,0,0.2); border: 1px solid #334155; display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;">
                     
                     <div style="width: 100%; height: 140px; overflow: hidden; border-radius: 6px; background: #0f172a; position: relative;">
                         <?php if ($is_video): ?>
                             <!-- Se for vídeo, exibe uma pré-visualização opaca e estática -->
                             <video src="uploads/<?php echo $arquivo; ?>" style="width:100%; height:100%; object-fit:cover; opacity: 0.5;"></video>
                             <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); color: #ca8a04; padding: 5px 10px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">📹 Vídeo</span>
                         <?php else: ?>
                             <!-- Se for foto, exibe a imagem de forma estática normal -->
                             <img src="uploads/<?php echo $arquivo; ?>" onerror="this.src='https://placehold.co'" style="width:100%; height:100%; object-fit:cover;">
                         <?php endif; ?>
                     </div>
 
                     <strong style="color: #fff; font-size:12px; display:block; margin-top:8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-transform: uppercase;"><?php echo htmlspecialchars($fotoItem['titulo']); ?></strong>
                     
                     <!-- 🟢 CONTROLO DE DIRECIONAMENTO: Fotos ficam quietas e vídeos ganham botão de redirecionamento -->
                     <?php if ($is_video): ?>
                         <a href="video.php?id_anuncio=<?php echo $fotoItem['id_anuncio']; ?>" style="display: block; background: #ca8a04; color: white; text-decoration: none; padding: 8px; margin-top: 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">Assistir Vídeo</a>
                     <?php endif; ?>
 
                 </div>
             <?php 
             endforeach;
         else: 
         ?>
             <p style="color: #aaa; text-align: center; grid-column: 1 / -1; padding: 25px; background: #1e293b; border-radius: 8px; font-style: italic;">Nenhuma foto ou vídeo carregado na galeria ainda.</p>
         <?php endif; ?>
     </div>
 
     <!-- SEÇÃO DOS PROFISSIONAIS ENVELOPADA (Inicia 100% Oculta) -->
     <div id="secaoFuncionarios" style="margin: 20px auto; max-width: 1200px; padding: 0 15px; display: none !important; visibility: hidden; height: 0; overflow: hidden;">
         <h3 style="color: #fff; font-size: 14px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">Status dos Profissionais:</h3>
         <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 15px;">
             <?php if(empty($lista_cards)): ?>
                 <p style="color: #94a3b8; grid-column: 1/-1;">Nenhum profissional cadastrado no sistema.</p>
             <?php else: ?>
                 <?php foreach($lista_cards as $card): 
                     $corCard = '#22c55e';
                     if (strpos($card['status'], 'Ausente') !== false || strpos($card['status'], 'Folga') !== false) { $corCard = '#ef4444'; }
                     elseif (strpos($card['status'], 'Atendimento') !== false || strpos($card['status'], 'Em') !== false) { $corCard = '#ffaa00'; }
                 ?>
                     <div style="background: #1e293b; border: 1px solid #334155; padding: 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.15);">
                         <span style="color: #cbd5e1; font-weight: bold;"><?php echo htmlspecialchars($card['nome']); ?></span>
                         <span id="status-text-<?php echo $card['id_funcionario']; ?>" style="font-weight: bold; color: <?php echo $corCard; ?>;"><?php echo htmlspecialchars($card['status']); ?></span>
                     </div>
                 <?php endforeach; ?>
             <?php endif; ?>
         </div>
     </div>
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  <!-- Fecha a div #secao-photos de forma limpa e isolada -
 <!=========================================================================
      ⭐ PAINEL FREEMIUM INTELIGENTE (Bordas retas e design integrado)
      ========================================================================= -->
 <div class="painel-azul" style="margin-top: 25px; margin-bottom: 25px; border-radius: 0px !important; box-sizing: border-box; width: 100%;">
     <div class="flex-freemium" style="display: flex; justify-content: space-between; align-items: center; width: 100%; box-sizing: border-box; padding: 15px;">
         
         <?php 
         $isPremium = (isset($_SESSION['tipo_conta']) && $_SESSION['tipo_conta'] === 'Premium');
         if ($isPremium): 
             $data_exp = isset($_SESSION['data_expiracao']) ? date('d/m/Y', strtotime($_SESSION['data_expiracao'])) : 'Brevemente';
         ?>
             <div class="info-freemium" style="text-align: left;">
                 <h4 style="font-size: 16px; font-weight: bold; color: #ffffff; margin: 0; font-family: sans-serif;">⭐ Conta Aurelius VIP Ativa</h4>
                 <p style="font-size: 13px; color: #93c5fd; margin: 6px 0 0 0; font-family: sans-serif;">O seu desconto de <strong>20%</strong> está ativo. Próxima renovação em: <strong><?php echo $data_exp; ?></strong>.</p>
                 <div style="margin-top: 12px; background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; color: #22c55e; padding: 6px 12px; display: inline-block; font-size: 12px; font-weight: bold;">
                     ✓ Subscrição Ativa
                 </div>
             </div>
             <span class="badge-premium" style="background-color: #ca8a04; color: #0f172a; padding: 6px 12px; font-size: 11px; font-weight: bold; border-radius: 0px !important; letter-spacing: 0.5px;">PREMIUM</span>
 
         <?php else: ?>
             <div class="info-freemium" style="text-align: left;">
                 <h4 style="font-size: 16px; font-weight: bold; color: #ffffff; margin: 0; font-family: sans-serif;">Acesso Freemium Ativo</h4>
                 <p style="font-size: 13px; color: #93c5fd; margin: 6px 0 0 0; font-family: sans-serif;">Subscreva o plano Premium para ocultar os anúncios e desbloquear relatórios completo.</p>
                 <button class="btn-upgrade" onclick="abrirModalPremium()" style="background-color: #d32f2f; color: white; border: none; padding: 8px 16px; margin-top: 12px; font-size: 13px; font-weight: bold; cursor: pointer; border-radius: 0px !important; text-transform: uppercase; letter-spacing: 0.5px;">
                     Activa Premium - com desconto de 20% kz/mês
                 </button>
             </div>
             <span class="badge-premium" style="background-color: #0b1a30; color: #ffffff; padding: 6px 12px; font-size: 11px; font-weight: bold; border-radius: 0px !important; border: 1px solid #3b82f6; letter-spacing: 0.5px;">CONTA GRÁTIS</span>
         <?php endif; ?>
     </div>
 </div>





     <!-- Secção Geral de Serviços -->
     <div id="secao-servicos" class="aba-conteudo" style="width:100%; max-width:1200px; margin:0 auto; padding:0 15px;">
    
<!-- Caixa de confirmação de preço (Inicia oculta) -->
<div id="caixa-preco" class="preco-container hidden">
    <h3 id="nome-servico">Serviço Selecionado</h3>
    <p id="valor-servico">0,00 kz</p>
    <span id="faturamentoStatus"></span>
    <button class="btn-confirmar" onclick="enviarMarcacaoParaBanco()"> Fazer Marcação</button>
</div>

<!-- PASSO 1: Sempre aparece primeiro (Categorias) -->
<div id="nivel1">
    <div class="grid-categorias">
        <button class="aba-item" onclick="mostrarNivel2('cortes')">
            <img src="1776692284530.jpg" alt=""> Cortes de Cabelo
        </button>
        <button class="aba-item" onclick="mostrarNivel2('pinturas')"> 
            <img src="1777986415454.jpg" alt=""> Pinturas de Cabelo
        </button>
        <button class="aba-item" onclick="mostrarNivel2('sobrancelhas')"> 
            <img src="54.jpg" alt=""> Sobrancelhas
        </button>
        <button class="aba-item" onclick="mostrarNivel2('maquilhagem')"> 
            <img src="54.jpg" alt=""> Maquilhagens
        </button>
        <button class="aba-item" onclick="mostrarNivel2('tratamentos')"> 
            <img src="24509.jpg" alt=""> Tratamentos Capilares
        </button>
        <button class="aba-item" onclick="mostrarNivel2('manicure')"> 
    <img src="1750281718295.jpg" alt=""> Manicure
</button>
        <button class="aba-item" onclick="mostrarNivel2('pedicure')"> 
            <img src="1754574223389.jpg" alt=""> Pedicure
        </button>
    </div>
</div>

<!-- PASSO 2: Inicia oculto via classe 'hidden' (Lista de Serviços) -->
<div id="nivel2" class="hidden">
    <button class="btn-voltar" onclick="voltarParaNivel1()">← Voltar às Categorias</button>
    
    <!-- Sub-grupo: Cortes (Inicia oculto) -->
    <div id="sub-cortes" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Cheio', '1.500 kz')"><div class="img-wrapper"><img src="1776692903268.jpg"></div>Corte Francês Cheio</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Vazio', '1.000 kz')"><div class="img-wrapper"><img src="1777201603721.jpg"></div>Corte Francês Vazio</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Corte de Crianças', '800 kz')"><div class="img-wrapper"><img src="1777757951670.jpg"></div>Corte de Crianças</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Corte de Adultos', '1.500 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Corte de Adultos</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Corte Careca', '500 kz')"><div class="img-wrapper"><img src="1777556066924.jpg"></div>Careca</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Design e Corte de Barba', '1.500 kz')"><div class="img-wrapper"><img src="1776692182096.jpg"></div>Barba</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Outros Estilos de Corte', '3.000 kz')"><div class="img-wrapper"><img src="1777986301625.jpg"></div>Outros</button>
    </div>

    <!-- Sub-grupo: Pinturas (Inicia oculto) -->
    <div id="sub-pinturas" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Tintura Geral', '5.000 kz')"><div class="img-wrapper"><img src="Save (21).jpg"></div>Tintura Geral</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Mechas / Luzes', '8.000 kz')"><div class="img-wrapper"><img src="1777986265622.jpg"></div>Mechas / Luzes</button>
    </div>

    <!-- Sub-grupo: Sobrancelhas (Inicia oculto) -->
    <div id="sub-sobrancelhas" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Design Simples', '1.000 kz')"><div class="img-wrapper"><img src="WhatsApp-Image-2021-07-27-at-11.13.51-768x768_50559e15-debf-46ab-86bb-8a217a1bf2f1.jpg"></div>Design Simples</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Aplicação de Henna', '4.500 kz')"><div class="img-wrapper"><img src="sobrancelhas-com-henna-1-278x300.png"></div>Aplicação de Henna</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Sobrancelhas normal', '1.500 kz')"><div class="img-wrapper"><img src="267f5f0795a07c2c267b53553657554e(0).jpg"></div>Sobrancelhas normal</button>
    </div>

    <!-- Sub-grupo: Maquilhagem (Inicia oculto) -->
    <div id="sub-maquilhagem" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Social', '15.000 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Maquilhagem Social</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Noiva', '40.000 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Maquilhagem Noiva</button>
    </div>

    <!-- Sub-grupo: Tratamentos (Inicia oculto) -->
    <div id="sub-tratamentos" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Hidratação Profunda', '5.500 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Hidratação Profunda</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Queratina / Selagem', '9.000 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Queratina / Selagem</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Tratamento Capilar', '8.000 kz')"><div class="img-wrapper"><img src="1777298458880.jpg"></div>Tratamento Antiqueda</button>
    </div>

    <!-- Sub-grupo: Manicure (Inicia oculto) -->
    <div id="sub-manicure" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Manicure Simples', '1.200 kz')"><div class="img-wrapper"><img src="1750282483395.jpg"></div>Manicure Simples</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Aplicação Gel / Acrigel', '3.500 kz')"><div class="img-wrapper"><img src="1750281850375.jpg"></div>Aplicação Gel / Acrigel</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Manutenção de Unhas', '1.000 kz')"><div class="img-wrapper"><img src="1750281735037.jpg"></div>Manutenção de Unhas</button>
    </div>

    <!-- Sub-grupo: Pedicure (Inicia oculto) -->
    <div id="sub-pedicure" class="grid-container sub-grupo hidden">
        <button class="aba-item" onclick="exibirPrecoFinal('Pedicure Simples', '1.000 kz')"><div class="img-wrapper"><img src="1753021732718.jpg"></div>Pedicure Simples</button>
        <button class="aba-item" onclick="exibirPrecoFinal('Spa Completo dos Pés', '4.000 kz')"><div class="img-wrapper"><img src="1754574216379.jpg"></div>Spa Completo dos Pés</button>
    </div>
</div>
</div>
</div>


<?php
// 1. IMPORTA O SEU CONEXAO.PHP ORIGINAL (PDO) NO TOPO OU ANTES DO BLOCO VISUAL
include_once("../Conexao.php");

try {
    // Busca a lista atualizada de todos os funcionários direto do banco
    $query_cards = $pdo->query("SELECT * FROM funcionarios ORDER BY nome ASC");
    $lista_cards = $query_cards->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $lista_cards = [];
}
?>


<!-- =================================================================
     🔮 PAINEL DE DICAS EXECUTIVAS: PONTOS DE PAGAMENTO E FREEMIUM (SAAS VIP)
     ================================================================= -->
     <div style="margin-top: 40px; text-align: left;">
     <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 20px; color: #38bdf8; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #38bdf8; padding-left: 10px;">
         Como fazer a sua marcação de forma rápida e Segura..??
     </h3>
 
     <!-- Configuração da Grid Expandida com Efeitos Radiais Ativos nos Cartões -->
     <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; margin-bottom: 25px;">
         
         <!-- Passo 1 -->
         <div class="passo-card-neon">
             <div class="emoji-glow">✍️</div>
             <h4>1. Identifique-se</h4>
             <p>Escreva o seu nome no formulário do topo e selecione o seu profissional de preferência no ecrã.</p>
         </div>
 
         <!-- Passo 2 -->
         <div class="passo-card-neon">
             <div class="emoji-glow">💇‍♂️</div>
             <h4>2. Escolha o Serviço</h4>
             <p>Clique no botão <b>"Serviços"</b> no menu superior, escolha a categoria e selecione o corte ou tratamento ideal.</p>
         </div>
 
         <!-- Passo 3 -->
         <div class="passo-card-neon" style="animation-delay: 0.3s;">
             <div class="emoji-glow">📅</div>
             <h4>3. Agende o Horário</h4>
             <p>Consulte o painel de expediente em tempo real, defina o dia útil e reserve um horário livre na agenda do barbeiro.</p>
         </div>
 
         <!-- Instrução 4: Integração Unitel Money -->
         <div class="passo-card-neon" style="animation-delay: 0.6s;">
             <div class="emoji-glow">📱</div>
             <h4>4. Desconto Unitel Money</h4>
             <p>Introduza um terminal Unitel elegível (prefixos 925/935). O gateway calcula e aplica <b>20% de Desconto VIP</b> automáticos no caixa.</p>
         </div>
 
         <!-- Instrução 5: Plano Freemium -->
         <div class="passo-card-neon" style="animation-delay: 0.9s;">
             <div class="emoji-glow">🆓</div>
             <h4>5. Vantagem Freemium</h4>
             <p>Novos salões parceiros operam com taxa zero nos primeiros 30 dias. Clientes efetuam adiantamentos seguros que caem direto no balcão.</p>
         </div>
 
         <!-- 🎁 NOVO PASSO 6: INTELIGÊNCIA DE CUPÕES DE POPULARIDADE E RECOMPENSAS -->
         <div class="passo-card-neon" style="animation-delay: 1.2s; border-bottom: 2px solid #fb923c !important;">
             <div class="emoji-glow">🎁</div>
             <h4 style="color: #fb923c;">6. Cupões de Popularidade</h4>
             <p>Interaja na galeria! Reagir com ❤️, partilhar ou marcar estilos acumula pontos automáticos. Cada 100 pontos libertam <b>Cupões de até 35% de Desconto</b> automáticos no balcão.</p>
         </div>
 
     </div> <!-- FIM DA GRID -->
 </div>
 <!-- Estilização CSS Interna Isolada para Injetar o Brilho Radiante sem Quebrar nada -->
 <style>
     /* 🟢 CARTÃO INDIVIDUAL COM MÁSCARA NEON GLOW ATIVA */
     .passo-card-neon {
         background: #1e293b;
         border: 1px solid #334155;
         padding: 20px;
         border-radius: 12px;
         box-shadow: 0 4px 6px rgba(0,0,0,0.15);
         transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
         border-bottom: 2px solid #38bdf8;
     }
     
     .passo-card-neon h4 {
         font-size: 14px;
         font-weight: bold;
         color: #ffffff;
         margin: 8px 0 4px 0;
         text-transform: uppercase;
         letter-spacing: 0.5px;
     }
     
     .passo-card-neon p {
         font-size: 12px;
         color: #94a3b8;
         line-height: 1.5;
         margin: 0;
     }
 
     /* Animação Flutuante e Radiante ao Passar o Rato (Hover Effect) */
     .passo-card-neon:hover {
         transform: translateY(-5px);
         background: #111e35;
         border-color: #38bdf8;
         box-shadow: 0 0 15px rgba(56, 189, 248, 0.4), 0 0 30px rgba(56, 189, 248, 0.1);
     }
 
     /* Efeito de Luz e Crescimento nos Emojis Corporativos */
     .emoji-glow {
         font-size: 26px;
         display: inline-block;
         transition: transform 0.3s ease;
         filter: drop-shadow(0 0 5px rgba(255,255,255,0.2));
     }
     .passo-card-neon:hover .emoji-glow {
         transform: scale(1.2) rotate(10deg);
         filter: drop-shadow(0 0 8px #38bdf8);
     }
 </style>

















         









<?php
// LINHA DE TESTE: Apaga isto depois de funcionar
echo "<p style='color:#fb923c; background:#111e36; padding:10px; text-align:center;'>O ID da barbearia ativa na sessão é: " . $_SESSION['empresa_codigo'] . "</p>";

// Busca os cosméticos vinculados a esta barbearia específica
$query_produtos = $mysqli->query("SELECT * FROM `produtos_cosmeticos` WHERE `empresa_id` = '".$_SESSION['empresa_codigo']."' AND `stock_atual` > 0");
?>

<div class="container">
    <span class="painel-titulo">Compre os Cosméticos Recomendados pelo seu Barbeiro</span>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 15px;">
        <?php if ($query_produtos && $query_produtos->num_rows > 0): ?>
            <?php while($produto = $query_produtos->fetch_assoc()): 
                $preco_original = $produto['preco'];
                
                // 1. Calcula o preço VIP com Unitel Money (20% de desconto)
                $preco_unitel = $preco_original * 0.80;
                
                // 2. Verifica se o cliente tem um cupão ativo na sessão (até 35% de desconto)
                $desconto_cupao_percentagem = isset($_SESSION['desconto_cupao_ganho']) ? intval($_SESSION['desconto_cupao_ganho']) : 0;
                if ($desconto_cupao_percentagem > 35) { $desconto_cupao_percentagem = 35; }
                
                $preco_com_cupao = $preco_original * (1 - ($desconto_cupao_percentagem / 100));
            ?>
                <div class="passo-card" style="text-align: center;">
                    <div class="emoji-animado" style="font-size: 40px; margin-bottom: 10px;">
                        <?php if(isset($produto['imagem']) && $produto['imagem'] != 'default_cosmetico.jpg'): ?>
                            <img src="uploads/<?php echo $produto['imagem']; ?>" style="width:80px; height:80px; object-fit:contain; margin-bottom:10px;">
                        <?php else: ?>
                            <img src="download (5).png" alt="">
                            
                        <?php endif; ?>
                    </div>
                    
                    <h3 style="font-size: 16px; margin-bottom: 8px; color: #38bdf8;">
                        <?php echo htmlspecialchars($produto['nome_produto']); ?>
                    </h3>
                    
                    <!-- Exibição Dinâmica de Preços e Vantagens -->
                    <p style="font-size: 14px; text-decoration: line-through; color: #a1a1aa; margin-bottom: 2px;">
                        <?php echo number_format($preco_original, 2, ',', '.'); ?> Kz
                    </p>
                    <p style="font-size: 20px; font-weight: bold; color: #fb923c; margin-bottom: 4px;">
                        <?php echo number_format($preco_unitel, 2, ',', '.'); ?> Kz
                        <span style="font-size: 11px; display: block; color: #22c55e;">(Pagar com Unitel Money -20%)</span>
                    </p>
                    
                    <?php if ($desconto_cupao_percentagem > 0): ?>
                        <p style="font-size: 13px; color: #f43f5e; margin-bottom: 10px; font-weight: bold;">
                            Com o seu Cupão: <?php echo number_format($preco_com_cupao, 2, ',', '.'); ?> AOA (-<?php echo $desconto_cupao_percentagem; ?>%)
                        </p>
                    <?php endif; ?>

                    <p style="font-size: 12px; color: #a1a1aa; margin-bottom: 15px;">
                        Stock no Balcão nº <strong><?php echo $produto['stock_atual']; ?></strong>
                    </p>
                    
                    <a href="checkout_produto.php?id=<?php echo $produto['id']; ?>&metodo=unitel" 
                       style="display: block; background-color: #22c55e; color: white; padding: 10px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 12px; margin-bottom: 5px;">
                       📱 Pagar com Unitel Money
                    </a>
                    <a href="checkout_produto.php?id=<?php echo $produto['id']; ?>&metodo=multicaixa" 
                       style="display: block; background-color: #0088cc; color: white; padding: 10px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 12px;">
                       💳 Gerar Referência Multicaixa
                    </a>
                </div>
            <?php endwhile; ?> <!-- 👈 Garante o fecho do loop do produto -->
        <?php else: ?>
            <p style="color: #a1a1aa; font-style: italic;">Esta barbearia ainda não listou produtos para venda esta semana.</p>
        <?php endif; ?> <!-- 👈 Garante o fecho da validação de segurança -->
    </div>
</div>



</div> <!-- Fecha a grid-container -->
</div> <!-- Fecha a secao-funcionarios de forma limpa -->


<div id="area-impressao-global" style="display: none; padding: 20px; font-family: monospace;"></div>
<!-- JANELA POP-UP (MODAL) DOS TERMOS -->
<div id="modalAbas" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 10000; justify-content: center; align-items: center; padding: 20px;">
    
    <div style="background-color: #0f172a; border: 1px solid #334155; width: 100%; max-width: 500px; border-radius: 12px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); position: relative;">
        
        <!-- Botão de Fechar (X) -->
        <span onclick="fecharAbas()" style="position: absolute; top: 15px; right: 20px; color: #ef4444; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <span onclick="fecharAbas()" style="position: absolute; top: 15px; right: 20px; color: #ef4444; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        
       <!-- Título Principal -->
<h3 style="color: #fff; border-bottom: 1px solid #334155; padding-bottom: 12px; margin-top: 0; font-size: 20px; display: flex; align-items: center; gap: 8px;">
Historial da Barbearia Branca
</h3>

<!-- Conteúdo com Rolagem Interna Otimizada de Alta Densidade -->
<div style="color: #94a3b8; font-size: 13px; line-height: 1.6; max-height: 400px; overflow-y: auto; margin-top: 15px; padding-right: 5px;">

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">1. Fundação e Legado Familiar:</strong> 
    O Salão & Barbearia Branca foi fundado em <strong>2015</strong> no bairro de <strong>São Luís-Catimba, Huambo</strong>, por uma parceria unida entre irmãos. O projeto começou com apenas duas cadeiras de atendimento manual e evoluiu para uma infraestrutura robusta de grande porte que atende dezenas de cidadãos por dia.
</p>

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">2. Plano de Expansão Nacional (Visão Futura):</strong> 
    O Grupo Aurélius está a desenhar a engenharia para construir uma das maior megastore estética da região centro e **espalhar franquias em todo o território nacional**. O foco prioritário de expansão para o próximo biénio concentra-se nas capitais de **Luanda, Benguela, Lubango e Cabinda**, padronizando cortes e tratamentos com tecnologia avançada.
</p>

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">3. Governança e Dados dos Clientes:</strong> 
    Os dados inseridos no formulário (Nome, Funcionário, serviços e Horário) são encriptados localmente e protegidos sob sigilo corporativo. Estas informações são confidenciais e usadas unicamente para a organização da agenda, prevenção de dupla marcação e auditoria interna de desempenho da equipa técnica.
</p>

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">4. Política Rígida de Cancelamentos e Faltas:</strong> 
    Alterações ou eliminações de registos no histórico de agendamentos devem ser validadas obrigatoriamente com o administrador do sistema com uma antecedência mínima de 2 horas. .
</p>

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">5. Rastreamento e Métricas de Mercado:</strong> 
    Ao utilizar a plataforma, o utilizador declara estar ciente de que as métricas de cliques em serviços estéticos, preferências de profissionais e relatórios financeiros são catalogados anonimamente. Estes dados alimentam o nosso motor de inteligência comercial para identificar os tratamentos mais populares na região.
</p>

<p style="margin-bottom: 14px; text-align: justify;">
    <strong style="color: #38bdf8;">6. Monetização e Parcerias Internacionais:</strong> 
    O sistema Freemium utiliza algoritmos de recomendação segmentados baseados nas escolhas do utilizador para sugerir cosméticos de marcas líderes globais (como L'Oréal Paris Angola, Clear e Nivea, Angelino ATELIER, BetoArt, AlexArt.). A Barbearia Branca retém comissões residenciais a cada venda direta ou clique convertido na loja parceira.
</p>



<p style="margin-bottom: 0; text-align: justify;">
    <strong style="color: #38bdf8;">7. Higiene e Segurança Sanitária:</strong> 
    Todos os equipamentos de corte, lâminas, tesouras e toalhas passam por um processo rigoroso de esterilização em autoclave após cada sessão. Mantemos o compromisso estrito com as normas de saúde pública de Angola, garantindo um ambiente seguro e eficaz para a proteção de toda a nossa clientela. <br> A Barbearia Branca é a única Barbearia segura pra ti e para toda sua Família.
</p>
</div>
        
        <!-- Botão Entendido -->
        <div style="text-align: right; margin-top: 20px;">
            <button onclick="fecharAbas()" style="background-color: #0088cc; color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 6px; cursor: pointer;">Entendido</button>
        </div>
    </div>
</div>






<div id="area-impressao-global" style="display: none; padding: 20px; font-family: monospace;"></div>

<!-- JANELA POP-UP (MODAL) DOS TERMOS -->
<div id="modalTermos" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 10000; justify-content: center; align-items: center; padding: 20px;">
    
    <div style="background-color: #0f172a; border: 1px solid #334155; width: 100%; max-width: 500px; border-radius: 12px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); position: relative;">
        
        <!-- Botão de Fechar Único e Corrigido (X) -->
        <span onclick="fecharTermos()" style="position: absolute; top: 15px; right: 20px; color: #ef4444; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        
        <!-- Título Principal -->
        <h3 style="color: #fff; border-bottom: 1px solid #334155; padding-bottom: 12px; margin-top: 0; font-size: 20px; display: flex; align-items: center; gap: 8px;">
            Termos e Privacidade
        </h3>

        <!-- Conteúdo com Rolagem Interna Otimizada de Alta Densidade -->
        <div style="color: #94a3b8; font-size: 13px; line-height: 1.6; max-height: 400px; overflow-y: auto; margin-top: 15px; padding-right: 5px; text-align: left;">
            <h5 style="color: #fff; margin: 0 0 5px 0; font-size: 14px;">1. Âmbito do Serviço</h5>
            <p style="margin: 0 0 15px 0;">O salão e barbearia AURELIUS disponibiliza uma plataforma de agendamento digital para otimizar os atendimentos na Província do Huambo. Os serviços marcados estão sujeitos à disponibilidade dos profissionais selecionados no painel técnico.</p>

            <h5 style="color: #fff; margin: 0 0 5px 0; font-size: 14px;">2. Política de Cancelamento e Tolerância</h5>
            <p style="margin: 0 0 15px 0;">O cliente compromete-se a comparecer com 10 minutes de antecedência ao horário validado no comprovativo. É estabelecida uma tolerância máxima de 15 minutos de atraso. Findo este período, o horário poderá ser redistribuído para garantir a fluidez da agenda.</p>

            <h5 style="color: #fff; margin: 0 0 5px 0; font-size: 14px;">3. Proteção de Dados e Privacidade</h5>
            <p style="margin: 0 0 15px 0;">Os dados recolhidos no formulário (Nome do Cliente, Telefone e especificações de atendimento) servem exclusivamente para a gestão interna das sessões e emissão de faturas. Garantimos a não partilha com entidades terceiras em conformidade com as boas práticas de governação de dados.</p>

            <h5 style="color: #fff; margin: 0 0 5px 0; font-size: 14px;">4. Assinatura VIP e Pagamentos Express</h5>
            <p style="margin: 0 0 15px 0;">As ativações de planos promocionais via MultiCaixa Express são de caráter livre e público. O desconto de 20% é aplicado diretamente sobre a tabela de preços vigente no banco de dados para os utilizadores com estatuto PREMIUM ativo.</p>

            <h5 style="color: #fff; margin: 0 0 5px 0; font-size: 14px;">5. Armazenamento Local e Cookies</h5>
            <p style="margin: 0 0 15px 0;">Este sistema utiliza persistência local (LocalStorage) para salvar o seu consentimento de navegação e otimizar o carregamento da cache offline (PWA), garantindo estabilidade técnica mesmo em cenários de conectividade reduzida.</p>
        </div>
        
        <!-- Botão Entendido -->
        <div style="text-align: right; margin-top: 20px;">
            <button onclick="fecharTermos()" style="background-color: #0088cc; color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 6px; cursor: pointer;">Entendido</button>
        </div>
    </div>
</div>
















<!-- =================================================================
     📋 BANNER DE CONSENTIMENTO E INTELIGÊNCIA DE NEGÓCIO (BI) REAL
     ================================================================= -->
     <div class="banner-consentimento" id="cookieBanner" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(15, 23, 42, 0.98); border-top: 2px solid #ca8a04; padding: 15px 25px; display: none; justify-content: space-between; align-items: center; font-size: 12px; color: #94a3b8; z-index: 9999; box-shadow: 0 -5px 20px rgba(0,0,0,0.5); font-family: sans-serif;">
     <div style="padding-right: 20px; line-height: 1.5; text-align: justify;">
         <strong style="color: #ca8a04;">Controlo de Auditoria PWA:</strong> O Grupo Aurélius recolhe métricas estatísticas de navegação anonimizadas, escolhas de serviços estéticos e volumetria financeira para otimização da agenda diária, cálculo do ranking mensal de produtividade e monetização regionalizada no Huambo.
     </div>
     <div style="display: flex; gap: 10px; align-items: center;">
         <button class="btn-aceitar" onclick="processarConsentimentoRealBI()" style="background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; cursor: pointer; white-space: nowrap; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: 0.2s;">
             Aceitar e Permitir Rastreamento
         </button>
     </div>
 </div>
 
 <!-- ⚡ JAVASCRIPT DE GOVERNANÇA DE DADOS (COLAR JUNTO AOS OUTROS SCRIPTS) -->
 <script>
 document.addEventListener("DOMContentLoaded", function() {
     // 🌟 VERIFICAÇÃO AUTOMÁTICA: Se o utilizador já aceitou antes, o banner permanece oculto para sempre
     if (localStorage.getItem('aurelius_consentimento_bi') !== 'permitido') {
         const banner = document.getElementById('cookieBanner');
         if (banner) {
             banner.style.display = 'flex'; // Só mostra a quem ainda não clicou
         }
     }
 });
 
 function processarConsentimentoRealBI() {
     // 1. Grava a decisão de conformidade técnica permanentemente na memória do telemóvel/PC
     localStorage.setItem('aurelius_consentimento_bi', 'permitido');
     
     // 2. Fecha o banner visual imediatamente com o clique do botão
     const banner = document.getElementById('cookieBanner');
     if (banner) {
         banner.style.display = 'none';
     }
     
     // 3. Informação técnica disparada na consola do navegador (Rastreamento de BI Ativo)
     console.log("📋 Grupo Aurélius: Permissão concedida. Métricas de produtividade e cacheoffline PWA inicializadas.");
 }
 </script>

<!-- =================================================================
     ⭐ MODAL DE SUBSCRICÃO PREMIUM - ACESSO PÚBLICO E ANIMAÇÃO FADE-IN
     ================================================================= -->
     <div id="modalPremium" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.85); z-index: 10000; justify-content: center; align-items: center; padding: 20px; box-sizing: border-box;">
    
     <!-- CSS Embutido de Alta Performance para o Efeito de Esmaecimento Suave -->
     <style>
         .fade-in-suave {
             animation: fadeInAnimacao 0.4s ease-in-out forwards;
         }
         @keyframes fadeInAnimacao {
             from { opacity: 0; transform: scale(0.95); }
             to { opacity: 1; transform: scale(1); }
         }
     </style>
     
     <div class="fade-in-suave" style="background-color: #0f172a; border: 2px solid #ca8a04; border-radius: 12px; width: 100%; max-width: 480px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); position: relative; font-family: sans-serif;">
         
         <!-- Botão Fechar -->
         <span onclick="fecharModalPremium()" style="position: absolute; top: 12px; right: 20px; color: #ef4444; font-size: 28px; cursor: pointer; font-weight: bold;">&times;</span>
         
         <!-- Cabeçalho com Destaque dos 20% em Barbearias -->
         <div style="text-align: center; margin-bottom: 20px;">
             <h2 style="color: #ca8a04; margin: 0 0 5px 0; font-size: 22px; letter-spacing: 0.5px;">⭐ PLANO AURELIUS VIP</h2>
             <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.4;">
                 Ative o seu plano FREMIUM para obter <strong>20% de DESCONTO EM QUALQUER SERVIÇO QUE DESEJARES</strong> Dámos-te Prioridade máxima no atendimento e remoção total de anúncios!
             </p>
         </div>
 
         <!-- Opções de Inscrição Aberta (Valores Promocionais) -->
         <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
             
             <!-- Mensal -->
             <label style="display: flex; align-items: center; justify-content: space-between; background: #131e35; padding: 14px; border-radius: 8px; cursor: pointer; border: 1px solid #ca8a04;" id="labelMensal">
                 <div style="display: flex; align-items: center;">
                     <input type="radio" name="planoPremium" value="mensal" checked onclick="atualizarPrecoPlano(1000)" style="margin-right: 12px; transform: scale(1.2);">
                     <span style="color: #fff; font-weight: bold; font-size: 14px;">Plano Mensal (Livre)</span>
                 </div>
                 <span style="color: #ca8a04; font-weight: bold; font-size: 14px;">1.000 Kz/mês</span>
             </label>
 
             <!-- Semestral -->
             <label style="display: flex; align-items: center; justify-content: space-between; background: #1e293b; padding: 14px; border-radius: 8px; cursor: pointer; border: 1px solid #334155;" id="labelSemestral">
                 <div style="display: flex; align-items: center;">
                     <input type="radio" name="planoPremium" value="semestral" onclick="atualizarPrecoPlano(5000)" style="margin-right: 12px; transform: scale(1.2);">
                     <span style="color: #fff; font-weight: bold; font-size: 14px;">Plano Semestral (Livre)</span>
                 </div>
                 <span style="color: #ca8a04; font-weight: bold; font-size: 14px;">5.000 Kz <small style="color:#22c55e; font-size:10px; display:block; text-align:right;">Poupe mais</small></span>
             </label>
 
             <!-- Anual -->
             <label style="display: flex; align-items: center; justify-content: space-between; background: #1e293b; padding: 14px; border-radius: 8px; cursor: pointer; border: 1px solid #334155;" id="labelAnual">
                 <div style="display: flex; align-items: center;">
                     <input type="radio" name="planoPremium" value="anual" onclick="atualizarPrecoPlano(9000)" style="margin-right: 12px; transform: scale(1.2);">
                     <span style="color: #fff; font-weight: bold; font-size: 14px;">Plano Anual (Livre)</span>
                 </div>
                 <span style="color: #ca8a04; font-weight: bold; font-size: 14px;">9.000 Kz <small style="color:#22c55e; font-size:10px; display:block; text-align:right;">Melhor Oferta</small></span>
             </label>
         </div>
 
         <!-- Área de Integração MultiCaixa Express Pública -->
         <div style="background: #1e293b; padding: 15px; border-radius: 8px; border: 1px solid #3b82f6;">
             <h4 style="color: #fff; margin: 0 0 8px 0; font-size: 14px; text-align: center;">📱 Pagamento Aberto via UnitelMoney/ MCX Express</h4>
             <p style="color: #94a3b8; font-size: 11px; margin: 0 0 12px 0; text-align: center; line-height: 1.3;">Disponível para qualquer utilizador da rede. Introduza o número do seu telemóvel Express para ativação imediata.</p>
             
             <input type="tel" id="telefoneExpress" placeholder="nº de telefone" maxlength="9" style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid #475569; background: #0f172a; color: white; text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 12px; box-sizing: border-box; outline: none;">
             
             <button onclick="processarPagamentoExpressAberto()" style="width: 100%; background: #22c55e; color: white; border: none; padding: 12px; font-size: 14px; font-weight: bold; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px;">
                 Confirmar e Inscrever <span id="txtPrecoBotao">1.000</span> Kz
             </button>
         </div>
 
     </div>
 </div>



















 <footer style="background-color: #0b111e; border-top: 2px solid #ca8a04; padding: 50px 20px 30px 20px; color: #f8fafc; margin-top: 60px; font-family: 'Segoe UI', Arial, sans-serif; text-align: left; box-shadow: 0 -5px 25px rgba(0,0,0,0.5);">
    <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px; padding-bottom: 30px; border-bottom: 1px solid #1e293b;">
        
        <!-- Coluna 1: Identidade da Marca -->
        <div>
            <h2 style="font-size: 20px; font-weight: 800; color: #ef4444; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                🎌 GRUPO <span style="color: #ffffff;">AURÉLIUS</span>
            </h2>
            <p style="font-size: 13px; color: #94a3b8; line-height: 1.6; margin: 0 0 15px 0; text-align: justify;">
                A maior infraestrutura e ecossistema multisserviços de estética, barbearia digital e e-commerce de cosméticos premium da província do Huambo.
            </p>
            <span style="background: rgba(202, 138, 4, 0.1); color: #ca8a04; border: 1px solid rgba(202, 138, 4, 0.3); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                SaaS Platform v2.1
            </span>
        </div>

        <!-- Coluna 2: Links de Acesso Rápido -->
        <div>
            <h4 style="font-size: 13px; font-weight: bold; color: #ca8a04; text-transform: uppercase; margin-bottom: 15px; letter-spacing: 0.5px;">Navegação Segura</h4>
            <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px; display: flex; flex-direction: column; gap: 10px;">
                <li><a href="frame.php" style="color: #cbd5e1; text-decoration: none; transition: 0.2s;">🏪 Portal de Barbearias</a></li>
                <li><a href="BrancaCadastar.php" style="color: #cbd5e1; text-decoration: none; transition: 0.2s;">👨🏼‍🦰 Criar Conta de Cliente</a></li>
                <li><a href="BrancaCadastar.php" style="color: #cbd5e1; text-decoration: none; transition: 0.2s;">🔐 Área Administrativa </a></li>
                <li><a href="unitel.php" style="color: #cbd5e1; text-decoration: none; transition: 0.2s;">📱 Gateway de Pagamento Móvel</a></li>
            </ul>
        </div>

        <!-- Coluna 3: Sede e Contactos Oficiais -->
        <div>
            <h4 style="font-size: 13px; font-weight: bold; color: #ca8a04; text-transform: uppercase; margin-bottom: 15px; letter-spacing: 0.5px;">Sede Executiva</h4>
            <p style="font-size: 13px; color: #cbd5e1; margin-bottom: 8px; line-height: 1.4;">
                📍 Bairro São Luís Catimba,<br>Huambo — Angola
            </p>
            <p style="font-size: 13px; color: #cbd5e1; margin-bottom: 8px;">
                📞 Suporte Técnico: <span style="color: #38bdf8; font-weight: bold;">+244 925 347 372/ <br> 928 829 299</span>
            </p>
            <p style="font-size: 12px; color: #64748b;">
                ⏰ Atendimento: Seg a Sáb — 08h00 às 22h00
            </p>
        </div>

    </div>

    <!-- Direitos Autorais e Assinatura Técnica -->
    <div style="max-width: 1100px; margin: 20px auto 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 12px; color: #64748b;">
        <p>© <?php echo date('Y'); ?> Grupo Aurélius. Todos os direitos reservados em território nacional.</p>
        <p>Desenvolvido por: <span style="color: #ca8a04; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">Aurélio Sacalumbo</span></p>
    </div>
</footer>


<!-- =================================================================
     📋 BANNER DE CONSENTIMENTO E INTELIGÊNCIA DE NEGÓCIO (BI) REAL
     ================================================================= -->
<div class="banner-consentimento" id="cookieBanner" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(15, 23, 42, 0.98); border-top: 2px solid #ca8a04; padding: 15px 25px; display: none; justify-content: space-between; align-items: center; font-size: 12px; color: #94a3b8; z-index: 9999; box-shadow: 0 -5px 20px rgba(0,0,0,0.5); font-family: sans-serif;">
    <div style="padding-right: 20px; line-height: 1.5; text-align: justify;">
        <strong style="color: #ca8a04;">Controlo de Auditoria PWA:</strong> O Grupo Aurélius recolhe métricas estatísticas de navegação anonimizadas, escolhas de serviços estéticos e volumetria financeira para otimização da agenda diária, cálculo do ranking mensal de produtividade e monetização regionalizada no Huambo.
    </div>
    <div style="display: flex; gap: 10px; align-items: center;">
        <button class="btn-aceitar" onclick="processarConsentimentoRealBI()" style="background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; cursor: pointer; white-space: nowrap; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: 0.2s;">
            Aceitar e Permitir Rastreamento
        </button>
    </div>
</div>


<!-- =================================================================
     🧠 MOTOR JAVASCRIPT: CONTROLO INTELIGENTE DO BANNER DE BI
     ================================================================= -->
<script>

   // =========================================================================
    // 🎁 GATILHO REATIVO: EXIBE E APLICA O DESCONTO DO RANKING AUTOMATICAMENTE
    // =========================================================================
    // Resgata com segurança as variáveis que o PHP injetou na sessão lá no topo
    const corteVipPre = "<?php echo $_SESSION['servico_pre_selecionado'] ?? ''; ?>";
    const percentualVipPre = parseInt("<?php echo $_SESSION['desconto_cupao_ganho'] ?? 0; ?>");

    if (corteVipPre !== "" && percentualVipPre > 0) {
        console.log(`🎁 Cupão detetado: ${corteVipPre} com -${percentualVipPre}%`);

        // 1. Aciona a tua função blindada para preencher os textos e as caixas de preço
        if (typeof exibirPrecoFinal === "function") {
            // Passa o nome do corte e o texto sinalizando o cálculo do prémio
            exibirPrecoFinal(corteVipPre, "A aplicar prémio... kz");
            
            // Fixa os dados nas variáveis globais masters exigidas pelo teu botão de gravação
            window.nomeServicoGlobal = corteVipPre;
            
            // 2. Localiza o teu botão de agendamento e carimba o selo de desconto ganho
            const btnConfirmar = document.querySelector('.btn-confirmar') || document.querySelector('.btn-confirmar-sessao');
            if (btnConfirmar) {
                btnConfirmar.innerHTML = `📅 Confirmar Atendimento (Cupão -${percentualVipPre}% Ativo!)`;
                btnConfirmar.style.background = "linear-gradient(135deg, #22c55e, #16a34a)"; // Força a cor verde de sucesso
                btnConfirmar.style.color = "#ffffff";
                btnConfirmar.style.fontWeight = "bold";
            }
        }
    }


    document.addEventListener("DOMContentLoaded", function() {
        // Verifica se o cliente já aceitou o rastreamento nesta máquina anteriormente
        let consentimentoBI = localStorage.getItem("aurelius_consentimento_bi");
        
        // Se ainda não existir a chave gravada, o motor força a aparição do banner mudando para flex
        if (!consentimentoBI) {
            document.getElementById("cookieBanner").style.display = "flex";
        }
    });

    // Função executada no clique do botão verde para salvar a escolha e sumir com o bloco
    function processarConsentimentoRealBI() {
        localStorage.setItem("aurelius_consentimento_bi", "aceito_auditado");
        document.getElementById("cookieBanner").style.display = "none";
        console.log("✓ Auditoria BI autorizada com sucesso na rede local.");
    }
</script>

<script>





// ⚡ CONTROLO TOTALMENTE DINÂMICO E ABERTO DO MODAL PREMIUM
const tabelaPrecosPromocionais = { mensal: 1000, semestral: 5000, anual: 9000 };

function atualizarPrecoPlano(valor) {
    const txtBotao = document.getElementById('txtPrecoBotao');
    if (txtBotao) txtBotao.innerText = valor.toLocaleString('pt-PT');
    
    const plano = document.querySelector('input[name="planoPremium"]:checked').value;
    const caixas = {
        mensal: document.getElementById('labelMensal'),
        semestral: document.getElementById('labelSemestral'),
        anual: document.getElementById('labelAnual')
    };
    
    for (const chave in caixas) {
        if (caixas[chave]) {
            if (chave === plano) {
                caixas[chave].style.borderColor = "#ca8a04";
                caixas[chave].style.background = "#131e35";
            } else {
                caixas[chave].style.borderColor = "#334155";
                caixas[chave].style.background = "#1e293b";
            }
        }
    }
}

function fecharModalPremium() {
    document.getElementById('modalPremium').style.display = 'none';
}

function abrirModalPremium() {
    const modal = document.getElementById('modalPremium');
    if (modal) {
        modal.style.display = 'flex';
        atualizarPrecoPlano(tabelaPrecosPromocionais.mensal);
    }
}


function processarPagamentoExpressAberto() {
    const telefone = document.getElementById('telefoneExpress').value.trim();
    const planoEscolhido = document.querySelector('input[name="planoPremium"]:checked').value;
    
    // CAPTURA REAL: Lê o valor exato que o utilizador digitou no input do Painel Azul
    const inputNome = document.getElementById('inputNomeCliente');
    const nomeCliente = inputNome ? inputNome.value.trim() : "";
    
    // Validação de segurança para impedir o nome fixo de teste
    if (nomeCliente === "" || nomeCliente === "Nome do Cliente (Obrigatório)") {
        alert("⚠️ Por favor, digite o Nome do Cliente no formulário (Painel Azul) antes de ativar o plano Premium!");
        return;
    }
    
    if (telefone.length !== 9) {
        alert("⚠️ Grupo Aurélius: Insira um número de telemóvel Express válido com 9 dígitos.");
        return;
    }
    
    // Dispara o envio dos dados dinâmicos reais para o servidor
    fetch('salvar_assinatura.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            telefone: telefone,
            plano: planoEscolhido,
            nome: nomeCliente
        })
    })
    .then(response => response.json())
    .then(dados => {
        if (dados.status === 'sucesso') {
            alert(`🎉 Inscrição Concluída...!\n\nEstatuto PREMIUM ativado para o cliente ${nomeCliente}.\n\nDesconto de 20% já disponível no sistema!`);
            fecharModalPremium();
        } else {
            alert("❌ Erro ao ativar o plano: " + dados.mensagem);
        }
    })
    .catch(erro => {
        console.error("Erro na requisição:", erro);
        alert("❌ Erro de conectividade com o servidor.");
    });
}








    let nomeServicoGlobal = "";
    let valorServicoGlobal = 0;
    document.getElementById('printLinhaDesconto').style.display = 'flex';
document.getElementById('printMensagemAgradecimentoVIP').style.display = 'block';

// Dentro do 'else':
document.getElementById('printLinhaDesconto').style.display = 'none';
document.getElementById('printMensagemAgradecimentoVIP').style.display = 'none';
    function irParaSecao(idSecao) {
        // 1. Oculta todas as abas do sistema primeiro
        document.querySelectorAll('.aba-conteudo').forEach(div => {
            div.style.display = 'none';
            div.classList.remove('active');
        });
    
        // 2. Localiza a seção desejada (ex: secao-funcionarios)
        const alvo = document.getElementById('secao-' + idSecao);
        if (alvo) {
            // 3. Torna a seção visível e ativa na tela
            alvo.style.display = 'block';
            alvo.classList.add('active');
        }
        
        // 4. Atualiza o endereço na barra do navegador (#funcionarios)
        window.location.hash = idSecao;
    }

    // Abre a categoria clicada e esconde o painel principal de categorias
    function alternarCategoria(idCategoria) {
        // Esconde todas as listas de serviços abertas
        document.querySelectorAll('.aba-conteudo').forEach(aba => {
            aba.style.display = 'none';
        });
        
        // Esconde o bloco principal com as 11 categorias para limpar a tela
        document.getElementById('secao-categorias').style.display = 'none';
        
        // Mostra apenas a lista de serviços da categoria que foi clicada
        const alvo = document.getElementById(idCategoria);
        if(alvo) {
            alvo.style.display = 'block';
            alvo.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // CORRIGIDO: Fecha os serviços e faz a grade das categorias reaparecer
    function fecharCategoria() {
        // Oculta todas as listas de serviços
        document.querySelectorAll('.aba-conteudo').forEach(aba => {
            aba.style.display = 'none';
        });

        // Faz a grade principal de categorias reaparecer no ecrã
        if (document.getElementById('secao-categorias')) {
            document.getElementById('secao-categorias').style.display = 'block';
        }
        
        // Oculta as barras de confirmação de preço inferiores
        if (document.getElementById('caixa-confirmacao')) {
            document.getElementById('caixa-confirmacao').style.display = 'none';
        }
        
        const barraVerde = document.getElementById('barra-topo-verde');
        if (barraVerde) barraVerde.style.display = 'none';
    } 

    // UNIFICADO E CORRIGIDO: Controla de forma absoluta a exibição dos funcionários pelo clique
    function toggleFuncionarios() {
        const secao = document.getElementById('secaoFuncionarios');
        const botao = document.getElementById('btnToggleFuncionarios');
        
        if (!secao || !botao) return;

        // Verifica se a propriedade display contém 'none' ou se está oculta nativamente
        if (secao.style.getPropertyValue('display').trim() === 'none' || secao.style.display === '' || window.getComputedStyle(secao).display === 'none') {
            // Remove a trava do display e mostra a lista
            secao.style.setProperty('display', 'block', 'important');
            botao.innerHTML = '❌ Ocultar Funcionários';
            botao.style.background = 'linear-gradient(135deg, #475569, #334155)';
        } else {
            // Adiciona a trava do display e esconde a lista novamente
            secao.style.setProperty('display', 'none', 'important');
            botao.innerHTML = '👥 Ver Funcionários';
            botao.style.background = 'linear-gradient(135deg, #3b82f6, #1d4ed8)';
        }
    }
    const telefoneCliente = document.getElementById('inputTelefoneCliente').value.trim();

// No bloco onde adiciona os campos ao FormData, acrescente:
dadosForm.append('cliente_telefone', telefoneCliente);

    // UNIFICADO: Faz a busca dinâmica e atualiza status e contadores sem duplicar código
    function atualizarIndicadores() {
        fetch('buscar_dados_dashboard.php')
            .then(response => {
                if (!response.ok) throw new Error('Erro na resposta do servidor');
                return response.json();
            })
            .then(dados => {
                // Atualiza sempre os contadores superiores (Caixa, Sessões, Equipa)
                if(document.getElementById('valorCaixa')) document.getElementById('valorCaixa').innerHTML = dados.caixa;
                if(document.getElementById('valorAtendimentos')) document.getElementById('valorAtendimentos').innerHTML = dados.atendimentos;
                if(document.getElementById('valorEquipa')) document.getElementById('valorEquipa').innerHTML = dados.equipa;

                // Atualiza os status ocultos nos bastidores (deixando os dados prontos para quando abrir)
                if (dados.status_funcionarios) {
                    Object.keys(dados.status_funcionarios).forEach(idNum => {
                        const elemento = document.getElementById('status-text-' + idNum);
                        if (elemento) {
                            const textoStatus = dados.status_funcionarios[idNum];
                            elemento.innerText = textoStatus;

                            // Trata e atualiza a cor do texto conforme o estado guardado no banco
                            if (textoStatus.includes('Ausente') || textoStatus.includes('Folga')) {
                                elemento.style.color = '#ef4444'; // Vermelho
                            } else if (textoStatus.includes('Atendimento') || textoStatus.includes('Em')) {
                                elemento.style.color = '#ffaa00'; // Laranja
                            } else {
                                elemento.style.color = '#22c55e'; // Verde
                            }
                        }
                    });
                }
            })
            .catch(error => console.error('Erro na atualização automática de indicadores:', error));
    }

    // Inicialização única do temporizador de 4 segundos
    document.addEventListener("DOMContentLoaded", function() {
        // 15000 milissegundos = 15 segundos (Poupe a memória do seu Apache local)
        setInterval(atualizarIndicadores, 15000);
    });

    // Rolagem suave e navegação mobile
    function irParaSecaoScroll(idSecao) {
        var secaoAlvo = document.getElementById(idSecao);
        if (secaoAlvo) {
            secaoAlvo.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function irParaSecaoMobile(idSecao) {
        irParaSecaoScroll(idSecao);
        if (typeof toggleMenu === "function") {
            toggleMenu();
        }
    }
    function abrirAbas() {
        var modal = document.getElementById('modalAbas');
        if (modal) modal.style.display = 'flex';
    }

    function fecharAbas() {
        var modal = document.getElementById('modalAbas');
        if (modal) modal.style.display = 'none';
    }

    function abrirTermos() {
        var modal = document.getElementById('modalTermos');
        if (modal) modal.style.display = 'flex';
    }

    function fecharTermos() {
        var modal = document.getElementById('modalTermos');
        if (modal) modal.style.display = 'none';
    }
   

    function enviarMarcacaoParaBanco() {
        const inputCliente = document.getElementById('inputNomeCliente');
        // ... Resto da sua lógica de envio que já estava boa ...
    }






























function atualizarIndicadores() {
    fetch('buscar_dados_dashboard.php')
        .then(response => {
            if (!response.ok) throw new Error('Erro na resposta do servidor');
            return response.json();
        })
        .then(dados => {
            if (document.getElementById('valorCaixa')) {
                document.getElementById('valorCaixa').innerHTML = dados.caixa;
            }
            if (document.getElementById('valorAtendimentos')) {
                document.getElementById('valorAtendimentos').innerHTML = dados.atendimentos;
            }
            if (document.getElementById('valorEquipa')) {
                document.getElementById('valorEquipa').innerHTML = dados.equipa;
            }
        })
        .catch(error => console.error('Erro na atualização automática:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    atualizarIndicadores(); 
    setInterval(atualizarIndicadores, 4000);
});

function enviarMarcacaoParaBanco() {
    // 1. Captura os dados reais do formulário do topo
    const inputCliente = document.getElementById('inputNomeCliente') || document.querySelector('input[type="text"]');
    const inputFuncionario = document.getElementById('inputFuncionario') || document.querySelector('select');
    const inputData = document.getElementById('inputDataServico') || document.querySelector('input[type="date"]');
    const inputHora = document.getElementById('inputHoraServico') || document.querySelector('input[type="time"]');

    const cliente = inputCliente ? inputCliente.value.trim() : "Consumidor Final";
    const funcionario = inputFuncionario ? inputFuncionario.value : "Não Informado";
    const data = inputData && inputData.value ? inputData.value : new Date().toISOString().split('T')[0];
    const hora = inputHora && inputHora.value ? inputHora.value : new Date().toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit' });

    // 2. Validações de segurança
    if (!cliente || cliente === "Consumidor Final") {
        alert("Por favor, digite o Nome do Cliente no formulário do topo!");
        if (inputCliente) inputCliente.focus();
        return;
    }

    if (!funcionario || funcionario.includes("Selecione") || funcionario === "Não Informado") {
        alert("Por favor, selecione um Profissional no formulário do topo!");
        if (inputFuncionario) inputFuncionario.focus();
        return;
    }

    if (!window.nomeServicoGlobal) {
        alert("Por favor, clique numa categoria e selecione o tipo de serviço/corte antes de marcar!");
        return;
    }

    const valorServico = parseFloat(window.valorServicoGlobal) || 0;

    // 3. ENVELOPA OS DADOS COMO FORMULÁRIO REAL (Prepara para o PHP ler no $_POST)
    const dadosForm = new FormData();
    dadosForm.append('nome_cliente', cliente);
    dadosForm.append('funcionario', funcionario);
    dadosForm.append('data_servico', data);
    dadosForm.append('hora_servico', hora);
    dadosForm.append('servico', window.nomeServicoGlobal); 
    dadosForm.append('preco_base', valorServico);

    console.log("A submeter dados para o servidor...");

    // 4. ENVIO DUPLO AUTOMATIZADO (Tenta salvar_agendamento.php e se falhar tenta salvar_atendimento.php)
    const ficheiroDestino = './salvar_agendamento.php';

    fetch(ficheiroDestino, {
        method: 'POST',
        body: dadosForm // Envia como FormData e não como JSON!
    })
    .then(response => {
        if (!response.ok) throw new Error('Erro de rede');
        return response.json();
    })
    .then(resultado => {
        if (resultado.sucesso || resultado.status === 'sucesso') {
            alert("✨ Marcação feita com sucesso! ✨\nA processar o recibo do cliente...");
            
            // Dispara a impressão térmica enviando os dados limpos
            imprimirRelatorioCompleto(cliente, funcionario, data, hora, window.nomeServicoGlobal, valorServico);

            if (typeof atualizarIndicadores === "function") atualizarIndicadores();
            if (inputCliente) inputCliente.value = "";
            voltarParaNivel1();
        } else {
            // TENTATIVA DE CONTINGÊNCIA: Se falhar num ficheiro, tenta no outro automaticamente
            fetch('./salvar_atendimento.php', { method: 'POST', body: dadosForm })
            .then(r => r.json())
            .then(resAlt => {
                if (resAlt.sucesso) {
                    alert("✨ Marcação feita com sucesso (Rota Alternativa)! ✨");
                    imprimirRelatorioCompleto(cliente, funcionario, data, hora, window.nomeServicoGlobal, valorServico);
                    if (inputCliente) inputCliente.value = "";
                    voltarParaNivel1();
                } else {
                    alert("Aviso do servidor: " + (resAlt.mensagem || resultado.mensagem));
                }
            }).catch(() => {
                alert("Aviso: " + resultado.mensagem);
            });
        }
    })
    .catch(erro => {
        console.error("Erro na Gravação:", erro);
        // Fallback Local: Se o teu Apache estiver offline ou sem as tabelas, ele abre o talão de qualquer forma para não travar o cliente!
        alert("⚠️ Sincronização Local ativa: A gerar o talão térmico de atendimento.");
        imprimirRelatorioCompleto(cliente, funcionario, data, hora, window.nomeServicoGlobal, valorServico);
    });
}

















     
function mostrarNivel2(cat) {
    // 1. Esconde por completo o Nível 1 (Grade de Categorias)
    const nivel1 = document.getElementById('nivel1');
    if (nivel1) {
        nivel1.classList.add('hidden');
    }
    
    // 2. Torna visível o contêiner do Nível 2 (Área dos Serviços)
    const nivel2 = document.getElementById('nivel2');
    if (nivel2) {
        nivel2.classList.remove('hidden');
    }
    
    // 3. Força TODOS os subgrupos de serviços a receberem a classe hidden
    document.querySelectorAll('.sub-grupo').forEach(subGrupo => {
        subGrupo.classList.add('hidden');
    });
    
    // 4. Mostra exclusivamente o subgrupo da categoria que foi clicada
    const subGrupoAlvo = document.getElementById('sub-' + cat);
    if (subGrupoAlvo) {
        subGrupoAlvo.classList.remove('hidden');
        subGrupoAlvo.scrollIntoView({ behavior: 'smooth' });
    }
}

function voltarParaNivel1() {
    // 1. Faz a grade de categorias (Nível 1) reaparecer na tela
    const nivel1 = document.getElementById('nivel1');
    if (nivel1) {
        nivel1.classList.remove('hidden');
    }
    
    // 2. Esconde o bloco de serviços do Nível 2
    const nivel2 = document.getElementById('nivel2');
    if (nivel2) {
        nivel2.classList.add('hidden');
    }
    
    // 3. Garante que nenhum subgrupo isolado fique aberto
    document.querySelectorAll('.sub-grupo').forEach(subGrupo => {
        subGrupo.classList.add('hidden');
    });
    
    // 4. Limpa e oculta a caixa de confirmação de preço do topo
    const caixaPreco = document.getElementById('caixa-preco');
    if (caixaPreco) {
        caixaPreco.classList.add('hidden');
    }
}

// Botão de retorno para limpar a tela e voltar ao Nível 1
function voltarParaNivel1() {
    const nivel1 = document.getElementById('nivel1');
    if (nivel1) nivel1.classList.remove('hidden');
    
    const nivel2 = document.getElementById('nivel2');
    if (nivel2) nivel2.classList.add('hidden');
    
    const caixaPreco = document.getElementById('caixa-preco');
    if (caixaPreco) caixaPreco.classList.add('hidden');
}
// =========================================================================
// 🎯 CONTROLADOR MESTRE DE CLIQUE DO SERVIÇO (DESTRAVAMENTO GLOBAL DO CAIXA)
// =========================================================================
function exibirPrecoFinal(nome, valorTexto) {
    // 1. Grava obrigatoriamente na memória master absoluta que o teu botão verde lê
    window.nomeServicoGlobal = nome;
    
    // Extrai apenas os números (ex: "4.500 kz" vira 4500) para o PHP não bugar
    let valorLimpo = valorTexto.replace('kz', '').replace(/\./g, '').trim();
    window.valorServicoGlobal = parseFloat(valorLimpo);

    console.log("🎯 Serviço fixado globalmente:", window.nomeServicoGlobal, "por", window.valorServicoGlobal, "Kz");

    // 2. Alimenta TODOS os possíveis elementos de texto no teu HTML (evita erros de ID)
    const IDsNome = ['nome-servico', 'nome-servico-selecionado', 'barra-verde-nome'];
    const IDsPreco = ['valor-servico', 'preco-servico-selecionado', 'barra-verde-preco'];
    const IDsCaixa = ['caixa-preco', 'caixa-confirmacao', 'barra-topo-verde'];

    IDsNome.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.innerText = nome;
    });

    IDsPreco.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.innerText = valorTexto;
    });

    // 3. Força a exibição imediata e remove qualquer classe 'hidden' das caixas de preço
    IDsCaixa.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.classList.remove('hidden');
            el.style.display = 'block';
        }
    });
}


// Vincula a rota antiga dos teus botões dinâmicos/estáticos para a nova engine blindada
function selecionarServico(nome, preco) {
    exibirPrecoFinal(nome, preco.toLocaleString('pt-AO') + " kz");




















}function imprimirRelatorioCompleto(clienteParam, funcionarioParam, dataParam, horaParam, servicoParam, valorParam) {
    // Mecanismo de segurança: se o parâmetro não vier, busca do formulário ou variáveis globais
    const cliente = clienteParam || document.getElementById('inputNomeCliente')?.value || "Consumidor Final";
    const funcionario = funcionarioParam || document.getElementById('inputFuncionario')?.value || "Não Informado";
    
    // CORREÇÃO: Captura segura da data sem quebrar o split
    let dataInput = dataParam || document.getElementById('inputDataServico')?.value;
    const dataRaw = dataInput ? dataInput.split('T')[0] : new Date().toISOString().split('T')[0];
    
    const hora = horaParam || document.getElementById('inputHoraServico')?.value || "--:--";
    const servico = servicoParam || (typeof nomeServicoGlobal !== 'undefined' ? nomeServicoGlobal : "Serviço Geral");
    const valor = valorParam !== undefined ? valorParam : (typeof valorServicoGlobal !== 'undefined' ? valorServicoGlobal : 0);

    // Formata a data do padrão do sistema (AAAA-MM-DD) para DD/MM/AAAA
    let dataFormatada = "--/--/----";
    if (dataRaw && dataRaw.includes("-")) {
        const partes = dataRaw.split("-");
        if (partes.length === 3) {
            dataFormatada = partes[2] + "/" + partes[1] + "/" + partes[0];
        }
    } else {
        dataFormatada = dataRaw;
    }
    
    // Formata o valor monetário separando os milhares por espaço (ex: 15 000 Kz)
    let precoNumerico = parseFloat(valor) || 0;
    let precoFormatado = precoNumerico.toLocaleString('pt-PT').replace(/\./g, ' ');

    // Injeta os estilos CSS otimizados para Impressoras Térmicas de Talões (80mm / 58mm)
    let estiloImpressao = document.getElementById('estilo-impressao-aurelius');
    if (!estiloImpressao) {
        estiloImpressao = document.createElement('style');
        estiloImpressao.id = 'estilo-impressao-aurelius';
        estiloImpressao.innerHTML = `
            @media print {
                /* Esconde tudo o que está no site, exceto a área da fatura */
                body * { display: none !important; }
                #area-impressao-global, #area-impressao-global * { display: block !important; }
                
                body, html {
                    background-color: #ffffff !important;
                    color: #000000 !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
                .no-print-btn { display: none !important; }
                @page { size: auto; margin: 0mm; }
                
                /* Força o visual compacto de talão térmico na bobine */
                .zona-recibo-impressao { padding: 0 !important; min-height: auto !important; background: #fff !important; }
                .recibo-card-premium { 
                    max-width: 100% !important; 
                    width: 80mm !important; /* Padrão de impressora térmica */
                    padding: 10px !important; 
                    box-shadow: none !important; 
                    background: #fff !important;
                    border: none !important;
                }
                /* Alterna os textos vermelhos/azuis para preto legível no papel térmico */
                .recibo-card-premium text, .recibo-card-premium span, .recibo-card-premium h1, .recibo-card-premium label {
                    color: #000000 !important;
                }
                .bloco-total { border: 1px dashed #000 !important; background: #fff !important; color: #000 !important; }
                .bloco-total * { color: #000 !important; }
            }
            
            /* Visualização bonita no Ecrã antes de mandar imprimir */
            .zona-recibo-impressao {
                background-color: rgba(11, 26, 48, 0.95);
                font-family: 'Courier New', Courier, monospace;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100vh;
                z-index: 99999;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow-y: auto;
                padding: 20px;
                box-sizing: border-box;
            }
            .recibo-card-premium {
                background-color: #111e38;
                border: 2px solid #0088cc;
                border-radius: 12px;
                width: 100%;
                max-width: 400px;
                padding: 25px;
                box-shadow: 0 0 20px rgba(0, 136, 204, 0.4);
                box-sizing: border-box;
            }
        `;
        document.head.appendChild(estiloImpressao);
    }

    const areaImpressao = document.getElementById('area-impressao-global');
    if (areaImpressao) {
        // CORREÇÃO: Torna a div de impressão visível imediatamente no ecrã ao clicar
        areaImpressao.style.display = 'flex';
        
        areaImpressao.innerHTML = `
            <div class="zona-recibo-impressao">
                <div class="recibo-card-premium">
                    
                    <!-- Botão Fechar no Ecrã -->
                    <span class="no-print-btn" onclick="document.getElementById('area-impressao-global').style.display='none'" style="float: right; color: #ef4444; font-size: 24px; cursor: pointer; font-weight: bold; font-family: sans-serif; line-height: 1;">&times;</span>
                    
                    <!-- Cabeçalho do Talão -->
                    <div style="text-align: center; margin-bottom: 15px;">
                        <h1 style="color: #38bdf8; font-size: 20px; margin: 0 0 4px 0; text-transform: uppercase; font-weight: bold;">Barbearia Branca</h1>
                        <p style="color: #94a3b8; font-size: 11px; margin: 0; text-transform: uppercase;">Comprovativo de Atendimento</p>
                    </div>

                    <div style="border-top: 1px dashed #334155; margin: 12px 0;"></div>

                    <!-- Dados Dinâmicos da Fatura -->
                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px; font-size: 13px; text-align: left;">
                        <div style="display: flex; justify-content: space-between;">
                            <label style="color: #64748b; font-weight: bold;">Cliente:</label>
                            <span style="color: #ffffff; font-weight: bold;">` + cliente + `</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <label style="color: #64748b; font-weight: bold;">Profissional:</label>
                            <span style="color: #ffffff;">` + funcionario + `</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <label style="color: #64748b; font-weight: bold;">Serviço:</label>
                            <span style="color: #ffffff;">` + servico + `</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <label style="color: #64748b; font-weight: bold;">Data/Hora:</label>
                            <span style="color: #38bdf8; font-weight: bold;">` + dataFormatada + ` - ` + hora + `</span>
                        </div>
                    </div>

                    <!-- Bloco de Total Pago -->
                    <div class="bloco-total" style="background-color: #0b1329; border-left: 4px solid #22c55e; padding: 12px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; box-sizing: border-box;">
                        <label style="color: #22c55e; font-size: 12px; font-weight: bold; text-transform: uppercase; margin: 0;">Total:</label>
                        <span style="color: #22c55e; font-size: 18px; font-weight: bold;">` + precoFormatado + ` Kz</span>
                    </div>

                    <div style="border-top: 1px dashed #334155; margin: 12px 0;"></div>

                    <!-- Rodapé do Talão -->
                    <div style="text-align: center; font-size: 12px; color: #38bdf8; font-weight: bold; margin-bottom: 4px;">Obrigado pela preferência!</div>
                    <div style="text-align: center; font-size: 10px; color: #94a3b8; line-height: 1.4; margin-bottom: 20px;">
                        📍 Bairro de São Luís / perto da IECA<br>
                        Huambo - Angola
                    </div>

                    <!-- Botão de Ação -->
                    <button type="button" class="no-print-btn" onclick="window.print()" style="width: 100%; background-color: #22c55e; color: white; border: none; padding: 12px; font-size: 13px; font-weight: bold; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px;">
                        🖨️ Imprimir Talão
                    </button>
                    
                </div>
            </div>
        `;
    }
}

























function processarPagamentoExpress() {
    const telefoneInput = document.getElementById('telefoneExpress').value.trim();
    const planoRadio = document.querySelector('input[name="planoPremium"]:checked');
    const planoNome = planoRadio.value;
    const valorPagar = document.getElementById('txtPrecoBotao').innerText;

    // Validação de número móvel em Angola
    if (telefoneInput.length !== 9 || !telefoneInput.startsWith('9')) {
        alert('Por favor, insira um número de telefone válido com 9 dígitos ().');
        return;
    }

    // Informa o utilizador que o processo começou
    alert(`A enviar pedido de ${valorPagar} Kz para o Express do número ${telefoneInput}...\nPor favor, valide a notificação no seu telemóvel.`);

    // Cria os dados que vão ser enviados para o PHP
    const dados = new FormData();
    dados.append('telefone', telefoneInput);
    dados.append('plano', planoNome);

    // Envia os dados para o processar_pagamento.php via AJAX (Fetch API)
    fetch('processar_pagamento.php', {
        method: 'POST',
        body: dados
    })
    .then(resposta => resposta.json())
    .then(resultado => {
        if (resultado.sucesso) {
            alert('Sucesso! 🎉 ' + resultado.mensagem);
            fecharModalPremium();
            location.reload(); // Recarrega a página para atualizar o painel azul na hora
        } else {
            alert('Aviso: ' + resultado.mensagem);
        }
    })
    .catch(erro => {
        console.error('Erro:', erro);
        alert('Ocorreu um erro ao processar o seu plano na base de dados.');
    });
}









        
    
        function prepararEnvio() {
            // Captura os dados do topo da página
            const cliente = document.getElementById('inputNomeCliente').value.trim();
            const funcionario = document.getElementById('inputFuncionario').value;
            const data = document.getElementById('inputDataServico').value;
            const hora = document.getElementById('inputHoraServico').value;
    
            // Validação obrigatória antes de submeter ao arquivo PHP
            if (!cliente || !funcionario || !data || !hora || !nomeServicoGlobal) {
                alert("Por favor, preencha todos os campos do atendimento no topo e selecione um serviço!");
                return false;
            }
    
            // Passa os valores para os inputs ocultos do formulário
            document.getElementById('envioCliente').value = cliente;
            document.getElementById('envioFuncionario').value = funcionario;
            document.getElementById('envioData').value = data;
            document.getElementById('envioHora').value = hora;
            document.getElementById('envioServico').value = nomeServicoGlobal;
            document.getElementById('envioValor').value = valorServicoGlobal;
    
            return true;
        }

           
            // Carrega automaticamente os estados guardados ao abrir a página
            window.addEventListener('DOMContentLoaded', () => {
                const funcionariosIds = ['hanganga', 'angelino', 'aurelio', 'fernandinho', 'raimundo', 'zidane', 'albino', 'tuxa','edna', 'belma', 'dalton', 'magui'];
                
                funcionariosIds.forEach(id => {
                    const statusGuardado = localStorage.getItem('status-' + id);
                    if (statusGuardado) {
                        const elemento = document.getElementById('status-' + id);
                        if (elemento) {
                            elemento.innerText = statusGuardado;
                            
                            // Trata e atualiza a cor do texto conforme o estado guardado
                            if (statusGuardado.includes('Ausente') || statusGuardado.includes('Folga')) {
                                elemento.style.color = '#ef4444';
                            } else if (statusGuardado.includes('Atendimento')) {
                                elemento.style.color = '#ffaa00';
                            } else {
                                elemento.style.color = '#22c55e';
                            }
                        }
                    }
                });
            });

            
function atualizarIndicadores() {
    // Faz a chamada para o ficheiro que procura os dados atualizados no banco de dados
    fetch('buscar_dados_dashboard.php')
        .then(response => response.json())
        .then(dados => {
            // Atualiza o texto mantendo a estrutura visual limpa
            document.getElementById('valorCaixa').innerHTML = dados.caixa;
            document.getElementById('valorAtendimentos').innerHTML = dados.atendimentos;
            document.getElementById('valorEquipa').innerHTML = dados.equipa;
        })
        .catch(error => console.error('Erro na atualização automática:', error));
}

// Inicializa a verificação recorrente
document.addEventListener("DOMContentLoaded", function() {
    // Atualiza a cada 4 segundos (4000 milissegundos)
    setInterval(atualizarIndicadores, 4000);
});




            // Mostra ou oculta as opções de alteração para o Gerente/Administrador
            function toggleModoAdmin() {
                const paineis = document.querySelectorAll('.select-admin');
                paineis.forEach(painel => {
                    painel.style.display = (painel.style.display === 'none' || painel.style.display === '') ? 'block' : 'none';
                });
            }

            // Altera o estado dinamicamente e guarda na memória local do navegador (LocalStorage)
            function atualizarStatus(idFuncionario, novoValor) {
                const elemento = document.getElementById('status-' + idFuncionario);
                if (elemento) {
                    elemento.innerText = novoValor;
                    localStorage.setItem('status-' + idFuncionario, novoValor);
                    
                    // Trata as cores em tempo real ao selecionar
                    if (novoValor.includes('Ausente') || novoValor.includes('Folga')) {
                        elemento.style.color = '#ef4444';
                    } else if (novoValor.includes('Atendimento')) {
                        elemento.style.color = '#ffaa00';
                    } else {
                        elemento.style.color = '#22c55e';
                    }
                }
            }
            

            function Funcionario() {
                console.log("Visualizando portfólio e informações do profissional.");
            }


// Cole esta função dentro do seu bloco de scripts atual
function fecharBannerCookies() {
    const banner = document.getElementById('cookieBanner');
    if (banner) {
        // Esconde o banner da tela imediatamente ao clicar no botão verde
        banner.style.display = 'none';
        
        // Salva na memória do navegador que o usuário já aceitou, 
        // para que o banner não fique reaparecendo toda hora que atualizar a página
        localStorage.setItem('cookiesAceitos', 'sim');
    }
}

// Bloquinho extra de segurança: Verifica se o usuário já aceitou antes. 
// Se já aceitou anteriormente, o banner nem aparece ao carregar a página.
window.addEventListener('DOMContentLoaded', () => {
    // Se tinha algum código seu aqui para carregar estados, cole-o aqui!
    console.log("Página e estados carregados com sucesso!");
});
// Abre e fecha o menu lateral mudando a posição do painel 'left'
function toggleMenu() {
    const menuLateral = document.getElementById('menuLateralMobile');
    if (menuLateral.style.left === '0px') {
        menuLateral.style.left = '-280px'; // Esconde o menu
    } else {
        menuLateral.style.left = '0px'; // Desliza o menu para dentro da tela
    }
}
// Chamado ao clicar no Menu Superior (Garante o Reset para o Nível 1)
function alternarAbas(idSecao) {
    // 1. Oculta todas as abas principais do sistema
    document.querySelectorAll('.aba-conteudo').forEach(div => {
        div.style.display = 'none';
        div.classList.remove('active');
    });

    // 2. Localiza a secção alvo (ex: secao-servicos)
    const alvo = document.getElementById('secao-' + idSecao);
    if (alvo) {
        alvo.style.display = 'block';
        alvo.classList.add('active');
        
        // Se a secção aberta for a de serviços, força a voltar para o Passo 1 (Categorias)
        if (idSecao === 'servicos') {
            voltarParaNivel1();
        } else {
            alvo.scrollIntoView({ behavior: 'smooth' });
        }
    }
}

// Chamado ao clicar numa Categoria (Esconde Nível 1, Mostra Nível 2 e ativa o Sub-grupo)
function mostrarNivel2(cat) {
    // Esconde as categorias do Nível 1
    const nivel1 = document.getElementById('nivel1');
    if (nivel1) nivel1.classList.add('hidden');
    
    // Mostra o contêiner de serviços do Nível 2
    const nivel2 = document.getElementById('nivel2');
    if (nivel2) nivel2.classList.remove('hidden');
    
    // Oculta todos os sub-grupos de serviços para não misturar
    document.querySelectorAll('.sub-grupo').forEach(div => {
        div.classList.add('hidden');
    });
    
    // Mostra exclusivamente o sub-grupo da categoria clicada (ex: sub-cortes)
    const subGrupo = document.getElementById('sub-' + cat);
    if (subGrupo) {
        subGrupo.classList.remove('hidden');
        subGrupo.scrollIntoView({ behavior: 'smooth' });
    }
}

// Chamado ao clicar no botão "Voltar" (Reseta a tela de volta para as Categorias)
function voltarParaNivel1() {
    // Faz a grade de categorias reaparecer
    const nivel1 = document.getElementById('nivel1');
    if (nivel1) nivel1.classList.remove('hidden');
    
    // Esconde o container do Nível 2
    const nivel2 = document.getElementById('nivel2');
    if (nivel2) nivel2.classList.add('hidden');
    
    // Esconde a caixa de confirmação de preço superior
    const caixaPreco = document.getElementById('caixa-preco');
    if (caixaPreco) caixaPreco.classList.add('hidden');
}



function calcularPrecoServico() {
    // Injeta o status da sessão PHP diretamente no JavaScript
    const isPremium = <?php echo (isset($_SESSION['tipo_conta']) && $_SESSION['tipo_conta'] === 'Premium') ? 'true' : 'false'; ?>;
    
    let precoBase = 3000; // Preço normal da Tintura/Serviço Geral
    let precoFinal = precoBase;

    if (isPremium) {
        precoFinal = precoBase - (precoBase * 0.20); // Aplica os 20% -> 2.400 Kz
    }

    // Atualiza o ecrã verde do Dashboard
    const lblPreco = document.getElementById('lblPrecoExibido');
    if (lblPreco) {
        lblPreco.innerText = precoFinal.toLocaleString('pt-PT') + " Kz";
    }
}
// 1. FUNÇÃO PROFISSIONAL PARA FECHAR O MODAL E ATUALIZAR O PAINEL
function fecharFaturaNatural() {
    document.getElementById('faturaPainelNatural').style.display = 'none';
    location.reload(); // Atualiza as listas do salão na hora
}

// 2. DISPARADOR REAL DE IMPRESSÃO FÍSICA
function dispararImpressaoFisica() {
    window.print();
}

function salvarAgendamentoSessao() {
    const nome = document.getElementById('inputNomeCliente').value.trim();
    const funcionario = document.getElementById('inputFuncionario').value;
    const data = document.getElementById('inputDataServico').value;
    const hora = document.getElementById('inputHoraServico').value;
    
    // Captura os dados com base nas variáveis globais selecionadas no ecrã
    const servicoNome = typeof nomeServicoGlobal !== 'undefined' ? nomeServicoGlobal : "Mechas / Luzes"; 
    const precoServicoOriginal = typeof valorServicoGlobal !== 'undefined' ? parseFloat(valorServicoGlobal) : 18000;

    if (!funcionario || !data || !hora) {
        alert('Por favor, selecione o profissional, a data e a hora do atendimento.');
        return;
    }

    // =================================================================
    // 🌍 ALTERNATIVA AUTOMÁTICA: PREMIUM DESCONTA (20%) | GRÁTIS NÃO DESCONTA
    // =================================================================
    const tipoContaCliente = "<?php echo $_SESSION['tipo_conta'] ?? 'Gratis'; ?>";
    
    let precoFinalEnvio = precoServicoOriginal;
    let valorDesconto = 0;

    if (tipoContaCliente === 'Premium') {
        // Alternativa 1: É Premium -> Calcula os 20% de abatimento real
        valorDesconto = precoServicoOriginal * 0.20; 
        precoFinalEnvio = precoServicoOriginal - valorDesconto; 
    } else {
        // Alternativa 2: É Grátis -> Preço permanece normal e cheio
        precoFinalEnvio = precoServicoOriginal;
        valorDesconto = 0;
    }

    const dadosForm = new FormData();
    dadosForm.append('nome_cliente', nome);
    dadosForm.append('funcionario', funcionario);
    dadosForm.append('data_servico', data);
    dadosForm.append('hora_servico', hora);
    dadosForm.append('servico', servicoNome); 
    dadosForm.append('preco_base', precoFinalEnvio); // Grava o valor correto final no MySQL

    fetch('./salvar_agendamento.php', {
        method: 'POST',
        body: dadosForm
    })
    .then(resposta => resposta.json())
    .then(resultado => {
        if (resultado.sucesso) {
            
            // Organiza a cronologia da data no padrão pt-PT
            const partesData = data.split('-');
            const dataFormatada = `${partesData[2]}/${partesData[1]}/${partesData[0]} às ${hora}`;

            // Injeção de metadados no Comprovativo Neon
            document.getElementById('natIdPagamento').innerText = resultado.id_pagamento ? resultado.id_pagamento : '62';
            document.getElementById('natNomeCliente').innerText = nome !== "" ? nome : "Aurelio";
            document.getElementById('natProfissional').innerText = funcionario;
            document.getElementById('natDataEmissao').innerText = dataFormatada;
            document.getElementById('natServicoNome').innerText = servicoNome;

            // =================================================================
            // 🎌 ALTERNATIVA VISUAL DE EXIBIÇÃO E VALIDAÇÃO NA FATURA
            // =================================================================
            if (tipoContaCliente === 'Premium') {
                // Se for Premium: Mostra o Subtotal, a linha vermelha de -20% e altera o título
                document.getElementById('printBlocoPremiumPrecos').style.display = 'flex';
                document.getElementById('natTextoTotalTitulo').innerText = "TOTAL PAGO (Membro VIP)";
                
                document.getElementById('natSubtotal').innerText = precoServicoOriginal.toLocaleString('pt-PT') + " Kz";
                document.getElementById('natDescontoValor').innerText = "- " + valorDesconto.toLocaleString('pt-PT') + " Kz";
                document.getElementById('natTotalFinal').innerText = precoFinalEnvio.toLocaleString('pt-PT') + " Kz";
            } else {
                // Se for Grátis: Oculta os blocos de desconto e exibe apenas o preço normal de tabela
                document.getElementById('printBlocoPremiumPrecos').style.display = 'none';
                document.getElementById('natTextoTotalTitulo').innerText = "TOTAL PAGO";
                
                document.getElementById('natTotalFinal').innerText = precoServicoOriginal.toLocaleString('pt-PT') + " Kz";
            }

            // Atualização do Código QR estável com os valores finais reais
            const textoQR = `Aurelius - Fatura: #00${resultado.id_pagamento || '62'} | Cliente: ${nome} | Total: ${precoFinalEnvio} Kz`;
            document.getElementById('natQrCode').src = "https://qrserver.com" + encodeURIComponent(textoQR);

            // Exibe a fatura no ecrã com o design escuro e neon da imagem
            document.getElementById('faturaPainelNatural').style.display = 'flex';

        } else {
            alert('Aviso do Sistema: ' + resultado.mensagem);
        }
    })
    .catch(erro => {
        console.error('Erro técnico:', erro);
        alert('Erro de comunicação com o servidor local.');
    });
}

// Se o cliente veio da página principal com um cupão ganho, ativa a caixa na hora!
const servicoPre = "<?php echo $_SESSION['servico_pre_selecionado'] ?? ''; ?>";
const descontoPre = parseInt("<?php echo $_SESSION['desconto_cupao_ganho'] ?? 0; ?>");

if (servicoPre !== "" && descontoPre > 0) {
    // Força a ativação do serviço na memória e exibe o preço com o abatimento aplicado
    exibirPrecoFinal(servicoPre, "Calculando... kz");
    
    // Atualiza a variável global com o desconto da plataforma ativo para a gravação
    window.nomeServicoGlobal = servicoPre;
    
    // Altera o texto do botão para o cliente saber que está a usar o cupão premiado
    const btnConfirmar = document.querySelector('.btn-confirmar');
    if (btnConfirmar) btnConfirmar.innerHTML = `📅 Fazer Marcação (Cupão -${descontoPre}% Ativo!)`;
}



</script>
   
    

    </body>
    </html>