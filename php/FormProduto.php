<?php
// Incluir o script de conexão
include '../caminho/para/conexao.php'; // Ajuste o caminho conforme necessário

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $foto = $_FILES['foto']['name'];

    // Definir o caminho para salvar a imagem
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($foto);

    // Mover a imagem para o diretório de uploads
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Inserir os dados no banco de dados
        $sql = 'INSERT INTO produtosPatrocinadores (nome, preco, descricao, foto) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sdds', $nome, $preco, $descricao, $target_file);
        
        if ($stmt->execute()) {
            echo 'Produto adicionado com sucesso!';
        } else {
            echo 'Erro ao adicionar produto: ' . $conn->error;
        }
    } else {
        echo 'Erro ao enviar a imagem.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="adicionar_produto.css">
</head>
<body>
    <header>
        <h1>Adicionar Novo Produto</h1>
    </header>

    <section class="form-container">
        <form action="adicionar_produto.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required></textarea>

            <label for="foto">Foto do Produto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <button type="submit">Adicionar Produto</button>
        </form>
    </section>
</body>
</html>
