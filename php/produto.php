<?php
// Incluir o script de conexão
include 'conexao.php'; // Ajuste o caminho conforme necessário

// Buscar produtos patrocinadores
$sql = 'SELECT id, nome, preco, descricao, foto FROM produtosPatrocinadores';
$result = $conn->query($sql);

if ($result === false) {
    die('Erro na consulta: ' . $conn->error);
}

$produtos = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Patrocinadores</title>
    <link rel="stylesheet" href="../css/produto.css">
</head>
<body>
    <header>
        <h1>Nosso Catálogo de Produtos Dos Patrocinadores</h1>
    </header>

    <section class="produtos-container">
        <?php foreach ($produtos as $produto): ?>
        <a href="produto_detalhado.php?id=<?php echo htmlspecialchars($produto['id']); ?>" class="card">
            <!-- Ajuste o caminho para a pasta uploadsPatrocinador -->
            <img src="../uploadsPatrocinador/<?php echo htmlspecialchars($produto['foto']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
            <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
            <span class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
        </a>
        <?php endforeach; ?>
    </section>
</body>
</html>
