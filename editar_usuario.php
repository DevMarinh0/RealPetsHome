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
            header("Location: admin_dashboard.php");
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
