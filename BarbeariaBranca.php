<?php
// =========================================================================
// 💈 GATEWAY DE LOGIN UNIFICADO MULTI-TENANT - ECOSSISTEMA AURÉLIUS
// =========================================================================
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
date_default_timezone_set('Africa/Luanda');

// Liga à base de dados centralizada do Grupo Aurélius
include("conect.php");

$erro = array(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && strlen($_POST['email']) > 0) {
    
    // 🧹 Limpa os dados de sessões antigas para evitar contaminações cruzadas
    session_unset();

    $email = trim($_POST['email']);
    $senha_digitada = trim($_POST['senha']);

    try {
        // Busca o utilizador/parceiro pelo e-mail na tabela unificada 'usuario'
        $stmt = $mysqli->prepare("SELECT codigo, nome, senha, nivel FROM `usuario` WHERE `email` = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado && $resultado->num_rows > 0) {
            $dado = $resultado->fetch_assoc();
            
            // 🛡️ VALIDAÇÃO CRIPTOGRÁFICA PROFISSIONAL (Suporta hashes seguros e fallback MD5 legados)
            $senha_valida = false;
            if (password_verify($senha_digitada, $dado['senha'])) {
                $senha_valida = true;
            } elseif (md5($senha_digitada) === $dado['senha'] || $senha_digitada === $dado['senha']) {
                $senha_valida = true;
                // [Opcional] No futuro pode atualizar o campo para password_hash aqui para aumentar a segurança
            }

            if ($senha_valida) {
                // 🎯 ISOLAMENTO MULTI-TENANT: Grava apenas as informações da empresa ativa
                $_SESSION['empresa_codigo']      = $dado['codigo'];
                $_SESSION['nome_usuario']        = $dado['nome'];
                $_SESSION['tipo_acesso']         = $dado['nivel']; // parceiro_hospedado, admin, etc.
                
                // Visto mestre para moderação interna da barbearia logada
                $_SESSION['gerente_autenticado'] = true; 
                
                // Compatibilidade redundante de variáveis do ecossistema SaaS
                $_SESSION['parceiro_id']         = $dado['codigo'];
                $_SESSION['parceiro_name']       = $dado['nome']; 
                
                session_write_close(); 
                
                // Redirecionamento dinâmico e isolado baseado no ID único do banco
                header("Location: Dashboard.php?id=" . intval($dado['codigo']));
                exit();
            } else {
                $erro[] = "E-mail ou Palavra-passe incorretos no sistema.";
            }
        } else {
            $erro[] = "E-mail ou Palavra-passe incorretos no sistema.";
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        $erro[] = "Erro de infraestrutura técnica de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Acesso - Grupo Aurélius</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0b0f19; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; box-sizing: border-box; }
        .container { width: 100%; max-width: 450px; background: #111827; padding: 50px 40px; border-radius: 40px; text-align: center; color: white; border: 2px solid #22c55e; box-shadow: 0 0 20px rgba(34, 197, 94, 0.4); position: relative; }
        .container h2 { margin: 0 0 10px 0; color: #ffffff; font-size: 22px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
        .sub-tag { font-size: 11px; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 30px; letter-spacing: 0.5px; border-bottom: 2px solid rgba(34, 197, 94, 0.2); padding-bottom: 12px; }
        .campo-form { margin-bottom: 22px; text-align: left; }
        .campo-form label { font-weight: bold; display: block; margin-bottom: 10px; font-size: 13px; color: #a7f3d0; text-transform: uppercase; }
        .campo-form input { width: 100%; padding: 15px 18px; border: 1px solid #374151; border-radius: 25px; box-sizing: border-box; font-size: 16px; background: #0b0f19; color: #ffffff; outline: none; }
        .campo-form input:focus { border-color: #22c55e; box-shadow: 0 0 8px rgba(34, 197, 94, 0.3); }
        .btn-enviar { width: 100%; background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; padding: 16px; cursor: pointer; font-size: 16px; border-radius: 25px; font-weight: bold; margin-top: 15px; text-transform: uppercase; transition: all 0.2s; }
        .btn-enviar:hover { background: linear-gradient(135deg, #4ade80, #22c55e); transform: translateY(-2px); }
        .erro-msg { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; padding: 12px; border-radius: 20px; font-size: 13px; margin-bottom: 20px; font-weight: bold; }
        .btn-fechar-top { position: absolute; top: 20px; right: 20px; width: 32px; height: 32px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-weight: bold; }
        .links { margin-top: 30px; font-size: 13px; border-top: 1px dashed #374151; padding-top: 20px; }
        .links a { color: #22c55e; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <a href="Principal.php" class="btn-fechar-top" title="Voltar ao Portal">✕</a>
    <h2>AURÉLIUS PORTAL</h2>
    <span class="sub-tag">Autenticação Unificada de Barbearias & Lojas</span>

    <?php
    if(isset($erro) && is_array($erro) && count($erro) > 0){
        foreach($erro as $msg){
            echo "<p class='erro-msg'>⚠️ " . htmlspecialchars($msg) . "</p>";
        }
    }
    ?>

    <form action="" method="POST">
        <div class="campo-form">
            <label for="email">E-mail de Acesso Corporativo:</label>
            <input type="email" name="email" id="email" required placeholder="Ex: gerencia@branca.com" value="<?php echo isset($_POST['email'])? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>

        <div class="campo-form">
            <label for="senha">Palavra-passe Privada:</label>
            <input type="password" name="senha" id="senha" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-enviar">Entrar no Ecossistema →</button>
        
        <div class="links">
            <p><a href="recuperar.php">Esqueceu as suas credenciais?</a></p>
            <p style="color: #9ca3af;">Deseja registar o seu salão parceiro? <a href="BrancaCadastar.php">Cadastre-se aqui</a></p>
        </div>
    </form>
</div>

</body>
</html>