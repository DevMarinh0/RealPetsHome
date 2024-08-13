<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Obtém o ID do animal da URL
$id = $_GET['id'];

// Executa uma consulta para buscar todos os detalhes do animal pelo ID
$sql = "SELECT nome, especie, idade, descricao, genero, preco, foto, opcao_compra FROM animais WHERE id = $id";
$result = $conn->query($sql);

// Verifica se encontrou o animal
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $especie = $row['especie'];
    $idade = $row['idade'];
    $descricao = $row['descricao'];
    $genero = $row['genero'];
    $preco = $row['preco'];
    $foto = $row['foto'];
    $opcao_compra = $row['opcao_compra'];
} else {
    echo "Animal não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome; ?></title>
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
                <img src="../uploads/<?php echo $foto; ?>" alt="<?php echo $nome; ?>">
            </div>
            <div class="info">
                <h1><?php echo $nome; ?></h1>
                <p><strong>Espécie:</strong> <?php echo $especie; ?></p>
                <p><strong>Idade:</strong> <?php echo $idade; ?> anos</p>
                <p><strong>Gênero:</strong> <?php echo $genero; ?></p>
                <p><strong>Descrição:</strong> <?php echo $descricao; ?></p>
                <p><strong>Opção:</strong> <?php echo $opcao_compra; ?></p>
                <p><strong>Preço:</strong> R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
         
            </div>
        </div>
    </main>

    <!-- Footer -->
    
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
