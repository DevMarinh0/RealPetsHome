<?php
// Incluindo a conexão com o banco de dados
include('conexao.php');

// Obtendo os valores enviados pelo formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$localizacao = $_POST['localizacao'];

// Inserindo os dados na tabela patrocinadores
$sql = "INSERT INTO patrocinadores (nome, email, telefone, localizacao) 
        VALUES ('$nome', '$email', '$telefone', '$localizacao')";

if (mysqli_query($conn, $sql)) {
    // Redirecionando para uma página de sucesso
    header("Location: ../html/patrocinador.html");
} else {
    // Exibindo mensagem de erro
    echo "Erro ao cadastrar: " . mysqli_error($conn);
}

// Fechando a conexão com o banco de dados
mysqli_close($conn);
?>
