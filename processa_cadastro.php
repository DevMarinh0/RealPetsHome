<?php
session_start();
include 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

    if ($stmt->execute()) {
        $_SESSION['usuario_id'] = $stmt->insert_id;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['endereco'] = $endereco;
        header("Location: registerAnimal.html");
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
