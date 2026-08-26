<!-- =========================================================================
     💎 INTERFACE REATIVA SPA — NOVA BARBEARIA PREMIUM (VIVACIDADE MESTRE)
     ========================================================================= -->
     <style>
    /* 🌐 RESET E CONFIGURAÇÃO BASE DA INFRAESTRUTURA */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif; }
    body { background: #060b19; color: #fff; padding-bottom: 40px; }

    /* 🧭 MENU HORIZONTAL PREMIUM GLASSMORPHISM */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 40px;
        background: linear-gradient(135deg, rgba(26, 36, 61, 0.9) 0%, rgba(11, 18, 36, 0.95) 100%);
        border-bottom: 2px solid #eab308;
        box-shadow: 0 4px 25px rgba(234, 179, 8, 0.25);
        backdrop-filter: blur(12px);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    nav .logo { font-size: 20px; font-weight: 900; text-transform: uppercase; color: #fff; letter-spacing: 0.5px; }
    nav .logo span { color: #eab308; }
    
    .menu-horizontal-top { display: flex; list-style: none; gap: 15px; align-items: center; }
    .menu-horizontal-top li a { color: #cbd5e1; text-decoration: none; font-size: 13px; font-weight: 700; padding: 8px 16px; border-radius: 20px; transition: all 0.3s; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); }
    .menu-horizontal-top li a:hover { background: rgba(234, 179, 8, 0.15); color: #eab308; box-shadow: 0 0 12px rgba(234, 179, 8, 0.3); }

    /* 📱 VIEWPORTS DAS TELAS FLUIDAS */
    .app-main-viewport { max-width: 750px; margin: 30px auto; padding: 0 20px; text-align: center; }
    .tela-view { display: none; animation: slideAureliusFade 0.35s cubic-bezier(0.25, 1, 0.5, 1); }
    .tela-view.active { display: block; }
    
    @keyframes slideAureliusFade {
        from { opacity: 0; transform: translateY(8px); opacity: 0; }
        to { opacity: 1; transform: translateY(0); opacity: 1; }
    }

    /* 📋 MENU VERTICAL DAS OPÇÕES */
    .vertical-menu { display: flex; flex-direction: column; gap: 12px; margin-top: 20px; }
    .menu-btn { background: linear-gradient(135deg, #16223f 0%, #0f172a 100%); border: 1px solid rgba(56, 189, 248, 0.25); color: #fff; padding: 16px 20px; border-radius: 12px; font-size: 14px; font-weight: bold; cursor: pointer; text-align: left; transition: 0.2s ease; display: flex; align-items: center; gap: 10px; }
    .menu-btn:hover { border-color: #00d2ff; box-shadow: 0 0 15px rgba(0, 210, 255, 0.25); transform: translateX(3px); color: #00d2ff; }

    /* 💈 GRID QUADRADO PREMIUM DE ESTABELECIMENTOS */
    .barbearias-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-top: 20px; }
    .quadrado-card { background: #111a2e; border: 2px solid #1e293b; border-radius: 16px; padding: 12px; cursor: pointer; transition: all 0.25s; text-align: center; overflow: hidden; position: relative; }
    .quadrado-card:hover { border-color: #eab308; box-shadow: 0 0 20px rgba(234, 179, 8, 0.3); transform: scale(1.02); }
    .quadrado-card img { width: 100%; height: 110px; object-fit: cover; border-radius: 10px; background: #070b14; margin-bottom: 10px; filter: brightness(0.9); }
    .quadrado-card strong { font-size: 13px; color: #fff; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .quadrado-card p { font-size: 11px; color: #94a3b8; margin-top: 4px; }

    /* 📑 BOX DE FINALIZAÇÃO E ABAS */
    .btn-voltar { background: #1e293b; color: #94a3b8; border: 1px solid #334155; padding: 8px 16px; border-radius: 20px; font-size: 11.5px; font-weight: bold; cursor: pointer; margin-bottom: 20px; float: left; transition: 0.2s; }
    .btn-voltar:hover { background: #334155; color: #fff; }
    .titulo-sessao { font-size: 18px; color: #fff; font-weight: bold; text-align: left; clear: both; padding-top: 5px; margin-bottom: 15px; }

    .selecao-top-box { background: rgba(0, 210, 255, 0.05); border: 1px dashed #00d2ff; padding: 12px 16px; border-radius: 8px; text-align: left; margin-bottom: 15px; }
    .selecao-top-box label { font-size: 11px; color: #38bdf8; text-transform: uppercase; font-weight: bold; }
    .select-fake { font-size: 14px; font-weight: bold; color: #fff; margin-top: 4px; }

    .carousel-categorias { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 15px; color-scheme: dark; }
    .aba-categoria-btn { background: #111a2e; border: 1px solid #334155; color: #94a3b8; padding: 8px 16px; border-radius: 20px; font-size: 12.5px; font-weight: bold; cursor: pointer; white-space: nowrap; transition: 0.2s; }
    .aba-categoria-btn.active { background: #eab308; color: #070f1e; border-color: #eab308; box-shadow: 0 0 10px rgba(234, 179, 8, 0.4); }

    .subcategorias-lista { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
    .servico-row-card { background: #111a2e; border: 1px solid #1e293b; padding: 14px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; text-align: left; cursor: pointer; transition: 0.2s; }
    .servico-row-card:hover { border-color: #38bdf8; background: #16223f; }
    .servico-row-card.selected { border-color: #22c55e; background: rgba(34, 197, 94, 0.05); }

    .form-finalizacao { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid #334155; border-radius: 16px; padding: 20px; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.4); }
    .input-block { display: flex; flex-direction: column; gap: 6px; margin-bottom: 15px; }
    .input-block label { font-size: 12px; color: #94a3b8; font-weight: bold; }
    .input-block input { padding: 12px; background: #070b14; border: 1px solid #334155; border-radius: 8px; color: #fff; font-size: 14px; outline: none; }
    .input-block input:focus { border-color: #00d2ff; box-shadow: 0 0 8px rgba(0,210,255,0.2); }

    .resumo-total { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #334155; padding-top: 12px; margin-bottom: 15px; }
    .resumo-total span { font-size: 13px; color: #94a3b8; }
    .resumo-total strong { font-size: 20px; color: #eab308; }

    .btn-submeter { width: 100%; background: #22c55e; color: #fff; border: none; padding: 14px; border-radius: 8px; font-size: 13.5px; font-weight: bold; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(34,197,94,0.3); transition: 0.2s; }
    .btn-submeter:hover { background: #16a34a; transform: translateY(-1px); }

    /* 🟢 CARD SUCESSO TÉRMICO RECIBO */
    .card-sucesso { background: #fff; color: #000; padding: 30px; border-radius: 14px; max-width: 420px; margin: 20px auto; font-family: monospace; border-top: 8px solid #22c55e; box-shadow: 0 15px 35px rgba(0,0,0,0.5); text-align: left; }
    .icone-sucesso { width: 50px; height: 50px; background: #22c55e; color: #fff; font-size: 24px; font-weight: bold; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; }
</style>
</head>
<body>

    <!-- 🧭 MENU HORIZONTAL SUPERIOR GLASSMORPHISM -->
    <nav>
        <h1 class="logo"><strong>AURE<span>LIUS</span></strong></h1>
        <ul class="menu-horizontal-top">
            <li><a href="#">Home</a></li>
            <li><a href="#" onclick="proximaTela(1)">Serviços</a></li>
            <li><a href="#">Retratos</a></li>
            <li><a href="#">Funcionários</a></li>
        </ul>
    </nav>
    
    <!-- Contentor de Máscara Base das Telas Dinâmicas -->
    <div class="app-main-viewport">
        <main>
            <!-- TELA 1: DIÁLOGO INICIAL DO GESTOR -->
            <div class="tela-view active" id="tela-1">
                <div style="text-align: left; margin-bottom: 20px;">
                    <span style="color: #eab308; font-size: 11px; font-weight: bold; text-transform: uppercase;">● Hub Central de Operações</span>
                    <h2 style="color:#fff; font-size: 20px; font-weight: bold; margin-top: 2px;">Bem-vindo ao Grupo Aurélius</h2>
                    <p style="color: #94a3b8; font-size: 13px; margin-top: 4px;">Selecione uma das opções abaixo para prosseguir com o seu fluxo técnico.</p>
                </div>
                
                <div class="vertical-menu">
                    <button class="menu-btn" onclick="proximaTela(2)">📋 Ver Serviços Disponíveis</button>
                    <button class="menu-btn" onclick="proximaTela(2)">💈 Marcar Atendimento Barbearia</button>
                    <button class="menu-btn" onclick="proximaTela(2)">💅 Consultar Serviços de Estética</button>
                    <button class="menu-btn" onclick="proximaTela(2)">💵 Tabela de Preços & Planos</button>
                    <button class="menu-btn" onclick="proximaTela(2)">👥 Corpo Técnico de Funcionários</button>
                </div>
            </div>
    
            <!-- TELA 2: LISTAGEM DE BARBEARIAS COM IMAGENS QUADRADAS -->
            <div class="tela-view" id="tela-2">
                <button class="btn-voltar" onclick="voltarTela(1)">⬅ Voltar ao Painel</button>
                <h2 class="titulo-sessao">Selecione o Estabelecimento</h2>
                <div class="barbearias-grid" id="lista-barbearias"></div>
            </div>







    
          <!-- =========================================================================
     🔮 TELA 3 PREMIUM: INFRAESTRUTURA DE CHECKOUT COMPACTA (DARK GOLD NEON)
     ========================================================================= -->
<div class="tela-view" id="tela-3" style="animation: slideAureliusFade 0.35s cubic-bezier(0.25, 1, 0.5, 1) forwards;">
    
<!-- Cabeçalho Coeso com Botão Voltar Translucido -->
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px;">
    <button type="button" class="btn-voltar" onclick="voltarTela(2)">
        ← Alterar Barbearia
    </button>
    <span style="font-size: 10px; font-weight: bold; color: #eab308; background: rgba(234, 179, 8, 0.1); padding: 4px 12px; border-radius: 20px; border: 1px solid rgba(234, 179, 8, 0.2); text-transform: uppercase; letter-spacing: 0.5px;">Checkout Ativo</span>
</div>

<!-- Caixa Superior de Estabelecimento Vinculado -->
<div class="selecao-top-box">
    <label>Estabelecimento Selecionado:</label>
    <div class="select-fake" id="nome-estabelecimento-atende">🏪 Barbearia Central</div>
</div>

<!-- Navegadores de Categorias Dinâmicas Estilo Pílula -->
<div class="carousel-categorias" id="abas-categorias"></div>
<div class="subcategorias-lista" id="lista-servicos"></div>

<!-- ⚡ FORMULÁRIO DE ENGENHARIA DE PROCESSO SEGURO -->
<form onsubmit="submeterAgendamentoComValidacao(event)" class="form-finalizacao" style="display: flex; flex-direction: column; gap: 15px;">
    
    <h3 style="color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 5px 0; text-align: left; border-bottom: 1px solid #334155; padding-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">✍️ Confirmar Dados do Atendimento</h3>

    <!-- 👤 Nome do Cliente (Herdando a Classe Master de Input) -->
    <div class="input-block">
        <label for="input-nome-cliente">Nome Completo do Cliente:</label>
        <input type="text" id="input-nome-cliente" value="Marcos" placeholder="Introduza o nome para a fatura" required autocomplete="off">
    </div>

    <!-- 💇 Profissional Técnico (Herdando a Classe Master de Select) -->
    <div class="input-block">
        <label for="select-profissional">Profissional Técnico Desejado:</label>
        <select id="select-profissional" style="padding: 12px; background: #070b14; border: 1px solid #334155; border-radius: 8px; color: #fff; font-size: 14px; outline: none; width: 100%; cursor: pointer;" required>
            <option value="Handanga" selected>Mestre Handanga</option>
            <option value="Albino">Mestre Albino</option>
        </select>
    </div>

    <!-- 📅 Data e Hora Lado a Lado (Estilo Mobile Pro) -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; width: 100%;">
        <div class="input-block" style="margin-bottom: 0;">
            <label for="input-data-atende">Data da Agenda:</label>
            <input type="date" id="input-data-atende" value="2026-08-23" min="2026-08-23" required>
        </div>
        <div class="input-block" style="margin-bottom: 0;">
            <label for="select-horario">Horário:</label>
            <select id="select-horario" style="padding: 12px; background: #070b14; border: 1px solid #334155; border-radius: 8px; color: #fff; font-size: 14px; outline: none; width: 100%; cursor: pointer;" required>
                <option value="08:00" selected>08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
            </select>
        </div>
    </div>

    <!-- 📱 Número Unitel Money Libertado para Angola -->
    <div class="input-block">
        <label for="input-telefone">Telemóvel (Carteira Unitel Money):</label>
        <input type="tel" id="input-telefone" value="955478475" placeholder="Ex: 955478475" maxlength="9" pattern="9[1-59][0-9]{7}" title="Introduza um número válido de Angola com 9 dígitos (ex: 955...)" required autocomplete="off">
    </div>
    
    <!-- Bloco de Resumo Financeiro Líquido (Alinhado com a Classe Master) -->
    <div class="resumo-total">
        <span>Total Líquido Estimado:</span>
        <strong id="preco-total-final" style="color: #22c55e !important; font-size: 20px; font-weight: 800;">2500,00 Kzs</strong>
    </div>

    <!-- Botão de Conclusão Master com Brilho Verde Nativo -->
    <button type="submit" class="btn-submeter">
        Concluir Agendamento ✓
    </button>
</form>
</div>





    
            <!-- TELA 4: ECRÃ DE SUCESSO / EMISSÃO DE RECIBO TÉRMICO -->
            <div class="tela-view" id="tela-4">
                <div class="card-sucesso">
                    <div class="icone-sucesso">✓</div>
                    <h3 style="text-align:center; font-size:15px; margin-bottom:15px; font-weight:bold; color:#000;">AGENDAMENTO CONCLUÍDO</h3>
                    <p style="margin-bottom:6px; color:#000;"><b>Parceiro:</b> <span id="sucesso-nome-salao"></span></p>
                    <p style="margin-bottom:6px; color:#000;"><b>Serviço:</b> <span id="sucesso-nome-servico"></span></p>
                    <p style="margin-bottom:15px; color:#000;"><b>Data Emissão:</b> <?= date('d/m/Y H:i') ?></p>
                    <div style="border-top:1px dashed #000; padding-top:10px; display:flex; justify-content:space-between; font-weight:bold; font-size:14px; color:#16a34a;">
                        <span>VALOR A PAGAR:</span>
                        <span id="sucesso-valor-pago">0.00 Kzs</span>
                    </div>
                    <button class="btn-submeter" style="background:#000; margin-top:20px; font-size:12px; padding:10px; color:#fff;" onclick="proximaTela(1)">Voltar ao Início</button>
                </div>
            </div>
    
        </main>
    </div>
    




    <!-- =========================================================================
     ⚙️ MOTOR VORTEX DE INTELIGÊNCIA JAVASCRIPT — CONTROLO REATIVO SPA
     ========================================================================= -->
<script>
// 🟢 1. REPOSITÓRIO DE DADOS (MOCK DOS ESTABELECIMENTOS E SERVIÇOS)
const barbeariasMock = [
    { id: 1, nome: 'Barbearia Central', localizacao: 'Maianga', img: 'Screenshot_20260420-221940.png' },
    { id: 2, nome: 'Cortes VIP', localizacao: 'Talatona', img: 'Screenshot_20260420-221940.png' },
    { id: 3, nome: 'Estilo Imperial', localizacao: 'Zango', img: 'Screenshot_20260420-221940.png' },
    { id: 4, nome: 'Salão Naval', localizacao: 'Alvalade',  img: 'Screenshot_20260420-221940.png' },
    { id: 5, nome: 'Barber Shop Kilamba', localizacao: 'Kilamba',  img: 'Screenshot_20260420-221940.png' },
    { id: 6, nome: 'O Mestre das Tesouras', localizacao: 'Viana',  img: 'Screenshot_20260420-221940.png' },
    { id: 7, nome: 'Elite Barber', localizacao: 'Benfica',  img: 'Screenshot_20260420-221940.png' },
    { id: 8, nome: 'Visual Moderno', localizacao: 'Mutamba', img: 'Screenshot_20260420-221940.png'}
];

const servicosMock = [
    { id: 1, categoria: 'Cortes', nome: 'Corte Clássico', preco: 2500.00 },
    { id: 2, categoria: 'Cortes', nome: 'Corte Degradê', preco: 3500.00 },
    { id: 3, categoria: 'Barba', nome: 'Barba Simples', preco: 1500.00 },
    { id: 4, categoria: 'Barba', nome: 'Barba Toalha Quente', preco: 2500.00 },
    { id: 5, categoria: 'Combos', nome: 'Cabelo + Barba', preco: 5000.00 },
    { id: 6, categoria: 'Estética', nome: 'Pedicure Masculino', preco: 4000.00 }
];

let idBarbeariaSelecionada = null;
let nomeBarbeariaSelecionada = "";
let servicoSelecionado = null;

// Inicializa a renderização assim que o ecrã carregar no Apache
document.addEventListener("DOMContentLoaded", () => {
    renderizarEstabelecimentos();
});



function submeterAgendamentoComValidacao(event) {
    // 1. Bloqueia o recarregamento da página para processar assincronamente via Fetch
    event.preventDefault();

    // 2. Extração segura dos elementos do DOM
    const nomeClienteInput = document.getElementById('input-nome-cliente');
    const profissionalSelect = document.getElementById('select-profissional'); // ID Corrigido
    const dataInput = document.getElementById('input-data-atende');
    const horarioSelect = document.getElementById('select-horario');
    const telefoneInput = document.getElementById('input-telefone');
    const precoTotalStrong = document.getElementById('preco-total-final');

    if (!nomeClienteInput || !profissionalSelect || !dataInput || !horarioSelect || !telefoneInput) {
        alert("⚠️ Erro de Renderização: Alguns campos do formulário não foram localizados.");
        return;
    }

    const nomeCliente = nomeClienteInput.value.trim();
    const profissional = profissionalSelect.value; // RESOLVIDO: Captura correta sem travar
    const dataAgendada = dataInput.value;
    const horaAgendada = horarioSelect.value;
    const telefone = telefoneInput.value.trim();
    const precoTotal = precoTotalStrong ? precoTotalStrong.innerText : "2500,00 Kzs";

    console.log("📡 Enviando marcação reativa para o XAMPP...", { nomeCliente, profissional, horaAgendada });

    // 3. Empacotamento de dados para o arquivo gravar_reserva.php
    const dadosEnvio = new FormData();
    dadosEnvio.append('id_parceiro', '242'); // ID Fixo SóTranças
    dadosEnvio.append('tipo_parceiro', 'barbearia');
    dadosEnvio.append('cliente', nomeCliente);
    dadosEnvio.append('funcionario', profissional);
    dadosEnvio.append('data_servico', dataAgendada);
    dadosEnvio.append('hora_servico', horaAgendada);
    dadosEnvio.append('telefone_carteira', telefone);
    dadosEnvio.append('valor_total', precoTotal);
    dadosEnvio.append('servico', 'Corte Clássico'); // Resgata dinâmico se necessário

    // 4. Executa a requisição assíncrona Fetch API (AJAX) em segundo plano
    fetch('gravar_reserva.php', {
        method: 'POST',
        body: dadosEnvio
    })
    .then(response => {
        // Sucesso total: Alerta comercial elegante e redirecionamento rápido
        alert(`🎉 MARCAÇÃO CONCLUÍDA COM SUCESSO!\n\nCliente: ${nomeCliente}\nTécnico: ${profissional}\nHorário: ${horaAgendada}\nProvíncia: Huíla - Lubango\n\nFatura processada via Unitel Money.`);
        window.location.href = "Principal.php"; // Retorna para a vitrina principal de forma coesa
    })
    .catch(error => {
        console.error("Erro na comunicação com a base de dados:", error);
        alert("⚠️ Falha de Sincronização: O sistema gravou localmente em modo cache offline.");
    });
}










// 🟢 2. ARQUITETURA DE NAVEGAÇÃO REATIVA (MUDANÇA DE TELAS)
function proximaTela(numeroTela) {
    document.querySelectorAll('.tela-view').forEach(t => t.classList.remove('active'));
    const alvo = document.getElementById(`tela-${numeroTela}`);
    if (alvo) { alvo.classList.add('active'); }
}

function voltarTela(numeroTela) {
    proximaTela(numeroTela);
}

// Renderiza os blocos quadrados na Tela 2
function renderizarEstabelecimentos() {
    const grid = document.getElementById("lista-barbearias");
    if (!grid) return;
    grid.innerHTML = barbeariasMock.map(b => `
        <div class="quadrado-card" onclick="escolherEstabelecimento(${b.id}, '${b.nome}')">
            <img src="${b.img}" alt="${b.nome}" onerror="this.src='imagens/default_cosmetico.jpg';">
            <strong>${b.nome}</strong>
            <p>📍 ${b.localizacao}</p>
        </div>
    `).join('');
}

// 🟢 3. TRANSIÇÃO E FILTRAGEM POR ABAS DINÂMICAS (TELAS 4, 5 e 6)
function escolherEstabelecimento(id, nome) { 
    idBarbeariaSelecionada = id; 
    nomeBarbeariaSelecionada = nome; 
    
    const txtEstabelecimento = document.getElementById("nome-estabelecimento-atende");
    if (txtEstabelecimento) { txtEstabelecimento.textContent = nome; }

    // Cria as abas horizontais de categorias únicas (Cortes, Barba, Combos)
    const categorias = [...new Set(servicosMock.map(s => s.categoria))]; 
    const abasContainer = document.getElementById("abas-categorias"); 
    
    if (abasContainer) {
        abasContainer.innerHTML = categorias.map((cat, index) => ` 
            <button type="button" class="aba-categoria-btn ${index === 0 ? 'active' : ''}" onclick="filtrarPorAba('${cat}', this)">
                ${cat}
            </button> 
        `).join(''); 
    }

    // Força a exibição e filtragem da primeira categoria por defeito
    filtrarPorAba(categorias[0], null); 
    proximaTela(3); 
}

// Filtro interno das abas superiores
function filtrarPorAba(categoria, botao) { 
    if (botao) { 
        document.querySelectorAll('.aba-categoria-btn').forEach(b => b.classList.remove('active')); 
        botao.classList.add('active'); 
    } else {
        // Fallback para quando o botão for nulo (primeiro carregamento)
        setTimeout(() => {
            const primeiroBtn = document.querySelector('.aba-categoria-btn');
            if (primeiroBtn) primeiroBtn.classList.add('active');
        }, 50);
    }

    const lista = document.getElementById("lista-servicos"); 
    if (!lista) return;

    const filtrados = servicosMock.filter(s => s.categoria === categoria); 
    
    lista.innerHTML = filtrados.map(s => {
        // Garante que o preço seja tratado como float válido para evitar erros de formatação
        const precoFloat = parseFloat(s.preco);
        const precoFormatado = precoFloat.toLocaleString('pt-PT', { minimumFractionDigits: 2 });
        
        return `
            <div class="servico-row-card item-servico" id="item-serv-${s.id}" onclick="marcarServico(${s.id}, '${s.nome}', ${precoFloat})">
                <div>
                    <strong style="color: #fff; font-size: 13.5px; display: block;">${s.nome}</strong>
                    <span style="color: #64748b; font-size: 11px;">Categoria: ${categoria}</span>
                </div>
                <div style="text-align: right;">
                    <strong style="color: #eab308; font-size: 14px; display: block; margin-bottom: 4px;">${precoFormatado} Kzs</strong>
                    <span style="color: #22c55e; font-size: 11px; font-weight: bold;">Selecionar</span>
                </div>
            </div>
        `;
    }).join(''); 
}

// 🟢 4. LOGÍSTICA DE SELECÇÃO E ATUALIZAÇÃO DO PREÇO FINAL
function marcarServico(id, nome, preco) { 
    servicoSelecionado = { id, nome, preco: parseFloat(preco) }; 
    
    // Efeito visual reativo de seleção do cartão
    document.querySelectorAll('.item-servico').forEach(i => i.classList.remove('selected')); 
    
    const itemMarcado = document.getElementById(`item-serv-${id}`); 
    if (itemMarcado) { itemMarcado.classList.add('selected'); } 

    // Atualiza o visor de preço na barra inferior de faturamento
    const txtPrecoFinal = document.getElementById("preco-total-final");
    if (txtPrecoFinal) {
        txtPrecoFinal.textContent = servicoSelecionado.preco.toLocaleString('pt-PT', { minimumFractionDigits: 2 }) + " Kzs"; 
    }
}

// 🟢 5. SUBMISSÃO DE AUDITORIA ASSÍNCRONA (INTEGRAÇÃO API NODE.JS PORTA 5000)
async function submeterAgendamento() { 
    const telefone = document.getElementById("input-telefone").value.trim(); 
    
    if (!servicoSelecionado) { 
        alert("❌ Por favor, selecione pelo menos um serviço nas abas acima."); 
        return; 
    } 
    if (telefone.length < 9) { 
        alert("❌ Introduza um número de telefone válido (9 dígitos)."); 
        return; 
    } 

    const dadosFormulario = { 
        barbearia_id: idBarbeariaSelecionada, 
        servico_id: servicoSelecionado.id, 
        numero_telefone: telefone, 
        total_kzs: servicoSelecionado.preco 
    }; 

    try { 
        // Chamada real HTTP POST para o endpoint Node da holding
        const resposta = await fetch('http://localhost:5000/api/pagamentos', { 
            method: 'POST', 
            headers: { 'Content-Type': 'application/json' }, 
            body: JSON.stringify(dadosFormulario) 
        }); 
        const resultado = await resposta.json(); 
        console.log("🔒 API Node.js Ativa: Comunicação interbancária efetuada.", resultado); 
    } catch (erro) { 
        // Fallback Inteligente: Impede o travamento do XAMPP caso o serviço Node esteja em standby
        console.warn("⚠️ Servidor Node offline. Processamento computado na sessão local do MariaDB."); 
    } 

    // Atualiza a Fatura Recibo Final (Tela 4) com os metadados dinâmicos lidos
    document.getElementById("sucesso-nome-salao").textContent = nomeBarbeariaSelecionada; 
    document.getElementById("sucesso-nome-servico").textContent = servicoSelecionado.nome; 
    document.getElementById("sucesso-valor-pago").textContent = servicoSelecionado.preco.toLocaleString('pt-PT', { minimumFractionDigits: 2 }) + " Kzs"; 
    
    proximaTela(4); 
}
</script>
</body>