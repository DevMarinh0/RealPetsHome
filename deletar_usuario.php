<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    // Obtém o ID do usuário
    $id = $_GET['id'];

    // Prepara a consulta para excluir o usuário do banco de dados
    $sql = "DELETE FROM usuarios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

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
?>
