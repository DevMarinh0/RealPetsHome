<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if ($result->num_rows > 0) {
        echo "Email já cadastrado!";
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

        if ($stmt->execute()) {
            header("Location: login.html");
        } else {
            echo "Erro ao cadastrar!";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
