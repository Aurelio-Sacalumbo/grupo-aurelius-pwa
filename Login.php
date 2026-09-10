<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . "/config/Banco.php";

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha   = trim($_POST['senha']);

    // Autenticação direta do Administrador Mestre (Aurélio)
    if ($usuario === "admin" && $senha === "aurelius2026") {
        $_SESSION['admin_logado'] = true;
        $_SESSION['usuario_nome'] = "Aurélio Sacalumbo";
        header("Location: Admini.php");
        exit();
    } else {
        $erro = "🚨 Credenciais de administrador inválidas!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Grupo Aurélius</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0f172a; color: white; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-box { background: #1e293b; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); text-align: center; width: 100%; max-width: 360px; border: 1px solid #334155; }
        h2 { color: #eab308; margin-bottom: 20px; font-size: 22px; text-transform: uppercase; }
        .campo { margin-bottom: 20px; text-align: left; }
        label { display: block; font-size: 12px; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px; font-weight: bold; }
        input { width: 100%; padding: 12px; border-radius: 6px; border: 1px solid #475569; background: #0f172a; color: white; outline: none; box-sizing: border-box; }
        input:focus { border-color: #eab308; }
        button { width: 100%; padding: 14px; background: #eab308; color: #0f172a; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; text-transform: uppercase; margin-top: 10px; }
        button:hover { background: #ca8a04; }
        .error { color: #f87171; font-size: 13px; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Painel Aurélius</h2>
        <?php if (!empty($erro)) echo "<p class='error'>$erro</p>"; ?>
        <form method="POST">
            <div class="campo">
                <label>Utilizador:</label>
                <input type="text" name="usuario" required placeholder="Ex: admin">
            </div>
            <div class="campo">
                <label>Palavra-passe:</label>
                <input type="password" name="senha" required placeholder="Digite a sua senha">
            </div>
            <button type="submit">Entrar no Painel</button>
        </form>
    </div>
</body>
</html>