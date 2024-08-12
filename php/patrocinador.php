<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Inicializa uma variável para armazenar o patrocinador
$patrocinador = [];

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
        'endereco' => 'Endereço Exemplo',
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

        <!-- Produtos -->
        <section id="products">
            <h2>Produtos</h2>
            <div class="product">
                <h3>Produto 1</h3>
                <p>Descrição do Produto 1. Este produto é conhecido por sua alta qualidade e durabilidade.</p>
            </div>
            <div class="product">
                <h3>Produto 2</h3>
                <p>Descrição do Produto 2. Ideal para quem busca inovação e design moderno.</p>
            </div>
            <div class="product">
                <h3>Produto 3</h3>
                <p>Descrição do Produto 3. Uma escolha perfeita para o dia a dia.</p>
            </div>
        </section>

        <!-- Serviços -->
        <section id="services">
            <h2>Serviços</h2>
            <div class="service-card">
                <h3>Serviço 1</h3>
                <p>Oferecemos consultoria especializada para ajudar nossos clientes a escolherem os melhores produtos
                    para suas necessidades.</p>
            </div>
            <div class="service-card">
                <h3>Serviço 2</h3>
                <p>Nosso serviço de entrega é rápido e eficiente, garantindo que seus produtos cheguem em perfeito
                    estado.</p>
            </div>
            <div class="service-card">
                <h3>Serviço 3</h3>
                <p>Disponibilizamos suporte técnico para auxiliar com qualquer dúvida ou problema relacionado aos nossos
                    produtos.</p>
            </div>
        </section>
    </main>
</body>

</html>
