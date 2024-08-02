<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $idade = $_POST['idade'];
        $descricao = $_POST['descricao'];
        $genero = $_POST['genero'];
        $opcao = $_POST['opcao'];
        $preco = $_POST['preco'];

        // Se uma nova foto foi enviada, faça o upload
        if ($_FILES['foto']['name']) {
            $foto = $_FILES['foto']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($foto);
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $foto_sql = "foto='$foto',";
            } else {
                echo "Erro ao mover o arquivo da foto.";
                $foto_sql = "";
            }
        } else {
            $foto_sql = "";
        }

        $sql = "UPDATE animais SET nome=?, especie=?, idade=?, descricao=?, genero=?, opcao_compra=?, preco=?, $foto_sql WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissdii", $nome, $especie, $idade, $descricao, $genero, $opcao, $preco, $id);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $sql = "SELECT * FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <h2>Editar Animal</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($animal['nome']); ?>" required>
        <label>Espécie:</label>
        <input type="text" name="especie" value="<?php echo htmlspecialchars($animal['especie']); ?>" required>
        <label>Idade:</label>
        <input type="text" name="idade" value="<?php echo htmlspecialchars($animal['idade']); ?>" required>
        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($animal['descricao']); ?>" required>
        <label>Gênero:</label>
        <input type="text" name="genero" value="<?php echo htmlspecialchars($animal['genero']); ?>" required>
        <label>Opção de Compra:</label>
        <input type="text" name="opcao" value="<?php echo htmlspecialchars($animal['opcao_compra']); ?>" required>
        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($animal['preco']); ?>" required>
        <label>Foto:</label>
        <input type="file" name="foto">
        <img src="uploads/<?php echo htmlspecialchars($animal['foto']); ?>" alt="Foto" style="width: 100px;">
        <input type="submit" value="Salvar">
    </form>
    <a href="admin_dashboard.php">Voltar</a>
</body>
</html>
