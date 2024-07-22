<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: login.html");
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
