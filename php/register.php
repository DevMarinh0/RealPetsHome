<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Verifica se o email já está cadastrado
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se o email já estiver cadastrado, exibe uma mensagem
    if ($result->num_rows > 0) {
        echo "Email já cadastrado!";
    } else {
        // Se o email não estiver cadastrado, insere o novo usuário
        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

        // Executa a inserção e redireciona para a página de login em caso de sucesso
        if ($stmt->execute()) {
            header("Location: ../html/login.html");
            exit();
        } else {
            // Exibe uma mensagem de erro caso a inserção falhe
            echo "Erro ao cadastrar!";
        }
    }

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
