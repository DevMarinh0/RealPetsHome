<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php'; 

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados fornecidos pelo usuário no formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Prepara a consulta SQL para inserir os dados do novo usuário no banco de dados
    $sql = "INSERT INTO institucional (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

    // Executa a consulta SQL e verifica se a inserção foi bem-sucedida
    if ($stmt->execute()) {
        // Se bem-sucedido, armazena os dados do usuário na sessão
        $_SESSION['usuario_id'] = $stmt->insert_id; // Armazena o ID do novo usuário
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['endereco'] = $endereco;

        // Redireciona para a página principal
        header("Location: ../php/index.php");
        exit();
    } else {
        // Se houve um erro, exibe a mensagem de erro
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
