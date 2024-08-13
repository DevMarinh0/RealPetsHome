<?php
// Incluir o script de conexão
include 'conexao.php';

// Buscar produtos patrocinadores
$sql = 'SELECT nome, preco, descricao, foto FROM produtospatrocinadores';
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Patrocinadores</title>
    <link rel="stylesheet" href="produto.css">
</head>
<body>
    <header>
        <h1>Nosso Catálogo de Produtos Patrocinadores</h1>
    </header>

    <section class="produtos-container">
        <?php foreach ($produtos as $produto): ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($produto['foto']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
            <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
            <span class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
        </div>
        <?php endforeach; ?>
    </section>
</body>
</html>
