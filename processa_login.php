<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php'; 

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o email e a senha fornecidos pelo usuário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para verificar se o usuário existe com o email e senha fornecidos
    $sql = "SELECT id, nome, telefone, endereco FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se um usuário correspondente for encontrado
    if ($result->num_rows > 0) {
        // Obtém os dados do usuário e armazena na sessão
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $usuario['telefone'];
        $_SESSION['endereco'] = $usuario['endereco'];

        // Redireciona para a página principal
        header("Location: index.php");
        exit();
    } else {
        // Se o usuário não for encontrado, redireciona para a página de erro
        header("location: lost.html");
        exit();
    }

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
