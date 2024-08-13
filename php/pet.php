<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID foi passado pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do animal não especificado.");
}

$id = $_GET['id'];

// Prepara e executa a consulta para buscar todos os detalhes do animal e o nome e telefone do usuário que fez a postagem
$sql = "SELECT a.nome AS animal_nome, a.especie, a.idade, a.descricao, a.genero, a.preco, a.foto, a.opcao_compra, u.nome AS usuario_nome, u.telefone AS usuario_telefone 
        FROM animais a
        JOIN usuarios u ON a.usuario_id = u.id
        WHERE a.id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o animal
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['animal_nome'];
    $especie = $row['especie'];
    $idade = $row['idade'];
    $descricao = $row['descricao'];
    $genero = $row['genero'];
    $preco = $row['preco'];
    $foto = $row['foto'];
    $opcao_compra = $row['opcao_compra'];
    $usuario_nome = $row['usuario_nome'];
    $usuario_telefone = $row['usuario_telefone'];
} else {
    die("Animal não encontrado. Verifique se o ID fornecido é válido.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nome); ?></title>
    <link rel="stylesheet" href="../css/pet.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <a href="../php/index.php">Home</a>
            <a href="../php/usuario.php">Usuario</a>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="container">
        <div class="animal-detail">
            <div class="image">
                <img src="../uploads/<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($nome); ?>">
            </div>
            <div class="info">
                <h1><?php echo htmlspecialchars($nome); ?></h1>
                <p><strong>Espécie:</strong> <?php echo htmlspecialchars($especie); ?></p>
                <p><strong>Idade:</strong> <?php echo htmlspecialchars($idade); ?> anos</p>
                <p><strong>Gênero:</strong> <?php echo htmlspecialchars($genero); ?></p>
                <p><strong>Descrição:</strong> <?php echo htmlspecialchars($descricao); ?></p>
                <p><strong>Opção:</strong> <?php echo htmlspecialchars($opcao_compra); ?></p>
                <p><strong>Preço:</strong> R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                <p><strong>Postado por:</strong> 
                <a href="https://wa.me/<?php echo htmlspecialchars($usuario_telefone); ?>" target="_blank">
                <?php echo htmlspecialchars($usuario_nome); ?>
                </a> 
                (<?php echo htmlspecialchars($usuario_telefone); ?>)
                </p>

            </div>
        </div>
    </main>
    
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
