<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, telefone = ?, endereco = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $email, $senha, $telefone, $endereco, $usuario_id);

    if ($stmt->execute()) {
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['endereco'] = $endereco;
        header("Location: usuario.php");
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
