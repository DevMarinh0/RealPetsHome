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

    // Verifica se o e-mail já está cadastrado no banco de dados
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Se o e-mail já existe, redireciona para uma página de erro
        header("Location: ../html/user_existente.html");
        exit();
    }

    // Prepara a consulta SQL para inserir os dados do novo usuário no banco de dados
    $stmt->close();
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
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
        header("Location: index_user.php");
        exit();
    } else {
        // Se houve um erro, redireciona para a página "lost.html"
        header("Location: lost.html");
        exit();
    }

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
