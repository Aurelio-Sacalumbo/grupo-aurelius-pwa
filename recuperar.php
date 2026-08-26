<?php
// recuperar.php - Módulo de Redefinição de Credenciais (Grupo Aurélius)
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set('Africa/Luanda');
include("conect.php");

$erro = array();
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recuperar_senha'])) {
    $email = $mysqli->escape_string(trim($_POST['email']));
    
    // Procura o e-mail na tabela de usuários (Parceiros) e na de clientes comuns
    $sql_user = "SELECT * FROM `usuario` WHERE `email` = '$email'";
    $query_user = $mysqli->query($sql_user);
    
    $sql_client = "SELECT * FROM `clientes` WHERE `email` = '$email'";
    $query_client = $mysqli->query($sql_client);

    $encontrou_algum = false;

    // 🟢 TRATAMENTO PARA PARCEIROS (TABELA USUARIO)
    if ($query_user && $query_user->num_rows > 0) {
        $encontrou_algum = true;
        // Gera um PIN limpo de 6 dígitos para o ambiente seguro de parceiros
        $novo_pin_puro = rand(100000, 999999);
        
        // Atualiza a coluna pin_acesso sem criptografia MD5 conforme a nova regra
        $sql_update_user = "UPDATE `usuario` SET `pin_acesso` = '$novo_pin_puro' WHERE `email` = '$email'";
        $mysqli->query($sql_update_user);
        
        $sucesso = "✓ Um novo PIN de acesso temporário foi gerado com sucesso para o seu painel de parceiro: <strong style='font-size: 18px; color: #22c55e; letter-spacing: 1px;'>$novo_pin_puro</strong>";
    }
    
    // 🔵 TRATAMENTO PARA CLIENTES COMUNS (TABELA CLIENTES)
    if ($query_client && $query_client->num_rows > 0) {
        $encontrou_algum = true;
        // Mantém a regra antiga de senha criptografada para os clientes normais
        $nova_senha_pura = rand(100000, 999999);
        $senha_cripto = md5(md5($nova_senha_pura));

        $sql_update_client = "UPDATE `clientes` SET `senha` = '$senha_cripto' WHERE `email` = '$email'";
        $mysqli->query($sql_update_client);
        
        // Se já exibiu a mensagem do parceiro, concatena, senão define a do cliente
        if ($sucesso) {
            $sucesso .= "<br>✓ Acesso de cliente atualizado. Nova senha: <strong>$nova_senha_pura</strong>";
        } else {
            $sucesso = "✓ Uma nova credencial temporária de cliente foi gerada com sucesso: <strong>$nova_senha_pura</strong>";
        }
    }

    if (!$encontrou_algum) {
        $erro[] = "Este e-mail não foi localizado no ecossistema comercial.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Acesso - Grupo Aurélius</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0b0f19; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; color: white; }
        .container { width: 100%; max-width: 440px; background: #111827; padding: 45px; border-radius: 16px; border: 2px solid #ca8a04; box-shadow: 0 0 20px rgba(202, 138, 4, 0.4); text-align: center; animation: pulsar 3s infinite alternate; }
        @keyframes pulsar { 0% { box-shadow: 0 0 12px #a16207; } 100% { box-shadow: 0 0 25px #eab308; } }
        h2 { margin-top:0; border-bottom: 2px solid rgba(202, 138, 4, 0.3); padding-bottom: 12px; font-size: 20px; text-transform: uppercase; color: #ca8a04; }
        .campo { margin-bottom: 20px; text-align: left; }
        .campo label { display: block; font-size: 12px; margin-bottom: 6px; text-transform: uppercase; color: #cbd5e1; }
        input { width: 100%; padding: 14px; border-radius: 8px; border: 1px solid #374151; background: #0b0f19; color: white; outline: none; box-sizing: border-box; font-size: 15px; text-align: center; }
        input:focus { border-color: #ca8a04; }
        button { width: 100%; padding: 15px; background: linear-gradient(135deg, #ca8a04, #a16207); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; text-transform: uppercase; }
        .erro-msg { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; padding: 12px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; text-align: left; font-weight: bold; }
        .sucesso-msg { background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; color: #4ade80; padding: 12px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; text-align: center; line-height: 1.6; }
        .links { margin-top: 25px; font-size: 13px; border-top: 1px dashed #374151; padding-top: 15px; display: flex; justify-content: space-around; }
        .links a { color: #38bdf8; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2>Recuperar Acesso</h2>
    
    <?php if(count($erro) > 0) { foreach($erro as $msg) { echo "<p class='erro-msg'>⚠️ $msg</p>"; } } ?>
    <?php if($sucesso) { echo "<p class='sucesso-msg'>$sucesso</p>"; } ?>
    
    <form action="" method="POST">
        <div class="campo">
            <label for="email">Insira o E-mail registado:</label>
            <input type="email" name="email" id="email" required placeholder="gerente@aurelius.com ou cliente@gmail.com">
        </div>
        <button type="submit" name="recuperar_senha">Gerar Novas Credenciais</button>
        
        <div class="links" style="display: flex; flex-direction: column; gap: 10px; margin-top: 25px; border-top: 1px dashed #374151; padding-top: 15px;">
        <!-- 🔑 Direciona para o Painel Mercantil e Barbearias que usam PIN -->
        <p style="margin: 0;"><a href="login_parceiros.php" style="color: #38bdf8; font-size: 14px;">← Voltar ao Portal de Parceiros (Login por PIN)</a></p>
        <p style="font-size: 12px; color: #94a3b8; text-align: center; margin-bottom: 20px; line-height: 1.4;">
    <strong>Atenção Parceiro:</strong> Atualizámos o nosso sistema para sua segurança. <br>
    Se é a sua primeira vez neste painel, clique em <strong>Esqueci-me do meu PIN</strong> abaixo para gerar o seu código de acesso.
</p>
        <!-- 👤 Direciona apenas para os Clientes finais do Salão (Agendamentos) -->
        <p style="margin: 0;"><a href="Login.php" style="color: #94a3b8; font-size: 12px; font-weight: normal;">✕ Ir para Login de Clientes (E-mail e Senha)</a></p>
    </div>
    </form>
</div>
</body>
</html>