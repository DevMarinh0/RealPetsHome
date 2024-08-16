<?php
// Incluir o script de conexão
include 'conexao.php';

// Verificar se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Buscar os detalhes do produto e o telefone do institucional pelo ID
    $sql = "SELECT p.*, i.telefone AS institucional_telefone
            FROM produtosPatrocinadores p
            LEFT JOIN institucional i ON i.id = (SELECT institucional_id FROM produtosPatrocinadores WHERE id = p.id)
            WHERE p.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID do produto não fornecido!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto - <?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="../css/produto_detalhado.css">
</head>
<body>
    <header>
        <a href="patrocinador.php" class="voltar-link">Home</a>
        <h1>Detalhes do Produto</h1>
        <a href="produto.php" class="usuario-link">Produtos</a>
    </header>

    <div class="produto-detalhe">
        <div class="imagem">
            <img src="../uploadsPatrocinador/<?php echo htmlspecialchars($produto['foto']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
        </div>
        <div class="informacoes">
            <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
            <p><strong>Descrição:</strong> <?php echo htmlspecialchars($produto['descricao']); ?></p>
            <p><strong>Preço:</strong> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            <p><strong>Telefone do Institucional:</strong> <?php echo htmlspecialchars($produto['institucional_telefone']); ?></p>
            <a href="https://wa.me/<?php echo urlencode(preg_replace('/[^0-9]/', '', $produto['institucional_telefone'])); ?>" target="_blank">Entre em contato via WhatsApp</a>
        </div>
    </div>
</body>
</html>
