// Base de dados simulada para preços e sub-serviços
const tabelaPrecos = {
    "Cortes de Cabelo": [
        { nome: "Corte Simples", preco: "1.500,00 kz" },
        { nome: "Corte + Barba", preco: "2.500,00 kz" }
    ],
    "Pinturas de Cabelo": [
        { nome: "Pintura Completa", preco: "5.000,00 kz" },
        { nome: "Madeixas", preco: "3.500,00 kz" }
    ],
    "Sobrancelhas": [
        { nome: "Design Simples", preco: "800,00 kz" },
        { nome: "Design com Henna", preco: "1.500,00 kz" }
    ],
    "Maquilhagens": [
        { nome: "Make Social", preco: "6.000,00 kz" },
        { nome: "Make Noiva", preco: "15.000,00 kz" }
    ],
    "Tratamentos Capilares": [
        { nome: "Hidratação Profunda", preco: "4.000,00 kz" },
        { nome: "Selagem", preco: "8.000,00 kz" }
    ]
};

let servicoSelecionadoGlobal = "";
let precoSelecionadoGlobal = "";

// Função para alternar de forma limpa entre as seções
function irParaSecao(idSecao) {
    const secoes = document.querySelectorAll('.aba-conteudo');
    secoes.forEach(secao => {
        secao.classList.add('hidden');
    });
    
    const secaoAlvo = document.getElementById(idSecao);
    if (secaoAlvo) {
        secaoAlvo.classList.remove('hidden');
    }
}

// PASSO 1 -> PASSO 2: Ao clicar em uma Categoria, carrega os Tipos de Serviços específicos
function selecionarCategoria(categoria) {
    document.getElementById('titulo-categoria-selecionada').innerText = categoria;
    const listaSubservicos = document.getElementById('lista-subservicos');
    listaSubservicos.innerHTML = ""; // Limpa os botões antigos

    if (tabelaPrecos[categoria]) {
        tabelaPrecos[categoria].forEach(item => {
            const botao = document.createElement('button');
            botao.className = 'aba-item';
            botao.innerHTML = `<strong>${item.nome}</strong><br><small>${item.preco}</small>`;
            botao.onclick = function() {
                abrirFormularioPreenchimento(item.nome, item.preco);
            };
            listaSubservicos.appendChild(botao);
        });
    }
    irParaSecao('secao-tipos-servicos');
}

// PASSO 2 -> PASSO 3: Ao clicar no Tipo de Serviço, carrega o Preço e abre o Formulário
function abrirFormularioPreenchimento(nomeServico, precoServico) {
    servicoSelecionadoGlobal = nomeServico;
    precoSelecionadoGlobal = precoServico;

    document.getElementById('nome-servico').innerText = nomeServico;
    document.getElementById('valor-servico').innerText = precoServico;

    irParaSecao('secao-formulario-agendamento');
}

// PASSO 3: Captura os dados preenchidos e simula o salvamento na Base de Dados
function guardarNoBancoDeDados(event) {
    event.preventDefault(); // Impede a página de recarregar

    const cliente = document.getElementById('inputNomeCliente').value;
    const funcionario = document.getElementById('inputFuncionario').value;
    const data = document.getElementById('inputDataServico').value;
    const hora = document.getElementById('inputHoraServico').value;

    // Objeto pronto para envio à API ou Back-end
    const payloadAgendamento = {
        cliente: cliente,
        funcionario: funcionario,
        data: data,
        hora: hora,
        servico: servicoSelecionadoGlobal,
        preco: precoSelecionadoGlobal
    };

    console.log("Gravando na Base de Dados:", payloadAgendamento);

    // Mensagem de sucesso ao usuário
    alert(`Sucesso! O agendamento de ${cliente} para o serviço de "${servicoSelecionadoGlobal}" foi guardado com sucesso na Base de Dados!`);
    
    // Reseta o formulário e volta para a Home
    document.getElementById('formAgendamento').reset();
    irParaSecao('secao-home');
}

// Menu sanduíche para telas mobile
function toggleMenu() {
    const menu = document.getElementById('menuLateral');
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}