<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO usuarios (nome, email, senha, telefone) VALUES ('$nome', '$email', '$senha', '$telefone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: registerAnimal.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
