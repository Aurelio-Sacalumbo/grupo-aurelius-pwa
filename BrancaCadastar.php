<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Africa/Luanda');

// 🟢 CORREÇÃO MESTRE: Substitui a chamada quebrada pelo ficheiro de conexão real
require_once __DIR__ . "/config/Banco.php";

// Reaproveita a variável global ativa do ecossistema
$mysqli = $conexao_link ?? $conexao_aurelius ?? $conexao ?? null;

if (!$mysqli || !($mysqli instanceof mysqli) || @mysqli_ping($mysqli) === false) {
    $db_host = getenv('DB_HOST') ?: "altaria.proxy.rlwy.net";
    $db_port = getenv('DB_PORT') ?: "52030";
    $db_name = getenv('DB_NAME') ?: "railway";
    $db_user = getenv('DB_USER') ?: "root";
    $db_pass = getenv('DB_PASSWORD') ?: "tPzDwXGkyczyyYdcyvLmHLSMmfZmnMIZ";
    
    $mysqli = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
}

// Inicializador preventivo do array de erros para travar o Warning
$erro = [];
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <!-- Configurações nativas para PWA no iOS e Android -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Aurélius">
    <link rel="manifest" href="manifest.json">

    <script>
    // Ativa o Service Worker nos bastidores do navegador do telemóvel
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('serviceWorker.js')
                .then(reg => console.log('✓ PWA Aurélius registado com sucesso!', reg))
                .catch(err => console.log('❌ Falha ao registar PWA:', err));
        });
    }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Registo de Utilizador - Grupo Aurélius</title>
    <style>
        /* 🔒 AJUSTE LATERAL COMPACTO PARA ECOSSISTEMA ANDROID (ZERO MARGENS VAZIAS) */
        html, body { 
            width: 100% !important; 
            max-width: 100% !important; 
            overflow-x: hidden !important; 
            margin: 0 !important; 
            padding: 0 !important; 
            box-sizing: border-box !important;
        }
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-image: url('1755959614013.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-color: #0b0f19; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            padding: 15px !important;
        }
        .container { 
            width: 100% !important; 
            max-width: 440px !important; 
            background: rgba(0, 24, 39, 0.96); 
            padding: 25px 20px; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.5); 
            border: 2px solid #22c55e; 
            color: white; 
            text-align: center; 
            box-sizing: border-box; 
        }
        .container h2 { margin: 0; color: #ffffff; font-size: 20px; text-transform: uppercase; font-weight: 900; letter-spacing: 0.5px; }
        .sub-tag { font-size: 10.5px; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 20px; letter-spacing: 0.5px; border-bottom: 2px solid rgba(34, 197, 94, 0.2); padding-bottom: 8px; }
        .campo-form { margin-bottom: 14px; text-align: left; }
        .campo-form label { font-weight: bold; display: block; margin-bottom: 6px; font-size: 11.5px; color: #a7f3d0; text-transform: uppercase; }
        .campo-form input { width: 100%; padding: 11px 14px; border: 1px solid #374151; border-radius: 14px; box-sizing: border-box; font-size: 13.5px; background: #0b0f19; color: #ffffff; outline: none; }
        .campo-form input:focus { border-color: #22c55e; box-shadow: 0 0 6px rgba(34, 197, 94, 0.3); }
        .btn-enviar { width: 100%; background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; padding: 12px; cursor: pointer; font-size: 14px; border-radius: 14px; font-weight: bold; margin-top: 8px; text-transform: uppercase; transition: transform 0.2s; outline: none; }
        .btn-enviar:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(34,197,94,0.3); }
        .btn-voltar { display: block; width: 100%; text-align: center; background: #374151; color: white; border: 1px solid #4b5563; padding: 11px; font-size: 13px; border-radius: 14px; font-weight: bold; text-decoration: none; margin-top: 10px; box-sizing: border-box; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="container">
    <h2>Criar Nova Conta</h2>
    <span class="sub-tag">Inscrição de Lojas e Barbearias Parceiras</span>

    <!-- 🛡️ CORREÇÃO OPERACIONAL DA ANTERIOR LINHA 68: Ciclo unificado sem crash -->
    <?php if (isset($erro) && is_array($erro) && count($erro) > 0): ?>
        <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; color: #f87171; padding: 10px; border-radius: 12px; font-size: 12px; margin-bottom: 15px; text-align: left;">
            <?php foreach ($erro as $e): ?>
                <p style="margin: 3px 0;">❌ <?php echo htmlspecialchars($e); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        
        <div class="campo-form">
            <label for="nome">Nome Completo do Responsável:</label>
            <input type="text" name="nome" id="nome" required placeholder="Ex: Carlos Aurélio Sacalumbo">
        </div>

        <div class="campo-form">
            <label for="email">E-mail Corporativo de Acesso:</label>
            <input type="email" name="email" id="email" required placeholder="Ex: gerencia@branca.com">
        </div>

        <div class="campo-form">
            <label for="telefone">Telemóvel de Contacto:</label>
            <input type="text" name="telefone" id="telefone" placeholder="Ex: 923000000">
        </div>

        <div class="campo-form">
            <label for="senha">Palavra-passe Privada:</label>
            <input type="password" name="senha" id="senha" required placeholder="Crie uma senha de alta segurança">
        </div>

        <div class="campo-form">
            <label for="endereco">Endereço / Bairro da Sede:</label>
            <input type="text" name="endereco" id="endereco" placeholder="Ex: Via S10, Talatona, Luanda">
        </div>

        <button type="submit" name="cadastrar" class="btn-enviar">Concluir Registo</button>
        <a href="Principal.php" class="btn-voltar">✕ Cancelar e Voltar</a>
        
    </form>
</div>

</body>
</html>