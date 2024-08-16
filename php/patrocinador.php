<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Inicializa uma variável para armazenar o patrocinador
$patrocinador = [];
// Buscar produtos patrocinadores
$sql = 'SELECT id, nome, preco, descricao, foto FROM produtosPatrocinadores';
$result = $conn->query($sql);
$produtos = $result->fetch_all(MYSQLI_ASSOC);

// Executa a consulta SQL para buscar um patrocinador
$sql = "SELECT * FROM patrocinadores LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Busca o primeiro registro da tabela
    $patrocinador = $result->fetch_assoc();
} else {
    // Caso não haja resultados, você pode definir valores padrão
    $patrocinador = [
        'nome' => 'Nome do Patrocinador',
        'localizacao' => 'Endereço Exemplo',
        'telefone' => '(00) 1234-5678',
        'email' => 'exemplo@patrocinador.com'
    ];
}

// Fecha a conexão
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/patrocinador.css" />
    <title>Patrocinador</title>
    <link rel="shortcut icon" href="../assets/Cat and dog-cuate 1.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="header-info">
            <h1 id="sponsor-name">
                <?php echo htmlspecialchars($patrocinador['nome']); ?>
            </h1>
            <p id="location">
                <?php echo htmlspecialchars('Localização Física: ' . $patrocinador['localizacao']); ?>
            </p>
            <p id="phone">
                <?php echo htmlspecialchars('Telefone: ' . $patrocinador['telefone']); ?>
            </p>
            <p id="email">
                <?php echo htmlspecialchars('Email: ' . $patrocinador['email']); ?>
            </p>
        </div>
        <div class="header-links">
            <a href="../html/FormPatrocinador.html">Link para o Formulário</a>
            <a href="../php/Produto.php">Link para ver Todos os Produtos</a>
            <a href="../html/FormProduto.html">Link para Adicionar os Produtos</a>
        </div>
    </header>

    <main>
        <!-- Sobre Nós -->
        <section id="about-us">
            <h2>Sobre Nós</h2>
            <p>Somos uma empresa dedicada a oferecer os melhores produtos e serviços para nossos clientes. Com anos de
                experiência no mercado, estamos sempre em busca de inovação e excelência.</p>
            <p>Nossa missão é atender às necessidades dos nossos clientes com produtos de alta qualidade e um
                atendimento excepcional.</p>
        </section>
    <!-- Seção de Produtos -->
    <h2>Produtos</h2>
    <div class="produtos-wrapper">
        <?php foreach ($produtos as $produto): ?>
        <div class="produtos-container">
            <a href="produto_detalhado.php?id=<?php echo htmlspecialchars($produto['id']); ?>" class="card">
                <!-- Ajuste o caminho para a pasta uploadsPatrocinador -->
                <img src="../uploadsPatrocinador/<?php echo htmlspecialchars($produto['foto']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                <span class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</main>

</body>

</html>
