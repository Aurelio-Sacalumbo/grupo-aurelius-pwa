<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
date_default_timezone_set('Africa/Luanda');

$mysqli = new mysqli("127.0.0.1", "root", "", "aurelius_salao");
if ($mysqli->connect_error) { die("Falha na ligação: " . $mysqli->connect_error); }
$mysqli->set_charset("utf8");

// 🟢 GRAVAÇÃO CORRIGIDA DE CANDIDATURA (FIM DA FALHA DE REGISTO)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao_candidatura'])) {
    $id_barbearia = intval($_POST['id_barbearia_destino']);
    $nome         = $mysqli->real_escape_string($_POST['nome_barbeiro']);
    $telefone     = $mysqli->real_escape_string($_POST['telefone_barbeiro']);
    $experiencia  = $mysqli->real_escape_string($_POST['experiencia_texto']);

    $sqlInsert = "INSERT INTO pedidos_emprego (id_barbearia, nome_candidato, telefone, experiencia, data_envio) 
                  VALUES ($id_barbearia, '$nome', '$telefone', '$experiencia', NOW())";
    
    if ($mysqli->query($sqlInsert)) {
        echo "<script>alert('📋 Candidatura enviada com sucesso! O gerente foi notificado.'); window.location.href='vagas_emprego.php';</script>";
        exit;
    } else {
        die("Erro ao registar no banco: " . $mysqli->error);
    }
}

$vagas_ativas = $mysqli->query("SELECT v.*, u.nome AS nome_salao FROM vagas_trabalho v LEFT JOIN usuario u ON v.id_barbearia = u.codigo ORDER BY v.id DESC");
$barbearias_lista = $mysqli->query("SELECT codigo, nome FROM usuario WHERE transacao_status = 'Confirmado' ORDER BY nome ASC");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Bolsa de Emprego Aurélius - Huambo</title>
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Segoe UI', Arial, sans-serif; padding: 20px; }
        .container-vagas { max-width: 900px; margin: 0 auto; }
        .header-vagas { text-align: center; margin-bottom: 30px; background: linear-gradient(135deg, #1e3a8a, #0f172a); padding: 25px; border-radius: 12px; border: 2px solid #38bdf8; }
        .tabs-control { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        .tab-btn { background: #1e293b; border: 1px solid #475569; color: #94a3b8; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 13px; }
        .tab-btn.active { background: #38bdf8; color: #0f172a; border-color: #38bdf8; }
        .painel-conteudo { display: none; }
        .painel-conteudo.active { display: block; }
        .card-vaga { background: #111827; border: 1px solid #1e293b; border-radius: 10px; padding: 20px; margin-bottom: 15px; text-align: left; }
        .form-control { width: 100%; background: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 12px; color: white; box-sizing: border-box; margin-top: 5px; margin-bottom: 15px; }
        .btn-submeter { background: linear-gradient(135deg, #38bdf8, #0284c7); color: #0f172a; border: none; padding: 14px; border-radius: 6px; font-weight: bold; cursor: pointer; width: 100%; text-transform: uppercase; font-size: 13px; }
    </style>
</head>
<body>
<div class="container-vagas">
    <div class="header-vagas">
        <h2 style="color: #38bdf8; margin: 0 0 6px 0; text-transform: uppercase;">💼 Portal de Oportunidades & Emprego</h2>
        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Liga profissionais de estética aos salões líderes da província do Huambo.</p>
    </div>

    <!-- 🟢 1º REQUISITO: ABA DO GERENTE TOTALMENTE OCULTADA DOS CLIENTES -->
    <div class="tabs-control">
        <button id="btn-vagas" class="tab-btn active" onclick="mudarAba('vagas')">📢 Vagas Abertas na Região</button>
        <button id="btn-candidatar" class="tab-btn" onclick="mudarAba('candidatar')">✍️ Enviar Ficha de Candidatura</button>
    </div>

    <div id="aba-vagas" class="painel-conteudo active">
        <?php if ($vagas_ativas && $vagas_ativas->num_rows > 0): ?>
            <?php while($vaga = $vagas_ativas->fetch_assoc()): ?>
                <div class="card-vaga">
                    <h3 style="color: #38bdf8; margin: 0 0 4px 0; font-size: 18px; text-transform: uppercase;"><?= htmlspecialchars($vaga['cargo']); ?></h3>
                    <h4 style="color: #eab308; margin: 0 0 12px 0; font-size: 14px;">💈 Fornecedor: <?= htmlspecialchars($vaga['nome_salao']); ?></h4>
                    <p style="font-size: 13px; margin: 0 0 8px 0;">💰 <strong>Remuneração:</strong> <?= htmlspecialchars($vaga['salario']); ?></p>
                    <p style="font-size: 13px; color: #94a3b8; margin: 0;">📝 <strong>Requisitos:</strong> <?= nl2br(htmlspecialchars($vaga['requisitos'])); ?></p>
                    <button class="btn-submeter" style="margin-top: 15px; padding: 10px; font-size: 11px;" onclick="candidatarSeParaVaga(<?= $vaga['id_barbearia']; ?>)">Candidatar-me a este Salão</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #94a3b8; text-align: center; padding: 40px; font-style: italic; background: #111827; border-radius: 10px;">Nenhuma vaga listada de momento.</p>
        <?php endif; ?>
    </div>

    <div id="aba-candidatar" class="painel-conteudo">
        <div class="card-vaga">
            <h3 style="color: #38bdf8; margin-bottom: 20px; text-transform: uppercase; font-size: 15px;">✍️ Enviar Ficha ao Recrutamento</h3>
            <form action="vagas_emprego.php" method="POST">
                <input type="hidden" name="acao_candidatura" value="1">
                <label>Selecione a Barbearia Alvo:</label>
                <select name="id_barbearia_destino" id="id_barbearia_destino" class="form-control" taxed required>
                    <option value="">Selecione o salão...</option>
                    <?php if($barbearias_lista): while($b = $barbearias_lista->fetch_assoc()): ?>
                        <option value="<?= $b['codigo']; ?>"><?= htmlspecialchars($b['nome']); ?></option>
                    <?php endwhile; endif; ?>
                </select>
                <label>Teu Nome Completo:</label>
                <input type="text" name="nome_barbeiro" class="form-control" required>
                <label>Contacto Telefónico:</label>
                <input type="number" name="telefone_barbeiro" class="form-control" required>
                <label>Resumo de Competências:</label>
                <textarea name="experiencia_texto" class="form-control" rows="4" required></textarea>
                <button type="submit" class="btn-submeter">Submeter Ficha de Barbeiro</button>
            </form>
        </div>
    </div>
</div>
<script>
function mudarAba(nomeAba) {
    document.querySelectorAll('.painel-conteudo').forEach(function(p) { p.classList.remove('active'); });
    document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
    document.getElementById('aba-' + nomeAba).classList.add('active');
    document.getElementById('btn-' + nomeAba).classList.add('active');
}
function candidatarSeParaVaga(id) { mudarAba('candidatar'); document.getElementById('id_barbearia_destino').value = id; }
</script>
</body>
</html>