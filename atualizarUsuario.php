<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];

    // Atualiza as informações do usuário no banco de dados
    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, senha = ?, endereco = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $email, $telefone, $senha_hash, $endereco, $usuario_id);
    } else {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisi", $nome, $email, $telefone, $endereco, $usuario_id);
    }

    if ($stmt->execute()) {
        $_SESSION['mensagem_sucesso'] = "Informações atualizadas com sucesso!";
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao atualizar informações!";
    }

    $stmt->close();
    $conn->close();

    header("Location: usuario.php");
    exit();
}
?>
