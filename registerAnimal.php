<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $opcao = $_POST['opcao'];
    $preco = $_POST ['preco'];
    // Tratamento do upload da imagem
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Insere os dados no banco de dados
        $sql = "INSERT INTO animais (nome, especie, idade, descricao, genero, foto, opcao_compra,preco) 
                VALUES ('$nome', '$especie', $idade, '$descricao', '$genero', '$foto', '$opcao','$preco')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo registro criado com sucesso";
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erro ao mover o arquivo da foto.";
    }

    $conn->close();
}
?>
