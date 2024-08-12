<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtém o ID do usuário

    // Verifica se o formulário foi enviado (método POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtém os dados enviados pelo formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        // Prepara a consulta SQL para atualizar o usuário no banco de dados
        $sql = "UPDATE usuarios SET nome=?, email=?, telefone=?, endereco=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $email, $telefone, $endereco, $id);

        // Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            // Redireciona para o painel de administração em caso de sucesso
            header("Location: ../php/admin_dashboard.php");
            exit();
        } else {
            // Exibe uma mensagem de erro se houver falha na execução
            echo "Erro: " . $stmt->error;
        }
    }

    // Prepara a consulta SQL para buscar os dados do usuário a ser editado
    $sql = "SELECT * FROM usuarios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    // Obtém os dados do usuário como um array associativo
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
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <script>
        // Função para confirmar salvamento
        function confirmarSalvamento(event) {
            if (!confirm("Tem certeza que deseja salvar as alterações?")) {
                event.preventDefault(); // Cancela a ação se o usuário não confirmar
            }
        }

        // Adiciona o evento ao carregar a página
        window.onload = function() {
            document.querySelector('.btn-edit').addEventListener('click', confirmarSalvamento);
        }
    </script>
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
        <input type="submit" class="btn-edit" value="Salvar">
    </form>
    <a href="admin_dashboard.php">Voltar</a>
</body>
</html>
