<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        $sql = "UPDATE usuarios SET nome=?, email=?, telefone=?, endereco=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $email, $telefone, $endereco, $id);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $sql = "SELECT * FROM usuarios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <h2>Editar Usuário</h2>
    <form action="" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" required>
        <label>Endereço:</label>
        <input type="text" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required>
        <input type="submit" value="Salvar">
    </form>
    <a href="admin_dashboard.php">Voltar</a>
</body>
</html>
