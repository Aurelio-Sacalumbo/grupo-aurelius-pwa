<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <title>Aurelius Jbs - Plataforma Profissional</title>

    <!-- SCRIPT DO GOOGLE ADSENSE REAL -->
    <script src="https://googlesyndication.com/"></script>

    <style>
        /* CONFIGURAÇÕES GLOBAIS DE ALTO NÍVEL */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            background: rgb(235, 252, 237);
            text-align: center;
            padding-bottom: 40px;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* BARRA DE NAVEGAÇÃO PROFISSIONAL */

        nav {
            padding: 20px 15px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1000;
        }

        .logo {
            color: #340aee;
            font-size: 24px;
            text-align: left;
            cursor: pointer;
        }

        .logo span {
            color: red;
        }

        .ul {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .ul li {
            font-size: 14px;
            border: 1px solid #0e373f;
            border-radius: 20px;
            background: rgb(2, 162, 255);
            font-weight: bold;
        }

        .ul li a {
            color: rgb(10, 6, 6);
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
        }

        .ul li:hover {
            background: #03cff8c7;
        }

        .Menu-Icon {
            display: none;
            cursor: pointer;
        }

        .Menu-Icon svg {
            width: 30px;
            height: 30px;
            fill: #14424b;
        }

        @media(max-width: 1000px) {
            .Menu-Icon {
                display: block;
            }
            .ul {
                position: fixed;
                width: 70%;
                height: 100%;
                top: 0;
                left: 100%;
                background: rgb(25, 37, 73);
                transition: 0.4s ease;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 80px;
                gap: 15px;
                z-index: 999;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
            }
            .ul li {
                width: 85%;
                font-size: 18px;
                margin: 0 auto;
                background: rgba(14, 55, 63, 0.6);
                border-radius: 10px;
            }
            .ul li a {
                color: aliceblue;
                width: 100%;
                padding: 12px;
            }
            .ul.ativo {
                left: 30%;
            }
        }

        /* LAYOUT DE GRIDS E PAINÉIS */

        .Principal,
        .grid-container {
            background: #a9cbf0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 20px auto;
            padding: 15px;
            width: 92%;
            border-radius: 16px;
        }

        .aba-item {
            width: 100%;
            min-height: 80px;
            background-color: #14424b;
            color: rgb(255, 255, 255);
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            border: none;
            font-size: 15px;
            display: flex;
            flex-direction: column !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .aba-item:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .hidden,
        #area-impressao-relatorio.hidden {
            display: none !important;
        }

        .preco-container {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin: 20px auto;
            width: 92%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .preco-container h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .preco-container p {
            font-size: 26px;
            font-weight: bold;
        }

        .btn-voltar {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px auto;
            cursor: pointer;
            display: block;
        }

        .painel-freemium {
            background: #fff;
            border: 2px dashed #340aee;
            border-radius: 15px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: left;
        }

        .badge-premium {
            background: #ffc107;
            color: #000;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            float: right;
        }

        .btn-upgrade {
            background: #ffc107;
            color: black;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        /* ESTILIZAÇÃO DO GATEWAY DE PAGAMENTO ANGOLANO */

        .gateway-multicaixa {
            background: #f8f9fa;
            border: 2px solid #0056b3;
            border-radius: 12px;
            padding: 15px;
            margin: 15px auto;
            width: 92%;
            text-align: left;
            display: none;
        }

        .linha-recibo {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 4px;
        }

        .bloco-publicidade {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 12px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: center;
            display: none;
        }

        .tag-anuncio {
            font-size: 10px;
            color: #6c757d;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .btn-anuncio-comissao {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .patrocinadores-container {
            width: 92%;
            margin: 20px auto;
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .patrocinadores-logos {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 8px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .marca-parceina,
        .marca-parceira {
            font-style: italic;
            font-weight: bold;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-dados-imprimir {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 15px auto;
            cursor: pointer;
            display: block;
        }

        /* INTERFACE NOTIFICAÇÕES E COOKIES */

        .notificacao-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #343a40;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notificacao-toast.mostrar {
            transform: translateX(-50%) translateY(0);
        }

        .banner-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #212529;
            color: white;
            padding: 25px;
            text-align: left;
            z-index: 99999;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.4);
        }

        .btn-cookies {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            align-self: flex-end;
        }

        footer {
            background: #f5f5f5;
            border-top: 1px solid #ccc;
            padding: 15px;
            margin-top: 30px;
            font-size: 12px;
        }

        footer ul {
            display: flex;
            justify-content: center;
            gap: 15px;
            list-style: none;
            margin-bottom: 8px;
        }

        footer a {
            color: #14424b;
            font-weight: bold;
            text-decoration: none;
        }

        /* REGRAS VISUAIS DE FOTOS PROPORCIONAIS */

        .img-wrapper {
            width: 100%;
            height: 60px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            border-radius: 6px;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .input-estilizado {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .aba-galeria {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* TALÃO COURIER DE IMPRESSÃO */

        #area-impressao-relatorio {
            background: white;
            color: black;
            padding: 30px;
            text-align: left;
            max-width: 450px;
            margin: 15px auto;
            border: 1px dashed #000;
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }
            #area-impressao-relatorio,
            #area-impressao-relatorio * {
                visibility: visible !important;
            }
            #area-impressao-relatorio {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: left;
                padding: 20px;
                border: none;
            }
        }
    </style>
</head>

<body>

    <html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <title>Aurelius Jbs - Plataforma Profissional</title>

    <!-- SCRIPT DO GOOGLE ADSENSE REAL -->
    <script src="https://googlesyndication.com/"></script>

    <style>
        /* CONFIGURAÇÕES GLOBAIS DE ALTO NÍVEL */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            background: rgb(235, 252, 237);
            text-align: center;
            padding-bottom: 40px;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* BARRA DE NAVEGAÇÃO PROFISSIONAL */

        nav {
            padding: 20px 15px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1000;
        }

        .logo {
            color: #340aee;
            font-size: 24px;
            text-align: left;
            cursor: pointer;
        }

        .logo span {
            color: red;
        }

        .ul {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .ul li {
            font-size: 14px;
            border: 1px solid #0e373f;
            border-radius: 20px;
            background: rgb(2, 162, 255);
            font-weight: bold;
        }

        .ul li a {
            color: rgb(10, 6, 6);
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
        }

        .ul li:hover {
            background: #03cff8c7;
        }

        .Menu-Icon {
            display: none;
            cursor: pointer;
        }

        .Menu-Icon svg {
            width: 30px;
            height: 30px;
            fill: #14424b;
        }

        @media(max-width: 1000px) {
            .Menu-Icon {
                display: block;
            }
            .ul {
                position: fixed;
                width: 70%;
                height: 100%;
                top: 0;
                left: 100%;
                background: rgb(25, 37, 73);
                transition: 0.4s ease;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 80px;
                gap: 15px;
                z-index: 999;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
            }
            .ul li {
                width: 85%;
                font-size: 18px;
                margin: 0 auto;
                background: rgba(14, 55, 63, 0.6);
                border-radius: 10px;
            }
            .ul li a {
                color: aliceblue;
                width: 100%;
                padding: 12px;
            }
            .ul.ativo {
                left: 30%;
            }
        }

        /* LAYOUT DE GRIDS E PAINÉIS */

        .Principal,
        .grid-container {
            background: #a9cbf0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 20px auto;
            padding: 15px;
            width: 92%;
            border-radius: 16px;
        }

        .aba-item {
            width: 100%;
            min-height: 80px;
            background-color: #14424b;
            color: rgb(255, 255, 255);
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            border: none;
            font-size: 15px;
            display: flex;
            flex-direction: column !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .aba-item:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .hidden,
        #area-impressao-relatorio.hidden {
            display: none !important;
        }

        .preco-container {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin: 20px auto;
            width: 92%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .preco-container h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .preco-container p {
            font-size: 26px;
            font-weight: bold;
        }

        .btn-voltar {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px auto;
            cursor: pointer;
            display: block;
        }

        .painel-freemium {
            background: #fff;
            border: 2px dashed #340aee;
            border-radius: 15px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: left;
        }

        .badge-premium {
            background: #ffc107;
            color: #000;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            float: right;
        }

        .btn-upgrade {
            background: #ffc107;
            color: black;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        /* ESTILIZAÇÃO DO GATEWAY DE PAGAMENTO ANGOLANO */

        .gateway-multicaixa {
            background: #f8f9fa;
            border: 2px solid #0056b3;
            border-radius: 12px;
            padding: 15px;
            margin: 15px auto;
            width: 92%;
            text-align: left;
            display: none;
        }

        .linha-recibo {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 4px;
        }

        .bloco-publicidade {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 12px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: center;
            display: none;
        }

        .tag-anuncio {
            font-size: 10px;
            color: #6c757d;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .btn-anuncio-comissao {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .patrocinadores-container {
            width: 92%;
            margin: 20px auto;
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .patrocinadores-logos {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 8px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .marca-parceina,
        .marca-parceira {
            font-style: italic;
            font-weight: bold;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-dados-imprimir {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 15px auto;
            cursor: pointer;
            display: block;
        }

        /* INTERFACE NOTIFICAÇÕES E COOKIES */

        .notificacao-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #343a40;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notificacao-toast.mostrar {
            transform: translateX(-50%) translateY(0);
        }

        .banner-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #212529;
            color: white;
            padding: 25px;
            text-align: left;
            z-index: 99999;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.4);
        }

        .btn-cookies {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            align-self: flex-end;
        }

        footer {
            background: #f5f5f5;
            border-top: 1px solid #ccc;
            padding: 15px;
            margin-top: 30px;
            font-size: 12px;
        }

        footer ul {
            display: flex;
            justify-content: center;
            gap: 15px;
            list-style: none;
            margin-bottom: 8px;
        }

        footer a {
            color: #14424b;
            font-weight: bold;
            text-decoration: none;
        }

        /* REGRAS VISUAIS DE FOTOS PROPORCIONAIS */

        .img-wrapper {
            width: 100%;
            height: 60px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            border-radius: 6px;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .input-estilizado {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .aba-galeria {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* TALÃO COURIER DE IMPRESSÃO */

        #area-impressao-relatorio {
            background: white;
            color: black;
            padding: 30px;
            text-align: left;
            max-width: 450px;
            margin: 15px auto;
            border: 1px dashed #000;
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }
            #area-impressao-relatorio,
            #area-impressao-relatorio * {
                visibility: visible !important;
            }
            #area-impressao-relatorio {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: left;
                padding: 20px;
                border: none;
            }
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGAÇÃO -->
    <nav>
        <a href="Capaa.html">
            <img width="50" src="images (18).png" alt="">
        </a>
        <h1 class="logo" onclick="irParaSecao('home')">
            <strong>
                <u>AURE
                    <span>LIUS</span>
                </u>
                <h6>Salão de Beleza e Barbearia</h6>
            </strong>
        </h1>

        <ul class="ul" id="menuLateral">
            <li>
                <a href="#" onclick="irParaSecao('home')">Home</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('servicos')">Serviços</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('photos')">Photos</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('funcionarios')">Funcionários</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('termos')">Termos & Privacidade</a>
            </li>
        </ul>

        <div class="Menu-Icon" onclick="toggleMenu()">
            <svg viewBox="0 0 100 80" width="30" height="30">
                <rect width="100" height="15" rx="8"></rect>
                <rect y="30" width="100" height="15" rx="8"></rect>
                <rect y="60" width="100" height="15" rx="8"></rect>
            </svg>
        </div>
    </nav>

    <!-- FORMULÁRIO DE ATENDIMENTO GLOBAL COM PLACEHOLDERS E VALIDAÇÃO -->
    <div class="painel-freemium" id="dadosAgendamento" style="border: 1px solid #14424b;">
        <h4 style="color: #14424b; margin-bottom: 12px;">Dados de Atendimento da Sessão</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">
            <div>
                <input type="text" id="inputNomeCliente" placeholder="Nome do Cliente (Obrigatório)" class="input-estilizado" oninput="validarFormularioAgendamento()">
            </div>
            <div>
                <select id="inputFuncionario" class="input-estilizado" onchange="validarFormularioAgendamento()">
                    <option value="" disabled selected>Selecione o Profissional (Obrigatório)</option>
                    <option value="Mestre Carlos">Mestre Carlos (Barba & Linhas)</option>
                    <option value="Cabeleireira Ana">Cabeleireira Ana (Pinturas & Mechas)</option>
                    <option value="Estilista Mateus">Estilista Mateus (Cortes Modernos)</option>
                    <option value="Manicure Sofia">Manicure Sofia (Unhas de Gel)</option>
                </select>
            </div>
            <div>
                <input type="date" id="inputDataServico" class="input-estilizado" onchange="validarFormularioAgendamento()">
            </div>
            <div>
                <input type="time" id="inputHoraServico" class="input-estilizado" onchange="validarFormularioAgendamento()">
            </div>
        </div>
    </div>

    <!-- GATEWAY DE CHECKOUT COM VALIDAÇÃO DE TELEFONE DE ANGOLA -->
    <div class="gateway-multicaixa" id="checkoutGateway">
        <h4 style="margin-bottom: 12px; color: #0056b3; text-align:center;">Finalizar Pagamento do Serviço Selecionado</h4>

        <div style="display:flex; gap:10px; margin-bottom:15px;">
            <button onclick="mudarMetodoPagamento('express')" style="flex:1; padding:10px; border:none; background:#007bff; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">MCX Express</button>
            <button onclick="mudarMetodoPagamento('unitel')" style="flex:1; padding:10px; border:none; background:#ff6600; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">Unitel Money</button>
            <button onclick="mudarMetodoPagamento('ref')" style="flex:1; padding:10px; border:none; background:#6c757d; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">Referência ATM</button>
        </div>




        <!-- Ecrã Multicaixa Express -->
        <div id="pay-express">
            <p style="font-size:13px; margin-bottom:8px; color:#555;">Introduza o telemóvel do
                <strong>Multicaixa Express</strong> (9 dígitos angolanos começados por 9):</p>
            <input type="tel" id="telExpress" placeholder="Ex: 923456789" class="input-estilizado" style="margin-bottom:12px;" oninput="validarTelefoneAngola('express')">
            <button id="btnPagarExpress" onclick="simularTransacaoInstantanea('Multicaixa Express')" style="width:100%; padding:11px; background:#6c757d; color:#fff; border:none; font-weight:bold; border-radius:6px; cursor:not-allowed;"
                disabled>Pagar via Express</button>
        </div>

        <!-- Ecrã Unitel Money -->
        <div id="pay-unitel" style="display:none;">
            <p style="font-size:13px; margin-bottom:8px; color:#555;">Introduza o número de telefone do
                <strong>Unitel Money</strong> (9 dígitos angolanos começados por 9):</p>
            <input type="tel" id="telUnitel" placeholder="Ex: 923456789" class="input-estilizado" style="margin-bottom:12px;" oninput="validarTelefoneAngola('unitel')">
            <button id="btnPagarUnitel" onclick="simularTransacaoInstantanea('Unitel Money')" style="width:100%; padding:11px; background:#6c757d; color:#fff; border:none; font-weight:bold; border-radius:6px; cursor:not-allowed;"
                disabled>Confirmar no Unitel Money</button>
        </div>

        <!-- Ecrã Referência ATM -->
        <div id="pay-ref" style="display:none;">
            <div class="linha-recibo">
                <span>Entidade Provedora:</span>
                <strong>00942 (ProxyPay)</strong>
            </div>
            <div class="linha-recibo">
                <span>Referência Monte:</span>
                <strong id="refGerada">999 123 456</strong>
            </div>
            <div class="linha-recibo">
                <span>Total do Serviço:</span>
                <strong id="refValorTotal">0,00 kz</strong>
            </div>
            <p style="font-size: 11px; color: #dc3545; margin-top: 5px; text-align:center;">Disponível para liquidação imediata em qualquer caixa ATM em Angola.</p>
        </div>
    </div>

    <!-- SEÇÃO HOME -->
    <div id="secao-home" class="aba-conteudo">
        <div class="painel-freemium" id="blocoFreemium">
            <span class="badge-premium" id="statusBadge">CONTA GRÁTIS</span>
            <h4 id="tituloFreemium">Acesso Freemium Ativo</h4>
            <p style="font-size: 13px; color: #555; margin-top: 4px;" id="descFreemium">Subscreva o plano Premium para ocultar anúncios de Luanda e desbloquear relatórios completos.</p>
            <button class="btn-upgrade" id="btnAcaoPremium" onclick="gerarFaturaPremium()">Seja Premium - 2.500 kz/mês</button>
        </div>

        <div class="bloco-publicidade" id="blocoAnuncios">
            <span class="tag-anuncio">Oferta Exclusiva Afiliada</span>
            <strong id="anuncioTitulo">Carregando produto recomendado...</strong>
            <p id="anuncioTexto" style="font-size: 13px; margin: 5px 0; color: #444;"></p>
            <button class="btn-anuncio-comissao" id="anuncioLink" onclick="redirecionarAfiliadoReal()">Comprar com Desconto</button>
        </div>
    </div>





    <!-- SEÇÃO SERVIÇOS (RECURSO INTERATIVO DE COMPRA E PREÇOS) -->
    <div id="secao-servicos" class="aba-conteudo hidden">
        <div id="caixa-preco" class="preco-container hidden">
            <h3 id="nome-servico">Serviço</h3>
            <p id="valor-servico">0,00 kz</p>
            <span id="faturamentoStatus" style="font-size:12px; display:block; margin-top:5px; font-weight:bold;"></span>
        </div>

        <!-- NÍVEL 1: CATEGORIAS PRINCIPAIS -->
        <div id="nivel1">
            <div class="Principal">
                <button class="aba-item" onclick="mostrarNivel2('cortes')">Cortes de Cabelo</button>
                <button class="aba-item" onclick="mostrarNivel2('pinturas')">Pinturas de Cabelo</button>
                <button class="aba-item" onclick="mostrarNivel2('sobrancelhas')">Sobrancelhas</button>
                <button class="aba-item" onclick="mostrarNivel2('maquilhagem')">Maquilhagens</button>
                <button class="aba-item" onclick="mostrarNivel2('tratamentos')">Tratamentos Capilares</button>
                <button class="aba-item" onclick="mostrarNivel2('manicure')">Manicure</button>
                <button class="aba-item" onclick="mostrarNivel2('pedicure')">Pedicure</button>
            </div>
        </div>

        <!-- NÍVEL 2: SUBCATEGORIAS COMPLETAS INTERATIVAS -->
        <div id="nivel2" class="hidden">
            <button class="btn-voltar" onclick="voltarParaNivel1()">← Voltar às Categorias</button>

            <div id="sub-cortes" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Cheio', '4.500 kz')">
                    <div class="img-wrapper">
                        <img src="1776692903268.jpg">
                    </div>Corte Francês Cheio
                </button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Vazio', '4.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777201603721.jpg">
                    </div>Corte Francês Vazio
                </button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte de Crianças', '2.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777757951670.jpg">
                    </div>Corte de Crianças</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte de Adultos', '3.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777298458880.jpg">
                    </div>Corte de Adultos</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Careca', '1.500 kz')">
                    <div class="img-wrapper">
                        <img src="1777556066924.jpg">
                    </div>Careca</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Design e Corte de Barba', '2.000 kz')">
                    <div class="img-wrapper">
                        <img src="1776692182096.jpg">
                    </div>Barba</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Outros Estilos de Corte', '3.500 kz')">
                    <div class="img-wrapper">
                        <img src="1777986301625.jpg">
                    </div>Outros</button>
            </div>

            <div id="sub-pinturas" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Tintura Geral', '12.000 kz')">Tintura Geral</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Mechas / Luzes', '18.000 kz')">Mechas / Luzes</button>
            </div>

            <div id="sub-sobrancelhas" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Design Simples', '2.000 kz')">Design Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Aplicação de Henna', '4.500 kz')">Aplicação de Henna</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Sobrancelhas normal', '1.500 kz')">Sobrancelhas normal</button>
            </div>

            <div id="sub-maquilhagem" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Social', '15.000 kz')">Maquilhagem Social</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Noiva', '45.000 kz')">Maquilhagem Noiva</button>
            </div>

            <div id="sub-tratamentos" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Hidratação Profunda', '8.500 kz')">Hidratação Profunda</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Queratina / Selagem', '14.000 kz')">Queratina / Selagem</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Tratamento Antiqueda', '10.000 kz')">Tratamento Antiqueda</button>
            </div>

            <div id="sub-manicure" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Manicure Simples', '2.000 kz')">Manicure Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Aplicação Gel / Acrigel', '7.500 kz')">Aplicação Gel / Acrigel</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Manutenção de Unhas', '4.000 kz')">Manutenção de Unhas</button>
            </div>

            <div id="sub-pedicure" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Pedicure Simples', '2.500 kz')">Pedicure Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Spa Completo dos Pés', '6.000 kz')">Spa Completo dos Pés</button>
            </div>
        </div>

        <button class="btn-dados-imprimir" onclick="imprimirDados()">🖨️ Emitir Fatura de Atendimento Recibo</button>
    </div>

    <!-- SEÇÃO PHOTOS (GALERIA LOCAL DE ARMAZENAMENTO E CARREGAMENTO COMPARTILHADO) -->
    <div id="secao-photos" class="aba-conteudo hidden" style="width:92%; margin:20px auto;">
        <div class="aba-galeria">
            <h4 style="margin-bottom:10px; color:#14424b;">Galeria Dinâmica e Publicação Local</h4>
            <p style="font-size:13px; color:#666; margin-bottom:15px;">Carregue retratos de modelos para a galeria. Outros utilizadores no localhost poderão visualizar o histórico.</p>

            <div style="background:#f8f9fa; border:2px dashed #ccc; padding:20px; border-radius:8px; text-align:center;">
                <input type="file" id="inputUploadImagem" accept="image/*" style="display:none;" onchange="processarUploadImagemLocal(event)">
                <button onclick="document.getElementById('inputUploadImagem').click()" style="padding:10px 20px; background:#007bff; color:white; border:none; font-weight:bold; border-radius:6px; cursor:pointer;">Selecionar Imagem do Computador</button>
                <p id="nomeArquivoSelecionado" style="font-size:12px; margin-top:8px; color:#555; font-style:italic;">Nenhum ficheiro selecionado</p>
            </div>
        </div>

        <h5 style="text-align:left; color:#14424b; margin:15px 0 10px 0;">Retratos Publicados Novas Tendências</h5>
        <div id="muroImagensPublicas" class="grid-container" style="background:#fff; border:1px solid #ddd; padding:10px; margin:0; width:100%;">
            <div class="aba-item" style="background:#f8f9fa; color:#000;">
                <div class="img-wrapper">
                    <img src="Screenshot_20251002-123823.png">
                </div>Modelagem Curto</div>
            <div class="aba-item" style="background:#f8f9fa; color:#000;">
                <div class="img-wrapper">
                    <img src="Screenshot_2025-06-27-00-49-58-99.png">
                </div>Design Afro</div>
        </div>
    </div>

    <!-- SEÇÃO FUNCIONÁRIOS (AUDITORIA OPERACIONAL DO SALÃO) -->
    <div id="secao-funcionarios" class="aba-conteudo hidden" style="width:92%; margin:20px auto;">
        <div class="aba-galeria" style="background:linear-gradient(135deg, #14424b, #255861); color:white;">
            <h4>Painel Corporativo de Auditoria Operacional</h4>
            <p style="font-size:12px; opacity:0.9; margin-top:4px;">Gestão de equipas ativas e escala de atendimento para Luanda.</p>
        </div>
        <div class="grid-container" style="padding:0; background:transparent; width:100%;">
            <div class="aba-item">
                <strong>Mestre Hanganga</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Disponível (Cadeira 1)</span>
            </div>
            <div class="aba-item">
                <strong>Cabeleireira Ana</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Em Atendimento</span>
            </div>
            <div class="aba-item">
                <strong>Estilista Tomas</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Disponível (Cadeira 2)</span>
            </div>
            <div class="aba-item">
                <strong>Manicure Sofia</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Ausente (Folga)</span>
            </div>
        </div>
    </div>

    <!-- SEÇÃO TERMOS (CONTRATO AVANÇADO DE PRIVACIDADE E MONETIZAÇÃO) -->
    <div id="secao-termos" class="aba-conteudo hidden" style="width:92%; margin:20px auto; text-align:left;">
        <div class="aba-galeria" style="line-height:1.6; font-size:13px; color:#333;">
            <h3 style="color:#14424b; margin-bottom:10px;">Contrato de Termos de Uso e Consentimento de Dados</h3>
            <p>
                <strong>1. Recolha Comercial:</strong> Ao utilizar a plataforma Aurelius Jbs, o utilizador declara estar ciente de
                que as métricas comportamentais de cliques em serviços estéticos, escolhas de preços e relatórios financeiros
                gerados são catalogados anonimamente.</p>
            <p style="margin-top:8px;">
                <strong>2. Monetização Regionalizada:</strong> O sistema Freemium utiliza algoritmos ultra-segmentados baseados nos
                seus cliques para sugerir soluções de cosméticos parceiros (como L'Oréal Paris Angola ou Clear), gerando
                comissões residenciais estruturadas.</p>
        </div>
    </div>

    <!-- PATROCINADORES -->
    <div class="patrocinadores-container">
        <span style="font-size: 11px; color: #777; text-transform: uppercase;">Parcerias de Fornecimento Oficiais</span>
        <div class="patrocinadores-logos">
            <span class="marca-parceira">💃 Atelier Angelino Hbo, Angola</span>
            <span class="marca-parceira">🧴 Clear Distribuição</span>
            <span class="marca-parceira">✂️ BarberPro Huambo</span>
        </div>
    </div>

    <!-- BANNER DE COOKIES / PRIVACIDADE -->
    <div class="banner-cookies" id="bannerPrivacidade">
        <p>A
            <strong>Aurelius Jbs</strong> recolhe dados estatísticos de navegação anonimizados para fins publicitários e análise
            de tendências de mercado em Angola.</p>
        <button class="btn-cookies" onclick="aceitarTermosPrivacidade()">Acceptar e Permitir Rastreamento</button>
    </div>

    <!-- ÁREA DE IMPRESSÃO DO TALÃO COURIER -->
    <div id="area-impressao-relatorio" class="hidden"></div>

    <div id="toastNotificacao" class="notificacao-toast">
        <span id="toastIcone">🔔</span>
        <span id="toastTexto"></span>
    </div>

    <footer>
        <p>&copy; 2026 Aurelius Jbs. Todos os direitos reservados.</p>
    </footer>

    <!-- 1. CARREGAMENTO DOS MOTORES COMPATÍVEIS VIA CDN ALTERNATIVO UNPKG -->
    <!-- 1. Carrega o SDK Principal do Firebase (Obrigatório) -->
    <script src="https://gstatic.com"></script>

    <!-- 2. Carrega o Cloud Firestore para usar o Banco de Dados Real (Obrigatório) -->
    <script src="https://gstatic.com"></script>

    <!-- 3. Opcional: Carrega o Analytics se quiser monitorizar acessos -->
    <script src="https://gstatic.com"></script>
    <script src="https://unpkg.com"></script>
    <script src="https://unpkg.com"></script>

    <!-- ⚡ SCRIPTS DE NAVEGAÇÃO, VALIDAÇÃO E COMUNICAÇÃO GOOGLE FIRESTORE -->
    <script>
        var servicoSelecionadoAtual = {
            nome: "Nenhum selecionado",
            preco: "0,00 kz"
        };
        var dadosUsuario = {
            plano: "Freemium"
        };
        var db = null;

        // 🌟 CONFIGURAÇÃO DA SUA CONTA ATUALIZADA COM OS NOVOS CORES DA CHAVE DO PROJETO
        const firebaseConfig = {
            apiKey: "AIzaSyCTExo1LULEKMcZuAvKzzYfA6RIs7WshsE",
            authDomain: "://firebaseapp.com",
            projectId: "myapp-7f4bb",
            storageBucket: "://appspot.com",
            messagingSenderId: "814845444533",
            appId: "1:814845444533:web:43d874bf8206d20f6990ae",
            measurementId: "G-2BRHVQ6SLE"
        };

        const CONFIG_UNITEL_MONEY_API_KEY = "PLACEHOLDER_API_KEY_REAL_UNITEL_MONEY";
        const CONFIG_UNITEL_MONEY_MERCHANT_ID = "PLACEHOLDER_MERCHANT_ID_REAL";

        // CONFIGURAÇÕES OBRIGATÓRIAS DO GATEWAY DE SMS EM ANGOLA
        const CONFIG_SMS_GATEWAY_URL = "PLACEHOLDER_SMS_GATEWAY_URL_ANGOLA";
        const CONFIG_SMS_API_TOKEN = "PLACEHOLDER_SMS_API_TOKEN_VALOR";

        try {
            if (typeof firebase !== 'undefined') {
                firebase.initializeApp(firebaseConfig);
                db = firebase.firestore();
                console.log("🔥 Base de Dados Firebase ativa e ligada com sucesso ao projeto myapp-7f4bb!");
                if (document.getElementById('faturamentoStatus')) {
                    document.getElementById('faturamentoStatus').innerText = "Conectado ao Cloud Firestore Real";
                }
            } else {
                console.warn("Aviso: O script do Firebase não foi carregado na página HTML.");
            }
        } catch (e) {
            console.error("Erro na ligação à Base de Dados:", e.message);
        }
        // SISTEMA DE TROCA DE PÁGINAS DO MENU SUPERIOR
        function irParaSecao(idSecao) {
            var secoes = document.querySelectorAll('.aba-conteudo');
            secoes.forEach(s => s.classList.add('hidden'));

            var secaoAlvo = document.getElementById('secao-' + idSecao);
            if (secaoAlvo) secaoAlvo.classList.remove('hidden');

            var menu = document.getElementById('menuLateral');
            if (menu) menu.classList.remove('ativo');
        }

        function toggleMenu() {
            var menu = document.getElementById('menuLateral');
            if (menu) menu.classList.toggle('ativo');
        }

        // SISTEMA DE SUBCATEGORIAS (NÍVEL 1 E NÍVEL 2)
        function mostrarNivel2(categoria) {
            document.getElementById('nivel1').classList.add('hidden');
            document.getElementById('nivel2').classList.remove('hidden');
            var subGrupos = document.querySelectorAll('.sub-grupo');
            for (var i = 0; i < subGrupos.length; i++) {
                subGrupos[i].classList.add('hidden');
            }
            var subAlvo = document.getElementById('sub-' + categoria);
            if (subAlvo) {
                subAlvo.classList.remove('hidden');
            }
        }

        function voltarParaNivel1() {
            document.getElementById('nivel2').classList.add('hidden');
            document.getElementById('nivel1').classList.remove('hidden');
            document.getElementById('caixa-preco').classList.add('hidden');
            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "none";
        }

        function aceitarTermosPrivacidade() {
            var banner = document.getElementById('bannerPrivacidade');
            if (banner) banner.style.display = "none";
        }

        // 🔒 SISTEMA DE VALIDAÇÃO DO FORMULÁRIO SUPERIOR
        function validarFormularioAgendamento() {
            var nome = document.getElementById('inputNomeCliente').value.trim();
            var funcionario = document.getElementById('inputFuncionario').value;
            var dataServico = document.getElementById('inputDataServico').value;
            var horaServico = document.getElementById('inputHoraServico').value;

            if (nome === "" || funcionario === "" || dataServico === "" || horaServico === "") {
                return false;
            }
            return true;
        }

        // CLIQUE NO PREÇO: Exige o preenchimento total e abre o painel do Multicaixa
        function exibirPrecoFinal(nome, valor) {
            if (!validarFormularioAgendamento()) {
                dispararNotificacaoLocal("⚠️ Por favor, preencha primeiro todos os dados do Atendimento no topo!");
                return;
            }

            document.getElementById('nome-servico').innerText = nome;
            document.getElementById('valor-servico').innerText = valor;
            document.getElementById('caixa-preco').classList.remove('hidden');

            servicoSelecionadoAtual.nome = nome;
            servicoSelecionadoAtual.preco = valor;

            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "block";

            var refValorTotal = document.getElementById('refValorTotal');
            if (refValorTotal) refValorTotal.innerText = valor;

            var refCampo = document.getElementById('refGerada');
            var refProvedor = Math.floor(100000000 + Math.random() * 900000000).toString().replace(
                /(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
            if (refCampo) refCampo.innerText = refProvedor;
        }

        function gerarFaturaPremium() {
            if (!validarFormularioAgendamento()) {
                dispararNotificacaoLocal("⚠️ Preencha os dados do atendimento antes de comprar o plano Premium!");
                return;
            }
            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "block";

            var refValorTotal = document.getElementById('refValorTotal');
            if (refValorTotal) refValorTotal.innerText = "2.500,00 kz";

            var refCampo = document.getElementById('refGerada');
            var refProvedor = Math.floor(100000000 + Math.random() * 900000000).toString().replace(
                /(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
            if (refCampo) refCampo.innerText = refProvedor;

            dispararNotificacaoLocal("Fatura Premium gerada! Pague 2.500 kz via Express ou Referência.");
        }

        function mudarMetodoPagamento(metodo) {
            var expressDiv = document.getElementById('pay-express');
            var unitelDiv = document.getElementById('pay-unitel');
            var refDiv = document.getElementById('pay-ref');

            if (expressDiv) expressDiv.style.display = metodo === 'express' ? 'block' : 'none';
            if (unitelDiv) unitelDiv.style.display = metodo === 'unitel' ? 'block' : 'none';
            if (refDiv) refDiv.style.display = metodo === 'ref' ? 'block' : 'none';
        }

        // 🔒 SISTEMA DE VALIDAÇÃO DE TELEFONE DE ANGOLA (9 DÍGITOS E COMEÇANDO POR 9)
        function validarTelefoneAngola(tipo) {
            var inputTel = document.getElementById(tipo === 'express' ? 'telExpress' : 'telUnitel');
            var btnPagar = document.getElementById(tipo === 'express' ? 'btnPagarExpress' : 'btnPagarUnitel');

            if (!inputTel || !btnPagar) return;

            var numero = inputTel.value.trim();
            var regraAngola = /^9\d{8}$/;

            if (regraAngola.test(numero)) {
                btnPagar.disabled = false;
                btnPagar.style.background = tipo === 'express' ? '#28a745' : '#ff6600';
                btnPagar.style.cursor = "pointer";
            } else {
                btnPagar.disabled = true;
                btnPagar.style.background = "#6c757d";
                btnPagar.style.cursor = "not-allowed";
            }
        }

        // 🌟 REPARADO: SE CLICAR EM PAGAR COM O NÚMERO CORRETO, ENVIA E MOSTRA O AVISO NO ECRÃ
        function simularTransacaoInstantanea(plataforma) {
            if (document.getElementById('faturamentoStatus')) {
                document.getElementById('faturamentoStatus').innerText = "⏳ Gravando dados no Firebase...";
                document.getElementById('faturamentoStatus').style.color = "orange";
            }

            var nomeCliente = document.getElementById('inputNomeCliente').value || "Consumidor Local";
            var funcionario = document.getElementById('inputFuncionario').value;
            var dataServico = document.getElementById('inputDataServico').value || new Date().toLocaleDateString();
            var horaServico = document.getElementById('inputHoraServico').value || new Date().toLocaleTimeString();

            // Gravação assíncrona na coleção estruturada "Dados"
            if (db) {
                var idVendaUnica = "venda-" + Date.now();

                db.collection("Dados").doc(idVendaUnica).set({
                        cliente: nomeCliente,
                        barbeiro: funcionario,
                        servico: servicoSelecionadoAtual.nome,
                        preco: servicoSelecionadoAtual.preco,
                        metodoPagamento: plataforma,
                        dataAgendada: dataServico,
                        horaAgendada: horaServico,
                        timestamp: firebase.firestore.FieldValue.serverTimestamp()
                    })
                    .then(function () {
                        console.log("✅ Conexão estabelecida e gravada no Cloud Firestore!");

                        if (document.getElementById('faturamentoStatus')) {
                            document.getElementById('faturamentoStatus').innerText =
                                "✅ Conectado e Gravado no Cloud Firestore!";
                            document.getElementById('faturamentoStatus').style.color = "#fff";
                        }

                        // Notificação Toast em conformidade total com o pedido:
                        dispararNotificacaoLocal("🎉 O seu pagamento via " + plataforma +
                            " encontra-se na base de dados do Google Firebase!");

                        setTimeout(function () {
                            var gateway = document.getElementById('checkoutGateway');
                            if (gateway) gateway.style.display = "none";
                        }, 2500);
                    })
                    .catch(function (error) {
                        console.error("Erro ao gravar dados na nuvem:", error.message);
                    });
            }
        }

        // CARREGAMENTO DE IMAGENS E INJEÇÃO VISUAL NA GALERIA LOCAL
        function processarUploadImagemLocal(event) {
            var arquivo = event.target.files;
            if (!arquivo || arquivo.length === 0) return;

            document.getElementById('nomeArquivoSelecionado').innerText = arquivo[0].name + " (A processar...)";

            var leitor = new FileReader();
            leitor.onload = function (e) {
                var urlImagemBase64 = e.target.result;

                var novaAbasFoto = document.createElement('div');
                novaAbasFoto.className = "aba-item";
                novaAbasFoto.style.background = "#f8f9fa";
                novaAbasFoto.style.color = "#000";
                novaAbasFoto.innerHTML = "<div class='img-wrapper'><img src='" + urlImagemBase64 +
                    "'></div>Novo Estilo";

                var muro = document.getElementById('muroImagensPublicas');
                if (muro) {
                    muro.insertBefore(novaAbasFoto, muro.firstChild);
                    document.getElementById('nomeArquivoSelecionado').innerText = "✅ Publicado com sucesso!";
                    dispararNotificacaoLocal("📸 Foto adicionada à galeria de tendências!");
                }
            };
            leitor.readAsDataURL(arquivo[0]);
        }

        // TOAST DE ALERTA COM NOMES DE VARIÁVEIS EM PORTUGUÊS CORRIGIDOS (LINHA 662 FIX)
        function dispararNotificacaoLocal(mensagem) {
            var toast = document.getElementById('toastNotificacao');
            var texto = document.getElementById('toastTexto');
            if (toast && texto) {
                texto.innerText = mensagem; // Nome da variável unificado para 'mensagem'
                toast.classList.add('mostrar');
                setTimeout(function () {
                    toast.classList.remove('mostrar');
                }, 5000);
            }
        }

        // IMPRESSÃO DE TALÃO EXCLUSIVO DE ATENDIMENTO
        function imprimirDados() {
            var area = document.getElementById('area-impressao-relatorio');
            if (!area) return;

            var nomeCliente = document.getElementById('inputNomeCliente').value || "Consumidor Final";
            var funcionario = document.getElementById('inputFuncionario').value || "Não selecionado";
            var dataServico = document.getElementById('inputDataServico').value || new Date().toLocaleDateString();
            var horaServico = document.getElementById('inputHoraServico').value || new Date().toLocaleTimeString();

            var htmlTalao =
                "<div style='text-align:center; font-weight:bold;'><h2>AURELIUS JBS</h2><p>Luanda - Angola</p><p>Recibo de Atendimento</p></div>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<p><strong>CLIENTE:</strong> " + nomeCliente + "</p>";
            htmlTalao += "<p><strong>PROFISSIONAL:</strong> " + funcionario + "</p>";
            htmlTalao += "<p><strong>DATA:</strong> " + dataServico + " | <strong>HORA:</strong> " + horaServico +
                "</p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h3>DETALHE DO SERVIÇO:</h3>";
            htmlTalao += "<p>Desc: " + servicoSelecionadoAtual.nome + " -> <strong>" + servicoSelecionadoAtual.preco +
                "</strong></p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h4>TOTAL A PAGAR: " + servicoSelecionadoAtual.preco + "</h4>";
            htmlTalao +=
                "<p style='text-align:center; font-size:11px; margin-top:10px;'>Obrigado pela preferência!</p>";

            area.innerHTML = htmlTalao;
            area.classList.remove('hidden');
            window.print();
            setTimeout(function () {
                area.classList.add('hidden');
            }, 1000);
        }









        document.querySelector('.pagar-btn').addEventListener('click', async function (e) {
            e.preventDefault(); // Impede o recarregamento da página

            // Captura o número de telefone digitado no input
            const telefoneInput = document.querySelector('input[type="text"]').value.trim();

            // Configura os dados fixos do serviço selecionado na tela
            const dadosPagamento = {
                telefone: telefoneInput,
                servico: "Corte Francês Cheio",
                valor: 4500,
                metodoPagamento: "MCX Express" // Altere dinamicamente se o usuário mudar de aba
            };

            // Pequeno feedback visual imediato na tela
            const statusTexto = document.querySelector('.status-firebase') || document.createElement('p');
            statusTexto.className = 'status-firebase';
            statusTexto.innerText = "A processar pagamento... Aguarde.";
            statusTexto.style.color = "#yellow";

            try {
                // Faz a requisição POST para o servidor Express na porta 3000
                const resposta = await fetch('http://localhost:3000/api/agendamentos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dadosPagamento)
                });

                const resultado = await resposta.json();

                if (resposta.ok && resultado.sucesso) {
                    // Atualiza o texto verde informando o sucesso ao cliente
                    statusTexto.innerText = "Sucesso! Verifique o seu telemóvel para autorizar a operação.";
                    statusTexto.style.color = "#00ff00";
                    alert(
                        "Pedido enviado! Por favor, valide a transação no aplicativo Multicaixa Express do seu telemóvel."
                    );
                } else {
                    statusTexto.innerText = `Erro: ${resultado.erro}`;
                    statusTexto.style.color = "#ff0000";
                }

            } catch (erro) {
                console.error("Erro na comunicação com o servidor:", erro);
                statusTexto.innerText = "Erro ao conectar com o servidor da barbearia.";
                statusTexto.style.color = "#ff0000";
            }
        });
    </script>
</body>

</html>;
                novaAbasFoto.className = "aba-item";
                novaAbasFoto.style.background = "#f8f9fa";
                novaAbasFoto.style.color = "#000";
                novaAbasFoto.innerHTML = "<div class='img-wrapper'><img src='" + urlImagemBase64 +
                    "'></div>Novo Estilo";

                var muro = document.getElementById('muroImagensPublicas');
                if (muro) {
                    muro.insertBefore(novaAbasFoto, muro.firstChild);
                    document.getElementById('nomeArquivoSelecionado').innerText = "✅ Publicado com sucesso!";
                    dispararNotificacaoLocal("📸 Foto adicionada à galeria de tendências!");
                }
            };
            leitor.readAsDataURL(arquivo[0]);
        }

        // TOAST DE ALERTA COM NOMES DE VARIÁVEIS EM PORTUGUÊS CORRIGIDOS (LINHA 662 FIX)
        function dispararNotificacaoLocal(mensagem) {
            var toast = document.getElementById('toastNotificacao');
            var texto = document.getElementById('toastTexto');
            if (toast && texto) {
                texto.innerText = mensagem; // Nome da variável unificado para 'mensagem'
                toast.classList.add('mostrar');
                setTimeout(function () {
                    toast.classList.remove('mostrar');
                }, 5000);
            }
        }

        // IMPRESSÃO DE TALÃO EXCLUSIVO DE ATENDIMENTO
        function imprimirDados() {
            var area = document.getElementById('area-impressao-relatorio');
            if (!area) return;

            var nomeCliente = document.getElementById('inputNomeCliente').value || "Consumidor Final";
            var funcionario = document.getElementById('inputFuncionario').value || "Não selecionado";
            var dataServico = document.getElementById('inputDataServico').value || new Date().toLocaleDateString();
            var horaServico = document.getElementById('inputHoraServico').value || new Date().toLocaleTimeString();

            var htmlTalao =
                "<div style='text-align:center; font-weight:bold;'><h2>AURELIUS JBS</h2><p>Luanda - Angola</p><p>Recibo de Atendimento</p></div>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<p><strong>CLIENTE:</strong> " + nomeCliente + "</p>";
            htmlTalao += "<p><strong>PROFISSIONAL:</strong> " + funcionario + "</p>";
            htmlTalao += "<p><strong>DATA:</strong> " + dataServico + " | <strong>HORA:</strong> " + horaServico +
                "</p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h3>DETALHE DO SERVIÇO:</h3>";
            htmlTalao += "<p>Desc: " + servicoSelecionadoAtual.nome + " -> <strong>" + servicoSelecionadoAtual.preco +
                "</strong></p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h4>TOTAL A PAGAR: " + servicoSelecionadoAtual.preco + "</h4>";
            htmlTalao +=
                "<p style='text-align:center; font-size:11px; margin-top:10px;'>Obrigado pela preferência!</p>";

            area.innerHTML = htmlTalao;
            area.classList.remove('hidden');
            window.print();
            setTimeout(function () {
                area.classList.add('hidden');
            }, 1000);
        }









        document.querySelector('.pagar-btn').addEventListener('click', async function (e) {
            e.preventDefault(); // Impede o recarregamento da página

            // Captura o número de telefone digitado no input
            const telefoneInput = document.querySelector('input[type="text"]').value.trim();

            // Configura os dados fixos do serviço selecionado na tela
            const dadosPagamento = {
                telefone: telefoneInput,
                servico: "Corte Francês Cheio",
                valor: 4500,
                metodoPagamento: "MCX Express" // Altere dinamicamente se o usuário mudar de aba
            };

            // Pequeno feedback visual imediato na tela
            const statusTexto = document.querySelector('.status-firebase') || document.createElement('p');
            statusTexto.className = 'status-firebase';
            statusTexto.innerText = "A processar pagamento... Aguarde.";
            statusTexto.style.color = "#yellow";

            try {
                // Faz a requisição POST para o servidor Express na porta 3000
                const resposta = await fetch('http://localhost:3000/api/agendamentos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dadosPagamento)
                });

                const resultado = await resposta.json();

                if (resposta.ok && resultado.sucesso) {
                    // Atualiza o texto verde informando o sucesso ao cliente
                    statusTexto.innerText = "Sucesso! Verifique o seu telemóvel para autorizar a operação.";
                    statusTexto.style.color = "#00ff00";
                    alert(
                        "Pedido enviado! Por favor, valide a transação no aplicativo Multicaixa Express do seu telemóvel."
                    );
                } else {
                    statusTexto.innerText = `Erro: ${resultado.erro}`;
                    statusTexto.style.color = "#ff0000";
                }

            } catch (erro) {
                console.error("Erro na comunicação com o servidor:", erro);
                statusTexto.innerText = "Erro ao conectar com o servidor da barbearia.";
                statusTexto.style.color = "#ff0000";
            }
        });
    </script>
</body>

</html><html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <title>Aurelius Jbs - Plataforma Profissional</title>

    <!-- SCRIPT DO GOOGLE ADSENSE REAL -->
    <script src="https://googlesyndication.com/"></script>

    <style>
        /* CONFIGURAÇÕES GLOBAIS DE ALTO NÍVEL */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            background: rgb(235, 252, 237);
            text-align: center;
            padding-bottom: 40px;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* BARRA DE NAVEGAÇÃO PROFISSIONAL */

        nav {
            padding: 20px 15px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1000;
        }

        .logo {
            color: #340aee;
            font-size: 24px;
            text-align: left;
            cursor: pointer;
        }

        .logo span {
            color: red;
        }

        .ul {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .ul li {
            font-size: 14px;
            border: 1px solid #0e373f;
            border-radius: 20px;
            background: rgb(2, 162, 255);
            font-weight: bold;
        }

        .ul li a {
            color: rgb(10, 6, 6);
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
        }

        .ul li:hover {
            background: #03cff8c7;
        }

        .Menu-Icon {
            display: none;
            cursor: pointer;
        }

        .Menu-Icon svg {
            width: 30px;
            height: 30px;
            fill: #14424b;
        }

        @media(max-width: 1000px) {
            .Menu-Icon {
                display: block;
            }
            .ul {
                position: fixed;
                width: 70%;
                height: 100%;
                top: 0;
                left: 100%;
                background: rgb(25, 37, 73);
                transition: 0.4s ease;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 80px;
                gap: 15px;
                z-index: 999;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
            }
            .ul li {
                width: 85%;
                font-size: 18px;
                margin: 0 auto;
                background: rgba(14, 55, 63, 0.6);
                border-radius: 10px;
            }
            .ul li a {
                color: aliceblue;
                width: 100%;
                padding: 12px;
            }
            .ul.ativo {
                left: 30%;
            }
        }

        /* LAYOUT DE GRIDS E PAINÉIS */

        .Principal,
        .grid-container {
            background: #a9cbf0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 20px auto;
            padding: 15px;
            width: 92%;
            border-radius: 16px;
        }

        .aba-item {
            width: 100%;
            min-height: 80px;
            background-color: #14424b;
            color: rgb(255, 255, 255);
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            border: none;
            font-size: 15px;
            display: flex;
            flex-direction: column !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .aba-item:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .hidden,
        #area-impressao-relatorio.hidden {
            display: none !important;
        }

        .preco-container {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin: 20px auto;
            width: 92%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .preco-container h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .preco-container p {
            font-size: 26px;
            font-weight: bold;
        }

        .btn-voltar {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px auto;
            cursor: pointer;
            display: block;
        }

        .painel-freemium {
            background: #fff;
            border: 2px dashed #340aee;
            border-radius: 15px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: left;
        }

        .badge-premium {
            background: #ffc107;
            color: #000;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            float: right;
        }

        .btn-upgrade {
            background: #ffc107;
            color: black;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        /* ESTILIZAÇÃO DO GATEWAY DE PAGAMENTO ANGOLANO */

        .gateway-multicaixa {
            background: #f8f9fa;
            border: 2px solid #0056b3;
            border-radius: 12px;
            padding: 15px;
            margin: 15px auto;
            width: 92%;
            text-align: left;
            display: none;
        }

        .linha-recibo {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 4px;
        }

        .bloco-publicidade {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 12px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: center;
            display: none;
        }

        .tag-anuncio {
            font-size: 10px;
            color: #6c757d;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .btn-anuncio-comissao {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .patrocinadores-container {
            width: 92%;
            margin: 20px auto;
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .patrocinadores-logos {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 8px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .marca-parceina,
        .marca-parceira {
            font-style: italic;
            font-weight: bold;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-dados-imprimir {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 15px auto;
            cursor: pointer;
            display: block;
        }

        /* INTERFACE NOTIFICAÇÕES E COOKIES */

        .notificacao-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #343a40;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notificacao-toast.mostrar {
            transform: translateX(-50%) translateY(0);
        }

        .banner-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #212529;
            color: white;
            padding: 25px;
            text-align: left;
            z-index: 99999;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.4);
        }

        .btn-cookies {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            align-self: flex-end;
        }

        footer {
            background: #f5f5f5;
            border-top: 1px solid #ccc;
            padding: 15px;
            margin-top: 30px;
            font-size: 12px;
        }

        footer ul {
            display: flex;
            justify-content: center;
            gap: 15px;
            list-style: none;
            margin-bottom: 8px;
        }

        footer a {
            color: #14424b;
            font-weight: bold;
            text-decoration: none;
        }

        /* REGRAS VISUAIS DE FOTOS PROPORCIONAIS */

        .img-wrapper {
            width: 100%;
            height: 60px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            border-radius: 6px;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .input-estilizado {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .aba-galeria {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* TALÃO COURIER DE IMPRESSÃO */

        #area-impressao-relatorio {
            background: white;
            color: black;
            padding: 30px;
            text-align: left;
            max-width: 450px;
            margin: 15px auto;
            border: 1px dashed #000;
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }
            #area-impressao-relatorio,
            #area-impressao-relatorio * {
                visibility: visible !important;
            }
            #area-impressao-relatorio {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: left;
                padding: 20px;
                border: none;
            }
        }
    </style>
</head>

<body>

    <html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <title>Aurelius Jbs - Plataforma Profissional</title>

    <!-- SCRIPT DO GOOGLE ADSENSE REAL -->
    <script src="https://googlesyndication.com/"></script>

    <style>
        /* CONFIGURAÇÕES GLOBAIS DE ALTO NÍVEL */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            background: rgb(235, 252, 237);
            text-align: center;
            padding-bottom: 40px;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* BARRA DE NAVEGAÇÃO PROFISSIONAL */

        nav {
            padding: 20px 15px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1000;
        }

        .logo {
            color: #340aee;
            font-size: 24px;
            text-align: left;
            cursor: pointer;
        }

        .logo span {
            color: red;
        }

        .ul {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .ul li {
            font-size: 14px;
            border: 1px solid #0e373f;
            border-radius: 20px;
            background: rgb(2, 162, 255);
            font-weight: bold;
        }

        .ul li a {
            color: rgb(10, 6, 6);
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
        }

        .ul li:hover {
            background: #03cff8c7;
        }

        .Menu-Icon {
            display: none;
            cursor: pointer;
        }

        .Menu-Icon svg {
            width: 30px;
            height: 30px;
            fill: #14424b;
        }

        @media(max-width: 1000px) {
            .Menu-Icon {
                display: block;
            }
            .ul {
                position: fixed;
                width: 70%;
                height: 100%;
                top: 0;
                left: 100%;
                background: rgb(25, 37, 73);
                transition: 0.4s ease;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 80px;
                gap: 15px;
                z-index: 999;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
            }
            .ul li {
                width: 85%;
                font-size: 18px;
                margin: 0 auto;
                background: rgba(14, 55, 63, 0.6);
                border-radius: 10px;
            }
            .ul li a {
                color: aliceblue;
                width: 100%;
                padding: 12px;
            }
            .ul.ativo {
                left: 30%;
            }
        }

        /* LAYOUT DE GRIDS E PAINÉIS */

        .Principal,
        .grid-container {
            background: #a9cbf0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 20px auto;
            padding: 15px;
            width: 92%;
            border-radius: 16px;
        }

        .aba-item {
            width: 100%;
            min-height: 80px;
            background-color: #14424b;
            color: rgb(255, 255, 255);
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            border: none;
            font-size: 15px;
            display: flex;
            flex-direction: column !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .aba-item:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .hidden,
        #area-impressao-relatorio.hidden {
            display: none !important;
        }

        .preco-container {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin: 20px auto;
            width: 92%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .preco-container h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .preco-container p {
            font-size: 26px;
            font-weight: bold;
        }

        .btn-voltar {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px auto;
            cursor: pointer;
            display: block;
        }

        .painel-freemium {
            background: #fff;
            border: 2px dashed #340aee;
            border-radius: 15px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: left;
        }

        .badge-premium {
            background: #ffc107;
            color: #000;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            float: right;
        }

        .btn-upgrade {
            background: #ffc107;
            color: black;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        /* ESTILIZAÇÃO DO GATEWAY DE PAGAMENTO ANGOLANO */

        .gateway-multicaixa {
            background: #f8f9fa;
            border: 2px solid #0056b3;
            border-radius: 12px;
            padding: 15px;
            margin: 15px auto;
            width: 92%;
            text-align: left;
            display: none;
        }

        .linha-recibo {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 4px;
        }

        .bloco-publicidade {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 12px;
            padding: 15px;
            width: 92%;
            margin: 15px auto;
            text-align: center;
            display: none;
        }

        .tag-anuncio {
            font-size: 10px;
            color: #6c757d;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .btn-anuncio-comissao {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .patrocinadores-container {
            width: 92%;
            margin: 20px auto;
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .patrocinadores-logos {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 8px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .marca-parceina,
        .marca-parceira {
            font-style: italic;
            font-weight: bold;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-dados-imprimir {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin: 15px auto;
            cursor: pointer;
            display: block;
        }

        /* INTERFACE NOTIFICAÇÕES E COOKIES */

        .notificacao-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #343a40;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notificacao-toast.mostrar {
            transform: translateX(-50%) translateY(0);
        }

        .banner-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #212529;
            color: white;
            padding: 25px;
            text-align: left;
            z-index: 99999;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.4);
        }

        .btn-cookies {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            align-self: flex-end;
        }

        footer {
            background: #f5f5f5;
            border-top: 1px solid #ccc;
            padding: 15px;
            margin-top: 30px;
            font-size: 12px;
        }

        footer ul {
            display: flex;
            justify-content: center;
            gap: 15px;
            list-style: none;
            margin-bottom: 8px;
        }

        footer a {
            color: #14424b;
            font-weight: bold;
            text-decoration: none;
        }

        /* REGRAS VISUAIS DE FOTOS PROPORCIONAIS */

        .img-wrapper {
            width: 100%;
            height: 60px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            border-radius: 6px;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .input-estilizado {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .aba-galeria {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* TALÃO COURIER DE IMPRESSÃO */

        #area-impressao-relatorio {
            background: white;
            color: black;
            padding: 30px;
            text-align: left;
            max-width: 450px;
            margin: 15px auto;
            border: 1px dashed #000;
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }
            #area-impressao-relatorio,
            #area-impressao-relatorio * {
                visibility: visible !important;
            }
            #area-impressao-relatorio {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: left;
                padding: 20px;
                border: none;
            }
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGAÇÃO -->
    <nav>
        <a href="Capaa.html">
            <img width="50" src="images (18).png" alt="">
        </a>
        <h1 class="logo" onclick="irParaSecao('home')">
            <strong>
                <u>AURE
                    <span>LIUS</span>
                </u>
                <h6>Salão de Beleza e Barbearia</h6>
            </strong>
        </h1>

        <ul class="ul" id="menuLateral">
            <li>
                <a href="#" onclick="irParaSecao('home')">Home</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('servicos')">Serviços</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('photos')">Photos</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('funcionarios')">Funcionários</a>
            </li>
            <li>
                <a href="#" onclick="irParaSecao('termos')">Termos & Privacidade</a>
            </li>
        </ul>

        <div class="Menu-Icon" onclick="toggleMenu()">
            <svg viewBox="0 0 100 80" width="30" height="30">
                <rect width="100" height="15" rx="8"></rect>
                <rect y="30" width="100" height="15" rx="8"></rect>
                <rect y="60" width="100" height="15" rx="8"></rect>
            </svg>
        </div>
    </nav>

    <!-- FORMULÁRIO DE ATENDIMENTO GLOBAL COM PLACEHOLDERS E VALIDAÇÃO -->
    <div class="painel-freemium" id="dadosAgendamento" style="border: 1px solid #14424b;">
        <h4 style="color: #14424b; margin-bottom: 12px;">Dados de Atendimento da Sessão</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">
            <div>
                <input type="text" id="inputNomeCliente" placeholder="Nome do Cliente (Obrigatório)" class="input-estilizado" oninput="validarFormularioAgendamento()">
            </div>
            <div>
                <select id="inputFuncionario" class="input-estilizado" onchange="validarFormularioAgendamento()">
                    <option value="" disabled selected>Selecione o Profissional (Obrigatório)</option>
                    <option value="Mestre Carlos">Mestre Carlos (Barba & Linhas)</option>
                    <option value="Cabeleireira Ana">Cabeleireira Ana (Pinturas & Mechas)</option>
                    <option value="Estilista Mateus">Estilista Mateus (Cortes Modernos)</option>
                    <option value="Manicure Sofia">Manicure Sofia (Unhas de Gel)</option>
                </select>
            </div>
            <div>
                <input type="date" id="inputDataServico" class="input-estilizado" onchange="validarFormularioAgendamento()">
            </div>
            <div>
                <input type="time" id="inputHoraServico" class="input-estilizado" onchange="validarFormularioAgendamento()">
            </div>
        </div>
    </div>

    <!-- GATEWAY DE CHECKOUT COM VALIDAÇÃO DE TELEFONE DE ANGOLA -->
    <div class="gateway-multicaixa" id="checkoutGateway">
        <h4 style="margin-bottom: 12px; color: #0056b3; text-align:center;">Finalizar Pagamento do Serviço Selecionado</h4>

        <div style="display:flex; gap:10px; margin-bottom:15px;">
            <button onclick="mudarMetodoPagamento('express')" style="flex:1; padding:10px; border:none; background:#007bff; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">MCX Express</button>
            <button onclick="mudarMetodoPagamento('unitel')" style="flex:1; padding:10px; border:none; background:#ff6600; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">Unitel Money</button>
            <button onclick="mudarMetodoPagamento('ref')" style="flex:1; padding:10px; border:none; background:#6c757d; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer;">Referência ATM</button>
        </div>




        <!-- Ecrã Multicaixa Express -->
        <div id="pay-express">
            <p style="font-size:13px; margin-bottom:8px; color:#555;">Introduza o telemóvel do
                <strong>Multicaixa Express</strong> (9 dígitos angolanos começados por 9):</p>
            <input type="tel" id="telExpress" placeholder="Ex: 923456789" class="input-estilizado" style="margin-bottom:12px;" oninput="validarTelefoneAngola('express')">
            <button id="btnPagarExpress" onclick="simularTransacaoInstantanea('Multicaixa Express')" style="width:100%; padding:11px; background:#6c757d; color:#fff; border:none; font-weight:bold; border-radius:6px; cursor:not-allowed;"
                disabled>Pagar via Express</button>
        </div>

        <!-- Ecrã Unitel Money -->
        <div id="pay-unitel" style="display:none;">
            <p style="font-size:13px; margin-bottom:8px; color:#555;">Introduza o número de telefone do
                <strong>Unitel Money</strong> (9 dígitos angolanos começados por 9):</p>
            <input type="tel" id="telUnitel" placeholder="Ex: 923456789" class="input-estilizado" style="margin-bottom:12px;" oninput="validarTelefoneAngola('unitel')">
            <button id="btnPagarUnitel" onclick="simularTransacaoInstantanea('Unitel Money')" style="width:100%; padding:11px; background:#6c757d; color:#fff; border:none; font-weight:bold; border-radius:6px; cursor:not-allowed;"
                disabled>Confirmar no Unitel Money</button>
        </div>

        <!-- Ecrã Referência ATM -->
        <div id="pay-ref" style="display:none;">
            <div class="linha-recibo">
                <span>Entidade Provedora:</span>
                <strong>00942 (ProxyPay)</strong>
            </div>
            <div class="linha-recibo">
                <span>Referência Monte:</span>
                <strong id="refGerada">999 123 456</strong>
            </div>
            <div class="linha-recibo">
                <span>Total do Serviço:</span>
                <strong id="refValorTotal">0,00 kz</strong>
            </div>
            <p style="font-size: 11px; color: #dc3545; margin-top: 5px; text-align:center;">Disponível para liquidação imediata em qualquer caixa ATM em Angola.</p>
        </div>
    </div>

    <!-- SEÇÃO HOME -->
    <div id="secao-home" class="aba-conteudo">
        <div class="painel-freemium" id="blocoFreemium">
            <span class="badge-premium" id="statusBadge">CONTA GRÁTIS</span>
            <h4 id="tituloFreemium">Acesso Freemium Ativo</h4>
            <p style="font-size: 13px; color: #555; margin-top: 4px;" id="descFreemium">Subscreva o plano Premium para ocultar anúncios de Luanda e desbloquear relatórios completos.</p>
            <button class="btn-upgrade" id="btnAcaoPremium" onclick="gerarFaturaPremium()">Seja Premium - 2.500 kz/mês</button>
        </div>

        <div class="bloco-publicidade" id="blocoAnuncios">
            <span class="tag-anuncio">Oferta Exclusiva Afiliada</span>
            <strong id="anuncioTitulo">Carregando produto recomendado...</strong>
            <p id="anuncioTexto" style="font-size: 13px; margin: 5px 0; color: #444;"></p>
            <button class="btn-anuncio-comissao" id="anuncioLink" onclick="redirecionarAfiliadoReal()">Comprar com Desconto</button>
        </div>
    </div>





    <!-- SEÇÃO SERVIÇOS (RECURSO INTERATIVO DE COMPRA E PREÇOS) -->
    <div id="secao-servicos" class="aba-conteudo hidden">
        <div id="caixa-preco" class="preco-container hidden">
            <h3 id="nome-servico">Serviço</h3>
            <p id="valor-servico">0,00 kz</p>
            <span id="faturamentoStatus" style="font-size:12px; display:block; margin-top:5px; font-weight:bold;"></span>
        </div>

        <!-- NÍVEL 1: CATEGORIAS PRINCIPAIS -->
        <div id="nivel1">
            <div class="Principal">
                <button class="aba-item" onclick="mostrarNivel2('cortes')">Cortes de Cabelo</button>
                <button class="aba-item" onclick="mostrarNivel2('pinturas')">Pinturas de Cabelo</button>
                <button class="aba-item" onclick="mostrarNivel2('sobrancelhas')">Sobrancelhas</button>
                <button class="aba-item" onclick="mostrarNivel2('maquilhagem')">Maquilhagens</button>
                <button class="aba-item" onclick="mostrarNivel2('tratamentos')">Tratamentos Capilares</button>
                <button class="aba-item" onclick="mostrarNivel2('manicure')">Manicure</button>
                <button class="aba-item" onclick="mostrarNivel2('pedicure')">Pedicure</button>
            </div>
        </div>

        <!-- NÍVEL 2: SUBCATEGORIAS COMPLETAS INTERATIVAS -->
        <div id="nivel2" class="hidden">
            <button class="btn-voltar" onclick="voltarParaNivel1()">← Voltar às Categorias</button>

            <div id="sub-cortes" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Cheio', '4.500 kz')">
                    <div class="img-wrapper">
                        <img src="1776692903268.jpg">
                    </div>Corte Francês Cheio
                </button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Francês Vazio', '4.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777201603721.jpg">
                    </div>Corte Francês Vazio
                </button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte de Crianças', '2.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777757951670.jpg">
                    </div>Corte de Crianças</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte de Adultos', '3.000 kz')">
                    <div class="img-wrapper">
                        <img src="1777298458880.jpg">
                    </div>Corte de Adultos</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Corte Careca', '1.500 kz')">
                    <div class="img-wrapper">
                        <img src="1777556066924.jpg">
                    </div>Careca</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Design e Corte de Barba', '2.000 kz')">
                    <div class="img-wrapper">
                        <img src="1776692182096.jpg">
                    </div>Barba</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Outros Estilos de Corte', '3.500 kz')">
                    <div class="img-wrapper">
                        <img src="1777986301625.jpg">
                    </div>Outros</button>
            </div>

            <div id="sub-pinturas" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Tintura Geral', '12.000 kz')">Tintura Geral</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Mechas / Luzes', '18.000 kz')">Mechas / Luzes</button>
            </div>

            <div id="sub-sobrancelhas" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Design Simples', '2.000 kz')">Design Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Aplicação de Henna', '4.500 kz')">Aplicação de Henna</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Sobrancelhas normal', '1.500 kz')">Sobrancelhas normal</button>
            </div>

            <div id="sub-maquilhagem" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Social', '15.000 kz')">Maquilhagem Social</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Maquilhagem Noiva', '45.000 kz')">Maquilhagem Noiva</button>
            </div>

            <div id="sub-tratamentos" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Hidratação Profunda', '8.500 kz')">Hidratação Profunda</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Queratina / Selagem', '14.000 kz')">Queratina / Selagem</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Tratamento Antiqueda', '10.000 kz')">Tratamento Antiqueda</button>
            </div>

            <div id="sub-manicure" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Manicure Simples', '2.000 kz')">Manicure Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Aplicação Gel / Acrigel', '7.500 kz')">Aplicação Gel / Acrigel</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Manutenção de Unhas', '4.000 kz')">Manutenção de Unhas</button>
            </div>

            <div id="sub-pedicure" class="grid-container sub-grupo hidden">
                <button class="aba-item" onclick="exibirPrecoFinal('Pedicure Simples', '2.500 kz')">Pedicure Simples</button>
                <button class="aba-item" onclick="exibirPrecoFinal('Spa Completo dos Pés', '6.000 kz')">Spa Completo dos Pés</button>
            </div>
        </div>

        <button class="btn-dados-imprimir" onclick="imprimirDados()">🖨️ Emitir Fatura de Atendimento Recibo</button>
    </div>

    <!-- SEÇÃO PHOTOS (GALERIA LOCAL DE ARMAZENAMENTO E CARREGAMENTO COMPARTILHADO) -->
    <div id="secao-photos" class="aba-conteudo hidden" style="width:92%; margin:20px auto;">
        <div class="aba-galeria">
            <h4 style="margin-bottom:10px; color:#14424b;">Galeria Dinâmica e Publicação Local</h4>
            <p style="font-size:13px; color:#666; margin-bottom:15px;">Carregue retratos de modelos para a galeria. Outros utilizadores no localhost poderão visualizar o histórico.</p>

            <div style="background:#f8f9fa; border:2px dashed #ccc; padding:20px; border-radius:8px; text-align:center;">
                <input type="file" id="inputUploadImagem" accept="image/*" style="display:none;" onchange="processarUploadImagemLocal(event)">
                <button onclick="document.getElementById('inputUploadImagem').click()" style="padding:10px 20px; background:#007bff; color:white; border:none; font-weight:bold; border-radius:6px; cursor:pointer;">Selecionar Imagem do Computador</button>
                <p id="nomeArquivoSelecionado" style="font-size:12px; margin-top:8px; color:#555; font-style:italic;">Nenhum ficheiro selecionado</p>
            </div>
        </div>

        <h5 style="text-align:left; color:#14424b; margin:15px 0 10px 0;">Retratos Publicados Novas Tendências</h5>
        <div id="muroImagensPublicas" class="grid-container" style="background:#fff; border:1px solid #ddd; padding:10px; margin:0; width:100%;">
            <div class="aba-item" style="background:#f8f9fa; color:#000;">
                <div class="img-wrapper">
                    <img src="Screenshot_20251002-123823.png">
                </div>Modelagem Curto</div>
            <div class="aba-item" style="background:#f8f9fa; color:#000;">
                <div class="img-wrapper">
                    <img src="Screenshot_2025-06-27-00-49-58-99.png">
                </div>Design Afro</div>
        </div>
    </div>

    <!-- SEÇÃO FUNCIONÁRIOS (AUDITORIA OPERACIONAL DO SALÃO) -->
    <div id="secao-funcionarios" class="aba-conteudo hidden" style="width:92%; margin:20px auto;">
        <div class="aba-galeria" style="background:linear-gradient(135deg, #14424b, #255861); color:white;">
            <h4>Painel Corporativo de Auditoria Operacional</h4>
            <p style="font-size:12px; opacity:0.9; margin-top:4px;">Gestão de equipas ativas e escala de atendimento para Luanda.</p>
        </div>
        <div class="grid-container" style="padding:0; background:transparent; width:100%;">
            <div class="aba-item">
                <strong>Mestre Hanganga</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Disponível (Cadeira 1)</span>
            </div>
            <div class="aba-item">
                <strong>Cabeleireira Ana</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Em Atendimento</span>
            </div>
            <div class="aba-item">
                <strong>Estilista Tomas</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Disponível (Cadeira 2)</span>
            </div>
            <div class="aba-item">
                <strong>Manicure Sofia</strong>
                <span style="font-size:11px; opacity:0.8; margin-top:4px;">Ausente (Folga)</span>
            </div>
        </div>
    </div>

    <!-- SEÇÃO TERMOS (CONTRATO AVANÇADO DE PRIVACIDADE E MONETIZAÇÃO) -->
    <div id="secao-termos" class="aba-conteudo hidden" style="width:92%; margin:20px auto; text-align:left;">
        <div class="aba-galeria" style="line-height:1.6; font-size:13px; color:#333;">
            <h3 style="color:#14424b; margin-bottom:10px;">Contrato de Termos de Uso e Consentimento de Dados</h3>
            <p>
                <strong>1. Recolha Comercial:</strong> Ao utilizar a plataforma Aurelius Jbs, o utilizador declara estar ciente de
                que as métricas comportamentais de cliques em serviços estéticos, escolhas de preços e relatórios financeiros
                gerados são catalogados anonimamente.</p>
            <p style="margin-top:8px;">
                <strong>2. Monetização Regionalizada:</strong> O sistema Freemium utiliza algoritmos ultra-segmentados baseados nos
                seus cliques para sugerir soluções de cosméticos parceiros (como L'Oréal Paris Angola ou Clear), gerando
                comissões residenciais estruturadas.</p>
        </div>
    </div>

    <!-- PATROCINADORES -->
    <div class="patrocinadores-container">
        <span style="font-size: 11px; color: #777; text-transform: uppercase;">Parcerias de Fornecimento Oficiais</span>
        <div class="patrocinadores-logos">
            <span class="marca-parceira">💃 Atelier Angelino Hbo, Angola</span>
            <span class="marca-parceira">🧴 Clear Distribuição</span>
            <span class="marca-parceira">✂️ BarberPro Huambo</span>
        </div>
    </div>

    <!-- BANNER DE COOKIES / PRIVACIDADE -->
    <div class="banner-cookies" id="bannerPrivacidade">
        <p>A
            <strong>Aurelius Jbs</strong> recolhe dados estatísticos de navegação anonimizados para fins publicitários e análise
            de tendências de mercado em Angola.</p>
        <button class="btn-cookies" onclick="aceitarTermosPrivacidade()">Acceptar e Permitir Rastreamento</button>
    </div>

    <!-- ÁREA DE IMPRESSÃO DO TALÃO COURIER -->
    <div id="area-impressao-relatorio" class="hidden"></div>

    <div id="toastNotificacao" class="notificacao-toast">
        <span id="toastIcone">🔔</span>
        <span id="toastTexto"></span>
    </div>

    <footer>
        <p>&copy; 2026 Aurelius Jbs. Todos os direitos reservados.</p>
    </footer>

    <!-- 1. CARREGAMENTO DOS MOTORES COMPATÍVEIS VIA CDN ALTERNATIVO UNPKG -->
    <!-- 1. Carrega o SDK Principal do Firebase (Obrigatório) -->
    <script src="https://gstatic.com"></script>

    <!-- 2. Carrega o Cloud Firestore para usar o Banco de Dados Real (Obrigatório) -->
    <script src="https://gstatic.com"></script>

    <!-- 3. Opcional: Carrega o Analytics se quiser monitorizar acessos -->
    <script src="https://gstatic.com"></script>
    <script src="https://unpkg.com"></script>
    <script src="https://unpkg.com"></script>

    <!-- ⚡ SCRIPTS DE NAVEGAÇÃO, VALIDAÇÃO E COMUNICAÇÃO GOOGLE FIRESTORE -->
    <script>
        var servicoSelecionadoAtual = {
            nome: "Nenhum selecionado",
            preco: "0,00 kz"
        };
        var dadosUsuario = {
            plano: "Freemium"
        };
        var db = null;

        // 🌟 CONFIGURAÇÃO DA SUA CONTA ATUALIZADA COM OS NOVOS CORES DA CHAVE DO PROJETO
        const firebaseConfig = {
            apiKey: "AIzaSyCTExo1LULEKMcZuAvKzzYfA6RIs7WshsE",
            authDomain: "://firebaseapp.com",
            projectId: "myapp-7f4bb",
            storageBucket: "://appspot.com",
            messagingSenderId: "814845444533",
            appId: "1:814845444533:web:43d874bf8206d20f6990ae",
            measurementId: "G-2BRHVQ6SLE"
        };

        const CONFIG_UNITEL_MONEY_API_KEY = "PLACEHOLDER_API_KEY_REAL_UNITEL_MONEY";
        const CONFIG_UNITEL_MONEY_MERCHANT_ID = "PLACEHOLDER_MERCHANT_ID_REAL";

        // CONFIGURAÇÕES OBRIGATÓRIAS DO GATEWAY DE SMS EM ANGOLA
        const CONFIG_SMS_GATEWAY_URL = "PLACEHOLDER_SMS_GATEWAY_URL_ANGOLA";
        const CONFIG_SMS_API_TOKEN = "PLACEHOLDER_SMS_API_TOKEN_VALOR";

        try {
            if (typeof firebase !== 'undefined') {
                firebase.initializeApp(firebaseConfig);
                db = firebase.firestore();
                console.log("🔥 Base de Dados Firebase ativa e ligada com sucesso ao projeto myapp-7f4bb!");
                if (document.getElementById('faturamentoStatus')) {
                    document.getElementById('faturamentoStatus').innerText = "Conectado ao Cloud Firestore Real";
                }
            } else {
                console.warn("Aviso: O script do Firebase não foi carregado na página HTML.");
            }
        } catch (e) {
            console.error("Erro na ligação à Base de Dados:", e.message);
        }
        // SISTEMA DE TROCA DE PÁGINAS DO MENU SUPERIOR
        function irParaSecao(idSecao) {
            var secoes = document.querySelectorAll('.aba-conteudo');
            secoes.forEach(s => s.classList.add('hidden'));

            var secaoAlvo = document.getElementById('secao-' + idSecao);
            if (secaoAlvo) secaoAlvo.classList.remove('hidden');

            var menu = document.getElementById('menuLateral');
            if (menu) menu.classList.remove('ativo');
        }

        function toggleMenu() {
            var menu = document.getElementById('menuLateral');
            if (menu) menu.classList.toggle('ativo');
        }

        // SISTEMA DE SUBCATEGORIAS (NÍVEL 1 E NÍVEL 2)
        function mostrarNivel2(categoria) {
            document.getElementById('nivel1').classList.add('hidden');
            document.getElementById('nivel2').classList.remove('hidden');
            var subGrupos = document.querySelectorAll('.sub-grupo');
            for (var i = 0; i < subGrupos.length; i++) {
                subGrupos[i].classList.add('hidden');
            }
            var subAlvo = document.getElementById('sub-' + categoria);
            if (subAlvo) {
                subAlvo.classList.remove('hidden');
            }
        }

        function voltarParaNivel1() {
            document.getElementById('nivel2').classList.add('hidden');
            document.getElementById('nivel1').classList.remove('hidden');
            document.getElementById('caixa-preco').classList.add('hidden');
            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "none";
        }

        function aceitarTermosPrivacidade() {
            var banner = document.getElementById('bannerPrivacidade');
            if (banner) banner.style.display = "none";
        }

        // 🔒 SISTEMA DE VALIDAÇÃO DO FORMULÁRIO SUPERIOR
        function validarFormularioAgendamento() {
            var nome = document.getElementById('inputNomeCliente').value.trim();
            var funcionario = document.getElementById('inputFuncionario').value;
            var dataServico = document.getElementById('inputDataServico').value;
            var horaServico = document.getElementById('inputHoraServico').value;

            if (nome === "" || funcionario === "" || dataServico === "" || horaServico === "") {
                return false;
            }
            return true;
        }

        // CLIQUE NO PREÇO: Exige o preenchimento total e abre o painel do Multicaixa
        function exibirPrecoFinal(nome, valor) {
            if (!validarFormularioAgendamento()) {
                dispararNotificacaoLocal("⚠️ Por favor, preencha primeiro todos os dados do Atendimento no topo!");
                return;
            }

            document.getElementById('nome-servico').innerText = nome;
            document.getElementById('valor-servico').innerText = valor;
            document.getElementById('caixa-preco').classList.remove('hidden');

            servicoSelecionadoAtual.nome = nome;
            servicoSelecionadoAtual.preco = valor;

            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "block";

            var refValorTotal = document.getElementById('refValorTotal');
            if (refValorTotal) refValorTotal.innerText = valor;

            var refCampo = document.getElementById('refGerada');
            var refProvedor = Math.floor(100000000 + Math.random() * 900000000).toString().replace(
                /(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
            if (refCampo) refCampo.innerText = refProvedor;
        }

        function gerarFaturaPremium() {
            if (!validarFormularioAgendamento()) {
                dispararNotificacaoLocal("⚠️ Preencha os dados do atendimento antes de comprar o plano Premium!");
                return;
            }
            var gateway = document.getElementById('checkoutGateway');
            if (gateway) gateway.style.display = "block";

            var refValorTotal = document.getElementById('refValorTotal');
            if (refValorTotal) refValorTotal.innerText = "2.500,00 kz";

            var refCampo = document.getElementById('refGerada');
            var refProvedor = Math.floor(100000000 + Math.random() * 900000000).toString().replace(
                /(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
            if (refCampo) refCampo.innerText = refProvedor;

            dispararNotificacaoLocal("Fatura Premium gerada! Pague 2.500 kz via Express ou Referência.");
        }

        function mudarMetodoPagamento(metodo) {
            var expressDiv = document.getElementById('pay-express');
            var unitelDiv = document.getElementById('pay-unitel');
            var refDiv = document.getElementById('pay-ref');

            if (expressDiv) expressDiv.style.display = metodo === 'express' ? 'block' : 'none';
            if (unitelDiv) unitelDiv.style.display = metodo === 'unitel' ? 'block' : 'none';
            if (refDiv) refDiv.style.display = metodo === 'ref' ? 'block' : 'none';
        }

        // 🔒 SISTEMA DE VALIDAÇÃO DE TELEFONE DE ANGOLA (9 DÍGITOS E COMEÇANDO POR 9)
        function validarTelefoneAngola(tipo) {
            var inputTel = document.getElementById(tipo === 'express' ? 'telExpress' : 'telUnitel');
            var btnPagar = document.getElementById(tipo === 'express' ? 'btnPagarExpress' : 'btnPagarUnitel');

            if (!inputTel || !btnPagar) return;

            var numero = inputTel.value.trim();
            var regraAngola = /^9\d{8}$/;

            if (regraAngola.test(numero)) {
                btnPagar.disabled = false;
                btnPagar.style.background = tipo === 'express' ? '#28a745' : '#ff6600';
                btnPagar.style.cursor = "pointer";
            } else {
                btnPagar.disabled = true;
                btnPagar.style.background = "#6c757d";
                btnPagar.style.cursor = "not-allowed";
            }
        }

        // 🌟 REPARADO: SE CLICAR EM PAGAR COM O NÚMERO CORRETO, ENVIA E MOSTRA O AVISO NO ECRÃ
        function simularTransacaoInstantanea(plataforma) {
            if (document.getElementById('faturamentoStatus')) {
                document.getElementById('faturamentoStatus').innerText = "⏳ Gravando dados no Firebase...";
                document.getElementById('faturamentoStatus').style.color = "orange";
            }

            var nomeCliente = document.getElementById('inputNomeCliente').value || "Consumidor Local";
            var funcionario = document.getElementById('inputFuncionario').value;
            var dataServico = document.getElementById('inputDataServico').value || new Date().toLocaleDateString();
            var horaServico = document.getElementById('inputHoraServico').value || new Date().toLocaleTimeString();

            // Gravação assíncrona na coleção estruturada "Dados"
            if (db) {
                var idVendaUnica = "venda-" + Date.now();

                db.collection("Dados").doc(idVendaUnica).set({
                        cliente: nomeCliente,
                        barbeiro: funcionario,
                        servico: servicoSelecionadoAtual.nome,
                        preco: servicoSelecionadoAtual.preco,
                        metodoPagamento: plataforma,
                        dataAgendada: dataServico,
                        horaAgendada: horaServico,
                        timestamp: firebase.firestore.FieldValue.serverTimestamp()
                    })
                    .then(function () {
                        console.log("✅ Conexão estabelecida e gravada no Cloud Firestore!");

                        if (document.getElementById('faturamentoStatus')) {
                            document.getElementById('faturamentoStatus').innerText =
                                "✅ Conectado e Gravado no Cloud Firestore!";
                            document.getElementById('faturamentoStatus').style.color = "#fff";
                        }

                        // Notificação Toast em conformidade total com o pedido:
                        dispararNotificacaoLocal("🎉 O seu pagamento via " + plataforma +
                            " encontra-se na base de dados do Google Firebase!");

                        setTimeout(function () {
                            var gateway = document.getElementById('checkoutGateway');
                            if (gateway) gateway.style.display = "none";
                        }, 2500);
                    })
                    .catch(function (error) {
                        console.error("Erro ao gravar dados na nuvem:", error.message);
                    });
            }
        }

        // CARREGAMENTO DE IMAGENS E INJEÇÃO VISUAL NA GALERIA LOCAL
        function processarUploadImagemLocal(event) {
            var arquivo = event.target.files;
            if (!arquivo || arquivo.length === 0) return;

            document.getElementById('nomeArquivoSelecionado').innerText = arquivo[0].name + " (A processar...)";

            var leitor = new FileReader();
            leitor.onload = function (e) {
                var urlImagemBase64 = e.target.result;

                var novaAbasFoto = document.createElement('div');
                novaAbasFoto.className = "aba-item";
                novaAbasFoto.style.background = "#f8f9fa";
                novaAbasFoto.style.color = "#000";
                novaAbasFoto.innerHTML = "<div class='img-wrapper'><img src='" + urlImagemBase64 +
                    "'></div>Novo Estilo";

                var muro = document.getElementById('muroImagensPublicas');
                if (muro) {
                    muro.insertBefore(novaAbasFoto, muro.firstChild);
                    document.getElementById('nomeArquivoSelecionado').innerText = "✅ Publicado com sucesso!";
                    dispararNotificacaoLocal("📸 Foto adicionada à galeria de tendências!");
                }
            };
            leitor.readAsDataURL(arquivo[0]);
        }

        // TOAST DE ALERTA COM NOMES DE VARIÁVEIS EM PORTUGUÊS CORRIGIDOS (LINHA 662 FIX)
        function dispararNotificacaoLocal(mensagem) {
            var toast = document.getElementById('toastNotificacao');
            var texto = document.getElementById('toastTexto');
            if (toast && texto) {
                texto.innerText = mensagem; // Nome da variável unificado para 'mensagem'
                toast.classList.add('mostrar');
                setTimeout(function () {
                    toast.classList.remove('mostrar');
                }, 5000);
            }
        }

        // IMPRESSÃO DE TALÃO EXCLUSIVO DE ATENDIMENTO
        function imprimirDados() {
            var area = document.getElementById('area-impressao-relatorio');
            if (!area) return;

            var nomeCliente = document.getElementById('inputNomeCliente').value || "Consumidor Final";
            var funcionario = document.getElementById('inputFuncionario').value || "Não selecionado";
            var dataServico = document.getElementById('inputDataServico').value || new Date().toLocaleDateString();
            var horaServico = document.getElementById('inputHoraServico').value || new Date().toLocaleTimeString();

            var htmlTalao =
                "<div style='text-align:center; font-weight:bold;'><h2>AURELIUS JBS</h2><p>Luanda - Angola</p><p>Recibo de Atendimento</p></div>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<p><strong>CLIENTE:</strong> " + nomeCliente + "</p>";
            htmlTalao += "<p><strong>PROFISSIONAL:</strong> " + funcionario + "</p>";
            htmlTalao += "<p><strong>DATA:</strong> " + dataServico + " | <strong>HORA:</strong> " + horaServico +
                "</p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h3>DETALHE DO SERVIÇO:</h3>";
            htmlTalao += "<p>Desc: " + servicoSelecionadoAtual.nome + " -> <strong>" + servicoSelecionadoAtual.preco +
                "</strong></p>";
            htmlTalao += "<p>--------------------------------------------------</p>";
            htmlTalao += "<h4>TOTAL A PAGAR: " + servicoSelecionadoAtual.preco + "</h4>";
            htmlTalao +=
                "<p style='text-align:center; font-size:11px; margin-top:10px;'>Obrigado pela preferência!</p>";

            area.innerHTML = htmlTalao;
            area.classList.remove('hidden');
            window.print();
            setTimeout(function () {
                area.classList.add('hidden');
            }, 1000);
        }









        document.querySelector('.pagar-btn').addEventListener('click', async function (e) {
            e.preventDefault(); // Impede o recarregamento da página

            // Captura o número de telefone digitado no input
            const telefoneInput = document.querySelector('input[type="text"]').value.trim();

            // Configura os dados fixos do serviço selecionado na tela
            const dadosPagamento = {
                telefone: telefoneInput,
                servico: "Corte Francês Cheio",
                valor: 4500,
                metodoPagamento: "MCX Express" // Altere dinamicamente se o usuário mudar de aba
            };

            // Pequeno feedback visual imediato na tela
            const statusTexto = document.querySelector('.status-firebase') || document.createElement('p');
            statusTexto.className = 'status-firebase';
            statusTexto.innerText = "A processar pagamento... Aguarde.";
            statusTexto.style.color = "#yellow";

            try {
                // Faz a requisição POST para o servidor Express na porta 3000
                const resposta = await fetch('http://localhost:3000/api/agendamentos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dadosPagamento)
                });

                const resultado = await resposta.json();

                if (resposta.ok && resultado.sucesso) {
                    // Atualiza o texto verde informando o sucesso ao cliente
                    statusTexto.innerText = "Sucesso! Verifique o seu telemóvel para autorizar a operação.";
                    statusTexto.style.color = "#00ff00";
                    alert(
                        "Pedido enviado! Por favor, valide a transação no aplicativo Multicaixa Express do seu telemóvel."
                    );
                } else {
                    statusTexto.innerText = `Erro: ${resultado.erro}`;
                    statusTexto.style.color = "#ff0000";
                }

            } catch (erro) {
                console.error("Erro na comunicação com o servidor:", erro);
                statusTexto.innerText = "Erro ao conectar com o servidor da barbearia.";
                statusTexto.style.color = "#ff0000";
            }
        });
    </script>
<
</body>

</html>