<?php
// =========================================================================
// 💈 REGISTO UNIFICADO - ECOSSISTEMA SAAS MULTI-TENANT - GRUPO AURÉLIUS
// =========================================================================
if (!isset($_SESSION)) {
    session_start();
}

date_default_timezone_set('Africa/Luanda');

// Liga à base de dados centralizada do Grupo Aurélius
include("conect.php");

$erro = array(); 
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    
    $nome     = trim($_POST['nome']);
    $email    = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $senha    = $_POST['senha'];
    $endereco = trim($_POST['endereco']);

    if (empty($email) || empty($senha)) {
        $erro[] = "E-mail e Palavra-passe são obrigatórios.";
    }

    if (count($erro) == 0) {
        try {
            // 🎯 SINCRONIZAÇÃO 1: Prepared Statement para verificar duplicação de e-mail de forma segura
            $stmt_check = $mysqli->prepare("SELECT codigo FROM `usuario` WHERE `email` = ? LIMIT 1");
            $stmt_check->bind_param("s", $email);
            $stmt_check->execute();
            $query_check = $stmt_check->get_result();

            if ($query_check && $query_check->num_rows > 0) {
                $erro[] = "Este e-mail já está registado na plataforma.";
            }
            $stmt_check->close();
        } catch (mysqli_sql_exception $e) {
            $erro[] = "Erro técnico de validação: " . $e->getMessage();
        }
    }

    if (count($erro) == 0) {
        // 🎯 SINCRONIZAÇÃO 2: Criptografia profissional compatível com o seu novo validador unificado
        $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // 🎯 SINCRONIZAÇÃO 3: Grava de forma blindada incluindo o nível de acesso SaaS ('parceiro_hospedado')
            $stmt_insert = $mysqli->prepare("INSERT INTO `usuario` (nome, email, telefone, senha, endereco, transacao_status, visivel_no_site, nivel, data) VALUES (?, ?, ?, ?, ?, 'Confirmado', 1, 'parceiro_hospedado', NOW())");
            $stmt_insert->bind_param("sssss", $nome, $email, $telefone, $senha_cripto, $endereco);

            if ($stmt_insert->execute()) {
                $sucesso = true;
            } else {
                $erro[] = "Falha ao gravar o registo no sistema.";
            }
            $stmt_insert->close();
        } catch (mysqli_sql_exception $e) {
            $erro[] = "Erro de infraestrutura técnica de dados: " . $e->getMessage();
        }
    }
}
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo de Utilizador - Grupo Aurélius</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; padding: 20px; background-image: url('1755959614013.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-color: #0b0f19; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; box-sizing: border-box; }
        .container { width: 100%; max-width: 450px; background: rgba(0, 24, 39, 0.95); padding: 40px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border: 2px solid #22c55e; color: white; text-align: center; box-sizing: border-box; }
        .container h2 { margin: 0; color: #ffffff; font-size: 22px; text-transform: uppercase; font-weight: 900; letter-spacing: 1px; }
        .sub-tag { font-size: 11px; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 25px; letter-spacing: 0.5px; border-bottom: 2px solid rgba(34, 197, 94, 0.2); padding-bottom: 10px; }
        .campo-form { margin-bottom: 18px; text-align: left; }
        .campo-form label { font-weight: bold; display: block; margin-bottom: 8px; font-size: 13px; color: #a7f3d0; text-transform: uppercase; }
        .campo-form input { width: 100%; padding: 12px 16px; border: 1px solid #374151; border-radius: 20px; box-sizing: border-box; font-size: 14px; background: #0b0f19; color: #ffffff; outline: none; }
        .campo-form input:focus { border-color: #22c55e; box-shadow: 0 0 8px rgba(34, 197, 94, 0.3); }
        .erro-msg { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; padding: 10px; border-radius: 15px; font-size: 13px; margin-bottom: 15px; font-weight: bold; text-align: left; }
        .btn-enviar { width: 100%; background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; padding: 14px; cursor: pointer; font-size: 15px; border-radius: 20px; font-weight: bold; margin-top: 10px; text-transform: uppercase; transition: all 0.2s; outline: none; }
        .btn-enviar:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(34,197,94,0.3); }
        .btn-voltar { display: block; width: 100%; text-align: center; background: #374151; color: white; border: 1px solid #4b5563; padding: 12px; font-size: 14px; border-radius: 20px; font-weight: bold; text-decoration: none; margin-top: 12px; box-sizing: border-box; text-transform: uppercase; transition: all 0.2s; }
        .btn-voltar:hover { background: #4b5563; }
    </style>
</head>
<body>

<div class="container">
    <h2>Criar Nova Conta</h2>
    <span class="sub-tag">Inscrição de Lojas e Barbearias Parceiras</span>

    <?php
    if (count($erro) > 0) {
        foreach ($erro as $msg) {
            echo "<p class='erro-msg'>⚠️ " . htmlspecialchars($msg) . "</p>";
        }
    }

    if ($sucesso) {
        // Redireciona diretamente para o novo gateway unificado e centralizado
        echo "<script>alert('🎉 Conta criada com sucesso no Grupo Aurélius! Efetue o seu login com segurança.'); window.location.href='BarbeariaBranca.php';</script>";
    }
    ?>

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