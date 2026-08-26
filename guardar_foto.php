<?php
// guardar_foto.php - Processador de Portfólio das Barbearias
include_once("Conexao.php");
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ficheiro_foto'])) {
    
    // Captura a identidade da barbearia que está a publicar a foto (Fallback ID 237 se não houver sessão)
    $id_barbearia = $_SESSION['id_usuario'] ?? ($_SESSION['codigo'] ?? ($_SESSION['loja_id'] ?? 237));
    $titulo = trim($_POST['titulo_foto']);
    
    $ficheiro = $_FILES['ficheiro_foto'];
    $nome_original = $ficheiro['name'];
    $extensao = strtolower(pathinfo($nome_original, PATHINFO_EXTENSION));
    
    // Cria um nome sefuro encriptado para evitar colisões no disco do Apache
    $novo_nome_ficheiro = "prod_" . time() . "_" . uniqid() . "." . $extensao;
    $pasta_destino = "uploads/" . $novo_nome_ficheiro;
    
    // Validação de segurança básica da imagem
    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'webp'];
    if (in_array($extensao, $extensoes_permitidas)) {
        
        if (move_uploaded_files_aurelius($ficheiro['tmp_name'], $pasta_destino)) {
            try {
                // Inserção na tabela anuncios configurando pontos_recompensa a zero
                $stmt = $pdo->prepare("INSERT INTO `anuncios` (id_barbearia, titulo, imagem, ativo, pontos_recompensa, data_publicacao) VALUES (?, ?, ?, 1, 10, NOW())");
                $stmt->execute([$id_barbearia, $titulo, $novo_nome_ficheiro]);
                
                echo "<script>
                        alert('🎉 Sucesso! A foto do seu trabalho foi publicada e já está visível no ranking da Página Principal!');
                        window.location.href = 'Dashboard.php';
                      </script>";
                exit();
            } catch (PDOException $e) {
                die("Erro ao registar a foto na tabela anuncios: " . $e->getMessage());
            }
        } else {
            echo "<script>alert('🚨 Erro: Falha ao mover o ficheiro para a pasta uploads.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Formato inválido! Carregue apenas ficheiros JPG, PNG ou WEBP.'); window.history.back();</script>";
    }
}

function move_uploaded_files_aurelius($tmp, $dest) { return move_uploaded_file($tmp, $dest); }
?>