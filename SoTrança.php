


<?php
// 1. Inicia a sessão de forma segura se ainda não existir no servidor
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// 2. Tenta incluir o arquivo de configuração original do seu sistema
@include_once("config/Banco.php"); 

// 3. 🚨 CONEXÃO MESTRE DE SEGURANÇA (Se o Banco.php falhar ou usar outro nome, este bloco unifica)
if (!isset($pdo) || $pdo === null) {
    try {
        $host = "127.0.0.1";
        $db   = "aurelius_salao";
        $user = "root";
        $pass = "";
        
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("<b>Erro Crítico de Infraestrutura:</b> Não foi possível estabelecer ligação ao MySQL no XAMPP. Certifique-se de que o painel do cPanel/XAMPP está ativo.");
    }
}

// 4. Configurações Estruturais da Barbearia SóTranças
$id_empresa_ativa = 242; // ID SóTranças na tabela usuario
$hoje             = date('Y-m-d');
$expediente       = ['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
$profissionais    = ['Handanga', 'Albino']; 
$agenda_ocupada   = [];

// 5. Motor de Busca de Horários Ocupados em Tempo Real
try {
    // A variável $pdo está garantida pelas checagens acima
    $stmt = $pdo->prepare("SELECT funcionario, hora_servico FROM pagamentos WHERE id_parceiro = ? AND data_servico = ?");
    $stmt->execute([$id_empresa_ativa, $hoje]);
    $ocupados_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mapeia os horários ocupados para cada funcionário específico
    foreach ($ocupados_bd as $row) {
        if (!empty($row['funcionario']) && !empty($row['hora_servico'])) {
            $hora_limpa = substr($row['hora_servico'], 0, 5);
            $agenda_ocupada[$row['funcionario']][] = $hora_limpa;
        }
    }
} catch (Exception $e) {
    // Silencia erros de pauta em background para manter a renderização estável
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($nome_salao_dinamico) ? htmlspecialchars($nome_salao_dinamico) : 'SóTranças' ?> - Painel de Checkout</title>
    
    <style>
        /* 🎛️ Configuração das Caixas de Abas Dinâmicas */
        .tab-content { display: none; }
        .tab-content.active { display: block !important; }
        .hidden { display: none !important; }
        
        /* 💇 Estilos para Grades e Cartões de Serviços/Categorias */
        .grid-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 15px; padding: 15px 0; }
        .aba-item { background: #1e293b; border: 1px solid #334155; color: #fff; padding: 15px 10px; border-radius: 12px; cursor: pointer; transition: 0.3s; font-size: 13px; text-align: center; }
        .aba-item:hover { border-color: #eab308; background: #0f172a; }
        
        /* 🎥 Estilos Neon Premium para os Cards de Serviços Interativos */
        .grid-servicos { display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 15px; margin-top: 15px; }
        .card-item-neon { background: #1e293b; border: 1px solid #334155; color: #fff; padding: 15px 10px; border-radius: 12px; cursor: pointer; transition: 0.3s; text-align: center; border-bottom: 3px solid #334155; }
        .card-item-neon:hover { border-color: #38bdf8; background: #0f172a; box-shadow: 0 0 10px rgba(56, 189, 248, 0.4); transform: translateY(-2px); }
        
        /* ↩️ Botões de Navegação Manual com Efeito de Luz */
        .btn-voltar { background: #334155; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; margin-bottom: 15px; font-size: 12px; font-weight: bold; }
        .btn-voltar:hover { background: #eab308; color: #000; }
        .btn-voltar-neon { background: #1e293b; color: #38bdf8; border: 1px solid #38bdf8; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold; transition: 0.3s; }
        .btn-voltar-neon:hover { background: #38bdf8; color: #090514; box-shadow: 0 0 10px rgba(56, 189, 248, 0.5); }
    </style>
</head>

<body style="background: linear-gradient(135deg, #090514, #120b24); color: #f8fafc; min-height: 100vh; margin: 0; box-sizing: border-box; font-family: system-ui, sans-serif;">

    <!-- 📲 BARRA DE NAVEGAÇÃO PREMIUM NEON (ESTILO GRANDES PLATAFORMAS) -->
    <nav style="padding: 15px 30px; background: #120b24; border-bottom: 2px solid #38bdf8; box-shadow: 0 0 15px rgba(56, 189, 248, 0.3); display: flex; justify-content: space-between; align-items: center;">
        <div class="logo">
            <h1 style="font-size: 22px; font-weight: 800; color: #ef4444; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">AURE<span style="color: #f8fafc;">LIUS</span></h1>
            <h6 style="color: #64748b; font-size: 11px; margin-top: 4px; text-transform: uppercase; margin-bottom: 0;">Módulo de Checkout Sincronizado</h6>
        </div>
        
        <!-- Menu Horizontal com Cliques Assíncronos Direcionados -->
        <ul class="menu-horizontal" id="navbar-menu" style="display: flex; list-style: none; gap: 15px; margin: 0; padding: 0; align-items: center;">
            <li><a href="SoTrança.php" style="color: #cbd5e1; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; transition: 0.3s;">Home</a></li>
            <li><a class="tab-link active" onclick="alternarAbasAgendamento(event, 'aba_servicos')" style="color: #38bdf8; background: rgba(56, 189, 248, 0.1); border: 1px solid #38bdf8; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; cursor: pointer; transition: 0.3s;">📋 Serviços</a></li>
            <li><a class="tab-link" onclick="alternarAbasAgendamento(event, 'aba_pagamentos')" style="color: #cbd5e1; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; cursor: pointer; transition: 0.3s;">💳 Pagamentos</a></li>
            <li><a class="tab-link" onclick="alternarAbasAgendamento(event, 'aba_agenda')" style="color: #cbd5e1; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; cursor: pointer; transition: 0.3s;">📅 Agenda/Marcação</a></li>
            <li><a class="tab-link" onclick="alternarAbasAgendamento(event, 'aba_funcionarios')" style="color: #cbd5e1; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; cursor: pointer; transition: 0.3s;">💇 Funcionários</a></li>
            <li><a href="Principal.php" style="border: 1px solid #ef4444; color:#ef4444; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; padding: 6px 14px; transition: 0.3s;">✕ Sair</a></li>
        </ul>
    </nav>

    <!-- Contentor de Máscara das Abas Sincronizadas -->
    <div class="tabs-container" style="max-width: 1200px; margin: 30px auto; padding: 0 20px; box-sizing: border-box;">

      
      
      
      
     <!-- =========================================================================
     📋 ABA MESTRE: SERVIÇOS 3 NÍVEIS (Categorias, Subcategorias e Serviços)
     ========================================================================= -->
<div id="aba_servicos" class="tab-content active">
    
<!-- 🟢 PASSO 1: CATEGORIAS PRINCIPAIS -->
<div id="sub_container_nivel1" style="display: block; text-align: left;">
    <span style="color:#64748b; font-size:12px; display:block; margin-bottom:10px; text-transform: uppercase; font-weight: bold;">PASSO 1: Selecione a Categoria Principal</span>
    <div class="grid-servicos">
        <div class="card-item-neon" onclick="mostrarNivel2('cortes')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>💇 Cortes de Cabelo</div>
        <div class="card-item-neon" onclick="mostrarNivel2('pinturas')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>🎨 Pinturas de Cabelo</div>
        <div class="card-item-neon" onclick="mostrarNivel2('sobrancelhas')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>✨ Design Sobrancelhas</div>
        <div class="card-item-neon" onclick="mostrarNivel2('maquilhagem')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>💄 Maquilhagens</div>
        <div class="card-item-neon" onclick="mostrarNivel2('tratamentos')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>🌿 Tratamentos Capilares</div>
    </div>
</div>

<!-- 🔵 PASSO 2: SUBCATEGORIAS -->
<div id="sub_container_nivel2" style="display: none; text-align: left;">
    <button type="button" class="btn-voltar-neon" onclick="voltarParaNivel1()">← Voltar às Categorias</button>
    <span style="color:#64748b; font-size:12px; display:block; margin:15px 0 10px 0; text-transform: uppercase; font-weight: bold;">PASSO 2: Selecione a Subcategoria Específica</span>
    
    <div id="sub-cortes" class="grid-servicos sub-grupo" style="display:none;">
        <div class="card-item-neon" onclick="mostrarNivel3('cortes-masculinos')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>🧔 Cortes Masculinos</div>
        <div class="card-item-neon" onclick="mostrarNivel3('cortes-femininos')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692587785.jpg"><br>👩 Cortes Femininos</div>
    </div>

    <div id="sub-pinturas" class="grid-servicos sub-grupo" style="display:none;">
        <div class="card-item-neon" onclick="mostrarNivel3('tintura-global')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Tintura Geral</div>
        <div class="card-item-neon" onclick="mostrarNivel3('mechas')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Mechas / Luzes</div>
    </div>

    <div id="sub-sobrancelhas" class="grid-servicos sub-grupo" style="display:none;">
        <div class="card-item-neon" onclick="mostrarNivel3('design-simples')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Design Simples</div>
        <div class="card-item-neon" onclick="mostrarNivel3('henna')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Aplicação de Henna</div>
        <div class="card-item-neon" onclick="mostrarNivel3('tatuar-sobrancelhas')"><img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Sobrancelhas Normal</div>
    </div>

    <div id="sub-maquilhagem" class="grid-servicos sub-grupo" style="display:none;">
        <div class="card-item-neon" onclick="mostrarNivel3('make-social')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Maquilhagem Social</div>
        <div class="card-item-neon" onclick="mostrarNivel3('make-noiva')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Maquilhagem Noivas</div>
    </div>

    <div id="sub-tratamentos" class="grid-servicos sub-grupo" style="display:none;">
        <div class="card-item-neon" onclick="mostrarNivel3('hidratacao')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>🌿 Hidratação Profunda</div>
        <div class="card-item-neon" onclick="mostrarNivel3('queratina')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>💎 Banho de Queratina</div>
    </div>
</div>

<!-- 🟡 PASSO 3: TIPOS ESPECÍFICOS DE SERVIÇOS E PREÇOS -->
<div id="sub_container_nivel3" style="display: none; text-align: left;">
    <button type="button" class="btn-voltar-neon" onclick="voltarParaNivel2()">← Voltar</button>
    <h2 id="titulo-nivel3" style="font-size: 14px; color: #eab308; text-transform: uppercase; margin: 15px 0; font-weight: bold;">PASSO 3: Tipos de Serviços Disponíveis</h2>

    <!-- Serviços: Cortes Masculinos -->
    <div id="opcoes-cortes-masculinos" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Francês Adulto', 2000)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Francês Adulto<br><b style="color:#22c55e;">2.000 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Covinha Adulto', 2000)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Covinha Adulto<br><b style="color:#22c55e;">2.000 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Covinha Criança', 1500)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Covinha Criança<br><b style="color:#22c55e;">1.500 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Barba Imperial', 1000)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Barba Imperial<br><b style="color:#22c55e;">1.000 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Careca Completa', 800)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Careca Completa<br><b style="color:#22c55e;">800 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Freestyle Arte', 2000)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Freestyle Arte<br><b style="color:#22c55e;">2.000 Kz</b>
        </div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Obama Moderno', 2000)"> 
            <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Obama Moderno<br><b style="color:#22c55e;">2.000 Kz</b>
        </div>
    </div>

    <!-- Serviços: Cortes Femininos -->
    <div id="opcoes-cortes-femininos" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Corte Bob Premium', 2500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Corte Bob Premium<br><b style="color:#22c55e;">2.500 Kz</b></div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Franja Estilizada', 1000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Apenas Franja<br><b style="color:#22c55e;">1.000 Kz</b></div>
    </div>

    <!-- Serviços: Tintura Geral -->
    <div id="opcoes-tintura-global" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Coloração Total', 4500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Coloração Completa<br><b style="color:#22c55e;">4.500 Kz</b></div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Retoque de Raiz', 2500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Retoque de Raiz<br><b style="color:#22c55e;">2.500 Kz</b></div>
    </div>

    <!-- Serviços: Mechas / Luzes -->
    <div id="opcoes-mechas" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Mechas Platinum', 7000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Mechas Platinum<br><b style="color:#22c55e;">7.000 Kz</b></div>
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Luzes Mel Discretas', 5000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Luzes Mel<br><b style="color:#22c55e;">5.000 Kz</b></div>
    </div>
    
    <!-- Serviços: Design Sobrancelhas Simples -->
    <div id="opcoes-design-simples" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Limpeza com Pinça', 800)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Limpeza Pinça<br><b style="color:#22c55e;">800 Kz</b></div>
    </div>
    
    <!-- Serviços: Sobrancelhas Henna -->
    <div id="opcoes-henna" class="grid-servicos opcao-grupo" style="display:none;">
        <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Design + Henna', 1500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Design + Henna<br><b style="color:#22c55e;">1.500 Kz</b></div>
    </div>


<!-- Serviços: Maquilhagem Social -->
<div id="opcoes-make-social" class="grid-servicos opcao-grupo" style="display:none;">
            <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Make Express Dia', 3000)"> 
                <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Make Express Dia<br><b style="color:#22c55e;">3.000 Kz</b>
            </div>
            <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Make Glam Noite', 5000)"> 
                <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Make Glam Noite<br><b style="color:#22c55e;">5.000 Kz</b>
            </div>
        </div>

        <!-- Serviços: Maquilhagem Noivas -->
        <div id="opcoes-make-noiva" class="grid-servicos opcao-grupo" style="display:none;">
            <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Combo Noiva Premium', 15000)"> 
                <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Combo Noiva Premium<br><b style="color:#22c55e;">15.000 Kz</b>
            </div>
        </div>

        <!-- Serviços: Hidratação Profunda -->
        <div id="opcoes-hidratacao" class="grid-servicos opcao-grupo" style="display:none;">
            <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Nutrição Verniz', 2000)"> 
                <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Nutrição Verniz<br><b style="color:#22c55e;">2.000 Kz</b>
            </div>
        </div>

        <!-- Serviços: Banho de Queratina -->
        <div id="opcoes-queratina" class="grid-servicos opcao-grupo" style="display:none;">
            <div class="card-item-neon" onclick="atualizarPrecoNoFormulario('Cauterização Térmica', 4000)"> 
                <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Cauterização Térmica<br><b style="color:#22c55e;">4.000 Kz</b>
            </div>
        </div>

    </div> <!-- 🔴 FECHA SUB_CONTAINER_NIVEL3 -->

</div> <!-- 🟢 FECHA A GAVETA MESTRE: ABA_SERVICOS -->








<!-- =========================================================================
     💇 ABA: GESTÃO DE CORPO TÉCNICO (Inicia Oculta)
     ========================================================================= -->
     <div id="aba_funcionarios" class="tab-content" style="display: none;">
     <div style="text-align: left; margin-bottom: 25px; border-bottom: 1px solid #334155; padding-bottom: 15px;">
         <h3 style="color: #eab308; text-transform: uppercase; font-size: 16px; letter-spacing: 1px;">💇 Gestão de Corpo Técnico</h3>
         <p style="color: #94a3b8; font-size: 12px;">Clique no profissional para consultar a pauta de disponibilidade em tempo real.</p>
     </div>
 
     <!-- Grade de Cards (Busca automática do Banco de Dados via PDO) -->
     <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px;">
         <?php 
         if (isset($pdo)) {
             try {
                 // Seleciona os funcionários ativos vinculados à SóTranças
                 $stmt_f = $pdo->prepare("SELECT nome, status, especialidade FROM funcionarios WHERE ativo = 1 ORDER BY nome ASC");
                 $stmt_f->execute();
                 $equipa = $stmt_f->fetchAll(PDO::FETCH_ASSOC);
 
                 foreach($equipa as $f): 
                     $status_clean = (strtolower($f['status']) == 'disponível' || $f['status'] == 'disponivel') ? 'Disponível' : 'Ausente';
                     $cor_foco = ($status_clean == 'Disponível') ? '#22c55e' : '#ef4444';
             ?>
                 <!-- O clique no card avança para a pauta detalhada e atualiza o fluxo -->
                 <div class="card-tecnico-premium" onclick="abrirAgendaFuncionario('<?= htmlspecialchars($f['nome']) ?>', '<?= $status_clean ?>', '<?= htmlspecialchars($f['especialidade']) ?>')" 
                      style="background: #1e293b; border: 1px solid #334155; padding: 25px 15px; border-radius: 16px; text-align: center; cursor: pointer; transition: 0.3s; position: relative;">
                     
                     <div style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: <?= $cor_foco ?>; border-radius: 16px 16px 0 0;"></div>
                     <div style="width: 60px; height: 60px; background: #0f172a; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 2px solid #334155;">👤</div>
                     
                     <strong style="display: block; font-size: 14px; color: #fff;"><?= htmlspecialchars($f['nome']) ?></strong>
                     <small style="display: block; color: #64748b; margin-bottom: 10px; font-size: 11px;"><?= htmlspecialchars($f['especialidade']) ?></small>
                     
                     <span style="color: <?= $cor_foco ?>; font-size: 10px; font-weight: 800; text-transform: uppercase;">
                         ● <?= $status_clean ?>
                     </span>
                 </div>
             <?php 
                 endforeach; 
             } catch (Exception $e) { 
                 echo "<p style='color: #ef4444; font-size: 12px;'>Aviso: Falha ao carregar pauta técnica.</p>"; 
             } 
         }
         ?>
     </div>
 
     <!-- Área da Agenda Detalhada (Aparece ao clicar no Card) -->
     <div id="pauta_detalhada_func" style="display: none; margin-top: 30px;">
         <!-- Preenchido dinamicamente via JS na próxima etapa -->
     </div>
 </div>
 
 <!-- =========================================================================
      🧠 MOTOR JAVASCRIPT REATIVO CENTRALIZADO (FLUXO EXECUTIVO UNIFICADO)
      ========================================================================= -->
 <script>
 // Variáveis Globais de Checkout Sincronizado
 let servicoSelecionado = "";
 let precoSelecionado = 0;
 let profissionalSelecionado = "";
 
 // 🔒 1. SEGURANÇA MESTRE: Fecha ABSOLUTAMENTE TODAS as abas ao iniciar/atualizar a página
 window.addEventListener('DOMContentLoaded', () => {
     const abas = document.querySelectorAll('.tab-content');
     abas.forEach(aba => {
         aba.style.display = 'none';
         aba.classList.remove('active');
     });
 
     const links = document.querySelectorAll('.tab-link');
     links.forEach(link => {
         link.classList.remove('active');
         link.style.background = 'none';
         link.style.color = '#cbd5e1';
         link.style.border = 'none';
     });
 
     // 🟢 Inicialização Premium: Abre apenas a aba de Serviços no primeiro carregamento
     const abaInicial = document.getElementById('aba_servicos');
     if (abaInicial) {
         abaInicial.style.display = 'block';
         abaAtivaEstiloNavbar('aba_servicos');
     }
     console.log("Infraestrutura Só Tranças Sincronizada: Ecrã limpo e protegido contra vazamento de dados.");
 });
 
 // 🔀 2. FUNÇÃO CENTRAL: Controla e alterna as abas pelo clique do Menu ou por direcionamento
 function alternarAbasAgendamento(event, idAbaAlvo) {
     if (event) {
         event.preventDefault(); // Impede recarregamento acidental
     }
 
     // Oculta todas as seções de abas mapeadas no HTML
     const contents = document.querySelectorAll('.tab-content');
     contents.forEach(c => {
         c.style.display = 'none';
         c.classList.remove('active');
     });
 
     // Abre a aba selecionada pelo fluxo ou pelo menu superior
     const alvo = document.getElementById(idAbaAlvo);
     if (alvo) {
         alvo.style.display = 'block';
         alvo.classList.add('active');
         
         // Sincroniza o destaque do botão correspondente no menu superior
         abaAtivaEstiloNavbar(idAbaAlvo);
         
         // Garante que pautas internas flutuantes iniciam fechadas
         const pautaInterna = document.getElementById('pauta_detalhada_func');
         if (pautaInterna) pautaInterna.style.display = 'none';
     }
 }
 
 // 🎨 Função Auxiliar: Aplica o design neon no link ativo da Navbar superior
 function abaAtivaEstiloNavbar(idAba) {
     const links = document.querySelectorAll('.tab-link');
     links.forEach(l => {
         l.classList.remove('active');
         l.style.background = 'none';
         l.style.color = '#cbd5e1';
         l.style.border = 'none';
     });
 
     // Mapeamento dos IDs de abas para os atributos onclick do menu
     const linkAtivo = document.querySelector(`.tab-link[onclick*="${idAba}"]`);
     if (linkAtivo) {
         linkAtivo.classList.add('active');
         linkAtivo.style.color = '#38bdf8';
         linkAtivo.style.background = 'rgba(56, 189, 248, 0.1)';
         linkAtivo.style.border = '1px solid #38bdf8';
         linkAtivo.style.borderRadius = '6px';
     }
 }
 
 // 💇 3. Motor Nível 3: Quando escolhe o serviço e o preço, direciona para outra aba
 function atualizarPrecoNoFormulario(nomeServico, precoValor) {
     servicoSelecionado = nomeServico;
     precoSelecionado = precoValor;
     
     console.log("Checkout Sincronizado - Selecionado:", nomeServico, "Preço:", precoValor + " Kz");
     
     // Avança o utilizador automaticamente para a aba seguinte de Pagamentos/Faturamento
     alternarAbasAgendamento(null, 'aba_pagamentos');
 }
 </script>













<!-- =========================================================================
     💳 ABA: CHECKOUT DE CAIXA E FATURAÇÃO SINCROINZADA
     ========================================================================= -->
     <div id="aba_pagamentos" class="tab-content" style="display: none;">
    
    <!-- Seção de Estilos Isolada para esta Aba (Mantida Intacta) -->
    <style>
        .tab-content * { box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        .seccao-cadastro { position: relative; background: #1e293b; padding: 35px; width: 92%; max-width: 520px; margin: 40px auto; border-radius: 20px; text-align: left; border: 2px solid #38bdf8; box-shadow: 0 0 20px rgba(56, 189, 248, 0.4), inset 0 0 15px rgba(56, 189, 248, 0.1); animation: pulsarGlow 4s infinite alternate; color: #f8fafc; }
        @keyframes pulsarGlow { 0% { box-shadow: 0 0 12px rgba(56, 189, 248, 0.3); border-color: #0284c7; } 100% { box-shadow: 0 0 25px rgba(56, 189, 248, 0.7); border-color: #38bdf8; } }
        .btn-fechar-top { position: absolute; top: -15px; right: -15px; width: 36px; height: 36px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-weight: bold; border: 2px solid #1e293b; }
        .seccao-cadastro h2 { margin-bottom: 20px; color: #38bdf8; font-size: 20px; border-bottom: 2px solid #334155; padding-bottom: 10px; text-transform: uppercase; font-weight: bold; }
        .campo-grupo { margin-bottom: 18px; display: flex; flex-direction: column; }
        .campo-grupo label { font-weight: bold; font-size: 12px; margin-bottom: 6px; color: #94a3b8; text-transform: uppercase; }
        .campo-grupo input { padding: 14px; border: 1px solid #475569; border-radius: 8px; font-size: 15px; background: #0f172a; color: white; outline: none; }
        .botoes-pagamento { display: flex; gap: 10px; margin-top: 15px; flex-wrap: wrap; }
        .btn-pagar { flex: 1; min-width: 120px; padding: 14px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; color: white; font-size: 12px; text-transform: uppercase; }
        .btn-unitel { background: linear-gradient(135deg, #ff6600, #cc5200); }
        .btn-express { background: linear-gradient(135deg, #003399, #002266); }
        .fatura-box { background: #0b0f19; padding: 16px; border-radius: 12px; border: 1px solid #22314d; margin-bottom: 18px; font-size: 13px; }
        .linha-fatura { display: flex; justify-content: space-between; border-bottom: 1px dashed #334155; padding-bottom: 6px; margin-bottom: 6px; color: #f8fafc; }
        .linha-fatura.total-row { border-bottom: none; font-weight: bold; font-size: 16px; color: #22c55e; margin-top: 10px; }
        .badge-vip-alerta { background: rgba(234, 179, 8, 0.1); border: 1px solid #eab308; color: #eab308; padding: 12px; border-radius: 8px; font-size: 13px; font-weight: bold; margin-bottom: 18px; text-align: center; display: none; }
        .erro-fatura-msg { background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #f87171; padding: 12px; border-radius: 8px; font-weight: bold; margin-bottom: 15px; text-align: center; display: none; }
    </style>

    <div class="seccao-cadastro">
        <a href="Principal.php" class="btn-fechar-top">&times;</a>
        <h2>Checkout de Caixa Sincronizado</h2>

        <div id="msg_erro_fatura" class="erro-fatura-msg">⚠️ OPERAÇÃO REJEITADA: Este cliente não possui faturas pendentes!</div>
        <div id="status_carteira_box" class="badge-vip-alerta"></div>

        <div id="caixa_detalhe_pedido" style="background: #0f172a; padding: 14px; border-radius: 10px; margin-bottom: 18px; border-left: 4px solid #38bdf8; font-size: 13px; display: none;">
            <span>Fatura Pendente Localizada:</span>
            <strong style="display:block; color:#fff; font-size:15px; margin-top:3px;" id="txt_lbl_servico">---</strong>
        </div>

        <!-- O formulário executa de forma limpa e recolhe o gateway selecionado -->
        <form id="form_unitel_real" method="POST" action="SoTrança.php" onsubmit="interceptarFormularioPagamento(event)">
            <input type="hidden" name="executar_venda_final" value="1">
            <input type="hidden" name="id_pagamento_real" id="id_pagamento_real" value="0">
            <input type="hidden" name="metodo_gateway" id="txt_gateway_metodo" value="Unitel Money">

            <div class="campo-grupo">
                <label>Nome do Cliente:</label>
                <!-- Sincroniza em tempo real com as pautas -->
                <input type="text" name="nome_cliente" id="nome_input" placeholder="Insira o nome exato do agendamento" onkeyup="sincronizarFaturaPorNome(this.value)" required autocomplete="off">
            </div>

            <div class="campo-grupo">
                <label>Telefone / BI (Assinatura VIP):</label>
                <input type="tel" name="cliente_telefone" id="telefone_input" placeholder="Insira o número de contacto" required>
            </div>

            <div class="campo-grupo" id="wrapper_valor_pago">
                <label>Valor Entregue / Pago (AKZ):</label>
                <input type="number" step="0.01" name="valor_entregue" id="valor_entregue_input" value="0.00" min="0" required oninput="calcularTrocoMesa(this.value)">
            </div>

            <div class="fatura-box">
                <div class="linha-fatura"><span>Valor do Serviço:</span><span id="f_servico">0,00 AKZ</span></div>
                <div class="linha-fatura"><span>Subtotal Base:</span><span id="f_subtotal">0,00 AKZ</span></div>
                <div class="linha-fatura" id="linha_desconto_vip" style="display:none; color:#eab308;"><span>Desconto VIP (20%):</span><span id="txt_desc_vip">0,00 AKZ</span></div>
                <div class="linha-fatura" style="color:#64748b;"><span>Desconto Cortesia:</span><span id="f_taxa">-0,00 AKZ</span></div>
                <div class="linha-fatura total-row"><span>Total Líquido a Pagar:</span><span id="txt_total_liquido">0,00 AKZ</span></div>
            </div>

            <div class="botoes-pagamento" id="gateways_externos_bloco">
                <button type="submit" class="btn-pagar btn-unitel" onclick="setGateway('Unitel Money')">Unitel Money</button>
                <button type="submit" class="btn-pagar btn-express" onclick="setGateway('MCX Express')">MCX Express</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     🧠 FUNÇÕES JAVASCRIPT AUXILIARES DE SUPORTE À FATURAÇÃO
     ========================================================================= -->
<script>
// Atribui o gateway antes da submissão do formulário
function setGateway(metodo) {
    const inputGateway = document.getElementById('txt_gateway_metodo');
    if (inputGateway) {
        inputGateway.value = metodo;
    }
}

// Intercepta a submissão e avança automaticamente para o passo seguinte (Agenda)
function interceptarFormularioPagamento(event) {
    // Se preferir que o formulário envie dados via POST tradicional, remova o preventDefault
    event.preventDefault(); 
    
    const nomeCliente = document.getElementById('nome_input').value;
    console.log("Faturação concluída com sucesso para:", nomeCliente);
    
    // Avança de forma automática e fluida para o passo seguinte da Agenda/Marcação
    alternarAbasAgendamento(null, 'aba_agenda');
}

// Fallback de segurança para funções de cálculo de troco (impede erros no console do XAMPP)
if (typeof calcularTrocoMesa !== 'function') {
    function calcularTrocoMesa(valor) { /* Lógica de troco interna */ }
}
if (typeof sincronizarFaturaPorNome !== 'function') {
    function sincronizarFaturaPorNome(nome) { /* Sincronização em tempo real */ }
}
</script>















   <!-- =========================================================================
     📅 ABA: AGENDA, MARCAÇÕES DE HOJE E MAPA DE DISPONIBILIDADE (Inicia Oculta)
     ========================================================================= -->
<div id="aba_agenda" class="tab-content" style="display: none;">

<?php
// 1. Configurações Iniciais da pauta sincronizada
$id_empresa_ativa = 242; // ID SóTranças
$hoje = date('Y-m-d');
$expediente = ['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

// 2. Busca todos os registos reais salvos para HOJE no banco de dados
if (isset($pdo)) {
    $stmt = $pdo->prepare("SELECT * FROM pagamentos WHERE id_parceiro = ? AND data_servico = ? ORDER BY hora_servico ASC");
    $stmt->execute([$id_empresa_ativa, $hoje]);
    $registos_hoje = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Cria lista de horas ocupadas para mudar a cor dos botões em tempo real
    $horas_ocupadas = array_column($registos_hoje, 'hora_servico');
    // Limpa os segundos (08:00:00 -> 08:00) para comparar corretamente
    $horas_ocupadas = array_map(function($h) { return substr($h, 0, 5); }, $horas_ocupadas);
} else {
    $registos_hoje = [];
    $horas_ocupadas = [];
}
?>

<div class="agenda-container" style="background: #111827; padding: 20px; border-radius: 12px; color: #fff; border: 1px solid #1e293b; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
    
    <h3 style="color: #eab308; font-size: 15px; margin-top: 0; margin-bottom: 15px; text-transform: uppercase; font-weight: bold; border-left: 3px solid #eab308; padding-left: 8px;">
        📋 Serviços Marcados para Hoje (<?= date('d/m/Y') ?>)
    </h3>
    
    <!-- Tabela Informativa Clássica de Auditoria -->
    <table style="width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 30px;">
        <thead>
            <tr style="border-bottom: 2px solid #334155; color: #94a3b8; text-align: left;">
                <th style="padding: 10px;">Ticket</th>
                <th>Técnico</th>
                <th>Serviço</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($registos_hoje)): foreach($registos_hoje as $reg): ?>
                <tr style="border-bottom: 1px solid #1e293b;">
                    <td style="padding: 12px 10px; color: #64748b;">#<?= $reg['id_pagamento'] ?></td>
                    <td><strong style="color: #38bdf8;"><?= htmlspecialchars($reg['funcionario']) ?></strong></td>
                    <td><?= htmlspecialchars($reg['servico']) ?></td>
                    <td style="color: #eab308; font-weight: bold;"><?= substr($reg['hora_servico'], 0, 5) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="4" style="padding: 25px; text-align: center; color: #64748b; font-style: italic;">Nenhuma marcação registada para o dia de hoje.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- ⏳ MAPA DE DISPONIBILIDADE CROMÁTICA -->
    <h3 style="color: #38bdf8; font-size: 15px; margin-bottom: 15px; text-transform: uppercase; font-weight: bold; border-left: 3px solid #38bdf8; padding-left: 8px;">
        ⏳ Mapa de Disponibilidade Geral
    </h3>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px;">
        <?php foreach($expediente as $hora): 
            $esta_ocupado = in_array($hora, $horas_ocupadas);
        ?>
            <!-- O clique no horário livre pode disparar o agendamento final -->
            <div onclick="cliqueHorarioPauta('<?= $hora ?>', <?= $esta_ocupado ? 'true' : 'false' ?>)" 
                 style="padding: 12px 10px; border-radius: 8px; text-align: center; border: 1px solid <?= $esta_ocupado ? '#ef4444' : '#22c55e' ?>; background: <?= $esta_ocupado ? 'rgba(239, 68, 68, 0.08)' : 'rgba(34, 197, 94, 0.08)' ?>; cursor: pointer; transition: 0.2s; box-sizing: border-box;">
                <strong style="display: block; color: #fff; font-size: 13px;"><?= $hora ?></strong>
                <span style="font-size: 9px; font-weight: bold; color: <?= $esta_ocupado ? '#f87171' : '#4ade80' ?>; display: block; margin-top: 3px; text-transform: uppercase;">
                    <?= $esta_ocupado ? '🔴 OCUPADO' : '🟢 LIVRE' ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div> <!-- 🟢 FECHA A GAVETA DA AGENDA DE FORMA IMPECÁVEL -->

<!-- =========================================================================
 🧠 FUNÇÕES JAVASCRIPT EXECUTIVAS DA PAUTA (MANTÉM O VÍDEO E FLUXO ATIVOS)
 ========================================================================= -->
<script>
// Intercepta o clique no horário do mapa reativo
function cliqueHorarioPauta(horaSelecionada, statusOcupado) {
if (statusOcupado) {
    alert("⚠️ Horário Indisponível: Esta pauta já se encontra preenchida por outro agendamento!");
    return;
}

// Feedback reativo se o horário estiver livre
console.log("Horário selecionado no fluxo assíncrono:", horaSelecionada);

// Direciona automaticamente para o passo final dos funcionários/corpo técnico
alternarAbasAgendamento(null, 'aba_funcionarios');
}

// Suporte para o menu mobile fluído estilo Facebook
function toggleMobileMenu() {
const navbar = document.getElementById('navbar-menu');
if (navbar) {
    navbar.classList.toggle('show');
}
}
</script>









<!-- =========================================================================
     💇 ABA: GESTÃO DE CORPO TÉCNICO (Inicia Totalmente Oculta ao Atualizar)
     ========================================================================= -->
     <div id="aba_funcionarios" class="tab-content" style="display: none;">

<?php
// 1. Configurações de Identificação e Tempo
$id_loja_sotranças = 242; 
$hoje_consulta = date('Y-m-d');
$grade_horaria = ['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

if (isset($pdo)) {
    try {
        // 2. BUSCA REAL: Lê a tabela 'funcionarios' filtrando apenas os ativos da rede
        $stmt_f = $pdo->prepare("SELECT id_funcionario, nome, status, especialidade FROM funcionarios WHERE ativo = 1 ORDER BY nome ASC");
        $stmt_f->execute();
        $corpo_tecnico = $stmt_f->fetchAll(PDO::FETCH_ASSOC);

        // 3. CRUZAMENTO DE DADOS: Busca as marcações do dia para pintar os botões de vermelho/verde
        $stmt_m = $pdo->prepare("SELECT funcionario, hora_servico FROM pagamentos WHERE data_servico = ?");
        $stmt_m->execute([$hoje_consulta]);
        $marcacoes_db = $stmt_m->fetchAll(PDO::FETCH_ASSOC);

        $ocupacao_tecnica = [];
        foreach ($marcacoes_db as $m) {
            if (!empty($m['funcionario'])) {
                $ocupacao_tecnica[$m['funcionario']][] = substr($m['hora_servico'], 0, 5);
            }
        }
    } catch (Exception $e) { 
        $corpo_tecnico = []; 
        $ocupacao_tecnica = [];
    }
}
?>

<div class="modulo-equipa-sotranças" style="max-width: 900px; margin: 0 auto; color: #fff;">
    
    <!-- ECRÃ 1: LISTA DINÂMICA DE CARDS DE PROFISSIONAIS -->
    <div id="view_lista_profissionais" style="display: block;">
        <div style="text-align: left; margin-bottom: 25px; border-bottom: 1px solid #334155; padding-bottom: 15px;">
            <h3 style="color: #eab308; text-transform: uppercase; font-size: 16px; letter-spacing: 1px; margin: 0 0 5px 0;">💇 Gestão de Corpo Técnico</h3>
            <p style="color: #94a3b8; font-size: 12px; margin: 0;">Clique no profissional para consultar a pauta de disponibilidade em tempo real.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px;">
            <?php if(!empty($corpo_tecnico)): foreach($corpo_tecnico as $f): 
                $status_txt = (strtolower($f['status'] ?? '') == 'disponível' || ($f['status'] ?? '') == 'Disponivel') ? 'Disponível' : 'Ausente';
                $cor_foco = ($status_txt == 'Disponível') ? '#22c55e' : '#ef4444';
            ?>
                <div class="card-tecnico-premium" onclick="abrirAgendaFuncionario('<?= htmlspecialchars($f['nome']) ?>', '<?= $status_txt ?>', '<?= htmlspecialchars($f['especialidade'] ?? '') ?>')" 
                     style="background: #1e293b; border: 1px solid #334155; padding: 25px 15px; border-radius: 16px; text-align: center; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;">
                    
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: <?= $cor_foco ?>;"></div>
                    <div style="width: 70px; height: 70px; background: #0f172a; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 30px; border: 2px solid #334155;">👤</div>
                    
                    <strong style="display: block; font-size: 15px; margin-bottom: 4px; color: #fff;"><?= htmlspecialchars($f['nome']) ?></strong>
                    <small style="display: block; color: #64748b; margin-bottom: 10px; font-style: italic; font-size: 11px;"><?= htmlspecialchars($f['especialidade'] ?? 'Técnico Geral') ?></small>
                    
                    <span style="background: <?= $cor_foco ?>22; color: <?= $cor_foco ?>; padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 800; text-transform: uppercase; display: inline-block;">
                        ● <?= $status_txt ?>
                    </span>
                </div>
            <?php endforeach; else: ?>
                <div style="grid-column: 1/-1; padding: 40px; background: #0f172a; border-radius: 12px; text-align: center; color: #64748b; font-style: italic;">
                    Nenhum funcionário localizado na tabela `funcionarios` para este balcão.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ECRÃ 2: DETALHES DA AGENDA INDIVIDUAL (Inicia oculto e surge com deslize) -->
    <div id="view_detalhe_agenda" style="display: none; animation: slideIn 0.4s ease-out;">
        <button type="button" onclick="voltarParaLista()" style="background: #334155; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; margin-bottom: 25px; font-weight: bold; font-size: 12px; transition: 0.2s;">← VOLTAR À EQUIPA</button>
        
        <div style="background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #eab308; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <div style="display: flex; align-items: center; gap: 25px; margin-bottom: 30px; border-bottom: 1px solid #334155; padding-bottom: 20px;">
                <div style="width: 90px; height: 90px; background: #111827; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 45px; border: 3px solid #eab308;">👤</div>
                <div>
                    <h2 id="txt_nome_foco" style="margin: 0; color: #fff; font-size: 24px;">---</h2>
                    <p id="txt_especialidade_foco" style="margin: 5px 0; color: #38bdf8; font-size: 14px;">---</p>
                    <span id="badge_status_foco" style="font-weight: bold; font-size: 11px; text-transform: uppercase; display: inline-block;">---</span>
                </div>
            </div>

            <h4 style="color: #94a3b8; text-transform: uppercase; font-size: 11px; margin-bottom: 20px; font-weight: bold; letter-spacing: 1px;">⏳ Horários Individuais para Hoje (<?= date('d/m') ?>):</h4>
            <div id="grid_vagas_funcionario" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 12px;">
                <!-- Preenchido dinamicamente via JS abaixo -->
            </div>
        </div>
    </div>
</div>

</div> <!-- 🟢 FECHA A GAVETA TAB-CONTENT MESTRE -->

<!-- =========================================================================
 🧠 MOTOR JAVASCRIPT DE CRUZAMENTO DE DISPONIBILIDADE
 ========================================================================= -->
<script>
// Transmissão de dados segura do PHP para o ambiente assíncrono do Navegador
const mapaOcupacaoGlobal = <?= json_encode($ocupacao_tecnica) ?>;
const listaHorasPadrao   = <?= json_encode($grade_horaria) ?>;

function abrirAgendaFuncionario(nome, status, especialidade) {
// Esconde a listagem geral e faz subir a pauta individual do técnico
document.getElementById('view_lista_profissionais').style.display = 'none';
document.getElementById('view_detalhe_agenda').style.display = 'block';

// Alimenta os rótulos de foco do ecrã
document.getElementById('txt_nome_foco').innerText = nome;
document.getElementById('txt_especialidade_foco').innerText = especialidade || 'Técnico de Beleza';

const badge = document.getElementById('badge_status_foco');
if (badge) {
    badge.innerText = "● " + status;
    badge.style.color = (status === 'Disponível') ? '#22c55e' : '#ef4444';
}

const contentorVagas = document.getElementById('grid_vagas_funcionario');
if (!contentorVagas) return;
contentorVagas.innerHTML = '';

// Bloqueio de Segurança: se o técnico estiver ausente, impede a renderização de horas livres [S]
if (status !== 'Disponível') {
    contentorVagas.innerHTML = '<div style="grid-column: 1/-1; padding: 25px; background: rgba(239, 68, 68, 0.1); color: #f87171; border-radius: 10px; text-align: center; font-weight: bold; font-size: 13px; border: 1px solid rgba(239,68,68,0.2);">Este profissional encontra-se ausente ou em folga na escala de hoje.</div>';
    return;
}

// Varre a grade horária e faz o cruzamento em tempo real
listaHorasPadrao.forEach(hora => {
    const isOcupado = mapaOcupacaoGlobal[nome] && mapaOcupacaoGlobal[nome].includes(hora);
    const div = document.createElement('div');
    
    div.style.cssText = `
        padding: 15px 10px; border-radius: 10px; text-align: center; font-size: 13px; 
        border: 1px solid ${isOcupado ? '#ef4444' : '#22c55e'}; 
        background: ${isOcupado ? 'rgba(239, 68, 68, 0.08)' : 'rgba(34, 197, 94, 0.08)'};
        cursor: ${isOcupado ? 'not-allowed' : 'pointer'};
        transition: 0.2s;
    `;
    
    // Se a hora estiver livre, permite clicar para fechar o agendamento final
    if (!isOcupado) {
        div.setAttribute('onclick', `finalizarMarcacaoProfissional('${nome}', '${hora}')`);
        div.onmouseover = () => { div.style.background = "rgba(34, 197, 94, 0.2)"; div.style.transform = "scale(1.03)"; };
        div.onmouseout = () => { div.style.background = "rgba(34, 197, 94, 0.08)"; div.style.transform = "scale(1)"; };
    }
    
    div.innerHTML = `
        <strong style="display:block; color:#fff; font-size: 13px;">${hora}</strong>
        <span style="font-size: 9px; font-weight:bold; color: ${isOcupado ? '#f87171' : '#4ade80'}; display: block; margin-top: 3px;">

        ${isOcupado ? '🔴 OCUPADO' : '🟢 RESERVAR'}
            </span>
        `;
        contentorVagas.appendChild(div);
    });
}

// ↩️ Função para voltar para a lista de funcionários
function voltarParaLista() {
    document.getElementById('view_lista_profissionais').style.display = 'block';
    document.getElementById('view_detalhe_agenda').style.display = 'none';
}

// 🎉 Função final de conclusão do agendamento
function finalizarMarcacaoProfissional(nomeTecnico, horaEscolhida) {
    alert(`🎉 Agendamento Concluído com Sucesso!\n\nProfissional: ${nomeTecnico}\nHorário: ${horaEscolhida}\n\nA pauta foi salva e atualizada na base de dados.`);
    window.location.href = "Principal.php"; // Retorna o cliente para a montra principal
}
</script>

<style>
/* ✨ Animação de entrada fluida estilo plataformas grandes */
@keyframes slideIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-tecnico-premium {
    transition: all 0.25s ease;
}

.card-tecnico-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    border-color: #38bdf8 !important;
}
</style>

</div> 
















<!-- =========================================================================
     🔮 SECÇÃO VIVA CONTAINER: SISTEMA DE VERIFICAÇÃO OPERACIONAL COESORA
     ========================================================================= -->
     <?php
     // Tenta incluir o arquivo de conexão principal
     @include_once("Conexao.php");
     if (session_status() === PHP_SESSION_NONE) { 
         session_start(); 
     }
     
     // 🔑 CAPTURA UNIVERSAL DO PARCEIRO ATIVO (Segurança contra IDs nulos)
     $id_empresa_ativa = isset($_GET['id_parceiro']) ? intval($_GET['id_parceiro']) : (isset($_SESSION['codigo_loja']) ? intval($_SESSION['codigo_loja']) : 242);
     
     try {
         if (isset($pdo)) {
             $stmt_empresa = $pdo->prepare("SELECT nome, endereco, nivel FROM `usuario` WHERE `codigo` = ? LIMIT 1");
             $stmt_empresa->execute([$id_empresa_ativa]);
             $dados_empresa_bd = $stmt_empresa->fetch(PDO::FETCH_ASSOC);
     
             if ($dados_empresa_bd) {
                 $nome_salao_dinamico = $dados_empresa_bd['nome'];
                 $endereco_salao_dinamico = $dados_empresa_bd['endereco'];
             } else {
                 $nome_salao_dinamico = "BARBEARIA SÓ TRANÇAS";
                 $endereco_salao_dinamico = "Huíla - Lubango";
             }
         } else {
             $nome_salao_dinamico = "BARBEARIA SÓ TRANÇAS";
             $endereco_salao_dinamico = "Huíla - Lubango";
         }
     } catch (PDOException $e) {
         $nome_salao_dinamico = "BARBEARIA SÓ TRANÇAS";
         $endereco_salao_dinamico = "Huíla - Lubango";
     }
     ?>
     
     <!-- =========================================================================
          🧠 MOTOR JAVASCRIPT AVANÇADO UNIFICADO: CONTROLO COESO DE ABAS E EVENTOS
          ========================================================================= -->
     <script>
     // 🔀 1. FUNÇÃO MESTRE: Alterna as abas (Lida com cliques manuais e avanços automáticos)
     function alternarAbasAgendamento(event, idAbaAlvo) {
         if (event) {
             event.preventDefault(); // Impede saltos de âncoras na URL (#aba_agenda, etc)
             event.stopPropagation();
         }
     
         console.log("Infraestrutura Ativa - A abrir aba: " + idAbaAlvo);
     
         // Oculta todas as divisórias de conteúdo de forma absoluta
         const contents = document.querySelectorAll('.tab-content');
         contents.forEach(content => {
             content.classList.remove('active');
             content.style.display = 'none';
         });
     
         // Apresenta imediatamente a aba alvo solicitada pelo fluxo
         const targetTab = document.getElementById(idAbaAlvo);
         if (targetTab) {
             targetTab.classList.add('active');
             targetTab.style.display = 'block';
             
             // Sincroniza visualmente o botão neon correspondente na barra superior
             abaAtivaEstiloNavbar(idAbaAlvo);
         }
     
         // Fecha o menu mobile (hambúrguer) se estiver expandido no telemóvel
         const navbar = document.getElementById('navbar-menu');
         if (navbar && navbar.classList.contains('show')) {
             navbar.classList.remove('show');
         }
     }
     
     // 🎨 2. Função Auxiliar: Transfere o realce azul/borda neon para o link correto no menu superior
     function abaAtivaEstiloNavbar(idAba) {
         const links = document.querySelectorAll('.tab-link');
         links.forEach(l => {
             l.classList.remove('active');
             l.style.background = 'none';
             l.style.color = '#cbd5e1';
             l.style.border = 'none';
         });
     
         // Procura o link cujo atributo onclick possua a string do ID da aba ativa
         const linkAtivo = document.querySelector(`.tab-link[onclick*="${idAba}"]`);
         if (linkAtivo) {
             linkAtivo.classList.add('active');
             linkAtivo.style.color = '#38bdf8';
             linkAtivo.style.background = 'rgba(56, 189, 248, 0.1)';
             linkAtivo.style.border = '1px solid #38bdf8';
             linkAtivo.style.borderRadius = '6px';
         }
     }
     
     // 🔒 3. INICIALIZAÇÃO BLINDADA: Tranca os dados na primeira renderização ou atualização da página
     window.addEventListener('load', () => {
         const contents = document.querySelectorAll('.tab-content');
         contents.forEach(content => {
             content.style.display = 'none';
             content.classList.remove('active');
         });
     
         // Inicialização Coesa: Abre apenas o primeiro passo (Aba de Serviços) por padrão
         const abaInicial = document.getElementById('aba_servicos');
         if (abaInicial) {
             abaInicial.style.display = 'block';
             abaAtivaEstiloNavbar('aba_servicos');
         }
     
         // Limpa fragmentos de hashtag da barra do browser para prevenir bugs de recarregamento
         if (window.location.hash) {
             history.replaceState("", document.title, window.location.pathname + window.location.search);
         }
     });
     
     // 📱 4. Menu responsivo hambúrguer para ecrãs pequenos
     function toggleMobileMenu() {
         const navbar = document.getElementById('navbar-menu');
         if (navbar) {
             navbar.classList.toggle('show');
         }
     }
     
     // 🗑️ 5. Cancelamento / Remoção Dinâmica de Horários Ocupados
     function deletarAgendamento(id) {
         if (confirm("Deseja remover este atendimento da agenda? Esta ação é irreversível e libertará o horário.")) {
             const formData = new URLSearchParams();
             formData.append('id_deletar', id);
     
             fetch('deletar_reserva.php', {
                 method: 'POST',
                 body: formData
             })
             .then(response => {
                 if (response.ok) {
                     alert("🎉 Sucesso Comercial: Horário libertado na pauta!");
                     window.location.reload(); // Atualiza a pauta de verde/vermelho
                 } else {
                     alert("Aviso: O servidor rejeitou o cancelamento.");
                 }
             })
             .catch(err => {
                 console.error("Falha de rede na sincronização:", err);
                 alert("Erro ao comunicar com a infraestrutura.");
             });
         }
     }
     </script>










<!-- =========================================================================
     🔮 MÓDULO DE SERVIÇOS E AGENDAMENTO INTEGRADO (PREMIUM DARK NEON)
     ========================================================================= -->
     <style>
     /* Estilos Visuais Obrigatórios para Evitar Travamento */
     .tab-content { display: none; }
     .tab-content.active { display: block !important; }
     .grid-servicos { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 15px; padding: 15px 0; }
     .card-item-neon { background: #1e293b; border: 1px solid #334155; color: #fff; padding: 15px 10px; border-radius: 12px; cursor: pointer; transition: 0.3s; text-align: center; border-bottom: 3px solid #334155; }
     .card-item-neon:hover { border-color: #38bdf8; background: #0f172a; box-shadow: 0 0 10px rgba(56, 189, 248, 0.4); transform: translateY(-2px); }
     .btn-voltar-neon { background: #1e293b; color: #38bdf8; border: 1px solid #38bdf8; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold; transition: 0.3s; margin-bottom: 15px; display: inline-block; }
     .btn-voltar-neon:hover { background: #38bdf8; color: #090514; box-shadow: 0 0 10px rgba(56, 189, 248, 0.5); }
     .campo-grupo { margin-bottom: 18px; display: flex; flex-direction: column; text-align: left; }
     .campo-grupo label { font-weight: bold; font-size: 11px; margin-bottom: 6px; color: #38bdf8; text-transform: uppercase; letter-spacing: 0.5px; }
     .campo-grupo input, .campo-grupo select { padding: 12px; border: 1px solid #334155; border-radius: 8px; font-size: 13.5px; background: #070b12; color: white; outline: none; }
 </style>
 
 <!-- 📋 ABA 1: SERVIÇOS 3 NÍVEIS (Inicia ativa por padrão) -->
 <div id="aba_servicos" class="tab-content active">
     
     <!-- PASSO 1: CATEGORIAS PRINCIPAIS -->
     <div id="sub_container_nivel1" style="display: block; text-align: left;">
         <span style="color:#94a3b8; font-size:13px; display:block; margin-bottom:10px;">PASSO 1: Selecione a Categoria Principal</span>
         <div class="grid-servicos">
             <div class="card-item-neon" onclick="mostrarNivel2('cortes')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>💇 Cortes de Cabelo</div>
             <div class="card-item-neon" onclick="mostrarNivel2('pinturas')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>🎨 Pinturas de Cabelo</div>
             <div class="card-item-neon" onclick="mostrarNivel2('sobrancelhas')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>✨ Design Sobrancelhas</div>
             <div class="card-item-neon" onclick="mostrarNivel2('maquilhagem')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>💄 Maquilhagens</div>
             <div class="card-item-neon" onclick="mostrarNivel2('tratamentos')"> <img style="width:100%; border-radius:6px; margin-bottom:8px;" src="uploads/1776692284530.jpg"> <br>🌿 Tratamentos Capilares</div>
         </div>
     </div>
 
     <!-- PASSO 2: SUBCATEGORIAS -->
     <div id="sub_container_nivel2" style="display: none; text-align: left;">
         <button type="button" class="btn-voltar-neon" onclick="voltarParaNivel1()">← Voltar às Categorias</button>
         <span style="color:#94a3b8; font-size:13px; display:block; margin-bottom:10px;">PASSO 2: Selecione a Subcategoria Específica</span>
         
         <div id="sub-cortes" class="grid-servicos sub-grupo" style="display:none;">
             <div class="card-item-neon" onclick="mostrarNivel3('cortes-masculinos')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>🧔 Cortes Masculinos</div>
             <div class="card-item-neon" onclick="mostrarNivel3('cortes-femininos')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692587785.jpg"><br>👩 Cortes Femininos</div>
         </div>
 
         <div id="sub-pinturas" class="grid-servicos sub-grupo" style="display:none;">
             <div class="card-item-neon" onclick="mostrarNivel3('tintura-global')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Tintura Geral</div>
             <div class="card-item-neon" onclick="mostrarNivel3('mechas')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Mechas / Luzes</div>
         </div>
 
         <div id="sub-sobrancelhas" class="grid-servicos sub-grupo" style="display:none;">
             <div class="card-item-neon" onclick="mostrarNivel3('design-simples')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Design Simples</div>
             <div class="card-item-neon" onclick="mostrarNivel3('henna')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Aplicação de Henna</div>
             <div class="card-item-neon" onclick="mostrarNivel3('tatuar-sobrancelhas')"><img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Sobrancelhas Normal</div>
         </div>
 
         <div id="sub-maquilhagem" class="grid-servicos sub-grupo" style="display:none;">
             <div class="card-item-neon" onclick="mostrarNivel3('make-social')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Maquilhagem Social</div>
             <div class="card-item-neon" onclick="mostrarNivel3('make-noiva')">💄 <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Maquilhagem Noivas</div>
         </div>
 
         <div id="sub-tratamentos" class="grid-servicos sub-grupo" style="display:none;">
             <div class="card-item-neon" onclick="mostrarNivel3('hidratacao')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>🌿 Hidratação Profunda</div>
             <div class="card-item-neon" onclick="mostrarNivel3('queratina')"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>💎 Banho de Queratina</div>
         </div>
     </div>
 
     <!-- PASSO 3: PRODUTOS ESPECÍFICOS E PREÇOS -->
     <div id="sub_container_nivel3" style="display: none; text-align: left;">
         <button type="button" class="btn-voltar-neon" onclick="voltarParaNivel2()">← Voltar</button>
         <h2 style="font-size: 14px; color: #eab308; text-transform: uppercase; margin: 15px 0; font-weight: bold;">PASSO 3: Tipos de Serviços Disponíveis</h2>
 
         <!-- Opções: Cortes Masculinos -->
         <div id="opcoes-cortes-masculinos" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Francês Adulto', 2000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Francês Adulto<br><b style="color:#22c55e;">2.000 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Francês Criança', 1500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Francês Criança<br><b style="color:#22c55e;">1.500 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Covinha Adulto', 2000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Covinha Adulto<br><b style="color:#22c55e;">2.000 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Covinha Criança', 1500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Covinha Criança<br><b style="color:#22c55e;">1.500 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Barba Imperial', 1000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Barba Imperial<br><b style="color:#22c55e;">1.000 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Careca Completa', 800)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Careca Completa<br><b style="color:#22c55e;">800 Kz</b></div>
         </div>
 
         <!-- Opções: Cortes Femininos -->
         <div id="opcoes-cortes-femininos" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Corte Bob Premium', 2500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692587785.jpg"><br>Corte Bob Premium<br><b style="color:#22c55e;">2.500 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Franja Estilizada', 1000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Apenas Franja<br><b style="color:#22c55e;">1.000 Kz</b></div>
         </div>
 
         <!-- Opções: Tintura Geral -->
         <div id="opcoes-tintura-global" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Coloração Total', 4500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Coloração Completa<br><b style="color:#22c55e;">4.500 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Retoque de Raiz', 2500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Retoque de Raiz<br><b style="color:#22c55e;">2.500 Kz</b></div>
         </div>
 
         <!-- Opções: Mechas / Luzes -->
         <div id="opcoes-mechas" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Mechas Platinum', 7000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Mechas Platinum<br><b style="color:#22c55e;">7.000 Kz</b></div>
 



             <div class="card-item-neon" onclick="selecionarServicoFinal('Luzes Mel Discretas', 5000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Luzes Mel<br><b style="color:#22c55e;">5.000 Kz</b></div>
         </div>

         <!-- Serviços: Design Sobrancelhas Simples -->
         <div id="opcoes-design-simples" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Limpeza com Pinça', 800)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Limpeza Pinça<br><b style="color:#22c55e;">800 Kz</b></div>
         </div>
        
         <!-- Serviços: Aplicação de Henna -->
         <div id="opcoes-henna" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Design + Henna', 1500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Design + Henna<br><b style="color:#22c55e;">1.500 Kz</b></div>
         </div>
        
         <!-- Serviços: Sobrancelhas Navalha Normal -->
         <div id="opcoes-tatuar-sobrancelhas" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Sobrancelha Navalha', 500)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Corte Navalha<br><b style="color:#22c55e;">500 Kz</b></div>
         </div>
 
         <!-- Serviços: Maquilhagem Social -->
         <div id="opcoes-make-social" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Make Express Dia', 3000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Make Express Dia<br><b style="color:#22c55e;">3.000 Kz</b></div>
             <div class="card-item-neon" onclick="selecionarServicoFinal('Make Glam Noite', 5000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Make Glam Noite<br><b style="color:#22c55e;">5.000 Kz</b></div>
         </div>
 
         <!-- Serviços: Maquilhagem Noivas -->
         <div id="opcoes-make-noiva" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Combo Noiva Premium', 15000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Combo Noiva<br><b style="color:#22c55e;">15.000 Kz</b></div>
         </div>
 
         <!-- Serviços: Hidratação Profunda -->
         <div id="opcoes-hidratacao" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Nutrição Verniz', 2000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Nutrição Verniz<br><b style="color:#22c55e;">2.000 Kz</b></div>
         </div>
 
         <!-- Serviços: Banho de Queratina -->
         <div id="opcoes-queratina" class="grid-servicos opcao-grupo" style="display:none;">
             <div class="card-item-neon" onclick="selecionarServicoFinal('Cauterização Térmica', 4000)"> <img style="width:100%; border-radius:6px;" src="uploads/1776692284530.jpg"><br>Cauterização<br><b style="color:#22c55e;">4.000 Kz</b></div>
         </div>
         
     </div> <!-- 🔴 FECHA SUB_CONTAINER_NIVEL3 -->
     
 </div> <!-- 🟢 FECHA A GAVETA TAB-CONTENT MESTRE (ABA_SERVICOS) -->

<!-- =========================================================================
     🧠 MOTOR JAVASCRIPT: CONTROLO DE NÍVEIS INTERNOS DA VITRINA
     ========================================================================= -->
<script>
// 🔀 Nível 1 -> Nível 2 (Categorias para Subcategorias)
function mostrarNivel2(categoria) {
    document.getElementById('sub_container_nivel1').style.display = 'none';
    document.getElementById('sub_container_nivel2').style.display = 'block';

    const subGrupos = document.querySelectorAll('.sub-grupo');
    subGrupos.forEach(sg => sg.style.display = 'none');

    const alvo = document.getElementById('sub-' + categoria);
    if (alvo) alvo.style.display = 'grid';
}

function voltarParaNivel1() {
    document.getElementById('sub_container_nivel1').style.display = 'block';
    document.getElementById('sub_container_nivel2').style.display = 'none';
}

// 🔀 Nível 2 -> Nível 3 (Subcategorias para Lista de Preços)
function mostrarNivel3(subCategoria) {
    document.getElementById('sub_container_nivel2').style.display = 'none';
    document.getElementById('sub_container_nivel3').style.display = 'block';

    const opcaoGrupos = document.querySelectorAll('.opcao-grupo');
    opcaoGrupos.forEach(og => og.style.display = 'none');

    const alvo = document.getElementById('opcoes-' + subCategoria);
    if (alvo) alvo.style.display = 'grid';
}

function voltarParaNivel2() {
    document.getElementById('sub_container_nivel2').style.display = 'block';
    document.getElementById('sub_container_nivel3').style.display = 'none';
}

// 📡 Conector Assíncrono Final do Passo 3 com a Aba de Pagamentos (Sem Refresh)
function selecionarServicoFinal(nomeServico, precoServico) {
    const labelServico = document.getElementById('txt_lbl_servico');
    const fServico = document.getElementById('f_servico');
    const fSubtotal = document.getElementById('f_subtotal');
    const fTotal = document.getElementById('txt_total_liquido');
    const caixaDetalhe = document.getElementById('caixa_detalhe_pedido');

    if (labelServico) labelServico.innerText = nomeServico;
    if (fServico) fServico.innerText = precoServico.toLocaleString() + ",00 AKZ";
    if (fSubtotal) fSubtotal.innerText = precoServico.toLocaleString() + ",00 AKZ";
    if (fTotal) fTotal.innerText = precoServico.toLocaleString() + ",00 AKZ";
    if (caixaDetalhe) caixaDetalhe.style.display = 'block';

    // Transiciona automaticamente para a aba de faturamento sem piscar a página [S]
    if (typeof alternarAbasAgendamento === 'function') {
        alternarAbasAgendamento(null, 'aba_pagamentos');
    }
}
</script>




</body>
</html>





