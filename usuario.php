<?php
session_start();
include 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT nome, email, telefone, endereco FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $nome = $usuario['nome'];
    $email = $usuario['email'];
    $telefone = $usuario['telefone'];
    $endereco = $usuario['endereco'];
} else {
    echo "Usuário não encontrado!";
    exit();
}

$stmt->close();
$conn->close();

// Inclui o arquivo HTML
include 'usuario.html';
?>
